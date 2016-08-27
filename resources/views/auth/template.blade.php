<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title ?? 'Gulchuk' }}</title>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/assets/vendor/semantic/2.2.4/semantic.css">
</head>
<body>
    {{-- Меню --}}
    <div class="ui borderless main menu">
        <div class="ui text container">
            <a href="/" class="header item">
                <img class="logo" style="width: 32px; height: 32px" src="/assets/img/logo-gulchuk.png">
            </a>
            <div class="right menu">
                <a href="/password/reset" class="ui item">Recover password?</a>
                <a href="/login" class="ui item">Login</a>
            </div>
        </div>
    </div>

    @yield('content')

    <script defer src="/assets/vendor/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="/assets/vendor/semantic/2.2.4/semantic.js"></script>
    <script defer src="/assets/js/backend.js"></script>
</body>
</html>