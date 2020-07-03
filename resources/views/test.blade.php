<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="romania feng shui, feng shui , metafizica chineza, zodiacul chinezesc, marian golea, anca dimancea, alina badic, 360 de grade, 6tv, antena stars, feng shui bucuresti, lillian too, fengshui4life, sobolan, bivol, tigru, iepure, dragon, sarpe, cal, oaie, maimuta, cocos, caine, mistret, remedii feng shui, remedii sanatate, remedii pentru zodii, remedii prosperitate, remedii business, remedii dragoste, remedii noroc, bijuterii feng shui, cursuri feng shui, cursuri paht chee, elemente feng shui, lemn, pamant, apa, foc, metal, despre feng shui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-reboot.min.css"> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/glider.min.css') }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <title>@yield('title')</title>

</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <!-- Dropdown Navigation Menu -->
        <!-- Logo Text Romania  Feng Shui -->
        <div class="container">
            <a href="#" class="navbar-brand2"><img class="logo-text" src="img/logo-text.png" alt="logo"></a>
            <!-- Logo Text Romania  Feng Shui -->
            <nav class="navbar navbar-expand-lg navbar-dark ">
                <!-- Logo Nod Mistic -->
                <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo"></a>
                <!-- Logo Nod Mistic -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown _megaMenu">
                            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Magazin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    </ul>
                    <!-- Search bar -->
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Cauta..." aria-label="Search">
                        <button class="btn btn-primary badge-pill my-2 my-sm-0" type="submit"><i class="fa fa-search"
                                aria-hidden="true"></i></button>
                    </form>
                    <!-- End -- Search bar -->
                </div>
        </div>
        </nav>
        <div class="left-line"></div>
        <div class="right-line"></div>
        <div class="home-banner">
            <div class="bg-video">
                <video class="bg-video__content" autoplay muted loop>
                    <source src="img/video.mp4" type="video/mp4">
                </video>
            </div>

            <div class="text-box">
                <h1 class="heading-primary">
                    <span class="heading-primary--main">Cursuri Feng Shui</span>
                    <span class="heading-primary--sub">Vrei sa devii maestru Feng Shui?</span>
                </h1>
                <a href="#" class="btn btn--white btn--animated">Afla mai multe</a>
            </div>
        </div>
        </div>
    </header>
    <!-- Aici se incheie Headerul -->

    <main class="mainContent">
        @yield('mainContent')
        <!-- Sectiune Studenti Recomandati -->
        <section class="glider-contain multiple students-main section__students">
            <button class=" glider-prev carousel__button carousel__button--left">
                <i class="fas fa-chevron-left arrow-left-students"></i>
            </button>
            <h1 class="students-h1">Absolventi Recomandati</h1>
            <div class="glider glider-track carousel">

                <!-- Student 1 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student1.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 1 -->

                <!-- Student 2 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student3.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 2 -->

                <!-- Student 3 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student1.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 3 -->

                <!-- Student 4 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student3.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 4 -->

                <!-- Student 5 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student3.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 5 -->

                <!-- Student 6 -->
                <div class="wrap-students" data-tilt>
                    <div class="students">
                        <img class="students-img" src="/img/student3.jpg" alt="student-image">
                        <h2 class="students-name">Nick Harrison</h2>
                        <p class="students-description">Absolvent Feng Shui</p>
                        <div class="divider__students"></div>
                        <ul class="ulStudents__social-media">
                            <li><a href="#"><i class="icons__socialMedia fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="icons__socialMedia fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END -- Student 6 -->
            </div>
            <button class="glider-next carousel__button carousel__button--right">
                <i class="fas fa-chevron-right arrow-right-students"></i>
            </button>

            <div id="resp-dots" class="glider-dots dots carousel__nav">
                <!-- <button class="carousel__indicator"></button>
                <button class="carousel__indicator"></button>
                <button class="carousel__indicator"></button> -->
            </div>
        </section>
        <!-- End -- Sectiune Studenti Recomandati -->

        <!-- Sectiune Categorii Produse -->

        <!-- 1 Sectiune Categorii -->
        <section id="productCategories">
            <div class="productWrapper">
                <div class="productContainer">
                    <div class="categoryImg-wrapper">
                        <img class="categoryImage1" src="/img/remedii2.png" alt="Pagoda">
                        <div class="rombLeft"></div>
                        <div class="rombLeft2"></div>
                        <div class="rombLeft3"></div>
                        <div class="rombLeft4"></div>
                        <div class="rombLeft5"></div>
                        <div class="rombLeft6"></div>
                    </div>
                    <div class="categoryDescription1">
                        <h1 class="categoryHeading">Remedii Feng Shui</h1>
                        <p class="categoryDetails">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo
                            nesciunt inventore rerum maiores laboriosam id laudantium odio aut. Sequi maiores dolore
                            consectetur soluta praesentium velit perspiciatis commodi. Eum, vero in.</p>
                        <a href="#" class="categoryBtn">Afla mai multe</a>
                    </div>
                </div>
                <div class="bgSquare1"></div>
                <div class="bgSquare2"></div>
                <div class="bgSquare3"></div>
            </div>
        </section>
        <!-- END -- 1 Sectiune Categorii -->

        <!-- 2 Sectiune Categorii -->
        <section id="productCategories2">
                <div class="productWrapper2">
                    <div class="productContainer2">
                        <div class="categoryImg-wrapper2">
                            <img class="categoryImage2" src="/img/bratara-jad.png" alt="Bratara Jad">
                        </div>
                        <div class="categoryDescription2">
                            <h1 class="categoryHeading2">Magazin</h1>
                            <p class="categoryDetails2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo
                                nesciunt inventore rerum maiores laboriosam id laudantium odio aut. Sequi maiores dolore
                                consectetur soluta praesentium velit perspiciatis commodi. Eum, vero in.</p>
                            <a href="#" class="categoryBtn2">Afla mai multe</a>
                        </div>
                    </div>
                    <div class="bgSquareLeft1"></div>
                    <div class="bgSquareLeft2"></div>
                    <div class="bgSquareLeft3"></div>
                </div>
            </section>
            <!-- END 2 Sectiune Categorii -->

        <!-- END -- Sectiune Categorii Produse -->

        <!-- Sectiune Echipa Noastra -->
        <section class="team">
            <div class="container">
                <h1 class="heading-team">Despre Noi</h1>
                <div class="card-wrapper">
                    <div class="card-team card-left-team" data-aos="fade-right">
                        <!-- <img src="/img/marian.png" alt="card background" class="card-img"> -->
                        <img src="/img/marian.png" alt="profile image" class="profile-img">
                        <h1 class="card-h1">Marian Golea</h1>
                        <p class="job-title">Maestru Feng Shui</p>
                        <p class="card-about card-telefon"><strong>Telefon:</strong> 0737 148 888</p>
                        <p class="card-about card-email"><strong>Email:</strong> goleamarian@yahoo.com</p>
                        <ul class="social-media">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!--#1 end div-->

                    <div class="card-team card-right-team" data-aos="fade-left">
                        <!-- <img src="/img/ancad.png" alt="card background" class="card-img"> -->
                        <img src="/img/ancad.png" alt="profile image" class="profile-img">
                        <h1 class="card-h1">Anca Dimancea</h1>
                        <p class="job-title">Maestru Feng Shui</p>
                        <p class="card-about card-telefon"><strong>Telefon:</strong> 0737 138 888</p>
                        <p class="card-about card-email"><strong>Email:</strong> ancadimancea@yahoo.com</p>
                        <ul class="social-media">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!--#2 end div-->
                </div>
            </div>
        </section>
        <!-- End -- Sectiune Echipa Noastra -->


    </main>

    <!-- Go to Top Button -->
    <a class="gotopbtn" id="back-to-top-btn" href="#"><i class="fas fa-angle-double-up"></i></a>
    <!-- Sfarsit Go to Top Button -->

    <!--Aici incepe  FOOTER-ul -->
    <footer class="footer">
        <div id="contact">
            <div class="footer-container">
                <div class="row">
                    <br><br>
                    <div class="footer-brand-container">
                        <!-- Aici incepe Logo Nod Mistic -->
                        <a class="footer-brand" href="#"><img src="img/logo.png" alt="logo"
                                class="footer-brand-img"></a>
                        <!-- Aici se incheie Logo Nod Mistic -->

                        <!-- Aici incepe Logo Text -->
                        <a class="footer-brand" href="#"><img src="img/logo-text.png" alt="logo"
                                class="footer-text-brand-img"></a>
                        <!-- Aici se incheie Logo Text Footer -->
                    </div>

                    <div class="contact-left-main">
                        <div id="contact-left">
                            <br>
                            <div id="contact-info">
                                <ul class="footer-ul-contact">
                                    <li class="footer-li-map"><i class="fas fa-map-marker-alt"></i></li>
                                    <p class="footer-p-adresa">Strada Turda Nr. 100, Sector 1, Bucuresti, Romania </p>
                                    <li class="footer-li-phone"><i class="fa fa-phone"></i></li>
                                    <p class="footer-p-telefon">0737 138 888</p>
                                    <li class="footer-li-envelope"><i class="far fa-envelope"></i></li>
                                    <p class="footer-p-email"><a class="footer-email-link"
                                            href="mailto:romania_fengshui@yahoo.com">romania_fengshui@yahoo.com </a></p>

                                </ul>
                            </div>
                            <hr class="hr-footer-line">
                        </div>
                    </div>
                    <div class="contact-right-main">

                    </div>
                </div>
            </div>
            <div class="newsletter-footer">
                <form class="nl">
                    <button class="nl__btn-footer">
                        Aboneaza-te !
                    </button>
                    <input type="text" placeholder="adresa@email.com" class="nl__input">
                </form>
            </div>
            <br>
            <div id="footer-bottom">
                <div class="footer-bottom-container">
                    <div class="row">
                        <div class="social-container">
                            <ul class="social-list">
                                <li><a href="https://www.facebook.com/romania.fengshui/?__tn__=%2Cd%2CP-R&eid=ARASrL7smqxqqANrrYf3xpHAbcpGifgpw59fdqv00nG0ASb8PYBwghxp89--wgQiySY_nCJa6SFWRc_2"
                                        class="social-icon"><i class="fab fa-facebook-f"></i></a></li>

                                <li><a href="https://www.instagram.com/romania_feng_shui/" class="social-icon"><i
                                            class="fab fa-instagram"></i></a></li>

                                <li><a href="https://twitter.com/RomaniaFengShui" class="social-icon"><i
                                            class="fab fa-twitter"></i></a></li>

                                <li><a href="https://www.youtube.com/channel/UCo9Jdf22WkM7n2dYf-SpVEQ"
                                        class="social-icon"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <div id="footer-copyright">
                                <p class="footer-p-copyright">&copy; Copyright {{ now()->year }} | Made with <a
                                        class="footer-a-copyright" href="#"><span class="inima">&#10084;
                                        </span>DeCA23Designs</a></p>
                            </div>
                        </div>
                        <div class="footer-bottom-links">
                            <ul class="footer-bottom-ul">
                                <li class="footer-list-bottom-privacy"><a href="#"
                                        class="footer-link-bottom">Privacy</a></li>
                                <li class="footer-list-bottom-terms"><a href="#" class="footer-link-bottom">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Aici se termina FOOTER-ul -->

    <!-- CDNs ONLY-->

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- END -- Jquery CDN -->

    <!-- Scroll Reveal CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- END -- Scroll Reveal CDN -->

    <!-- Popper.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- END -- Popper.js CDN -->

    <!-- Bootstrap CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- END -- Bootstrap CDN -->

    <!-- Bootstrap Bundle CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- End -- Bootstrap Bundle CDN -->

    <!-- Animation on Scroll CDN -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- End -- Animation on Scroll CDN -->

    <!-- SCRIPTS ONLY-->

    <!-- Search bar Script -->
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Glider Min Js Script -->
    <script src="{{ asset('js/glider.min.js') }}"></script>
    <!-- Sfarsit -- Glider Min Js Script -->

    <!-- Slider Studenti Recomandati Script -->
    <script src="{{ asset('js/sliderStudents.js') }}"></script>
    <!-- Sfarsit -- Slider Studenti Recomandati Script -->

    <!-- Tilt JS Script -->
    <script src="{{ asset('js/tilt.js') }}"></script>
    <!-- Sfarsit -- Tilt JS Script -->

    <!-- Romb Animation Product Category Script -->
    <script src="{{ asset('js/square__animation1.js') }}"></script>
    <!-- Sfarsit -- Romb Animation Product Category Script -->

    <!-- Romb Animation Product Category Script -->
    <script src="{{ asset('js/square__animation2.js') }}"></script>
    <!-- Sfarsit -- Romb Animation Product Category Script -->

    <!-- Search bar Script -->
    <script src="{{ asset('js/parallax.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Search bar Script -->
    <script src="{{ asset('js/footer.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Back to Top Button Script -->
    <script src="{{ asset('js/backtotop.js') }}"></script>
    <!-- Sfarsit Back to Top Button Script -->


    <script>
        AOS.init({
            once: true
        });

    </script>

    @yield('scripts')
</body>

</html>
