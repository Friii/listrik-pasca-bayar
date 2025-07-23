<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wattly Chatbot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-2 flex justify-between items-center">
            <a href="#"><img src="img/logo.png" alt="Logo Wattly" class="w-28 object-contain" /></a>
            <nav class="hidden md:flex space-x-6 items-center text-gray-700">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5.121 17.804A4 4 0 0110 16h4a4 4 0 014.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    @if (isset($pelanggan))
                        <span class="font-medium">Hi, {{ $pelanggan->nama_pelanggan }}</span>
                    @endif
                </div>
                <button class="flex items-center space-x-1 text-blue-600 hover:text-blue-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M7 8h10M7 12h6m-1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    <span class="hidden lg:inline">Chatbot</span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Chatbot Area -->
    <main class="flex-1 flex items-center justify-center relative overflow-hidden p-4">
        <div class="bg-white w-full max-w-3xl h-[90vh] rounded-3xl shadow-xl flex flex-col z-10 animate-fade-in">

            <!-- Chat Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                <span class="text-yellow-400 text-xl">⚡</span>
                <h1 class="font-semibold text-lg">Wattly Chatbot</h1>
            </div>

            <!-- Chat Content -->
            <div id="chat-area" class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
                <!-- Bot Message -->
                <div class="flex items-start gap-2">
                    <img src="https://api.dicebear.com/7.x/bottts-neutral/svg?seed=Wattly" class="w-8 h-8 rounded-full"
                        alt="Bot" />
                    <div class="bg-gray-100 text-sm text-gray-700 p-3 rounded-xl max-w-sm shadow">
                        Halo, saya Wattly. Ada yang bisa saya bantu hari ini?
                    </div>
                </div>
            </div>

            <!-- Input Form -->
            <div class="border-t border-gray-200 p-4">
                <form id="chat-form" class="flex items-center gap-2">
                    <input id="chat-input" type="text" placeholder="Ketik pesan..."
                        class="flex-1 p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                        Kirim
                    </button>
                </form>
            </div>
        </div>

        {{-- <!-- Maskot Wattly -->
        <img src="593f4540-b2bb-40e3-9a2d-6c6a917b5d53.png" alt="Maskot Wattly"
            class="fixed bottom-6 right-6 w-36 h-36 object-contain opacity-90 pointer-events-none z-0 animate-fade-in" /> --}}
    </main>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatArea = document.getElementById('chat-area');
        const botAvatar = "https://api.dicebear.com/7.x/bottts-neutral/svg?seed=Wattly";
        const userAvatar = "https://api.dicebear.com/7.x/icons/svg?seed=User";

        // Fungsi untuk menambah pesan ke UI
        function addMessageToUI(message, sender) {
            const messageWrapper = document.createElement('div');
            messageWrapper.className = 'flex items-start gap-2 animate-fade-in';

            let content;
            if (sender === 'user') {
                messageWrapper.classList.add('justify-end');
                content = `
                <div class="bg-blue-600 text-white text-sm p-3 rounded-xl max-w-sm shadow order-1">
                    ${message}
                </div>
                <img src="${userAvatar}" class="w-8 h-8 rounded-full order-2" alt="User" />
            `;
            } else {
                messageWrapper.classList.add('items-start');
                // Ganti newline (\n) dengan tag <br> untuk tampilan HTML
                const formattedMessage = message.replace(/\n/g, '<br>');
                content = `
                <img src="${botAvatar}" class="w-8 h-8 rounded-full" alt="Bot" />
                <div class="bg-gray-100 text-sm text-gray-700 p-3 rounded-xl max-w-sm shadow">
                    ${formattedMessage}
                </div>
            `;
            }

            messageWrapper.innerHTML = content;
            chatArea.appendChild(messageWrapper);
            chatArea.scrollTop = chatArea.scrollHeight;
        }


        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;

            addMessageToUI(message, 'user');
            chatInput.value = '';

            try {
                const res = await fetch('http://localhost:5000/chat-bot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: message,
                        // Pastikan variabel $pelanggan ada dari controller
                        id_pelanggan: {{ $pelanggan->id_pelanggan ?? 1 }}
                    })
                });

                if (!res.ok) {
                    // Menangani error HTTP seperti 500
                    addMessageToUI("Maaf, terjadi gangguan pada server. Coba lagi nanti.", 'bot');
                    return;
                }

                const data = await res.json();
                const botReply = data.response || "Maaf, terjadi kesalahan tak terduga.";

                setTimeout(() => { // Beri jeda seolah-olah bot sedang berpikir
                    addMessageToUI(botReply, 'bot');
                }, 500);

            } catch (err) {
                console.error("Fetch Error:", err);
                addMessageToUI("Gagal menghubungi bot. Periksa koneksi Anda.", 'bot');
            }
        });
    </script>

</body>

</html>
