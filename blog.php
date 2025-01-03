<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'db.php';

// Fetch featured blogs (limit to 3)
$query_featured = "SELECT * FROM blog_posts ORDER BY date DESC LIMIT 3";
$result_featured = $conn->query($query_featured);

if (!$result_featured) {
  die("Query for featured blogs failed: " . $conn->error);
}

// Fetch additional blogs (offset 3)
$query_additional = "SELECT * FROM blog_posts ORDER BY date DESC LIMIT 3 OFFSET 3";
$result_additional = $conn->query($query_additional);

if (!$result_additional) {
  die("Query for additional blogs failed: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Optimize your business with advanced data analytics solutions tailored for industries like manufacturing, warehousing and logistics, mining, transportation, energy and utilities, and retail. Leverage predictive analytics, demand forecasting, and inventory management to enhance efficiency, reduce costs, and improve decision-making. Boost operational performance through real-time analytics, risk management, and supply chain optimization. From minimizing downtime with predictive maintenance to optimizing production cycles, our services empower businesses to achieve sustainable growth. Analyze customer behavior, streamline order management, and improve product quality while addressing dynamic market demands. Drive profitability with price optimization, eliminate bottlenecks in processes, and integrate automation and robotics for better productivity. Empower industries with actionable insights, ensuring competitive advantage and market sustainability.">

  <title>Prelette. Blog</title>

  <!-- Fav Icon -->
  <link rel="icon" type="image/x-icon" href="assets/imgs/logo/fav.png">

  <!-- All CSS files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/master-digital-agency.css">
  <link rel="stylesheet" href="assets/css/master-blog.css">
</head>

<body class="font-heading-recoleta-medium">

  <!-- Preloader -->
  <div id="preloader">
    <div id="container" class="container-preloader">
      <div class="animation-preloader">
        <div class="spinner"></div>
        <div class="txt-loading">
          <span data-text="P" class="characters">P</span>
          <span data-text="R" class="characters">R</span>
          <span data-text="E" class="characters">E</span>
          <span data-text="L" class="characters">L</span>
          <span data-text="E" class="characters">E</span>
          <span data-text="T" class="characters">T</span>
          <span data-text="T" class="characters">T</span>
          <span data-text="E" class="characters">E</span>
        </div>
      </div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
  </div>

  <!-- Cursor Animation -->
  <div class="cursor1"></div>
  <div class="cursor2"></div>

  <!-- Sroll to top -->
  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
  </div>

  <!-- Switcher Area Start -->
  <!-- <div class="switcher__area">
    <div class="switcher__icon">
      <button id="switcher_open"><i class="fa-solid fa-gear"></i></button>
      <button id="switcher_close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="switcher__items">
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">mode</p>
        </div>
        <div class="switcher__btn mode-type wc-col-2">
          <button class="active" data-mode="light">light</button>
          <button data-mode="dark">dark</button>
        </div>
      </div>
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Language Support</p>
        </div>
        <div class="switcher__btn lang_dir wc-col-2">
          <button class="active" data-mode="ltr">LTR</button>
          <button data-mode="rtl">RTL</button>
        </div>
      </div>
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Layout</p>
        </div>
        <div class="switcher__btn layout-type wc-col-2">
          <button class="active" data-mode="full-width">Full Width</button>
          <button data-mode="box-layout">Box Layout</button>
        </div>
      </div>
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Cursor</p>
        </div>
        <div class="switcher__btn">
          <select name="cursor-style" id="cursor_style">
            <option value="1">default</option>
            <option selected value="2">animated</option>
          </select>
        </div>
      </div>
    </div>
  </div> -->
  <!-- Switcher Area End -->

  <!-- offcanvas start  -->
  <div class="offcanvas-3__area">
    <div class="offcanvas-3__inner">
      <div class="offcanvas-3__meta-wrapper">
        <div class="">
          <button id="close_offcanvas" class="close-button close-offcanvas" onclick="hideCanvas3()">
            <span></span>
            <span></span>
          </button>
        </div>
        <!-- <div class="">
          <div class="offcanvas-3__meta mb-145 d-none d-md-block">
            <ul>
              <li><a href="tel:+2-352698102" class="unnerline"><u>+2-352 698 102</u></a></li>
              <li><a href="mailto:contact@me.com">contact@me.com</a></li>
              <li><a href="">27 Division St, <br>
                  New York, NY 10002, USA</a></li>
            </ul>
          </div>
          <div class="offcanvas-3__social d-none d-md-block">
            <p class="title">Follow Me</p>
            <div class="offcanvas-3__social-links">
              <a href=""><i class="fa-brands fa-facebook-f"></i></a>
              <a href=""><i class="fa-brands fa-twitter"></i></a>
              <a href=""><i class="fa-brands fa-dribbble"></i></a>
              <a href=""><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>
        </div> -->
      </div>
      <div class="offcanvas-3__menu-wrapper">
        <nav class="nav-menu offcanvas-3__menu">
          <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./about.html">About Us</a></li>
            <li><a href="./services.html">Services</a></li>
            <li><a href="./blog.html">Blogs</a></li>
            <li><a href="./portfolio-carousel.html">Portfolio</a></li>
            <li><a href="./contact.html">Contact Us</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- offcanvas end  -->


  <!-- search modal start -->
  <div class="modal fade" id="search-template" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="search-template" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form action="#" class="form-search">
            <input type="text" placeholder="Search">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- search modal end -->

  <!-- Header area start -->
  <header class="header-area pos-abs zi-9">
    <div class="container container-large">
      <div class="header-area__inner">
        <div class="header__logo">
          <a href="#">
            <img class="normal-logo show-light" src="assets/imgs/logo/logo-light.png" alt="Site Logo">
            <img class="normal-logo show-dark" src="assets/imgs/logo/logo-dark.png" alt="Site Logo">
          </a>
        </div>
        <div class="header__nav pos-center">
          <nav class="main-menu">
            <ul>
              <!-- <li class="menu-item-has-children">
                <a href="#">Demos</a>
                <ul class="dp-menu col-2">
                  <li><a href="branding-agency.html">Branding Agency</a></li>
                  <li><a href="web-agency.html">Web Agency</a></li>
                  <li><a href="seo-agency.html">SEO Agency</a></li>
                  <li><a href="design-studio.html">Design Agency</a></li>
                  <li><a href="video-production.html">Video Agency</a></li>
                  <li><a href="ai-agency.html">AI Agency</a></li>
                  <li><a href="creative-agency-classic.html">Creative Agency Classic</a></li>
                  <li><a href="marketing-agency.html">Marketing Agency</a></li>
                  <li><a href="corporate-agency.html">Corporate Agency</a></li>
                  <li><a href="startup-agency.html">Startup Agency</a></li>
                  <li><a href="modern-agency.html">Modern Agency</a></li>
                  <li><a href="photography-studio.html">Photography Agency</a></li>
                  <li><a href="creative-agency.html">Creative Agency</a></li>
                  <li><a href="digital-agency.html">Digital Agency</a></li>
                </ul>
              </li> -->
              <li><a href="./index.html">Home</a></li>
              <li><a href="./services.html">Our Services</a></li>
              <li><a href="./portfolio-carousel.html">Portfolio</a></li>
              <li><a href="./blog.html" class="active-btn">Blog</a></li>
              <li><a href="./about.html">about us</a></li>
              <!-- <li><a href="./blog.html">Blog</a></li> -->
              <li><a href="./contact.html">Contact</a></li>
              <!-- <li class="menu-item-has-children">
                <a href="#">Pages</a>
                <ul class="dp-menu">
                  <li class="menu-item-has-children">
                    <a href="#">service pages</a>
                    <ul>
                      <li><a href="services.html">services</a></li>
                      <li><a href="service-details.html">service details</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">project pages</a>
                    <ul>
                      <li><a href="works.html">project</a></li>
                      <li><a href="work-details.html">project details</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">team pages</a>
                    <ul>
                      <li><a href="team.html">team</a></li>
                      <li><a href="team-details.html">team details</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">career pages</a>
                    <ul>
                      <li><a href="career.html">career</a></li>
                      <li><a href="career-details.html">career details</a></li>
                    </ul>
                  </li>
                  <li><a href="faq.html">faq</a></li>
                  <li><a href="404.html">404 page</a></li>
                </ul>
              </li> -->
            </ul>
          </nav>
        </div>
        <div class="social-btn" id="has-smooth">
          <a href="https://www.instagram.com/prelette.au/" target="_blank" rel="noopener noreferrer"><i
              class="fa-brands fa-square-instagram"></i></a>
          <a href="https://www.linkedin.com/company/prelette/" target="_blank" rel="noopener noreferrer"><i
              class="fa-brands fa-linkedin"></i></a>
        </div>
        <div class="header__button d-none d-sm-inline-block">
          <!-- <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip" data-bs-toggle="modal"
            data-bs-target="#signupform"><span data-text="Get started">Get started</span></a> -->
        </div>
        <div class="header__navicon d-xl-none">
          <button onclick="showCanvas3()" class="open-offcanvas">
            <i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </div>
  </header>
  <!-- Header area end -->

  <div class="has-smooth" id="has_smooth"></div>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <div class="body-wrapper body-corporate-agency">

        <!-- overlay switcher close  -->
        <div class="overlay-switcher-close"></div>

        <main>

          <!-- featured area start  -->
          <section class="featured-area">
            <div class="container">
              <div class="featured-area-inner">
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h1 class="section-title large has_fade_anim">We always
                        think</h1>
                    </div>
                  </div>
                  <div class="text-box">
                    <div class="text-wrapper">
                      <!-- <p class="text has_fade_anim">Our blog delivers insightful, truthful, and accurate content,
                        inspire, and engage readers with credibility.</p> -->
                    </div>
                    <div class="counter-box has_fade_anim">
                      <div class="counter-item">
                        <span class="number wc-counter">400 +</span>
                        <p class="text">Total post</p>
                      </div>
                      <div class="counter-item">
                        <span class="number wc-counter">99 +</span>
                        <p class="text">Blog writer</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>
          <!-- featured area end  -->

          <div class="featured-post-area">
            <div class="container">
              <div class="featured-post-box">
                <div class="featured-posts">
                  <?php while ($row = $result_featured->fetch_assoc()): ?>
                    <article class="blog-box has_fade_anim">
                      <a href="/<?= $row['slug'] ?>">
                        <div class="thumb">
                          <img src="<?= $row['main_image'] ?>" alt="<?= $row['title'] ?>">
                        </div>
                        <div class="content">
                          <div class="content-first">
                            <h2 class="title"><?= $row['title'] ?></h2>
                          </div>
                          <div class="icon">
                            <i class="fa-solid fa-arrow-right"></i>
                          </div>
                        </div>
                      </a>
                    </article>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Blog area start -->
          <section class="blog-area">
            <div class="container">
              <div class="blog-area-inner section-spacing">
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Latest Insights at Prelette!</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Our blog delivers insightful, truthful, and accurate content, crafted
                      to inform, inspire, and engage readers with utmost credibility.</p>
                  </div>
                </div>
                <div class="blogs-wrapper-box">
                  <div class="blogs-wrapper has_fade_anim">
                    <?php
                    $index = 1; // Counter for numbering blogs
                    while ($row = $result_additional->fetch_assoc()): ?>
                      <a href="/<?= $row['slug'] ?>">
                        <div class="blog-box">
                          <div class="content">
                            <span class="number"><?= str_pad($index++, 2, '0', STR_PAD_LEFT) ?></span>
                            <h3 class="title"><?= $row['title'] ?></h3>
                            <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                          </div>
                        </div>
                      </a>
                    <?php endwhile; ?>
                  </div>
                  <div class="pagination-box has_fade_anim">
                    <!-- Pagination (if necessary) -->
                    <ul class="pagination">
                      <li><a href="#">01</a></li>
                      <li><a href="#">02</a></li>
                      <li><a href="#">03</a></li>
                      <li><a href="#">04</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- blog area end  -->

        </main>

        <!-- footer area start  -->
        <footer class="footer-area">
          <div class="container">
            <div class="footer-area-inner section-spacing-top">
              <div class="shape-1">
                <img class="show-light" src="assets/imgs/shape/img-s-33.webp" alt="shape">
                <img class="show-dark" src="assets/imgs/shape/img-s-33-light.webp" alt="shape">
              </div>
              <div class="section-header">
                <div class="section-title-wrapper">
                  <div class="title-wrapper">
                    <h2 class="section-title has_text_move_anim"><span>Get started</span> <br>
                      now</h2>
                  </div>
                </div>
                <div class="text-wrapper">
                  <p class="text has_fade_anim">If you would like to work with us or
                    just want to get in touch, we’d love
                    to hear from you!</p>
                </div>
              </div>
              <div class="footer-cta">
                <div class="footer-widget-wrapper">
                  <h2 class="title">Adelaide, AU</h2>
                  <ul class="footer-nav-list">
                    <li>Grand Junction Rd, Wingfield <br>
                      SA 5013</li>
                  </ul>
                </div>
                <div class="footer-widget-wrapper">
                  <h2 class="title">Melbourne, AU</h2>
                  <ul class="footer-nav-list">
                    <li>Grand Central Blvd, Pakenham <br>
                      VIC 3000</li>
                  </ul>
                </div>
                <div class="footer-widget-wrapper newsletter">
                  <form action="submit.php" method="POST" class="subscribe-form">
                    <div class="input-field">
                      <input type="email" placeholder="Enter your email">
                      <button type="submit" class="subscribe-btn"><img src="assets/imgs/icon/arrow-light.webp"
                          alt="icon"></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="copyright-area">
            <div class="container">
              <div class="copyright-area-inner">
                <div class="copyright-text">
                  <p class="text">© 2022 - 2025 | Alrights reserved <br>
                    by prelette.com</a></p>
                </div>
                <ul class="footer-nav-list">
                  <li><a href="./about.html">About Us</a></li>
                  <li><a href="./portfolio-carousel.html">Portfolio</a></li>
                  <li><a href="./services.html">Our Services</a></li>
                  <li><a href="./contact.html">Contact</a></li>
                  <!-- <li><a href="#">Career</a></li> -->
                  <li><a href="#">Privacy Policy</a></li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
        <!-- footer area end  -->

      </div>
    </div>
  </div>



  <!-- All JS files -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/swiper-bundle.min.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/progressbar.js"></script>
  <script src="assets/js/gsap.min.js"></script>
  <script src="assets/js/ScrollSmoother.min.js"></script>
  <script src="assets/js/ScrollToPlugin.min.js"></script>
  <script src="assets/js/ScrollTrigger.min.js"></script>
  <script src="assets/js/SplitText.min.js"></script>
  <script src="assets/js/jquery.meanmenu.min.js"></script>
  <script src="assets/js/backToTop.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/error-handling.js"></script>
  <script src="assets/js/offcanvas.js"></script>

  <script>

    // testimonial slider
    if (('.testimonial-slider').length) {
      var testimonial_slider = new Swiper(".testimonial-slider", {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 60,
        speed: 1800,
        watchSlidesProgress: true,
        navigation: {
          prevEl: ".testimonial-button-prev",
          nextEl: ".testimonial-button-next",
        },
      });
    }


    // client slider 
    if ('.client-slider-active') {
      var client_slider_active = new Swiper(".client-slider-active", {
        slidesPerView: 'auto',
        loop: true,
        autoplay: true,
        spaceBetween: 130,
        speed: 3000,
        autoplay: {
          delay: 1,
        },
      });
    }

  </script>

</body>

</html>