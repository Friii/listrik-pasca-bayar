<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-no-repeat bg-cover" style="background-image: url('/img/listrik.jpg')">
        <div class="px-2 max-w-md w-full shadow-2xl py-10 rounded-xl bg-slate-100 border-slate-700 ">
            <div>
                <h2 class="text-3xl font-bold text-center">Registration</h2>
            </div>
            <div class="py-4 px-4">
                <div class="grid grid-cols-1 gap-2">
                    <label for="">Username</label>
                    <input type="text" class="w-full bg-gray-300 rounded-full px-2 py-1 ">
                    <label for="">Password</label>
                    <input type="text" class="w-full bg-gray-300 rounded-full px-2 py-1 ">
                </div>
                <div>
                    <button class="px-2 py-1 w-full bg-green-500 text-white rounded-full my-4">Login</button>
                </div>
                <h2 class="text-center text-sm">Belum Punya Akun? <a href="" class="hover:underline hover:text-blue-500">Daftar Sekarang</a>
                </h2>
            </div>
        </div>
    </div>
</body>


</html>
