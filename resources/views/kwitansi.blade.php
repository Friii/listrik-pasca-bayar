<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #print-area, #print-area * {
                visibility: visible;
            }
            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 p-6">

    <div class="max-w-3xl mx-auto">
        <!-- Tombol -->
        <div class="flex justify-end mb-4">
            <button onclick="window.print()" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-md transition-all">
                🖨️ <span>Print Kwitansi</span>
            </button>
        </div>

        <!-- Area Kwitansi -->
        <div id="print-area" class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Kwitansi Pembayaran</h1>
                    <p class="text-sm text-gray-500">Tanggal: 22 Juli 2025</p>
                </div>
                <img src="img/logo.png" class="w-20 h-15 opacity-100" alt="Logo">
            </div>

            <!-- Info Pelanggan -->
            <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-gray-700 text-sm">
                <p><span class="font-semibold">Nama:</span> Budi Santoso</p>
                <p><span class="font-semibold">ID Pelanggan:</span> 1234567890</p>
                <p><span class="font-semibold">Nomor KWH:</span> 9876543210</p>
                <p><span class="font-semibold">Daya / Tarif:</span> 1300 VA – R1</p>
                <p class="col-span-2"><span class="font-semibold">Alamat:</span> Jl. Contoh No. 123, Jakarta</p>
            </div>

            <!-- Info Tagihan -->
            <div class="border-t pt-4 grid grid-cols-2 gap-y-2 gap-x-4 text-gray-700 text-sm">
                <p><span class="font-semibold">Bulan:</span> Juli 2025</p>
                <p><span class="font-semibold">Pemakaian:</span> 130 kWh</p>
                <p><span class="font-semibold">Total Tagihan:</span> Rp 187.000</p>
                <p><span class="font-semibold">Biaya Admin:</span> Rp 2.500</p>
                <p class="col-span-2">
                    <span class="font-semibold">Status:</span>
                    <span class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full font-medium text-xs">
                        Sudah Dibayar
                    </span>
                </p>
            </div>

            <!-- Footer -->
            <div class="text-sm text-gray-500 text-right pt-6 italic border-t">
                <p>Dokumen ini dicetak secara otomatis sebagai bukti pembayaran.</p>
            </div>
        </div>
    </div>

</body>
</html>
