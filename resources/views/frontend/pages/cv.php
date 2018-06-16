<?php /** @var $this \League\Plates\Template\Template */ ?>

<?php
    $this->layout('frontend/template', [
        'noindex' => true,
        'title' => 'CV :: Gulchuk Volodymyr',
        'description' => '',
        'keywords' => '',
    ])
?>

<main class="ui container">
    <div class="ui hidden divider"></div>
    <div class="ui centered grid">
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
            <div class="ui header">
                <i class="icon">
                    <svg class="fi-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-skills"></use>
                    </svg>
                </i>
                <div class="content">
                    Skills
                    <div class="sub header">List of my technical skills</div>
                </div>
            </div>
            <p>
                <strong>PHP</strong> — 5+ years of experience
                <br>
                <strong>Laravel</strong> — 3 years of experience
                <br>
                <strong>Codeigniter</strong> — 1 year of experience
                <br>
                <strong>Joomla 2.x</strong> — 2 years of experience
                <br>
                <strong>MySQL/MariaDB</strong> — 5+ years of experience
                <br>
                <strong>Redis</strong> — 2 years of experience
                <br>
                <strong>HTML</strong> — 5+ years of experience
                <br>
                <strong>CSS</strong> — 5+ years of experience
                <br>
                <strong>Javascript</strong> — 3 years of experience
                <br>
                <strong>Linux</strong> — 5+ years of experience
                <br>
                <strong>Git</strong> — 4 years of experience
                <br>
                <strong>English language</strong> — Beginner
            </p>
            <p>
                I have experience working with:
                <ul>
                    <li>
                        writing Linux Bash scripts;
                    </li>
                    <li>
                        fully configure Nginx;
                    </li>
                    <li>
                        configure PHP-FPM;
                    </li>
                    <li>
                        install and configure Redis Server, php-redis, php-iredis extensions;
                    </li>
                    <li>
                        PHP optimization: tunning configuration, Opcache, XCache, profiling;
                    </li>
                    <li>
                        brief experience with Codeception, PHPUnit;
                    </li>
                    <li>
                        install and configure TeamCity, Jenkins;
                    </li>
                    <li>
                        client side optimization (js/css minification, webfont optimization, lazy loading etc);
                    </li>
                    <li>
                        Gulp;
                    </li>
                    <li>
                        Search Engine Optimization;
                    </li>
                    <li>
                        works with css/js frameworks: Bootstrap, Semantic UI.
                    </li>
                </ul>
            </p>

            <div class="ui hidden divider"></div>

            <!-- Experience -->
            <div class="ui header">
                <i class="icon">
                    <svg class="fi-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-experience"></use>
                    </svg>
                </i>
                <div class="content">
                    Experience
                    <div class="sub header">List of projects in which I participated</div>
                </div>
            </div>

            <b>Full Stack Web Developer</b>
            <p>
                Dec 2014 — Now
                <br>
                Funtime
            </p>

            Projects:
            <div class="ui bulleted list">
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Funtime Kiev - online guide of the best locations and great events.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="https://funtime.kiev.ua">funtime.kiev.ua</a>
                        </div>
                        <div class="description">
                            <p>
                                Full development cycle: design, frontend, backend, api, seo, email campaigns configure etc.
                                <br>
                                Technologies/frameworks: PHP, Laravel 5, Semantic UI, Javascript, jQuery, Redis, MySQL/MariaDB.
                            </p>

                            Features:
                            <ul>
                                <li>
                                    Booking module fully integrated with
                                    <a target="_blank" rel="nofollow noopener"
                                       href="https://turbosms.ua/soap.html"
                                    >
                                        TurboSMS SOAP API</a>.
                                </li>
                                <li>
                                    Advanced advertising management module.
                                </li>
                                <li>
                                    Shortlink service.
                                </li>
                                <li>
                                    Statistics data collecting and analysis module.
                                </li>
                                <li>
                                    Integration with
                                    <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/">
                                        Google Maps JavaScript API</a>,
                                    <a target="_blank" href="https://developers.google.com/maps/documentation/static-maps/">
                                        Google Static Maps API</a>,
                                    <a target="_blank" href="https://tech.yandex.ru/maps/">
                                        Yandex Maps API</a>,
                                    <a target="_blank" href="https://developers.facebook.com/docs/graph-api">
                                        Facebook Graph API</a>,
                                    <a target="_blank" href="https://developers.facebook.com/docs/javascript">
                                        Facebook SDK for JavaScript</a>,
                                    <a target="_blank" href="https://vk.com/dev/openapi">VK Open API</a>.
                                </li>
                                <li>
                                    Implemented
                                    <a target="_blank" href="https://www.ssllabs.com/ssltest/analyze.html?d=funtime.kiev.ua">
                                        secure HTTPS connection</a>.
                                </li>
                                <li>
                                    Optimized for best
                                    <a target="_blank" href="http://www.webpagetest.org/result/170424_GC_AKE/">
                                        web performance results</a>.
                                </li>
                                <li>
                                    HTTP2 Protocol support.
                                </li>
                                <li>
                                    Implemented
                                    <a target="_blank" href="https://github.com/google/brotli">
                                        Brotli
                                    </a>
                                    support.
                                </li>
                                <li>
                                    Additional WebP images generation for supported browsers.
                                </li>
                                <li>
                                    Configured for
                                    <a target="_blank" href="https://observatory.mozilla.org/analyze.html?host=funtime.kiev.ua">
                                        maximum Web Security</a>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui hidden divider"></div>

            <b>Full Stack Web Developer</b>
            <p>
                Jan 2014 — Dec 2014
                <br>
                Freelance
            </p>
            Projects:
            <div class="ui bulleted list">
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Sphered - representative website for VR and panoramic photo project.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="https://sphered.com.ua">sphered.com.ua</a>
                        </div>
                        <div class="description">
                            Full development cycle. Technologies/frameworks: PHP, Laravel5, Semantic UI, jQuery,
                            threesixty, Pano2VR.
                        </div>
                    </div>
                </div>
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Oha-Oha! - local social network, service for rent things.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="http://oha-oha.com.ua">oha-oha.com.ua</a>
                        </div>
                        <div class="description">
                            Full development cycle. Technologies/frameworks: PHP, Laravel4, Semantic UI 1.x, jQuery.
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui hidden divider"></div>

            <b>PHP/Web Developer</b>
            <p>
                May 2010 — Jan 2014
                <br>
                Klookva Web Studio - E-commerce, Product Development
            </p>
            Some major of all projects:
            <div class="ui bulleted list">
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Tik-Tak - e-commerce website for network of clock stores.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="http://tik-tak.ua/">tik-tak.ua</a>
                        </div>
                        <div class="description">
                            Configure online shop based on Joomla CMS.
                            Developed additional modules, components and plugins.
                            Created module for importing goodies from Excel files.
                        </div>
                    </div>
                </div>
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Flosmall - Best Chinese Phones Shop.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="https://flosmall.com/">flosmall.com</a>
                        </div>
                        <div class="description">
                            Configure online shop based on Joomla CMS.
                            Developed additional modules, components and plugins.
                        </div>
                    </div>
                </div>
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Tour 365 - hotels booking service
                            <br>
                            &nearr; <a rel="nofollow" target="_blank" href="http://tour-365.com.ua/">tour-365.com.ua</a>
                        </div>
                        <div class="description">
                            Developed booking module, which was integrated with Profit system.
                        </div>
                    </div>
                </div>
                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Midexpress - Gadgets shop.
                            <br>
                            &nearr; <a rel="nofollow" target="_blank"
                                       href="http://midexpress.com.ua/">midexpress.com.ua</a>
                        </div>
                        <div class="description">
                            Configure online shop based on Joomla CMS.
                            Developed additional modules, components and plugins.
                            Created module for importing goodies from Excel files.
                        </div>
                    </div>
                </div>

                <div class="ui item">
                    <div class="content">
                        <div class="header">
                            Web system for a political party for separate gathering and analysis of votes in elections.
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui hidden divider"></div>

            <!--Education-->
            <div class="ui header">
                <i class="icon">
                    <svg class="fi-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-diploma"></use>
                    </svg>
                </i>
                <div class="content">
                    Education
                    <div class="sub header">My goals in education field</div>
                </div>
            </div>

            <h3>Certificates</h3>
            <p>
                2018
            </p>
            <ul>
                <li>
                    <a href="https://www.englishdom.com/cn/abdf048d/"
                       target="_blank"
                       rel="nofollow noopener"
                    >
                        English for IT
                    </a>
                </li>
            </ul>


            <p>
                2017
            </p>
            <ul>
                <li>
                    <a href="/uploads/files/2017/12/2425330_382101.en.pdf"
                       target="_blank"
                       rel="nofollow"
                    >
                        PHP. Advanced (Geekbrains)
                    </a>
                </li>
            </ul>

            <p>
                2016
            </p>
            <ul>
                <li>
                    <a href="https://stepic.org/certificate/7657358418adc90ff77c36b806b694ff189bd21c.pdf"
                       target="_blank"
                       rel="nofollow"
                    >
                        Analyze of web projects security (Stepic.org)
                    </a>
                </li>
                <li>
                    <a href="/uploads/files/2016/06/Certificate_OO_PHP_Pluralsight.pdf"
                       target="_blank"
                       rel="nofollow"
                    >
                        Object-oriented PHP: Essential Constructs (Pluralsight)
                    </a>
                </li>
                <li>
                    <a href="https://certification.mail.ru/certificates/9df13756-173e-4f80-8510-3496c214a19a/en/"
                       target="_blank"
                       rel="nofollow"
                    >
                        PHP5 (Mail.ru)
                    </a>
                </li>
            </ul>

            <p>
                2015
            </p>
            <ul>
                <li>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100839087"
                    >
                        PHP: OOP and Classes (Intuit.ru)
                    </a>
                </li>
            </ul>

            <p>
                2014
            </p>

            <ul>
                <li>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100824314"
                    >
                        Introduction to DBMS MySQL (Intuit.ru)
                    </a>
                </li>
                <li>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100825851"
                    >
                        Algorithms of Client Side Optimization (Intuit.ru)
                    </a>
                </li>
            </ul>

            <h3>Master's degree</h3>
            <p>
                2010 - 2012
                <br>
                National Technical University of Ukraine "Kyiv Polytechnic Institute"
            </p>
            <h3>Bachelor's degree</h3>
            <p>
                2006 - 2010
                <br>
                National Technical University of Ukraine "Kyiv Polytechnic Institute"
            </p>

            <div class="ui hidden divider"></div>

            <!--Hobbies-->
            <div class="ui header">
                <i class="icon">
                    <svg class="fi-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fi-diaphragm"></use>
                    </svg>
                </i>
                <div class="content">
                    Hobbies
                    <div class="sub header">My hobbies and what I like</div>
                </div>
            </div>

            <p>
                As a hobby, I investigate web performance optimization techniques, try to contribute to
                open-source
                projects, develop composer packages and different tools.
            </p>
            <p>
                Also, I am quite interested in system administration and web analytics.
            </p>
            <p>
                Love photography and interested in design.
            </p>
        </div>
    </div>
</main>