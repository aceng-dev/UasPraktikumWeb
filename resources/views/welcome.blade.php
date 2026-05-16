<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    @vite(['resources/css/app.js', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <div class="min-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 h-screen justify-center">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">UAS Praktikum Web Laravel</h1>
            <p class="text-gray-600 dark:text-gray-400">Sistem Autentikasi Multi-Role (5 Roles)</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg text-center">
            <p class="text-gray-700 dark:text-gray-300 mb-6 font-medium">Silakan pilih menu di bawah ini untuk masuk ke sistem:</p>
            
            <div class="flex flex-col space-y-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/' . Auth::user()->role . '/dashboard') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Masuk ke Dashboard Anda ({{ strtoupper(Auth::user()->role) }})
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Log In
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Register Akun Baru
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

    </div>
</body>
</html>