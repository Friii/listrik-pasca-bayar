<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Pilihan - Wattly</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=1470&q=80');
      background-size: cover;
      background-position: center;
    }
    .glass {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-10">

  <div class="glass shadow-xl p-10 md:p-16 w-full max-w-4xl text-white text-center animate-fade-in">
    <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Selamat Datang di <span class="text-blue-300">Wattly</span></h1>
    <p class="text-lg mb-10 text-white/80">Silakan pilih jenis akun untuk login ke sistem Anda</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Admin -->
      <a href="{{ route('login') }}"
         class="group bg-white/10 hover:bg-white/20 border border-white/30 p-6 rounded-2xl flex flex-col items-center transition-all duration-300 hover:scale-105 shadow-md">
        <svg class="w-12 h-12 mb-4 text-blue-200 group-hover:text-blue-100 transition" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21V8H5l7-7 7 7h-4v13z"/>
        </svg>
        <span class="text-xl font-semibold">Login Admin</span>
      </a>

      <!-- Pelanggan -->
      <a href="{{ route('loginPelanggan') }}"
         class="group bg-white/10 hover:bg-white/20 border border-white/30 p-6 rounded-2xl flex flex-col items-center transition-all duration-300 hover:scale-105 shadow-md">
        <svg class="w-12 h-12 mb-4 text-green-200 group-hover:text-green-100 transition" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 00-3-3.87M4 21v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"/>
        </svg>
        <span class="text-xl font-semibold">Login Pelanggan</span>
      </a>
    </div>
  </div>

  <script>
    document.querySelector("body").classList.add("transition", "duration-1000", "ease-in-out");
  </script>
</body>
</html>
