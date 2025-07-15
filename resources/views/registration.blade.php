<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-[-1]">
      <source src="img/video.mp4" type="video/mp4" />
    </video>
    <div class="flex items-center justify-center min-h-screen bg-no-repeat bg-cover">
        <div class="px-2 max-w-md w-full shadow-2xl py-10 rounded-xl backdrop-blur-2xl border-slate-700 ">
            <x-registration></x-registration>
        </div>
    </div>
</body>


</html>
