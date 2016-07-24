@extends('frontend.template')

@section('content')

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
                        <img class="" src="/assets/img/author-photo.jpg" alt="Author Photo">
                    </div>
                </div>

                {{-- Skills --}}
                <h2>Skills</h2>
                <p>
                    <strong>PHP</strong> — 5 years of experience.
                    <br>
                    <strong>Laravel</strong> — 2 years of experience.
                    <br>
                    <strong>Codeigniter</strong> — 1 year of experience.
                    <br>
                    <strong>Joomla 2.x</strong> — 2 years of experience.
                    <br>
                    <strong>OOP</strong> — 4 years of experience.
                    <br>
                    <strong>MySQL/MariaDB</strong> — 5 years of experience.
                    <br>
                    <strong>Redis</strong> — 2 years of experience.
                    <br>
                    <strong>HTML</strong> — 5 years of experience.
                    <br>
                    <strong>CSS</strong> — 5 years of experience.
                    <br>
                    <strong>Javascript</strong> — 3 years of experience.
                    <br>
                    <strong>Git</strong> — 3 years of experience.
                    <br>
                    <strong>English language</strong> — Beginer.
                </p>
                <p>
                    I have experience working with:
                    <ul>
                        <li>Linux</li>
                        <li>Bash</li>
                        <li>Nginx</li>
                        <li>PHP-FPM</li>
                        <li>OPCache</li>
                        <li>XCache</li>
                        <li>PHPUnit</li>
                        <li>Codeception</li>
                        <li>TeamCity</li>
                        <li>Search Engine Optimization</li>
                        <li>Bootstrap</li>
                        <li>Semantic UI</li>
                        <li>Node.js (brief experience)</li>
                        <li>Gulp</li>
                    </ul>
                </p>


                {{-- Experience --}}
                <h2>Experience</h2>
                <b>Full Stack Web Developer</b>
                <p>
                    Jan 2014 — Present
                    <br>
                    Freelance
                </p>
                <b>PHP/Web Developer</b>
                <p>
                    May 2010 — Jan 2014
                    <br>
                    Klookva Web Studio - E-commerce, Product Development
                </p>

                {{-- Education --}}
                <h2>Education</h2>
                <h3>Certificates</h3>
                <p>
                    2016
                    <br>
                    <a href="https://stepic.org/certificate/7657358418adc90ff77c36b806b694ff189bd21c.pdf"
                       target="_blank"
                       rel="nofollow"
                    >
                        Analyze of web projects security (Stepic.org)
                    </a>
                    <br>

                    <a href="/uploads/files/2016/06/Certificate_OO_PHP_Pluralsight.pdf"
                       target="_blank"
                       rel="nofollow"
                    >
                        Object-oriented PHP: Essential Constructs (Pluralsight)
                    </a>
                    <br>
                    <a href="https://certification.mail.ru/certificates/9df13756-173e-4f80-8510-3496c214a19a/en/"
                       target="_blank"
                       rel="nofollow"
                    >
                        PHP5 (Mail.ru)
                    </a>
                </p>
                <p>
                    2015
                    <br>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100839087"
                    >
                        PHP: OOP and Classes (Intuit.ru)
                    </a>
                </p>
                <p>
                    2014
                    <br>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100824314"
                    >
                        Introduction to DBMS MySQL (Intuit.ru)
                    </a>
                    <br>
                    <a target="_blank"
                       rel="nofollow"
                       href="http://www.intuit.ru/verifydiplomas/100825851"
                    >
                        Algorithms of Client Side Optimization (Intuit.ru)
                    </a>
                </p>

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

                {{-- Hobbies --}}
                <h2>Hobbies</h2>
                <p>
                    As a hobby I investigate web performance optimization techniques, try to contribute to
                    open-source
                    projects, develop composer packages and different tools.
                </p>
                <p>
                    Also I am quite interested in system administration and web analytics.
                </p>
                <p>
                    Love photography and interested in design.
                </p>
            </div>
        </div>
    </main>
@endsection