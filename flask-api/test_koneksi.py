import mysql.connector

try:
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="listrik_pascabayar"
    )
    print("Koneksi sukses")
except mysql.connector.Error as err:
    print(f"Error: {err}")
