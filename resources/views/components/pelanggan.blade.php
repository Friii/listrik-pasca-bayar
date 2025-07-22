<div>
    <h2 class="text-3xl font-bold text-center text-white">Login Pelanggan</h2>
</div>
<form action="{{ route('landingcheck') }}" method="post">
    @csrf
    <div class="py-4 px-4">
        <div class="grid grid-cols-1 gap-2">
            <label for="username" class="text-white">Username</label>
            <input type="text" name="username" id="username"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-900" />

            <label for="password" class="text-white">Password</label>
            <input type="password" name="password" id="password"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-900" />
        </div>

        <div>
            <button type="submit"
                class="px-2 py-1 w-full bg-green-500 text-white rounded-full my-4">Login</button>
        </div>

        <h2 class="text-center text-sm text-white">
            Belum Punya Akun? 
            <a href="/registration" class="hover:underline hover:text-blue-500 font-bold">Daftar Sekarang</a>
        </h2>
    </div>
</form>

