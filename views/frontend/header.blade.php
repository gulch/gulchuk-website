<div class="ui menu">
    <div class="ui container">
        <a href="/" class="borderless item">
            <img src="/assets/img/logo-gulchuk.png" alt="Gulchuk Website Logo">
        </a>

        <div class="right menu">
            <a href="/blog" class="{{ ($_SERVER['REQUEST_URI'] == '/blog') ? 'active' : '' }} item">Blog</a>
            <a href="/cv" class="{{ ($_SERVER['REQUEST_URI'] == '/cv') ? 'active' : '' }} item">CV</a>
            <a href="/" class="item">Search</a>
        </div>
    </div>
</div>
