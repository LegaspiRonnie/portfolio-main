<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 — Server Error</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' };</script>
    <style> body { font-family: 'Inter', 'IBM Plex Sans', sans-serif; } </style>
    <script>
        if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    </script>
</head>
<body class="bg-white dark:bg-gray-950 transition-colors duration-300">

    <div class="min-h-screen flex flex-col items-center justify-center text-center px-6">
        <p class="font-mono text-sm text-blue-700 dark:text-blue-400 mb-3">500</p>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white mb-3">Something broke on our end</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8 max-w-sm">
            An unexpected error occurred. Please try again in a moment.
        </p>
        <button type="button" onclick="location.reload()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium transition-all duration-200 hover:scale-[1.03] active:scale-[0.98]">
            Try again
        </button>
    </div>

</body>
</html>
