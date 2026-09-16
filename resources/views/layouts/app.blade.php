<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') | Campus Essentials</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f2f4f7; color: #1c2536;
               font-family: Arial, Helvetica, sans-serif; }
        header.site { background: #1c3d5a; color: #fff; padding: 18px 24px; }
        header.site h1 { margin: 0; font-size: 20px; }
        header.site p { margin: 4px 0 0; font-size: 13px; color: #b9cbdb; }
        nav.site { background: #16304a; padding: 0 16px; }
        nav.site a { display: inline-block; color: #cfe0ee; padding: 12px 16px;
                     text-decoration: none; font-size: 14px; }
        nav.site a:hover, nav.site a.active { background: #24506f; color: #fff; }
        .container { max-width: 980px; margin: 24px auto; padding: 0 16px; }
        .card { background: #fff; border: 1px solid #dbe1e8; border-radius: 6px;
                padding: 22px; }
        h2 { margin: 0 0 16px; font-size: 19px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 10px; border-bottom: 1px solid #e4e8ee; text-align: left; }
        th { background: #f7f9fb; font-size: 13px; }
        .btn { display: inline-block; background: #1c3d5a; color: #fff;
               padding: 10px 16px; border: 0; border-radius: 4px;
               text-decoration: none; font-size: 14px; cursor: pointer; }
        .alert-success { background: #e6f4ea; border: 1px solid #a8d5b5;
                         color: #1d6b3d; padding: 12px; border-radius: 4px;
                         margin-bottom: 16px; }
        .alert-error { background: #fdeaea; border: 1px solid #f0b4b4;
                       color: #a12222; padding: 12px; border-radius: 4px;
                       margin-bottom: 18px; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-size: 14px;
                font-weight: bold; }
        input, select { width: 100%; padding: 9px; border: 1px solid #c6cedb;
                        border-radius: 4px; font-size: 14px; background: #fff; }
        .error-text { color: #c0392b; font-size: 13px; margin-top: 5px;
                      display: block; }
        .badge-low { background: #fdeaea; color: #a12222; padding: 3px 9px;
                     border-radius: 10px; font-size: 12px; }
        .badge-ok { background: #e6f4ea; color: #1d6b3d; padding: 3px 9px;
                    border-radius: 10px; font-size: 12px; }
        footer.site { text-align: center; color: #7a8899; font-size: 13px;
                      padding: 26px; }
    </style>
</head>
<body>

    <header class="site">
        <h1>Campus Essentials School Supplies</h1>
        <p>Inventory Tracking System</p>
    </header>

    @include('partials.nav')

    <div class="container">
        @yield('content')
    </div>

    <footer class="site">
        © {{ date('Y') }} Campus Essentials — Prepared by Group 2
    </footer>

</body>
</html>