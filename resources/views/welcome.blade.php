<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{config('app.name')}}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets1/img/hero-img.png" rel="icon">
  <link href="assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets1/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets1/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eStartup
  * Template URL: https://bootstrapmade.com/estartup-bootstrap-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets1/img/buksu-logo.png" alt="Logo" class="logo-img">
            <h1 class="sitename">WST-SAAS</h1>
        </a>
        <nav id="navmenu" class="navmenu d-flex align-items-center">
            @auth
            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
            <div class="auth-links d-flex">
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            </div>
            @endauth
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>


  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2>Software as a Service</h2>

            <p>The BukSU Student Information System (SIS) is a Laravel-based platform for managing student enrollment, 
                subjects, and grades with secure authentication and role-based access.
            </p>

            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets1/img/hero-img.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>

      <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
        <div class="container position-relative">
          <div class="row gy-4 mt-5">

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-easel"></i></div>
                <h4 class="title"><a href="" class="stretched-link">Authentication</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-gem"></i></div>
                <h4 class="title"><a href="" class="stretched-link">Authorization</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-geo-alt"></i></div>
                <h4 class="title"><a href="" class="stretched-link">CRUDES</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-command"></i></div>
                <h4 class="title"><a href="" class="stretched-link">Grades & Enrollment</a></h4>
              </div>
            </div><!--End Icon Box -->

          </div>
        </div>
      </div>
    </section>

  

    <section id="developers" class="about section">

        <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="230">
        <div class="container position-relative">

        <div class="section-title text-center">
            <h1 class="display-4 fw-bold">Developers</h1>
        </div>
            <div class="row gy-4 mt-5">

            <!-- Developer 1 -->
            <div class="col-xl-3 col-md-6">
                <div class="icon-box text-center">
                <div class="icon">
                    <img src="assets1/img/rene.jpg" alt="Developer 1" class="img-fluid rounded-circle" style="width: 140px; height: 140px; object-fit: cover;">
                </div>
                <h4 class="title mt-3"><span>Rene Rey Sale</span></h4>
                <hr class="divider my-2">
                <p class="developer-description small mt-2">Full Stack Developer – Builds both frontend and backend components, ensuring seamless integration between user interface and server logic.</p>

                </div>
            </div><!-- End Developer -->

            <!-- Developer 2 -->
            <div class="col-xl-3 col-md-6">
                <div class="icon-box text-center">
                <div class="icon">
                    <img src="assets1/img/arvin.jpg" alt="Developer 2" class="img-fluid rounded-circle" style="width: 140px; height: 140px; object-fit: cover;">
                </div>
                <h4 class="title mt-3"><span>Arvin Glenn Aguid</span></h4>
                <hr class="divider my-2">
                <p class="developer-description small mt-2">Full Stack Developer – Builds both frontend and backend components, ensuring seamless integration between user interface and server logic.</p>

                </div>
            </div><!-- End Developer -->

            <!-- Developer 3 -->
            <div class="col-xl-3 col-md-6">
                <div class="icon-box text-center">
                <div class="icon">
                    <img src="assets1/img/bryan.jpg" alt="Developer 3" class="img-fluid rounded-circle" style="width: 140px; height: 140px; object-fit: cover;">
                </div>
                <h4 class="title mt-3"><span>Bryan Tagaan</span></h4>
                <hr class="divider my-2">
                <p class="developer-description small mt-2">Full Stack Developer – Builds both frontend and backend components, ensuring seamless integration between user interface and server logic.</p>

                </div>
            </div><!-- End Developer -->

            <!-- Developer 4 -->
            <div class="col-xl-3 col-md-6">
                <div class="icon-box text-center">
                <div class="icon">
                    <img src="assets1/img/james.jpg" alt="Developer 4" class="img-fluid rounded-circle" style="width: 140px; height: 140px; object-fit: cover;">
                </div>
                <h4 class="title mt-3"><span>James Lim</span></h4>
                <hr class="divider my-2">
                <p class="developer-description small mt-2">Full Stack Developer – Builds both frontend and backend components, ensuring seamless integration between user interface and server logic.</p>

                </div>
            </div><!-- End Developer -->

            </div>
        </div>
        </div>

</section><!-- /Developers Section -->



  <footer id="footer" class="footer light-background">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">eStartup</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>
  <script src="assets1/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets1/js/main.js"></script>

</body>

</html>
