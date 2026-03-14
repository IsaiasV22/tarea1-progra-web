<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Computer Science Books')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Books</a></li>
            <li><a href="{{ route('authors.index') }}" class="{{ request()->routeIs('authors.*') ? 'active' : '' }}">Authors</a></li>
            <li><a href="{{ route('publishers.index') }}" class="{{ request()->routeIs('publishers.*') ? 'active' : '' }}">Publishers</a></li>
        </ul>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <p>Copyright &copy; 2026 - Isaías Víquez Soto</p>
    </footer>

</body>
</html>
