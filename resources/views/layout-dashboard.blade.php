<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen px-4 py-6">
        <h1 class="text-2xl font-bold mb-6 text-blue-600">Dashboard</h1>
        <nav class="space-y-2">
            <a href="/layout-dashboard"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
                </svg>
                Beranda
            </a>
            <a href="/dashboard-tarif"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <img src="img/tax.png" alt="bil" class="w-5 h-5 mr-2">
                Data Tarif
            </a>
            <a href="/dashboard-pelanggan"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <img src="img/use.png" alt="user" class="w-5 h-5 mr-2">
                Data Pelanggan
            </a>
            <a href="/dashboard-penggunaan"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <img src="img/penggunaan.png" alt="user" class="w-5 h-5 mr-2">
                Data Penggunaan
            </a>

            <a href="/dashboard-tagihan"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <img src="img/tagihan.png" alt="user" class="w-5 h-5 mr-2">
                Data Tagihan
            </a>
            <a href="/dashboard-pembayaran"
                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-600">
                <img src="img/payment-method.png" alt="user" class="w-5 h-5 mr-2">
                Data Pembayaran
            </a>
            <div class="relative flex gap-2 justify-start ">
                <div class="relative mt-80">
                    <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                        <img src="img/us.png" alt="profil" class="w-12 h-12 rounded-full bg-cover">
                        <p class="text-2xl font-semibold text-blue-600 py-2 px-4">
                            {{ Auth::user()->nama_admin }}
                        </p>
                    </button>

                    <!-- Dropdown -->
                    <div id="dropdownMenu"
                        class="absolute left-0 mt-2 w-40  bg-white border rounded-xl shadow-lg opacity-0 scale-95 transition-all duration-200 origin-top-left transform pointer-events-none z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                            
                                class="w-full flex text-left px-4 py-2 text-red-600 hover:bg-red-100  hover:text-red-700">
                                <img src="img/keluar.png" alt="Keluar" width="20px" height="20px" class="flex"><p class="flex pl-2">Logout</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>


        </nav>
    </aside>



    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h2>
        <p class="text-gray-600 mb-8">Data statistik aplikasi</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card: Total Pengguna -->
            <div
                class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition hover:scale-105 p-6 flex flex-col items-center">
                <img src="img/user.png" alt="user" class="w-16 h-16 mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                <p class="text-4xl font-bold text-emerald-500 mt-2">{{ $totalPelanggan }}</p>
            </div>

            <!-- Card: Total Tagihan -->
            <div
                class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition hover:scale-105 p-6 flex flex-col items-center">
                <img src="img/bill.png" alt="tagihan" class="w-16 h-16 mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Tagihan</h3>
                <p class="text-4xl font-bold text-emerald-500 mt-2">{{ $totalTagihan }}</p>
            </div>

            <!-- Card: Pembayaran Berhasil -->
            <div
                class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition hover:scale-105 p-6 flex flex-col items-center">
                <img src="img/billl.png" alt="pembayaran" class="w-16 h-16 mb-4">
                <h3 class="text-lg font-semibold text-center text-gray-700">Pembayaran Berhasil</h3>
                <p class="text-4xl font-bold text-emerald-500 mt-2">{{ $totalPembayaran }}</p>
            </div>

            <!-- Card: Total Admin -->
            <div
                class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition hover:scale-105 p-6 flex flex-col items-center">
                <img src="img/admin.png" alt="admin" class="w-16 h-16 mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Admin</h3>
                <p class="text-4xl font-bold text-emerald-500 mt-2">{{ $totalUser }}</p>
            </div>
        </div>
    </main>

    

</body>

</html>
