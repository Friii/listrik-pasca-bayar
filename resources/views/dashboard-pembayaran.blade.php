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
    <aside class="w-64 bg-white shadow-md max-h-full px-4 py-6">
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
            <h2 class="text-3xl font-bold mb-8">Data Pembayaran</h2>
            <button onclick="openModal()"
                class="py-4 text-white font-semibold text-xl px-4 bg-blue-600 rounded-2xl hover:bg-blue-800 transition">
                + Tambah Pembayaran Pelanggan
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
                                <th class="px-4 py-3">Nama Pelanggan</th>
                                <th class="px-4 py-3">Tanggal Pembayaran</th>
                                <th class="px-4 py-3">Nomor KWH</th>
                                <th class="px-4 py-3">Bulan Bayar</th>
                                <th class="px-4 py-3">Total Bayar</th>
                                <th class="px-4 py-3">Bukti Pembayaran</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $no = 1; @endphp
                            @foreach ($data as $pembayaran)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-4 py-3">{{ $no++ }}</td>
                                    <td class="px-4 py-3">{{ $pembayaran->id_pelanggan }}</td>
                                    <td class="px-4 py-3">{{ $pembayaran->pelanggan->nama_pelanggan }}</td>
                                    <td class="px-4 py-3">{{ $pembayaran->tanggal_pembayaran }}</td>
                                    <td class="px-4 py-3">{{ $pembayaran->tagihan->bulan }}</td>
                                    <td class="px-4 py-3"><img src="{{ asset('storage/' . $pembayaran->bukti) }}" alt="Bukti Pembayaran" width="100"></td>
                                    <td class="px-4 py-3">
                                        {{ $pembayaran->total_bayar }}
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

                    <form action="{{ route('pembayarancheck.pelanggan') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <select name="id_tagihan" id="id_tagihan"
                                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800"
                                required>
                                <option value="">-- Pilih Tagihan --</option>
                                @foreach ($tagihan as $item)
                                    <option value="{{ $item->id_tagihan }}">
                                        {{ $item->id_tagihan }} - {{ $item->penggunaan->bulan }}
                                        {{ $item->penggunaan->tahun }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_pembayaran" required
                                class="w-full p-2 border rounded bg-gray-100">
                        </div>

                        <div>
                            <input type="hidden" name="id_user" value="15828">
                        </div>

                        <div>
                            <label class="block font-semibold">Bukti Pembayaran</label>
                            <input type="file" name="bukti" accept="image/*" required
                                class="w-full p-2 border rounded bg-gray-100">
                        </div>

                        <div>
                            <label class="block font-semibold">Total Bayar</label>
                            <input type="text" name="total_bayar" id="total_bayar"
                                class="w-full p-2 border rounded bg-gray-100" readonly>
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
            const selectTagihan = document.getElementById('id_tagihan');
            const totalBayarInput = document.getElementById('total_bayar');

            selectTagihan.addEventListener('change', function() {
                const idTagihan = this.value;

                if (idTagihan) {
                    fetch(`/get-total-bayar/${idTagihan}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.total_bayar !== undefined) {
                                totalBayarInput.value = data.total_bayar;
                            } else {
                                totalBayarInput.value = '0';
                            }
                        })
                        .catch(error => {
                            console.error('Gagal mengambil data total bayar:', error);
                            totalBayarInput.value = '0';
                        });
                } else {
                    totalBayarInput.value = '';
                }
            });
        });
    </script>








</body>

</html>
