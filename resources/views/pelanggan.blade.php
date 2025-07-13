<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-no-repeat bg-cover" style="background-image: url('/img/listrik.jpg')">
        <div class="px-2 max-w-md w-full shadow-2xl py-10 rounded-xl backdrop-blur-2xl border-slate-700 ">
            <div class="flex flex-wrap gap-2 justify-center mb-7">
                <a href="/" class="w-32 h-20 bg-sky-300 rounded-2xl border shadow-xl justify-items-center items-center pt-2 hover:bg-sky-100 transition ease-in duration-300 hover:border-sky-300"><img src="img/admin.png" alt="User" class="w-10 h-10"><p class="text-sm font-semibold">Admin</p></a>
                <a href="/pelanggan" class="w-32 h-20 bg-sky-300 rounded-2xl border shadow-xl justify-items-center items-center pt-2 hover:bg-sky-100 transition ease-in duration-300 hover:border-sky-300"><img src="img/profile.png" alt="User" class="w-10 h-10"><p class="text-sm font-semibold">Pelanggan</p></a>
            </div>
            <x-pelanggan></x-pelanggan>
        </div>
    </div>
</body>


</html>
