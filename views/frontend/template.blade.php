<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properities -->
    <title>Gulchuk :: Personal Website</title>

    @include('assets.favicon')
    @include('assets.css')
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
        <symbol id="close" viewBox="0 0 32 32">
            <line stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="1" y1="1" x2="31" y2="31" fill="none"></line>
            <line stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="1" y1="31" x2="31" y2="1" fill="none"></line>
        </symbol>
        <symbol id="logo" viewBox="0 0 250 250">
            <circle fill="#484748" cx="125" cy="125" r="123.5"/>
            <g>
                <path fill="#FFFFFF" d="M127.8,113.9h41.9v60.4c0,30.5-15.2,47.9-44.6,47.9s-44.6-17.4-44.6-47.9v-99c0-30.5,15.2-47.9,44.6-47.9
            s44.6,17.4,44.6,47.9v18.5h-28.3V73.4c0-13.6-6-18.8-15.5-18.8c-9.5,0-15.5,5.2-15.5,18.8v102.8c0,13.6,6,18.5,15.5,18.5
            c9.5,0,15.5-4.9,15.5-18.5v-35.1h-13.6V113.9z"/>
            </g>
        </symbol>
    </svg>

    @include('frontend.header')

    <main class="ui container">
        @yield('content')
    </main>

    @include('frontend.footer')
</body>
</html>