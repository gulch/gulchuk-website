<header>
    <nav class="ui menu">
        <div class="ui container">
            <a href="/"
               title="Gulchuk.com"
               class="item"
            >
                <svg id="main-menu-logo">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-logo"></use>
                </svg>
            </a>
            <div class="right menu">
                <a href="/cv"
                   title="CV"
                   class="item <?= ($_SERVER['REQUEST_URI'] === '/cv') ? 'active' : '' ?>"
                >
                    <i class="icon">
                        <svg class="fi-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-cv"></use>
                        </svg>
                    </i>
                    CV
                </a>
                <a href="/books"
                   title="Books"
                   class="item <?= ($_SERVER['REQUEST_URI'] === '/books') ? 'active' : '' ?>"
                >
                    <i class="icon">
                        <svg class="fi-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-books"></use>
                        </svg>
                    </i>
                    Books
                </a>
                <a href="/blog"
                   title="Blog"
                   class="item <?= ($_SERVER['REQUEST_URI'] === '/blog') ? 'active' : '' ?>"
                >
                    <i class="icon">
                        <svg class="fi-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-blog"></use>
                        </svg>
                    </i>
                    Blog
                </a>
            </div>
        </div>
    </nav>
</header>