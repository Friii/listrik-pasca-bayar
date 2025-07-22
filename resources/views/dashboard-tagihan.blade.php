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
    <main class="flex-1 p-8 mb-5">
        <div>
            <h2 class="text-3xl font-bold mb-8">Data Tagihan</h2>
            <button onclick="openModal()"
                class="py-4 text-white font-semibold text-xl px-4 bg-blue-600 rounded-2xl hover:bg-blue-800 transition">
                + Tambah Tagihan
            </button>

            <form action="">
                <div class="flex items-center justify-end -mt-8">
                    <input type="text" placeholder="Cari Nama Pelanggan"
                        class="py-3 pl-4 pr-24 rounded-l-xl focus:ring-1 focus:ring-slate-600">
                    <button type="submit"
                        class="py-2.5 px-6 font-semibold pl-3 pr-5 flex gap-2 bg-blue-600 text-white rounded-r-xl">
                        <img src="img/search.png" alt="" width="20px">
                        <p class="text-xl -pl-2">Cari</p>
                    </button>
                </div>
            </form>

            <div class="w-full bg-white shadow-xl mt-6 rounded-xl overflow-x-auto">
    <div class="p-6">
        <table class="min-w-full text-left text-sm text-gray-800">
            <thead>
                <tr class="bg-sky-800 text-white uppercase text-xs tracking-wider">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">ID Tagihan</th>
                    <th class="px-4 py-3">ID Penggunaan</th>
                    <th class="px-4 py-3">Nama Pelanggan</th>
                    <th class="px-4 py-3">Bulan</th>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Jumlah Meter</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php $no = 1; @endphp
                @foreach ($data as $tagihan)
                    <tr class="hover:bg-gray-100 transition duration-150">
                        <td class="px-4 py-3">{{ $no++ }}</td>
                        <td class="px-4 py-3">{{ $tagihan->id_tagihan }}</td>
                        <td class="px-4 py-3">{{ $tagihan->id_penggunaan }}</td>
                        <td class="px-4 py-3">{{ $tagihan->pelanggan->nama_pelanggan }}</td>
                        <td class="px-4 py-3">{{ $tagihan->bulan }}</td>
                        <td class="px-4 py-3">{{ $tagihan->tahun }}</td>
                        <td class="px-4 py-3">
                            {{ $tagihan->penggunaan->meter_ahir - $tagihan->penggunaan->meter_awal }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $tagihan->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center flex justify-center space-x-2">
                            <button onclick="openModal()"
                                class="p-2 bg-yellow-500 hover:bg-yellow-600 rounded-full text-white transition duration-150"
                                title="Edit">
                                ✎
                            </button>
                            <button onclick="deleteData()"
                                class="p-2 bg-red-500 hover:bg-red-600 rounded-full text-white transition duration-150"
                                title="Hapus">
                                🗑
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

            <!-- Modal Tambah Pelanggan -->
            <div id="modalTagihan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-[500px] p-6 relative">
                    <h2 class="text-2xl font-bold mb-4">Tambah Pelanggan</h2>

                    <form action="{{ route('tagihancheck.pelanggan') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <select name="id_pelanggan" id="id_pelanggan"
                                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800"
                                required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach ($penggunaan as $item)
                                    <option value="{{ $item->pelanggan->id_pelanggan }}">
                                        {{ $item->pelanggan->nomor_kwh }} - {{ $item->pelanggan->nama_pelanggan }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <select name="id_penggunaan" id="id_penggunaan"
                                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800"
                                required>
                                <option value="">-- Pilih Penggunaan --</option>
                                @foreach ($penggunaan as $item)
                                    <option value="{{ $item->id_penggunaan }}">
                                        {{ $item->pelanggan->id_pelanggan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <select name="bulan" id="bulan"
                                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800"
                                required>
                                <option value="">-- Pilih Bulan --</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>

                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold">Tahun</label>
                            <input type="text" name="tahun" id="tahun" required
                                class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block font-semibold">Jumlah Meter</label>
                            <input type="text" name="jumlah_meter" id="jumlah_meter"
                                class="w-full p-2 border rounded" readonly>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()"
                                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>

                    <button onclick="closeModal()"
                        class="absolute top-2 right-2 text-xl text-gray-500 hover:text-red-500">&times;</button>
                </div>
            </div>

    </main>

    <script>
        function openModal() {
            document.getElementById('modalTagihan').classList.remove('hidden');
            document.getElementById('modalTagihan').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalTagihan').classList.add('hidden');
            document.getElementById('modalTagihan').classList.remove('flex');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPelanggan = document.querySelector('#id_pelanggan');
            const selectBulan = document.querySelector('#bulan');
            const inputTahun = document.querySelector('#tahun');
            const jumlahMeterInput = document.querySelector('#jumlah_meter');

            function fetchJumlahMeter() {
                const idPelanggan = selectPelanggan.value;
                const bulan = selectBulan.value;
                const tahun = inputTahun.value;

                if (idPelanggan && bulan && tahun) {
                    fetch(`/api/jumlah-meter/${idPelanggan}?bulan=${bulan}&tahun=${tahun}`)
                        .then(response => response.json())
                        .then(data => {
                            jumlahMeterInput.value = data.jumlah_meter ?? '';
                        })
                        .catch(error => {
                            console.error('Gagal ambil jumlah meter:', error);
                            jumlahMeterInput.value = '';
                        });
                }
            }

            selectPelanggan.addEventListener('change', fetchJumlahMeter);
            selectBulan.addEventListener('change', fetchJumlahMeter);
            inputTahun.addEventListener('input', fetchJumlahMeter);
        });
    </script>





</body>

</html>
