<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Header atau navigasi di sini -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">BukuApp</a>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-4">
        <p>&copy; 2024 BukuApp</p>
    </footer>
</body>
</html>
