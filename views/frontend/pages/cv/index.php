<?php

/** @var $this \League\Plates\Template\Template */ ?>

<?php
$this->layout('frontend/template', [
    'noindex' => true,
    'title' => 'CV :: Gulchuk Volodymyr',
    'description' => '',
    'keywords' => '',
])
?>

<main class="ui container blog-container">
    <div class="left aligned fourteen wide computer column sixteen wide tablet">

        <div class="ui two columns grid">
            <div class="ui column">
                <h1 class="ui large header">Volodymyr Gulchuk</h1>
                <h2>PHP/Web Developer</h2>
                <p>
                    Birthday: 20 Jan 1989
                    <br>
                    Location: Kyiv, Ukraine
                    <br>
                    Email: volodymyr@gulchuk.com
                </p>
            </div>
            <div class="ui right aligned column">
                <img src="/assets/img/author-photo.jpg" alt="Author Photo">
            </div>
        </div>

        <div class="ui hidden divider"></div>

        <!--Skills-->
        <?php $this->insert('frontend/pages/cv/skills') ?>

        <div class="ui hidden divider"></div>

        <!-- Experience -->
        <?php $this->insert('frontend/pages/cv/experience') ?>

        <div class="ui hidden divider"></div>

        <!--Education-->
        <?php $this->insert('frontend/pages/cv/education') ?>

        <div class="ui hidden divider"></div>

        <!--Hobbies-->
        <?php $this->insert('frontend/pages/cv/hobbies') ?>

    </div>
</main>
