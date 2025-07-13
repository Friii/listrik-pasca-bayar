<div class="block p-4">
    <form action="" class="block space-y-4">
        <div>
            <label for="tarif" class="block mb-1 text-xl font-semibold">Daya</label>
            <select name="tarif" id="tarif" class="w-full mt-4 bg-gray-300 rounded-full px-2 py-2 focus:outline-none focus:ring-2 focus:ring-sky-800 ">
                <option value="tarif-1">Tarif Tingkat 1 (450 VA)</option>
                <option value="tarif-2">Tarif Tingkat 2 (900 VA)</option>
                <option value="tarif-3">Tarif Tingkat 3 (1300 VA)</option>
                <option value="tarif-4">Tarif Tingkat 4 (2200-5500 VA)</option>
                <option value="tarif-5">Tarif Tingkat 5 (>6600 VA)</option>
            </select>
        </div>

        <div>
            <label for="tarif" class="block mb-1 text-xl font-semibold">Tarif</label>
            <input type="text" id="tarif" class="w-1/3 border border-gray-300 p-2 rounded">
        </div>

        <button type="submit" class="py-2 px-6 bg-blue-400 rounded-2xl shadow hover:bg-blue-800 transition duration-500">Simpan</button>
    </form>
</div>