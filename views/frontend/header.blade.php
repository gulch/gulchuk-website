<div class="hero-header">
    <header class="header">
        <div class="container">
            <div class="header-left">
                <a class="header-item" href="/">
                    <svg id="main-menu-logo">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                    </svg>
                </a>
            </div>

            <span id="header-toggle" class="header-toggle">
              <span></span>
              <span></span>
              <span></span>
            </span>

            <div id="header-menu" class="header-right header-menu">
                <a class="header-item {{ ($_SERVER['REQUEST_URI'] == '/cv') ? 'is-active' : '' }}" href="/cv">
                    CV
                </a>
                <a class="header-item {{ ($_SERVER['REQUEST_URI'] == '/blog') ? 'is-active' : '' }}" href="/blog/">
                    Blog
                </a>

                <div class="header-item">
                  <button class="button is-info is-outlined">
                      Search
                  </button>
                </div>

            </div>
        </div>
    </header>
</div>
