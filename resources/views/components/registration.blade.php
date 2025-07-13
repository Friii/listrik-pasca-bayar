<form action="">
    <div>
        <h2 class="text-3xl font-bold text-center">Registration</h2>
    </div>
    <div class="py-4 px-4">
        <div class="grid grid-cols-1 gap-2">
            <label for="">Username</label>
            <input type="text"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800">
            <label for="">Password</label>
            <input type="text"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
            <label for="">Nomor Kwh</label>
            <input type="text"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
            <label for="">Nama Pelanggan</label>
            <input type="text"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
            <label for="">Alamat</label>
            <input type="text"
                class="w-full bg-gray-300 rounded-full px-2 py-1 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
            <select name="tarif" id="tarif" class="w-full mt-4 bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
                <option value="tarif-1">Tarif Tingkat 1 (450 VA)</option>
                <option value="tarif-2">Tarif Tingkat 2 (900 VA)</option>
                <option value="tarif-3">Tarif Tingkat 3 (1300 VA)</option>
                <option value="tarif-4">Tarif Tingkat 4 (2200-5500 VA)</option>
                <option value="tarif-5">Tarif Tingkat 5 (>6600 VA)</option>
            </select>
        </div>
        <div>
            <button type="submit"
                class="px-2 py-2 w-full bg-green-500 text-white rounded-full my-4 cursor-pointer">Register Now</button>
        </div>
        <h2 class="text-center text-sm">Sudah punya akun? <a href="/registration"
                class="hover:underline hover:text-blue-500 font-bold">Login Sekarang</a>
    </div>
</form>
