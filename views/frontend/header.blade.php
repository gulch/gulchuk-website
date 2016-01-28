<div class="ui menu main-menu">
    <div class="ui container">
        <a href="/" class="borderless item main-menu-logo-item">
            {{--<img src="/assets/img/logo-gulchuk.png" alt="Gulchuk Website Logo">--}}
            <svg id="main-menu-logo">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
            </svg>
        </a>

        <div class="right menu">
            <a href="/blog" class="{{ ($_SERVER['REQUEST_URI'] == '/blog') ? 'active' : '' }} item">Blog</a>
            <a href="/cv" class="{{ ($_SERVER['REQUEST_URI'] == '/cv') ? 'active' : '' }} item">CV</a>
            <a href="/" class="item">Search</a>
        </div>
    </div>
</div>
