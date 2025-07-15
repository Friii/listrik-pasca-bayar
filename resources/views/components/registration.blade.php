<form action="{{ route('registercheck.pelanggan') }}" method="post">
    @csrf
    <div>
        <h2 class="text-3xl font-bold text-center">Registration</h2>
    </div>
    <div class="py-4 px-4">
        <div class="grid grid-cols-1 gap-2">

            <label for="username">Username</label>
            <input type="text" name="username" id="username"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>

            <label for="nomor_kwh">Nomor KWH</label>
            <input type="text" name="nomor_kwh" id="nomor_kwh"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>

            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>

            <!-- Id Level disembunyikan (pelanggan) -->
            <input type="hidden" name="id_level" value="2">

            <!-- Tampilan level (tidak bisa diubah) -->
            <label for="level">Level</label>
            <select id="level" disabled
                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800">
                <option value="2" selected>2 - Pelanggan</option>
            </select>

            <!-- Tarif -->
            <label for="id_tarif">Tarif</label>
            <select name="id_tarif" id="id_tarif"
                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800"
                required>
                <option value="">-- Pilih Tarif --</option>
                <option value="1">Tarif Tingkat 1 (450 VA)</option>
                <option value="2">Tarif Tingkat 2 (900 VA)</option>
                <option value="3">Tarif Tingkat 3 (1300 VA)</option>
                <option value="4">Tarif Tingkat 4 (2200-5500 VA)</option>
                <option value="5">Tarif Tingkat 5 (&gt;6600 VA)</option>
            </select>

        </div>
        <div>
            <button type="submit"
                class="px-2 py-2 w-full bg-green-500 text-white rounded-full my-4 cursor-pointer">
                Register Now
            </button>
        </div>
        <h2 class="text-center text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="hover:underline hover:text-blue
