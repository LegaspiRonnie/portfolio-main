@props(['title' => 'Ronnie Legaspi — Full Stack Developer'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="description" content="Portfolio of Ronnie H. Legaspi — BSIT graduate and full stack developer working with Laravel, React.js, PHP, and MySQL.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'IBM Plex Sans', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                },
            },
        };
    </script>
    <style>
        html { scroll-behavior: smooth; scroll-padding-top: 4.5rem; }
        body { font-family: 'Inter', 'IBM Plex Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        a, button, [role="button"] {
            transition-property: color, background-color, border-color, opacity, transform, box-shadow;
            transition-duration: 200ms;
            transition-timing-function: ease-out;
        }

        main { transition: opacity 0.18s ease; }
        html.is-navigating main { opacity: 0.45; }

        [data-reveal] {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
            transition-delay: var(--reveal-delay, 0ms);
        }
        [data-reveal].in-view {
            opacity: 1;
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            [data-reveal] { opacity: 1; transform: none; transition: none; }
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float-slow { animation: float-slow 6s ease-in-out infinite; }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in { animation: fade-in 1s ease-out both; }
    </style>

    @livewireStyles
    @vite(['resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-950 transition-colors duration-300">

    <x-ui.page-loader />
    <x-ui.nav-loader />
    <x-ui.toast-container />
    <x-ui.confirm-dialog />

    @if (session('status'))
        <div x-data x-init="$store.toast.push({ message: @js(session('status')), type: 'success' })"></div>
    @endif

    @include('partials.navbar')

    <main class="pt-16">
        {{ $slot }}
    </main>

    @include('partials.footer')
    @include('partials.back-to-top')
    @include('banners.cookie-consent')
    <livewire:feedback-widget />
    <livewire:purchase-interest />
    <livewire:ai-chat-support />

    @livewireScripts
</body>
</html>
