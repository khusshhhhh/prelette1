<?php
include 'db_connection.php';

// Count total blogs
$totalBlogs = $conn->query("SELECT COUNT(*) as total FROM blogs")->fetch_assoc()['total'];
$blogsPerPage = 10;
$totalPages = ceil($totalBlogs / $blogsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Optimize your business with advanced data analytics solutions tailored for industries like manufacturing, warehousing and logistics, mining, transportation, energy and utilities, and retail. Leverage predictive analytics, demand forecasting, and inventory management to enhance efficiency, reduce costs, and improve decision-making. Boost operational performance through real-time analytics, risk management, and supply chain optimization. From minimizing downtime with predictive maintenance to optimizing production cycles, our services empower businesses to achieve sustainable growth. Analyze customer behavior, streamline order management, and improve product quality while addressing dynamic market demands. Drive profitability with price optimization, eliminate bottlenecks in processes, and integrate automation and robotics for better productivity. Empower industries with actionable insights, ensuring competitive advantage and market sustainability.">
  <meta name="keywords"
    content="Data analytics services for manufacturing companies in Australia, Supply chain optimization data analysis Australia, Logistics data analytics agency in Australia, Warehouse management data solutions Australia, Mining operations data analytics consulting Australia, Retail and wholesale data-driven insights Australia, Data analyst agency for Australian businesses, Big data solutions for mining industries in Australia, Predictive analytics for warehousing in Australia, Logistics optimization through data analysis Australia, Data analytics for retail supply chain management, Custom data analysis for Australian wholesalers, Manufacturing performance analytics services Australia, Advanced data analytics for mining companies, Retail data visualization experts Australia, Data-driven logistics solutions for Australian businesses, Operational analytics for warehouses in Australia, Consulting agency for data analysis in mining sector, End-to-end data analytics for logistics companies, Actionable data insights for Australian retailers, Cloud-based data analysis for wholesale businesses, Data analytics for streamlining manufacturing processes, Supply chain analytics for retail and logistics in Australia, Mining data visualization and reporting services, Data consulting for Australian industrial operations">

  <title>Prelette. Blog</title>

  <!-- Fav Icon -->
  <link rel="icon" type="image/x-icon" href="./assets/imgs/logo/fav.png">

  <!-- All CSS files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <!-- <link rel="stylesheet" href="assets/css/master-digital-agency.css"> -->
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
      </div>
      <div class="offcanvas-3__menu-wrapper">
        <nav class="nav-menu offcanvas-3__menu">
          <ul>
            <li><a href="./indexp.html">Home</a></li>
            <li><a href="./aboutus.html">About Us</a></li>
            <li><a href="./ourservices.html">Services</a></li>
            <li><a href="./blog.php">Blogs</a></li>
            <li><a href="./portfolio.html">Portfolio</a></li>
            <li><a href="./contactus.html">Contact Us</a></li>
            <li><a href="https://www.instagram.com/prelette.au/" target="_blank" rel="noopener noreferrer"><i
                  class="fa-brands fa-square-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/company/prelette/" target="_blank" rel="noopener noreferrer"><i
                  class="fa-brands fa-linkedin"></i></a></li>
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
  <!-- <header class="header-area pos-abs zi-9">
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
              <li><a href="./indexp.html">Home</a></li>
              <li><a href="./ourservices.html">Our Services</a></li>
              <li><a href="./portfolio.html">Portfolio</a></li>
              <li><a href="./blog.php" class="active-btn">Blog</a></li>
              <li><a href="./aboutus.html">about us</a></li>
              <li><a href="./contactus.html">Contact</a></li>
            </ul>
          </nav>
        </div>
        <div class="design-std-btn">
          <span class="mas">Design Studio<i class="fa-solid fa-arrow-up-from-bracket"
              style="color: #000000;"></i></span>
          <a href="designp.html"><button type="button" name="Hover">Design Studio<i
                class="fa-solid fa-arrow-up-from-bracket" style="color: #000000;"></i></button></a>
        </div>
        <div class="social-btn" id="has-smooth">
          <a href="https://www.instagram.com/prelette.au/" target="_blank" rel="noopener noreferrer"><i
              class="fa-brands fa-square-instagram"></i></a>
          <a href="https://www.linkedin.com/company/prelette/" target="_blank" rel="noopener noreferrer"><i
              class="fa-brands fa-linkedin"></i></a>
        </div>
        <div class="header__navicon d-xl-none">
          <button onclick="showCanvas3()" class="open-offcanvas">
            <i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </div>
  </header> -->
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
                        <span class="number wc-counter">10 +</span>
                        <p class="text">Total post</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>
          <!-- featured area end  -->
          <!--BLOG MAIN AREA STARTS-->
          <div class="featured-post-area">
            <div class="container">
              <div class="featured-post-box">
                <div class="featured-posts">
                  <article class="blog-box has_fade_anim">
                    <a href="blog-details.html">
                      <div class="thumb">
                        <img src="assets/imgs/blog/blogmain1.png" alt="blog image">
                      </div>
                      <div class="content">
                        <div class="content-first">
                          <h2 class="title">Insights from Adelaide's Housing price</h2>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-arrow-right"></i>
                        </div>
                      </div>
                    </a>
                  </article>
                  <article class="blog-box has_fade_anim" data-delay="0.30">
                    <a href="blog-details.html">
                      <div class="thumb">
                        <img src="assets/imgs/blog/blogmain2.png" alt="blog image">
                      </div>
                      <div class="content">
                        <div class="content-first">
                          <h2 class="title">Building quality</h2>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-arrow-right"></i>
                        </div>
                      </div>
                    </a>
                  </article>
                  <article class="blog-box has_fade_anim" data-delay="0.45" data-on-scroll="0">
                    <a href="blog-details.html">
                      <div class="thumb">
                        <img src="assets/imgs/blog/blogmain3.png" alt="blog image">
                      </div>
                      <div class="content">
                        <div class="content-first">
                          <h2 class="title">Market research</h2>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-arrow-right"></i>
                        </div>
                      </div>
                    </a>
                  </article>
                </div>
              </div>
            </div>
          </div>
          <!--BLOG MAIN AREA ENDS-->

          <!-- blog area start  -->
          <section class="blog-area">
            <div class="container">
              <div class="blog-area-inner section-spacing">
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Latest
                        Insights at
                        Prelette!</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Our blog delivers insightful, truthful, and accurate content, crafted
                      to inform, inspire, and engage readers with utmost credibility.</p>
                  </div>
                </div>
                <div class="blogs-wrapper-box">
                  <div class="blogs-wrapper has_fade_anim" id="blog-container">
                    <!-- Blogs will be dynamically loaded here -->
                  </div>

                  <div class="pagination-box has_fade_anim">
                    <ul class="pagination">
                      <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li>
                          <a href="#" class="pagination-link" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                      <?php } ?>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      function loadBlogs(page) {
        $.ajax({
          url: "fetch_blogs.php",
          type: "GET",
          data: { page: page },
          success: function (data) {
            $("#blog-container").html(data);
          }
        });
      }

      // Load first page by default
      loadBlogs(1);

      $(".pagination-link").click(function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        loadBlogs(page);
      });
    });
  </script>
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