<header class="header">
    <div class="container">

        <!-- Left side -->
        <div class="header-left">
            <a class="header-item" href="/">
                <svg id="main-menu-logo">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                </svg>
            </a>
        </div>

        <!-- Hamburger menu (on mobile) -->
        <span class="header-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>

        <!-- Right side -->
        <div class="header-right header-menu">
            <span class="header-item">
                <a href="/blog" class="{{ ($_SERVER['REQUEST_URI'] == '/blog') ? 'active' : '' }} item">Blog</a>
            </span>
            <span class="header-item">
                <a href="/cv" class="{{ ($_SERVER['REQUEST_URI'] == '/cv') ? 'active' : '' }} item">CV</a>
            </span>
            <span class="header-item">
                <a href="/" class="item button">Search</a>
            </span>
        </div>

    </div>
</header>
