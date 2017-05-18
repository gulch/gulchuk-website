<?php /** @var $this \League\Plates\Template\Template */ ?>

<?php
    $this->layout('frontend/template', [
        'title' => 'Books :: Gulchuk Volodymyr',
        'description' => 'Books I have read and recommends. Books what I am currently reading.',
        'keywords' => 'books, php, it, javascript, nginx, redis, refactoring, ddd',
    ])
?>

<main>
    <div class="ui container blog-container">

        <h1 class="ui huge header blog-header-title">
            Books
        </h1>


        <h2>Currently reading...</h2>


        <div class="ui small header">
            <a href="https://leanpub.com/phpoopway" target="_blank" rel="nofollow noopener">
                PHP OOP Way
            </a>
            <div class="sub header">
                Sergey Zhuk
            </div>
        </div>


        <div class="ui hidden divider"></div>


        <h2>Books I've read and recommend</h2>


        <div class="ui small header">
            <a href="https://www.packtpub.com/application-development/php-microservices"
               target="_blank"
               rel="nofollow noopener"
            >
                PHP Microservices
            </a>
            <div class="sub header">
                Carlos Perez Sanchez, Pablo Solar Vilariño
            </div>
        </div>

        <div class="ui small header">
            <a href="https://www.packtpub.com/application-development/functional-php"
               target="_blank"
               rel="nofollow noopener"
            >
                Functional PHP
            </a>
            <div class="sub header">
                Gilles Crettenand
            </div>
        </div>

        <div class="ui small header">
            <a href="https://www.phparch.com/books/phparchitects-guide-to-enterprise-php-development/"
               target="_blank"
               rel="nofollow noopener"
            >
                php|architect’s Guide to Enterprise PHP Development
            </a>
            <div class="sub header">
                Ivo Jansch
            </div>
        </div>

        <div class="ui small header">
            <a href="https://leanpub.com/ddd-in-php" target="_blank" rel="nofollow noopener">
                Domain-Driven Design in PHP
            </a>
            <div class="sub header">
                Carlos Buenosvinos, Christian Soronellas, and Keyvan Akbary
            </div>
        </div>

        <div class="ui small header">
            <a href="https://leanpub.com/deploying-php-applications"
               target="_blank"
               rel="nofollow noopener"
            >
                Deploying PHP Applications
            </a>
            <div class="sub header">
                Niklas Modess
            </div>
        </div>

        <div class="ui small header">
            <a href="https://leanpub.com/modern-application-development-with-php"
               target="_blank"
               rel="nofollow noopener"
            >
                Modern Application Development with PHP
            </a>
            <div class="sub header">
                Tom Oram
            </div>
        </div>

        <div class="ui small header">
            <a href="http://www.apress.com/gp/book/9781484221136"
               target="_blank"
               rel="nofollow noopener"
            >
                Typed PHP
            </a>
            <div class="sub header">
                Pitt Christopher
            </div>
        </div>


        <div class="ui small header">
            <a href="https://leanpub.com/scalingphpapplications"
               target="_blank"
               rel="nofollow noopener"
            >
                Elephant sized PHP
            </a>
            <div class="sub header">
                Andy Beak
            </div>
        </div>

        <div class="ui small header">
            <a href="https://leanpub.com/buildingsecurephpapps"
               target="_blank"
               rel="nofollow noopener"
            >
                Building Secure PHP Apps
            </a>
            <div class="sub header">
                Ben Edmunds
            </div>
        </div>

        <div class="ui small header">
            <a href="http://shop.oreilly.com/product/0636920042860.do"
               target="_blank"
               rel="nofollow noopener"
            >
                PHP Web Services
            </a>
            <div class="sub header">
                Lorna Jane Mitchell
            </div>
        </div>


    </div>
</main>
