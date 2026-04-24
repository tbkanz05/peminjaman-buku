<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Premium Shiny Black Theme (Guest Layout) */
            :root {
                --bg-deep: #020203;
                --card-bg: rgba(18, 18, 20, 0.8);
                --accent-primary: #6366f1;
                --text-main: #f3f4f6;
                --border-color: rgba(255, 255, 255, 0.08);
            }

            body {
                background-color: var(--bg-deep) !important;
                color: var(--text-main) !important;
                font-family: 'Outfit', sans-serif;
                overflow-x: hidden;
            }

            .min-h-screen {
                background-color: var(--bg-deep) !important;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            /* Premium Glassmorphism Card */
            .bg-white, .dark\:bg-gray-800 {
                background: var(--card-bg) !important;
                backdrop-filter: blur(16px) saturate(180%) !important;
                -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
                border: 1px solid var(--border-color) !important;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8) !important;
                border-radius: 32px !important;
                padding: 2.5rem !important;
            }

            /* Labels */
            label {
                color: var(--accent-primary) !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                font-size: 0.65rem !important;
                letter-spacing: 0.5px !important;
                margin-bottom: 0.5rem !important;
                display: block !important;
            }

            /* Forms & Inputs */
            input {
                background: rgba(255, 255, 255, 0.04) !important;
                border: 1px solid rgba(255, 255, 255, 0.08) !important;
                border-radius: 12px !important;
                color: white !important;
                padding: 12px 16px !important;
                transition: all 0.3s ease !important;
                width: 100% !important;
            }
            input:focus {
                background: rgba(255, 255, 255, 0.08) !important;
                border-color: var(--accent-primary) !important;
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.2) !important;
                outline: none !important;
                transform: translateY(-2px);
            }

            .btn-shiny {
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3) !important;
                background-color: var(--accent-primary) !important;
                border-radius: 12px !important;
                font-weight: 800 !important;
                letter-spacing: 1px !important;
            }
            .btn-shiny:hover {
                transform: scale(1.02) translateY(-2px);
                box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5) !important;
                filter: brightness(1.1);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-black text-white italic tracking-tighter uppercase">
                    Peminjaman <span class="text-indigo-500">Buku</span>
                </h1>
                <p class="text-gray-500 text-sm mt-2">Silakan masuk ke akun Anda</p>
            </div>

            <div class="w-full sm:max-w-md animate-fade-in">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
