<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory') | Campus Essentials</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="page">

    <header class="masthead">
        <div>
            <p class="masthead-eyebrow">Inventory Tracking System</p>
            <h1 class="masthead-title">Campus Essentials<span>.</span></h1>
        </div>
        <p class="masthead-meta">School Supplies<br>Group 2</p>
    </header>

    @include('partials.nav')

    <main class="shell">
        @yield('content')
    </main>

    <footer class="colophon">
        <span>&copy; {{ date('Y') }} Campus Essentials</span>
        <span class="colophon-mark">Prepared by Group 2</span>
    </footer>

</div>

@stack('scripts')
</body>
</html>