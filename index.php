<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>EaseBank</title>
    <link rel="shortcut icon" href="images/xing-logo-2447.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/animation.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    <?php include 'css/styles.css'?><?php include 'css/queries.css'?><?include 'css/animation.css'?>
    </style>
    <style>
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #abcdef, #6f42c1);
        border-radius: 0 0 10px 10px;
    }
    </style>
</head>

<body>

    <div class="web_container">
        <header class="hero-header">
            <nav class="nav">
                <div class="logo-field">
                    <a href="#"><i class='bx bxl-xing logoIcon' style="font-size:44px;margin-right:8px;"></i>Ease<span
                            class="logo_highlight">Bank</span></a>
                </div>
                <ul class="nav-links opContainer" style="  animation: slideDown 0.6s ease-in-out;
  transition: all 0.6s ease-in-out;">
                    <li class="nav-ele"><a href="#features">Features</a></li>
                    <li class="nav-ele"><a href="#operation">Operations</a></li>
                    <li class="nav-ele"><a href="#testimonials">Testimonials</a></li>
                </ul>
                <ul class="nav-links" style="  animation: expand 0.6s ease-in-out;
  transition: all 0.6s ease-in-out;">
                    <li class="nav-ele login-btn log-btn"><a href="client/login.php">Login</a></li>
                    <li class="nav-ele open-acc open-account"><a href="client/register.php">Open Account</a></li>
                    <i class='nav-ele bx bx-cog set-btn out'></i>
                    <div class="sidebar">
                        <ul class="menu_list">
                            <li><a href="#">
                                    <i class='bx bx-cog set-btn'></i>
                                    <span class="links_name">Settings</span>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxs-moon'></i>
                                    <span class="links_name">Dark Mode</span>
                                    <div class="toggle"></div>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bx-help-circle'></i>
                                    <span class="links_name">Help Center</span>
                                </a></li>
                        </ul>
                    </div>
                </ul>
                <button class="btn-mobile-nav">
                    <i class='bx bx-menu icon-mobile-nav'></i>
                    <i class='bx bx-x icon-mobile-nav'></i>
                </button>
            </nav>

            <!-- <div class="header-container">
                <div class="heading">
                    <div class="primary-heading">
                        Secure <span>Tomorrow </span>Ease<span class="logo_highlight">Bank</span>
                        <span>Today</span>
                    </div>
                    <p class="primary-text">
                        Financial success at every service we offer.
                    </p>
                    <a href="#features" class="learn-more btn--scroll-to">Learn More &darr;</a>
                </div>
                <div class="img-container">
                    <h1 class="hero-heading">
                        <span class="highlight">Building</span> a brilliant monetary future.
                    </h1>
                    <img src="images/bank.jpg" alt="" />
                </div>
            </div> -->
            <div class="heroContainer">
                <div class="heroSlide">
                    <div class="item" style="background-image:url(images/image5.jpg)">
                        <div class="content">
                            <div class="name">
                                No longer need your<span class="logo_highlight"> account?</span>Close it instantly.

                            </div>
                            <div class="des">Financial success at every service we offer.</div>
                            <a href="#features">See More</a>
                        </div>
                    </div>
                    <div class="item" style="background-image:url(images/image2.jpg)">
                        <div class="content">
                            <div class="name">
                                Secure <span>Tomorrow </span>Ease<span class="logo_highlight">Bank</span>
                                <span>Today</span>
                            </div>
                            <div class="des">Financial success at every service we offer.</div>
                            <a href="#features">See More</a>
                        </div>
                    </div>

                    <div class="item"
                        style="background-image:linear-gradient(rgba(0,0,0,.34),rgba(0,0,0,.34)),url(images/image6.jpg)">
                        <div class="content">
                            <div class="name">Buy a home or make your <span class="logo_highlight">Dreams</span> come
                                true
                            </div>
                            <div class="des">Financial success at every service we offer.</div>
                            <a href="#features">See More</a>
                        </div>
                    </div>
                    <div class="item" style="background-image:url(images/image4.jpg)">
                        <div class="content">
                            <div class="name">Watch your <br> <span class="logo_highlight"> Money</span> grow
                            </div>
                            <div class="des">Financial success at every service we offer.</div>
                            <a href="#features">See More</a>
                        </div>
                    </div>
                    <div class="item" style="background-image:url(images/image1.avif)">
                        <div class="content">
                            <div class="name">100% Digital<span class="logo_highlight"> Money</span>

                            </div>
                            <div class="des">Financial success at every service we offer.</div>
                            <a href="#features">See More</a>
                        </div>
                    </div>
                </div>
                <div class="button">
                    <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </header>

        <section class="section features" id="features">
            <div class="section-heading">
                <h3 class="tert-head">FEATURES</h3>
                <h1 class="primary-head">
                    Everything you need in a modern bank and more.
                </h1>
            </div>
            <div class="features-container">
                <img src="images/undraw_online_banking_re_kwqh.svg" alt="" class="feature-img lazy-img"
                    loading="lazy" />
                <div class="feature-box">
                    <ion-icon name="laptop" class="feature-icon"></ion-icon>
                    <p class="feature-head">100% digital bank</p>
                    <p class="feature-desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
                        numquam officia aspernatur eos, ullam suscipit qui consequuntur,
                        amet sunt atque fuga aperiam
                    </p>
                </div>
                <div class="feature-box">
                    <ion-icon name="trending-up" class="feature-icon"></ion-icon>
                    <p class="feature-head">Watch your money grow</p>
                    <p class="feature-desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
                        numquam officia aspernatur eos, ullam suscipit qui consequuntur,
                        amet sunt atque fuga aperiam
                    </p>
                </div>
                <img src="images/undraw_success_factors_re_ce93.svg" alt="" class="feature-img lazy-img img2
            " />
                <img src="images/undraw_credit_card_re_blml.svg" alt="" class="feature-img lazy-img" name="card" />
                <div class="feature-box">
                    <ion-icon name="card" class="feature-icon"></ion-icon>
                    <p class="feature-head">Free debit and credit card included</p>
                    <p class="feature-desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
                        numquam officia aspernatur eos, ullam suscipit qui consequuntur,
                        amet sunt atque fuga aperiam
                    </p>
                </div>
                <div class="feature-box">
                </div>
        </section>
        <section class="section operations-section" id="operation">
            <div class="section-heading">
                <h3 class="tert-head">OPERATIONS</h3>
                <h1 class="primary-head">Everything as simple as possible.</h1>
            </div>
            <div class="operations">
                <div class="operation-tab--container">
                    <button class="btn operations-tab operations-tab--1 operations-tab--active"
                        data-tab="1"><span>01</span> Quick Transfers</button>
                    <button class="btn operations-tab operations-tab--2 " data-tab="2"><span>02</span> Instant
                        Loans</button>
                    <button class="btn operations-tab operations-tab--3 " data-tab="3"><span>03</span> Instant
                        Closing</button>
                </div>
                <div class="operations-content operations-content--1 operations-content--active">
                    <div><img src="images/undraw_transfer_money_re_6o1h (1).svg" alt="" class="operations_img"></div>
                    <div>
                        <h3 class="operations-header">Transfer money to anyone, instantly! No fees, No BS.</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius quidem pariatur numquam hic
                            mollitia fuga reiciendis fugit eaque inventore molestias? Provident, porro voluptatum
                            dolorem dolorum dolor debitis vel alias praesentium.</p>
                    </div>
                </div>
                <div class="operations-content operations-content--2">
                    <div><img src="images/undraw_for_sale_re_egkk.svg" alt="" class="operations_img"></div>
                    <div>
                        <h3 class="operations-header">Buy a home or make your dreams come true, with instant loans.</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius quidem pariatur numquam hic
                            mollitia fuga reiciendis fugit eaque inventore molestias? Provident, porro voluptatum
                            dolorem dolorum dolor debitis vel alias praesentium.</p>
                    </div>
                </div>
                <div class="operations-content operations-content--3">
                    <div><img src="images/undraw_throw_away_re_x60k.svg" alt="" class="operations_img"></div>
                    <div>
                        <h3 class="operations-header">No longer need your account? No Problem! Close it instantly.</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius quidem pariatur numquam hic
                            mollitia fuga reiciendis fugit eaque inventore molestias? Provident, porro voluptatum
                            dolorem dolorum dolor debitis vel alias praesentium.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section testimonials-section" id="testimonials">
            <div class="section-heading">
                <h3 class="tert-head">NOT SURE YET?</h3>
                <h1 class="primary-head">Millions of EaseBankers are already making their lifes simpler.</h1>
            </div>
            <div class="slider">
                <div class="slide_container">
                    <div class="slide">
                        <div class="testimonial">
                            <h5 class="testimonial__header">Best financial decision ever!</h5>
                            <blockquote class="testimonial__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Accusantium quas quisquam non? Quas voluptate nulla minima
                                deleniti optio ullam nesciunt, numquam corporis et asperiores
                                laboriosam sunt, praesentium suscipit blanditiis.
                            </blockquote>
                            <div class="name-box">
                                <address class="testimonial__author">
                                    <img src="images/ph.jpg" alt="" class="testimonial__photo" />
                                    <h6 class="testimonial__name">Prajwal Hiremath</h6>
                                    <p class="testimonial__location">Bailhongal, Belagavi</p>
                                </address>
                                <div class="star-box">
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star-half" class="rating"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <h5 class="testimonial__header">Easy to handle!</h5>
                            <blockquote class="testimonial__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Accusantium quas quisquam non? Quas voluptate nulla minima
                                deleniti optio ullam nesciunt, numquam corporis et asperiores
                                laboriosam sunt, praesentium suscipit blanditiis.
                            </blockquote>
                            <div class="name-box">
                                <address class="testimonial__author">
                                    <img src="images/tn.jpg" alt="" class="testimonial__photo" />
                                    <h6 class="testimonial__name">Tanmay Nidagundi</h6>
                                    <p class="testimonial__location">Ugar BK, Belagavi</p>
                                </address>
                                <div class="star-box">
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star-half" class="rating"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <h5 class="testimonial__header">Finally free from old-school banks</h5>
                            <blockquote class="testimonial__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Accusantium quas quisquam non? Quas voluptate nulla minima
                                deleniti optio ullam nesciunt, numquam corporis et asperiores
                                laboriosam sunt, praesentium suscipit blanditiis.
                            </blockquote>
                            <div class="name-box">
                                <address class="testimonial__author">
                                    <img src="images/parshwa.jpg" alt="" class="testimonial__photo" />
                                    <h6 class="testimonial__name">Parshwa Patil</h6>
                                    <p class="testimonial__location">Raybag, Belagavi</p>
                                </address>
                                <div class="star-box">
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star-outline" class="rating"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <h5 class="testimonial__header">Good interface</h5>
                            <blockquote class="testimonial__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Accusantium quas quisquam non? Quas voluptate nulla minima
                                deleniti optio ullam nesciunt, numquam corporis et asperiores
                                laboriosam sunt, praesentium suscipit blanditiis.
                            </blockquote>
                            <div class="name-box">
                                <address class="testimonial__author">
                                    <img src="images/satya.jpg" alt="" class="testimonial__photo" />
                                    <h6 class="testimonial__name">Satyajit Swami</h6>
                                    <p class="testimonial__location">Kolhapur, Maharashtra</p>
                                </address>
                                <div class="star-box">
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                    <ion-icon name="star" class="rating"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="slider__btn slider__btn--left">&larr;</button>
                <button class="slider__btn slider__btn--right">&rarr;</button>
                <div class="dots"></div>
            </div>
            <div class="test-img--box">
                <div class="text_images">
                    <img src="images/customer1.jpeg" class="test-img" alt="">
                    <img src="images/customer7.jpg" class="test-img" alt="">
                    <img src="images/customer2.jpg" class="test-img" alt="">
                    <img src="images/customer2.webp" class="test-img" alt="">
                    <img src="images/customer3.jpeg" class="test-img" alt="">
                    <img src="images/customer3.jpg" class="test-img" alt="">
                    <img src="images/customer5.jpg" class="test-img" alt="">
                    <img src="images/customer8.jpeg" class="test-img" alt="">
                </div>
                <p class="test-line"><span>100,000+</span> happy customers all over the world.</p>
            </div>
        </section>
        <section class="section sign_up">
            <div class="sign_up-container">
                <h1 class="sign_up-head">Join today, and make your life easy with our Ease<span
                        class="logo_highlight">Bank</span>!</h1>
                <a class="sign_up-btn open-acc" href="client/register.php">Open your free account today!</a>
            </div>
        </section>
        <footer class="footer">
            <ul class="footer_nav">
                <li class="footer_item"><a href="#" class="footer_link">About</a></li>
                <li class="footer_item"><a href="#" class="footer_link">Pricing</a></li>
                <li class="footer_item"><a href="" class="footer_link terms-btn">Terms of Use</a></li>
                <li class="footer_item"><a href="" class="footer_link privacy-btn">Privacy Policy</a></li>
                <li class="footer_item"><a href="#" class="footer_link">Careers</a></li>
                <li class="footer_item"><a href="" class="footer_link contact-btn">Contact Us</a></li>
                <li class="footer_item"><a href="#" class="footer_link blog">Blog</a></li>
            </ul>
            <a href="#"><img src="images/xing-logo-2447.png" alt="" class="logo-icon"></a>
            <p class="footer_text">&copy; Copyright by Prince Inc. All rights are reserved.</p>
        </footer>
        <div class="privacy">
            <h1 class="footers-head">
                Privacy
            </h1>
            <ion-icon name="close" class="close-btn icon btn-ok"></ion-icon>
            <p class="privacy-text">At U.S. Bancorp®, trust has always been the foundation of our relationship with
                customers. Because you trust us with your financial and other personal information, we respect your
                privacy and safeguard your information. In order to preserve that trust, the U.S. Bancorp family of
                financial service providers pledges to protect your privacy by adhering to the practices described
                below.</p> <br>
            <p class="privacy-text">The U.S. Bank—Dealer Financial Services Privacy Policy only applies to U.S.
                Bank—Dealer Financial Services customers who are NOT residents of California, North Dakota or Vermont
                and who leased or purchased a vehicle and obtained U.S. Bank financing through an automotive dealership.
            </p>
            <button class="ok btn-ok">Agree & continue</button>
        </div>
        <div class="terms">
            <h1 class="footers-head">Terms of Use</h1>
            <ion-icon name="close" class="close-btn icon btn-ok"></ion-icon>
            <ol class="terms-list">
                <li class="terms-li">These website terms of use explain legal aspects of our website and your use of it.
                    Your use of our website indicates your acceptance of these website terms of use.</li>
                <li class="terms-li">These website terms of use incorporate EaseBank’s privacy policy.</li>
                <li class="terms-li">Copyright and other intellectual property in our website belongs to EaseBank</li>
                <li class="terms-li">You must not use or distribute any information, images, screens, web pages, logos
                    or brands from our website in any public way (including reproduction on the Internet or digital
                    copies) without EaseBank’s written permission.</li>
                <li class="terms-li">EaseBank may amend or add to our website, including interest rates shown on our
                    website, at any time.</li>
                <li class="terms-li">EaseBank is not, in this website, making any offer to enter into any transaction or
                    relationship with you. You should visit or call EaseBank for details of up-to-date service
                    information, charges, interest rates, terms and conditions.</li>
                <li class="terms-li">EaseBank may use any suggestions you make for changes to this website, without any
                    obligation to you.</li>
                <li class="terms-li">Only authorised users of EaseBank’s internet banking, or mobile app, services may
                    access those services. Legal action may be taken against unauthorised users.</li>
                <li class="terms-li">EaseBank may change these website terms of use at any time. EaseBank will usually
                    give at least 14 days’ notice of changes, by publishing them on our website. Your continued use of
                    our website will indicate acceptance of the amended website terms of use.</li>
            </ol>
            <input type="checkbox" name="agree" id="agree" class="terms-agree" onclick="enable()"> &nbsp;Agree to the
            terms of use
            <button class="ok btn-ok" id="terms-btn" disabled="true">Agree & continue</button>
        </div>
        <div class="contacts">
            <h1>Contact us</h1>
            <ion-icon name="close" class="close-btn icon btn-ok"></ion-icon>
            <div class="link-box">
                <ion-icon name="link" class="link-icon"></ion-icon>
                <input type="text" class="link-text" value="https://easebank-by-princeinc.netlify.app">
                <ion-icon name="clipboard" class="link-icon" title="Copy"></ion-icon>
            </div>
            <hr>
            <p class="or c-or">Social Accounts</p>
            <div class="conicon">
                <a href="mailto:psh23g@gmail.com"><img src="images/google.png" alt=""
                        class="log-icon contact-icon google" title="Google"></a>
                <a href="https://www.instagram.com/_prajwalhiremath.ig/"><img src="images/instagram.png" alt=""
                        class="log-icon contact-icon insta"></a>
                <a href="https://www.facebook.com/prajwal.hiremath.9237">
                    <ion-icon name="logo-facebook" class="contact-icon fb" title="Facebook"></ion-icon>
                </a>
                <a href="https://github.com/PrinceSH21">
                    <ion-icon name="logo-github" class="contact-icon git" title="Git"></ion-icon>
                </a>
                <a href="https://twitter.com/Prince193067">
                    <ion-icon name="logo-twitter" class="contact-icon twitter" title="Twitter"></ion-icon>
                </a>
            </div>
        </div>
        <div class="overlay-main hidden">
            <img src="images/undraw_adventure_re_ncqp.svg" alt="" class="overlay-img left">
            <img src="images/undraw_ether_re_y7ft.svg" alt="" class="overlay-img right">
        </div>
    </div>

</html>
<script>
<?php include 'js/script.js'?>
</script>
</body>

</html>