<header>
    <nav class="ui container stackable menu">

        <a href="/" title="Gulchuk.com" class="item">
            <svg id="main-menu-logo"><use href="#logo"></use></svg>
        </a>
        
        <div class="right menu">
            <a href="/cv" title="CV" class="item <?= ($_SERVER['REQUEST_URI'] === '/cv') ? 'active' : '' ?>">
                <i class="icon">
                    <svg class="gi-icon"><use href="#cv"></use></svg>
                </i>
                CV
            </a>
            <a href="/books" title="Books" class="item <?= ($_SERVER['REQUEST_URI'] === '/books') ? 'active' : '' ?>">
                <i class="icon">
                    <svg class="gi-icon"><use href="#books"></use></svg>
                </i>
                Books
            </a>
            <a href="/blog" title="Blog" class="item <?= ($_SERVER['REQUEST_URI'] === '/blog') ? 'active' : '' ?>">
                <i class="icon">
                    <svg class="gi-icon"><use href="#blog"></use></svg>
                </i>
                Blog
            </a>
        </div>
        
    </nav>
</header>
