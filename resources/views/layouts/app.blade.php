<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portfolio')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="min-h-screen">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">PortfolioSpace</a>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="/dashboard" class="hover:underline">Dashboard</a>
                    <a href="{{ route('portfolio.show', auth()->id()) }}" class="hover:underline">My Portfolio</a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @else
                    <a href="/login" class="hover:underline">Login</a>
                    <a href="/register" class="hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} PortfolioSpace. All rights reserved.
        </div>
    </footer>

    @yield('scripts')
</body>
</html>