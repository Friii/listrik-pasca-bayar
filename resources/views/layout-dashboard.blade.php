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
    <aside class="w-64 bg-white shadow-md h-screen px-4 py-6 m-0">
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
            <div class="relative top-[23rem] flex gap-2 justify-start">
                <a href="" class="flex"><img src="img/fachri.jpg" alt="profil"
                        class="w-12 h-12 rounded-full bg-cover">
                    <p class="text-2xl font-semibold text-blue-600 py-2 px-4">Fachri</p>
                </a>

            </div>
        </nav>
    </aside>



    <!-- Main Content -->
    <main class="flex-1 p-8  ">
        <h2 class="text-3xl font-bold mb-4">Welcome to the Dashboard</h2>
        <p class="text-gray-600">Here is your main content area.</p>
        <div class="relative w-full h-screen ">
            <div class="px-4 py-6 flex justify-center">
                <div class="flex flex-wrap gap-4 ">
                    <div
                        class="w-64 h-72 rounded-2xl  mr-4 bg-white border-2 border-slate-700 shadow-2xl hover:scale-110 transition ease-in duration-300">
                        <div class="justify-center ml-[90px] mt-8">
                            <img src="img/user.png" alt="user" class="w-20 h-20">
                            <h3 class="font-bold text-xl text-slate-700 -ml-[68px] mt-3">Total Pengguna</h3>
                            <h1 class="font-bold text-7xl text-emerald-500 ">{{ $totalPelanggan }}</h1>

                        </div>
                    </div>
                    <div
                        class="w-64 h-72 rounded-2xl  mr-4 bg-white border-2 border-slate-700 shadow-2xl hover:scale-110 transition ease-in duration-300">
                        <div class="justify-center ml-[90px] mt-8">
                            <img src="img/bill.png" alt="user" class="w-20 h-20">
                            <h3 class="font-bold text-xl text-slate-700 -ml-[60px] mt-3">Total Tagihan</h3>
                            <h1 class="font-bold text-7xl text-emerald-500 ">{{ $totalTagihan }}</h1>

                        </div>
                    </div>
                    <div
                        class="w-64 h-72 rounded-2xl  mr-4 bg-white border-2 border-slate-700 shadow-2xl hover:scale-110 transition ease-in duration-300">
                        <div class="justify-center ml-[90px] mt-8">
                            <img src="img/billl.png" alt="user" class="w-20 h-20">
                            <h3 class="font-bold text-xl text-slate-700 -ml-24 pl-2 mt-3">Total Pembayaran Berhasil</h3>
                            <h1 class="font-bold text-7xl text-emerald-500 ">{{ $totalPembayaran }}</h1>

                        </div>
                    </div>
                    <div
                        class="w-64 h-72 rounded-2xl  mr-4 bg-white border-2 border-slate-700 shadow-2xl hover:scale-110 transition ease-in duration-300">
                        <div class="justify-center ml-[90px] mt-8">
                            <img src="img/admin.png" alt="user" class="w-20 h-20">
                            <h3 class="font-bold text-xl text-slate-700 -ml-4 mt-3">Total Admin</h3>
                            <h1 class="font-bold text-7xl text-emerald-500 ">{{ $totalUser }}</h1>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>

</body>

</html>
