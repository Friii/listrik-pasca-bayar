from flask import Flask, request, jsonify
import requests
import mysql.connector
from flask_cors import CORS
import re
from datetime import datetime

app = Flask(__name__)
CORS(app)

# --- KONEKSI DATABASE (Tidak ada perubahan) ---
try:
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="listrik_pascabayar",
        pool_name="mypool",
        pool_size=5
    )
except mysql.connector.Error as err:
    print(f"Error connecting to database: {err}")
    db = None

def get_riwayat_tagihan(id_pelanggan, limit=5):
    if not db or not db.is_connected():
        return None
    cursor = db.cursor(dictionary=True)
    cursor.execute("""
        SELECT bulan, tahun, jumlah_meter, total_bayar
        FROM tagihans
        WHERE id_pelanggan = %s
        ORDER BY tahun DESC, bulan DESC
        LIMIT %s
    """, (id_pelanggan, limit))
    return cursor.fetchall()


def get_pelanggan_data(id_pelanggan):
    if not db or not db.is_connected():
        return None
    cursor = db.cursor(dictionary=True)
    cursor.execute("""
        SELECT p.nama_pelanggan, t.bulan, t.jumlah_meter, t.total_bayar
        FROM pelanggans p
        JOIN tagihans t ON p.id_pelanggan = t.id_pelanggan
        WHERE p.id_pelanggan = %s
        ORDER BY t.tahun DESC, t.bulan DESC
        LIMIT 1
    """, (id_pelanggan,))
    return cursor.fetchone()

def get_tagihan_bulan_ini(id_pelanggan):
    if not db or not db.is_connected():
        return None
    now = datetime.now()
    cursor = db.cursor(dictionary=True)
    cursor.execute("""
        SELECT bulan, tahun, jumlah_meter, total_bayar
        FROM tagihans
        WHERE id_pelanggan = %s AND bulan = %s AND tahun = %s
        LIMIT 1
    """, (id_pelanggan, now.month, now.year))
    return cursor.fetchone()


def hitung_simulasi(jumlah_meter):
    if not db or not db.is_connected():
        return None
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT tarifperkwh FROM tarifs ORDER BY id_tarif DESC LIMIT 1")
    tarif = cursor.fetchone()
    if not tarif:
        return None
    total_bayar = jumlah_meter * tarif["tarifperkwh"]
    return {
        "jumlah_meter": jumlah_meter,
        "tarifperkwh": tarif["tarifperkwh"],
        "total_bayar": total_bayar
    }

@app.route("/chat-bot", methods=["POST"])
def chat():
    user_input = request.json.get("message")
    id_pelanggan = request.json.get("id_pelanggan")

    if not user_input or not id_pelanggan:
        return jsonify({"response": "Terjadi kesalahan, input tidak lengkap."}), 400

    lower_input = user_input.lower()
    
    sapaan = ["halo", "hai", "hi", "selamat pagi", "selamat siang", "selamat sore", "selamat malam"]
    if any(s in lower_input for s in sapaan):
        pelanggan = get_pelanggan_data(id_pelanggan)
        nama = pelanggan['nama_pelanggan'].split()[0] if pelanggan else ""
        return jsonify({"response": f"Halo {nama}, saya Wattly. Ada yang bisa saya bantu terkait tagihan listrik Anda?"})

    if "riwayat" in lower_input or "5 bulan" in lower_input:
        tagihan_list = get_riwayat_tagihan(id_pelanggan)
        if not tagihan_list:
            return jsonify({"response": "Belum ada data tagihan untuk Anda."})
        response_text = "📊 Riwayat 5 Tagihan Terakhir Anda:\n"
        for tagihan in tagihan_list:
            response_text += f"- {tagihan['bulan']} {tagihan['tahun']}: {tagihan['jumlah_meter']} kWh - Rp {tagihan['total_bayar']:,}\n"
        return jsonify({"response": response_text})

    if "tagihan bulan ini" in lower_input or "berapa tagihan saya" in lower_input:
        tagihan_bulan_ini = get_tagihan_bulan_ini(id_pelanggan)
        if tagihan_bulan_ini:
            response_text = (
                f"Tagihan listrik Anda bulan {tagihan_bulan_ini['bulan']} "
                f"{tagihan_bulan_ini['tahun']} adalah Rp {tagihan_bulan_ini['total_bayar']:,} "
                f"dengan penggunaan {tagihan_bulan_ini['jumlah_meter']} kWh."
            )
        else:
            response_text = "Maaf, data tagihan bulan ini belum tersedia."
        return jsonify({"response": response_text})
    
    match = re.search(r'(\d+)\s*(kwh|k\.?w\.?h?)', lower_input)
    if "simulasi" in lower_input or match:
        jumlah_meter = int(match.group(1)) if match else 0
        if jumlah_meter == 0:
            return jsonify({"response": "Mohon masukkan jumlah pemakaian kWh untuk simulasi, contoh: 'simulasi 100 kWh'."})
        hasil = hitung_simulasi(jumlah_meter)
        if not hasil:
            return jsonify({"response": "Gagal mengambil data tarif listrik dari sistem."})
        return jsonify({
            "response": f"🔢 Simulasi Tagihan:\n- Jumlah Meter: {hasil['jumlah_meter']} kWh\n- Tarif per kWh: Rp {hasil['tarifperkwh']:,}\n- Total Bayar: Rp {hasil['total_bayar']:,}"
        })

    pelanggan = get_pelanggan_data(id_pelanggan)
    if not pelanggan:
        return jsonify({"response": "Maaf, data pelanggan tidak ditemukan."})

    prompt = f"""Kamu adalah asisten virtual bernama Wattly yang membantu pelanggan listrik dengan ramah. Jangan bertele-tele. Jawab pertanyaan berdasarkan data ini. Jika tidak relevan, katakan tidak tahu.
Data Pelanggan:
Nama: {pelanggan['nama_pelanggan']}
Tagihan Terakhir ({pelanggan['bulan']}): {pelanggan['jumlah_meter']} kWh sejumlah Rp {pelanggan['total_bayar']}
Pertanyaan Pelanggan: {user_input}
Jawaban Wattly:"""

    try:
        nama_model_ai = "gemma:2b"
        
        res = requests.post("http://localhost:11434/api/generate", json={
            "model": nama_model_ai,
            "prompt": prompt,
            "stream": False
        }, timeout=20)
        
        res.raise_for_status()
        
        data = res.json()
        return jsonify({"response": data.get("response", "Maaf, saya tidak mengerti maksud Anda.")})

    except requests.exceptions.RequestException as e:
        print(f"Error connecting to Ollama: {e}")
        return jsonify({"response": "Maaf, sistem AI sedang sibuk. Silakan coba lagi beberapa saat."}), 500
    
    return jsonify({"response": "Maaf, saya tidak dapat memproses permintaan Anda saat ini."})


if __name__ == "__main__":
    app.run(port=5000, debug=True)