<div>
    <h2 class="text-3xl font-bold text-center">Registration</h2>
</div>

<form action="{{ route('registercheck.admin') }}" method="post">
    @csrf
    <div class="py-4 px-4">
        <div class="grid grid-cols-1 gap-2">
            <label for="username">Username</label>
            <input type="text" name="username"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800">

            <label for="password">Password</label>
            <input type="password" name="password"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">

            <label for="nama_admin">Nama Admin</label>
            <input type="text" name="nama_admin"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">

            <label for="id_level">Level</label>
            <input type="hidden" name="id_level" value="1">

            <!-- Select tampil tapi tidak bisa dipilih -->
            <select id="id_level" disabled
                class="w-full bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800">
                <option value="1">1 - Admin</option>
            </select>
        </div>

        <div>
            <button type="submit" class="px-2 py-2 w-full bg-green-500 text-white rounded-full my-4 cursor-pointer">
                Register Now
            </button>
        </div>

        <h2 class="text-center text-sm">
            Sudah punya akun? <a href="/login" class="hover:underline hover:text-blue-500 font-bold">Login Sekarang</a>
        </h2>
    </div>
</form>
