<header>
    <nav class="ui menu">
        <div class="ui container">
            <a href="/" class="item">
                <svg id="main-menu-logo">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                </svg>
            </a>
            <div class="right menu">
                <a href="/cv" class="item {{ ($_SERVER['REQUEST_URI'] == '/cv') ? 'active' : '' }}">
                    CV
                </a>
                <a href="/blog" class="item {{ ($_SERVER['REQUEST_URI'] == '/blog') ? 'active' : '' }}">
                    Blog
                </a>
                {{--<a href="#" class="item">
                    Search
                </a>--}}
            </div>
        </div>
    </nav>
</header>