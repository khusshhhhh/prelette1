<?php
include 'db_connection.php';

// Redirect if no SEO URL is provided
if (!isset($_GET['seo_url']) || empty($_GET['seo_url'])) {
    header("Location: blog.php");
    exit();
}

$seo_url = $_GET['seo_url'];

// Fetch blog details from the database
$stmt = $conn->prepare("SELECT * FROM blogs WHERE seo_url = ?");
$stmt->bind_param("s", $seo_url);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();

// If no blog is found, show an error
if (!$blog) {
    echo "<h2>Sorry, this blog does not exist.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo substr(htmlspecialchars($blog['paragraph1']), 0, 150) . '...'; ?>">
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <!-- Your existing CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/master-digital-agency.css">
    <link rel="stylesheet" href="./assets/css/master-blog-details.css">
    <link rel="shortcut icon" href="./assets/imgs/logo/fav.png" type="image/x-icon">
</head>

<body class="font-heading-recoleta-medium">

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
                        <li><a href="https://www.instagram.com/prelette.au/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-square-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/prelette/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- offcanvas end  -->

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
                            <li><a href="./index.html">Home</a></li>
                            <li><a href="./services.html">Our Services</a></li>
                            <li><a href="./portfolio-carousel.html">Portfolio</a></li>
                            <li><a href="./blog.php" class="active-btn">Blog</a></li>
                            <li><a href="./about.html">about us</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
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

    <div class="has-smooth" id="has_smooth"></div>
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <div class="body-wrapper body-corporate-agency">

                <!-- overlay switcher close  -->
                <div class="overlay-switcher-close"></div>

                <main>

                    <!-- Blog Details Section -->
                    <section class="blog-details-area">
                        <div class="container">
                            <div class="blog-details-area-inner">
                                <div class="section-header">
                                    <div class="section-title-wrapper">
                                        <div class="title-wrapper">
                                            <h1 class="section-title large has_fade_anim">
                                                <?php echo htmlspecialchars($blog['title']); ?>
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="meta-box has_fade_anim">
                                        <ul>
                                            <li>
                                                <span
                                                    class="number"><?php echo htmlspecialchars($blog['author']); ?></span>
                                            </li>
                                            <li>
                                                <p class="text"><?php echo $blog['date']; ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Image 1 -->
                                <div class="blog-thumb overflow-hidden">
                                    <img class="w-100" data-speed="0.8"
                                        src="<?php echo !empty($blog['image_url1']) ? htmlspecialchars($blog['image_url1']) : '/assets/imgs/default.jpg'; ?>"
                                        alt="Blog Image 1">
                                </div>

                                <div class="blogdetails__wrapper">
                                    <div class="blogdetails-contentleft">
                                        <ul class="blogdetails-overview dark-overview has_fade_anim"
                                            data-fade-from="left">
                                            <li>
                                                <i class="fa-solid fa-chart-simple"></i>
                                                <span>247 <br> Views </span>
                                            </li>
                                            <li><a href="www.instagram.com/_khusshhhhh_" target="_blank"
                                                    rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="blogdetails-contentright">
                                        <article class="blog-details-fullBody">
                                            <div class="text-wrapper">
                                                <p class="text has_fade_anim">
                                                    <?php echo nl2br(htmlspecialchars($blog['paragraph1'])); ?>
                                                </p>
                                                <p class="text has_fade_anim">
                                                    <?php echo nl2br(htmlspecialchars($blog['paragraph2'])); ?>
                                                </p>
                                            </div>
                                            <!-- Image 2 -->
                                            <div class="thumb overflow-hidden has_fade_anim">
                                                <img class="w-100" data-speed="0.8"
                                                    src="<?php echo !empty($blog['image_url2']) ? htmlspecialchars($blog['image_url2']) : '/assets/imgs/default.jpg'; ?>"
                                                    alt="Blog Image 2">
                                            </div>
                                            <div class="content-block">
                                                <div class="text-wrapper">
                                                    <p class="text has_fade_anim">
                                                        <?php echo nl2br(htmlspecialchars($blog['paragraph3'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content-block">
                                                <div class="text-wrapper">
                                                    <p class="text has_fade_anim">
                                                        <?php echo nl2br(htmlspecialchars($blog['paragraph4'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content-block">
                                                <div class="text-wrapper">
                                                    <p class="text has_fade_anim">
                                                        <?php echo nl2br(htmlspecialchars($blog['paragraph5'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="tagswrap has_fade_anim">
                                                <ul class="tags">
                                                    <li><span>Tags:</span></li>
                                                    <li><a href="#"><?php echo htmlspecialchars($blog['tag1']); ?></a>
                                                    </li>
                                                    <li><a href="#"><?php echo htmlspecialchars($blog['tag2']); ?></a>
                                                    </li>
                                                    <li><a href="#"><?php echo htmlspecialchars($blog['tag3']); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <footer class="footer-area" style="margin-top: 100px">
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
                                            <button type="submit" class="subscribe-btn"><img
                                                    src="assets/imgs/icon/arrow-light.webp" alt="icon"></button>
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
    <!-- Load jQuery First -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Essential Scripts -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/backToTop.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/offcanvas.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("All scripts are ready!");

            // Testimonial Slider (Check if it exists first)
            if (document.querySelector('.testimonial-slider')) {
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

            // Client Slider (Check if it exists first)
            if (document.querySelector('.client-slider-active')) {
                var client_slider_active = new Swiper(".client-slider-active", {
                    slidesPerView: 'auto',
                    loop: true,
                    autoplay: { delay: 3000 },
                    spaceBetween: 130,
                    speed: 3000
                });
            }
        });
    </script>


</body>

</html>