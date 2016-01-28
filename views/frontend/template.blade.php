<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properities -->
    <title>Gulchuk :: Personal Website</title>

    @include('assets.css')
</head>
<body>
    @include('frontend.header')

    <main class="ui container">
        @yield('content')
    </main>

    @include('frontend.footer')
</body>
</html>