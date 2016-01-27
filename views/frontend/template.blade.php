<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properities -->
    <title>Gulchuk :: Personal Website</title>

    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/css/semantic-ui/components/site.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/container.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/grid.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/segment.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/menu.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/list.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/semantic-ui/components/image.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/general.css">
</head>
<body>
    @include('frontend.header')

    <main class="ui container">
        @yield('content')
    </main>

    @include('frontend.footer')
</body>
</html>