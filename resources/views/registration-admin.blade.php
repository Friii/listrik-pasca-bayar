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
            <x-registration-admin></x-registration-admin>
        </div>
    </div>
</body>


</html>
