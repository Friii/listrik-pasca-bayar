<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Listrik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-0 flex justify-between items-center">
            <!-- Logo saja -->
            <a href="#">
                <img src="img/logo.png" alt="Logo Wattly" class="w-32 h-32 object-contain -my-4" />
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6 items-center">
                <!-- Akun Dummy -->
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5.121 17.804A4 4 0 0110 16h4a4 4 0 014.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    @if (isset($pelanggan))
                        <span class="font-medium">Hi, {{ $pelanggan->nama_pelanggan }}</span>
                    @endif
                </div>

                <!-- Chatbot -->
                <button class="flex items-center space-x-1 text-blue-600 hover:text-blue-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M7 8h10M7 12h6m-1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    <span class="hidden lg:inline">Chatbot</span>
                </button>
            </nav>

        </div>
    </header>



    <!-- Hero Section -->
    <section class="relative bg-cover bg-center" style="background-image: url('/img/listrikk.jpg');" data-aos="fade-up">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
        <div class="relative max-w-xl mx-auto text-center text-white py-24 px-4">
            <h2 class="text-4xl font-extrabold mb-4 drop-shadow-lg">Bayar Tagihan Listrik Mudah & Murah</h2>
            <p class="text-lg text-blue-200 mb-8">Cek & bayar tagihan listrik dengan harga promo setiap hari!</p>

            <div class="bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-8 shadow-xl" data-aos="zoom-in">
                <h3 class="text-xl font-semibold text-blue-700 mb-4">🔌 Tagihan Listrik</h3>
                <form action="{{ route('kelolaLandingPage') }}" method="POST" class="max-w-md mx-auto mt-8 space-y-4">
                    @csrf
                    <label for="id_tagihan" class="block text-sm font-medium text-gray-700">Masukkan ID Tagihan</label>
                    <input type="text" name="id_tagihan" id="id_tagihan" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg hover:bg-blue-700 transition">
                        🔍 Cek Tagihan
                    </button>
                </form>
                <p class="text-xs text-center mt-4 text-gray-500">
                    *Pembayaran tidak tersedia jam 23:00 - 01:00 WIB sesuai ketentuan PLN.
                </p>
            </div>
        </div>
    </section>

    @if (isset($tagihan) && isset($pelanggan))
        <div class="max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-xl p-8 space-y-6 font-sans" data-aos="zoom-out">
            <div class="flex justify-between items-center border-b pb-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">🔌 Detail Pelanggan</h2>
                    <p class="text-sm text-gray-500">Informasi pelanggan terdaftar</p>
                </div>
                <span class="text-sm text-gray-400">ID: {{ $tagihan->id_tagihan }}</span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-gray-700">
                <p><span class="font-semibold">Nama:</span> {{ $pelanggan->nama_pelanggan }}</p>
                <p><span class="font-semibold">Nomor KWH:</span> {{ $pelanggan->nomor_kwh }}</p>
                <p><span class="font-semibold">Daya / Tarif:</span> {{ $pelanggan->tarif->daya }} - {{ $pelanggan->tarif->tarifperkwh }}</p>
                <p><span class="font-semibold">Alamat:</span> {{ $pelanggan->alamat }}</p>
            </div>

            <div class="border-t pt-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">💡 Informasi Tagihan</h2>
                <div class="grid grid-cols-2 gap-4 text-gray-700">
                    <p><span class="font-semibold">Bulan:</span> {{ $tagihan->bulan }} {{ $tagihan->tahun }}</p>
                    <p><span class="font-semibold">Pemakaian:</span> {{ $tagihan->jumlah_meter }} kWh</p>
                    <p><span class="font-semibold">Total Tagihan:</span> Rp
                        {{ $tagihan->total_bayar }}</p>
                    <p><span class="font-semibold">Biaya Admin:</span> Rp 2.500</p>
                    <p class="col-span-2">
                        <span class="font-semibold">Status:</span>
                        <span class="inline-block bg-red-100 text-red-600 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $tagihan->status }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="pt-4 text-right">
                <button
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition">
                    💳 Bayar Sekarang
                </button>
            </div>
        </div>
    @endif



    <!-- Penjelasan Cara Cek Tagihan -->
    <div class="max-w-6xl mx-auto mt-12 bg-white rounded-xl shadow-md p-8 " data-aos="fade-up">
        <h2 class="text-4xl font-bold text-gray-800 mb-4 text-center">Cek Tagihan Listrik Terbaru 2025</h2>
        <p class="text-gray-600 mb-6 text-2xl">
            Cara Cek Tagihan Listrik PLN Pascabayar Online di <span
                class="font-semibold text-blue-600">Wattly.com</span>
        </p>
        <ul class="text-left text-gray-700 list-decimal list-inside space-y-2 text-xl">
            <li>Masukkan no ID pelanggan dan no HP kamu di kolom paling atas di halaman ini di kolom Tagihan Listrik.
            </li>
            <li>Kemudian klik tombol <span class="font-semibold">Cek Tagihan</span>.</li>
        </ul>
        <h2 class="text-4xl font-bold text-gray-800 mb-4 pt-4 text-center">Mengapa Harus Cek Tagihan Listrik di
            Wattly.com</h2>
        <p class="text-gray-600 mb-6 text-xl text-justify">Cek tagihan listrik tiap bulan atau bahkan tiap minggu adalah
            suatu keharusan bagi pelanggan listrik
            pascabayar, jika tidak maka kemungkinan tagihan listrik bisa membengkak dan ada beberapa pelanggan yang
            komplain karena tagihan yang mahal.
            Yuk , cek tagihan listrik kamu sekarang juga sebelum menyesal akibat tagihan listrik yang mahal!</p>
        <p class="text-gray-600 mb-6 text-xl text-justify">Cek tagihan listrik kamu sekarang juga karena kemudahan dan
            kecanggihan teknologi memudahkan kamu melakukan
            cek dan juga bayar listrik. Selain itu tidak perlu melakukan antrian di kantor cabang PLN terdekat.</p>

        <p class="text-gray-600 mb-6 text-xl text-justify">Antrian yang panjang sering kali bikin lelah, apalagi kalau
            harus bolak-balik karena data atau persyaratan tidak lengkap. Bukankah kamu ingin proses yang lebih cepat
            dan praktis?</p>

        <p class="text-gray-600 mb-6 text-xl text-justify">Wattly.com memberikan solusi untuk pelanggan yang malas antri
            mauapun keluar rumah hanya untuk membayar
            atau mengecek tagihan listrik. Disisi lain, masih banyak masyarakat yang bekerja di rumah ( work from home),
            anak-anak sekolah di rumah mengakibatkan tagihan listrik makin membengkak.</p>
    </div>


    <!-- FAQ Section -->
    <section class="max-w-4xl mx-auto mt-16 bg-white rounded-2xl shadow-md p-8" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">❓ Frequently Asked Questions (F.A.Q.)</h2>

        <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
            <!-- Loop FAQ Items -->
            <div class="border rounded-lg overflow-hidden transition-all duration-300">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>1. Apa itu Wattly?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Wattly adalah platform digital untuk membantu Anda membayar tagihan listrik
                        pascabayar secara cepat, aman, dan efisien.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>2. Layanan apa saja yang disediakan Wattly?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Wattly menyediakan pengecekan tagihan, riwayat penggunaan, pembayaran online, dan
                        pengelolaan data pelanggan listrik pascabayar.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>3. Bagaimana cara mendaftar di Wattly?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Anda dapat mendaftar melalui halaman registrasi dengan mengisi data seperti nomor
                        KWH, nama lengkap, alamat, dan membuat akun.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>4. Apakah Wattly aman untuk digunakan?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Wattly menggunakan sistem keamanan enkripsi dan autentikasi untuk menjaga data
                        dan transaksi Anda tetap aman.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>5. Apakah saya bisa melihat riwayat pembayaran saya?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Ya, riwayat pembayaran dan tagihan bisa dilihat langsung di dashboard Anda.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>6. Apa yang harus dilakukan jika ada kesalahan pembayaran?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Hubungi layanan pelanggan Wattly dengan menyertakan detail transaksi dan bukti
                        pembayaran.</p>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center px-4 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 faq-toggle text-lg md:text-xl">
                    <span>7. Apa kelebihan Wattly dibanding metode pembayaran lain?</span>
                    <svg class="w-6 h-6 transform transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 text-gray-600 px-4">
                    <p class="py-4">Wattly memberikan tampilan yang ramah pengguna, histori lengkap, dan kemudahan
                        akses di berbagai perangkat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white mt-20 py-6 text-center text-gray-500 text-sm shadow-inner">
        &copy; 2025 Wattly. All rights reserved.
    </footer>

</body>

<!-- Script toggle FAQ -->
<script>
    document.querySelectorAll('.faq-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const svgIcon = btn.querySelector('svg');
            const isOpen = content.classList.contains('max-h-96');

            // Close all first
            document.querySelectorAll('.faq-content').forEach(el => el.classList.remove('max-h-96'));
            document.querySelectorAll('.faq-toggle svg').forEach(icon => icon.classList.remove(
                'rotate-180'));

            if (!isOpen) {
                content.classList.add('max-h-96');
                svgIcon.classList.add('rotate-180');
            }
        });
    });

    AOS.init({
        duration: 800,
        once: true,
    });
</script>

</html>
