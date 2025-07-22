<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100 scale-80">

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
    <main class="flex-1 p-8 mb-5">
        <div>
            <h2 class="text-3xl font-bold mb-8">Data Pelanggan</h2>
            <button onclick="openModal()"
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-sky-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg backdrop-blur-sm hover:scale-105 hover:shadow-xl transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pelanggan
            </button>


            <form action="{{ route('pelanggan') }}" method="GET">
                <div class="flex items-center justify-end -mt-8">
                    <input type="text" name="search" placeholder="Cari Nama Pelanggan"
                        value="{{ request('search') }}"
                        class="py-3 pl-4 pr-24 rounded-l-xl focus:ring-1 focus:ring-slate-600">

                    <button type="submit"
                        class="py-2.5 px-6 font-semibold pl-2 pr-5 flex gap-2 bg-blue-600 text-white rounded-r-xl">
                        <img src="img/search.png" alt="" width="30px" height="20px">
                        <p class="text-xl -pl-2">Cari</p>
                    </button>
                </div>
            </form>


            <div class="w-full bg-white shadow-xl mt-6 rounded-xl overflow-x-auto">
                <div class="p-6">
                    <table class="min-w-full text-sm text-gray-800">
                        <thead>
                            <tr class="bg-sky-800 text-white uppercase text-xs tracking-wider">
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">ID Pelanggan</th>
                                <th class="px-4 py-3 text-left">No. Kwh</th>
                                <th class="px-4 py-3 text-left">Nama</th>
                                <th class="px-4 py-3 text-left">Alamat</th>
                                <th class="px-4 py-3 text-left">Tarif</th>
                                <th class="px-4 py-3 text-center">Gambar</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $no = 1; @endphp
                            @foreach ($data as $pelanggan)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-2">{{ $no++ }}</td>
                                    <td class="px-4 py-2">{{ $pelanggan->id_pelanggan }}</td>
                                    <td class="px-4 py-2">{{ $pelanggan->nomor_kwh }}</td>
                                    <td class="px-4 py-2">{{ $pelanggan->nama_pelanggan }}</td>
                                    <td class="px-4 py-2">{{ $pelanggan->alamat }}</td>
                                    <td class="px-4 py-2">
                                        {{ $pelanggan->tarif->daya }} / {{ $pelanggan->tarif->tarifperkwh ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <img src="{{ asset('img/admin.png') }}" alt="Gambar"
                                            class="w-8 h-8 mx-auto rounded-full">
                                    </td>
                                    <td class="px-4 py-2 text-center space-x-2">
                                        <button onclick="editModal({{ $pelanggan }})"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 transition">
                                            ✏️ Edit
                                        </button>

                                        <form action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition">
                                                🗑 Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <!-- Modal Tambah Pelanggan -->
        <div id="modalPelanggan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-[500px] p-6 relative">
                <h2 class="text-2xl font-bold mb-4">Tambah Pelanggan</h2>

                <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-4" id="formPelanggan">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="PUT">
                    <div>
                        <label class="block font-semibold">No. Kwh</label>
                        <input type="text" name="nomor_kwh" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Alamat</label>
                        <input type="text" name="alamat" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Tarif</label>
                        <input type="number" name="id_tarif" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Username</label>
                        <input type="text" name="username" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Password</label>
                        <input type="password" name="password" required class="w-full p-2 border rounded">
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
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');

            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                menu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
            } else {
                menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            }
        }

        // Optional: Auto-close if click outside
        document.addEventListener('click', function(e) {
            const button = document.querySelector('button[onclick="toggleDropdown()"]');
            const dropdown = document.getElementById('dropdownMenu');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                dropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            }
        });
    </script>


    <script>
        function openModal() {
            document.getElementById('modalPelanggan').classList.remove('hidden');
            document.getElementById('modalPelanggan').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalPelanggan').classList.add('hidden');
            document.getElementById('modalPelanggan').classList.remove('flex');

            // Reset form ke default
            document.getElementById('formPelanggan').action = "{{ route('pelanggan.store') }}";
            document.getElementById('formMethod').value = "POST";
            document.querySelectorAll('#formPelanggan input').forEach(input => input.value = '');
        }

        function editModal(pelanggan) {
            openModal();

            const form = document.getElementById('formPelanggan');
            form.action = `/pelanggan/update/${pelanggan.id_pelanggan}`;
            document.getElementById('formMethod').value = "PUT"; // ← Ini WAJIB agar Laravel tahu itu update

            // isi input field
            form.nomor_kwh.value = pelanggan.nomor_kwh;
            form.nama_pelanggan.value = pelanggan.nama_pelanggan;
            form.alamat.value = pelanggan.alamat;
            form.id_tarif.value = pelanggan.id_tarif;
            form.username.value = pelanggan.username;
            form.password.value = '';
        }
    </script>


    <script>
        function openModal() {
            document.getElementById('modalPelanggan').classList.remove('hidden');
            document.getElementById('modalPelanggan').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalPelanggan').classList.add('hidden');
            document.getElementById('modalPelanggan').classList.remove('flex');
        }
    </script>


</body>

</html>
