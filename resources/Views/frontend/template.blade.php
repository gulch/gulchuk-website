<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gulchuk :: Personal Website</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        @include('assets.favicon')
        @include('assets.css')
    </head>
    <body>
        <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
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
        @yield('content')
        @include('frontend.footer')

        @include('assets.js')
    </body>
</html>