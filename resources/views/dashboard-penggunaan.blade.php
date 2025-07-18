<!DOCTYPE html>
<html lang="en">

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
            <a href="/dashboard"
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
            <div class="relative top-[28rem] flex gap-2 justify-start">
                <a href="" class="flex"><img src="img/fachri.jpg" alt="profil"
                        class="w-12 h-12 rounded-full bg-cover">
                    <p class="text-2xl font-semibold text-blue-600 py-2 px-4">Fachri</p>
                </a>

            </div>
        </nav>
    </aside>


    <!-- Main Content -->
    <main class="flex-1 p-8 mb-5">
        <div>
        <h2 class="text-3xl font-bold mb-8">Data Penggunaan</h2>
        <a href="/tambah-penggunaan"
            class="py-4 text-white font-semibold text-xl px-4 bg-blue-600 rounded-2xl hover:bg-blue-200 transition">+Tambah
            Penggunaan</a>
        <form action="">
        <div class="flex items-center justify-end -mt-8">
            <input type="text" placeholder="Cari Nama Pelanggan"
                class="py-3 pl-4 pr-24 rounded-l-xl focus:ring-1 focus:ring-slate-600">
            <button type="submit" class="py-2.5 px-6 font-semibold pl-3 pr-5 flex gap-2 bg-blue-600 text-white rounded-r-xl hover:bg-blue-200 transition">
                <img src="img/search.png" alt="" width="20px">
                <p class="text-xl -pl-2">Cari</p>
            </button>
        </div>
        </form>

        <div class="w-full bg-white shadow-2xl mt-4 rounded-xl">
<div class="max-w-full p-4">
<table class="w-full border border-collapse mt-8">
  <thead>
    <tr class="">
      <th class="border border-slate-300">No</th>
      <th class="border border-slate-300">No. Kwh</th>
      <th class="border border-slate-300">Nama</th>
      <th class="border border-slate-300">Bulan</th>
      <th class="border border-slate-300">Tahun</th>
      <th class="border border-slate-300">Meter Awal</th>
      <th class="border border-slate-300">Meter Akhir</th>
      <th class="border border-slate-300">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1; @endphp
    @foreach ($penggunaan as $penggunaan)
    <tr>
      <td class="border border-slate-300">{{ $no++ }}</td> 
      <td class="border border-slate-300">{{ $penggunaan->pelanggan->nomor_kwh }}</td> 
      <td class="border border-slate-300">{{ $penggunaan->pelanggan->nama_pelanggan }}</td> 
      <td class="border border-slate-300">{{ $penggunaan->bulan }}</td>
      <td class="border border-slate-300">{{ $penggunaan->tahun }}</td>
      <td class="border border-slate-300">{{ $penggunaan->meter_awal }}</td>
      <td class="border border-slate-300">{{ $penggunaan->meter_ahir }}</td>
      <td class="border border-slate-300">
        <a href="" class="w-10 h-10 bg-red">Hapus</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

</div>
    </main>

</body>

</html>
