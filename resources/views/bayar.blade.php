<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran QRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle at top, #f0f4ff, #e2e8f0);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-6 font-sans">

    <div
        class="backdrop-blur-lg bg-white/80 border border-gray-200 shadow-xl rounded-3xl w-full max-w-2xl p-8 transition-all duration-300">
        <div class="text-center mb-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 tracking-tight mb-1">
                💸 Pembayaran Tagihan
            </h2>
            <p class="text-sm text-gray-500">Gunakan QRIS dan konfirmasi bukti pembayaran Anda</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm sm:text-base text-gray-700 mb-6">
            <div>
                <p><span class="font-medium">👤 Nama:</span> {{ $tagihan->pelanggan->nama_pelanggan }}</p>
                <p><span class="font-medium">📅 Periode:</span> {{ $tagihan->bulan }} {{ $tagihan->tahun }}</p>
            </div>
            <div>
                <p><span class="font-medium">⚡ Pemakaian:</span> {{ $tagihan->jumlah_meter }} kWh</p>
                <p><span class="font-medium">💰 Total:</span> Rp {{ number_format($tagihan->total_bayar) }}</p>
            </div>
        </div>

        <div class="text-center mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">🔳 Scan QRIS di bawah ini</h3>
            <img src="{{ asset('img/qris.jpg') }}" alt="QRIS"
                class="w-52 sm:w-60 mx-auto rounded-lg shadow-md border border-gray-300 transition hover:scale-105" />
            <p class="text-xs text-gray-500 mt-2 italic">Screenshot bukti transfer setelah pembayaran berhasil</p>
        </div>
        <form action="{{ route('bayar', ['id' => $tagihan->id_tagihan]) }}" id="form-pembayaran" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf

            <!-- Hidden Inputs -->
            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">
            <input type="hidden" name="id_pelanggan" value="{{ $tagihan->pelanggan->id_pelanggan }}">
            <input type="hidden" name="id_user" value="{{ $tagihan->id_user }}">
            <input type="hidden" name="total_bayar" value="{{ $tagihan->total_bayar }}">
            <input type="hidden" name="tanggal_pembayaran" id="tanggal_pembayaran">

            <!-- Upload Bukti -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📎 Upload Bukti Pembayaran :</label>
                <input type="file" name="bukti" accept="image/*" required
                    class="block w-full rounded-xl border border-dashed border-gray-300 bg-gray-100 text-gray-400 shadow-sm p-2" />
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold px-4 py-3 rounded-xl shadow-md transition-all duration-200">
                ✅ Konfirmasi Pembayaran
            </button>
        </form>

        <div class="pt-6 text-center">
            <a href="#"
                class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm gap-1 transition">
                ⬅️ <span>Kembali ke Daftar Tagihan</span>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('form-pembayaran').addEventListener('submit', function() {
            const today = new Date();
            const tanggal = today.toISOString().split('T')[0]; // format YYYY-MM-DD
            document.getElementById('tanggal_pembayaran').value = tanggal;
        });
    </script>
</body>

</html>
