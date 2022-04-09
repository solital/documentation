<?php

include_once 'config.php';

$title = "Solital - Fast, easy and modern PHP framework";
$meta_index = "index";

include_once __DIR__ .'/header/header.php';

?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Fast, easy and modern PHP framework</h1>
                <p data-aos="fade-up" data-aos-delay="400" style="margin-top: 15px">Solital is a framework designed for those who need to create projects quickly and with an easy syntax</p>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="<?= fullUrl() ?>docs/3.x/" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Get Started</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="<?= fullUrl() ?>assets/img/solital-logo-profile.png" class="w-75 img-fluid" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">
    <!-- ======= what-is Section ======= -->
    <section id="what-is" class="what-is">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h2>What is Solital Framework?</h2>
                        <p>
                            Solital is a PHP framework developed in 2020. Containing a template system, login structure, console and several other resources, Solital becomes a lighter alternative than other frameworks to create projects quickly, in addition to having a simple syntax of learn.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="<?= fullUrl() ?>assets/img/routers.svg" class="img-fluid" alt="">
                </div>

            </div>
        </div>

    </section><!-- End what-is Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Main Features</h2>
            </header>

            <div class="row">

                <div class="col-lg-6">
                    <img src="assets/img/vinci.svg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                    <div class="row align-self-center gy-4">

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Vinci Console</h3>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Katrina ORM 2</h3>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Wolf Template</h3>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Authentication structure</h3>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Migrations and Seeders</h3>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Queues</h3>
                            </div>
                        </div>

                    </div>
                </div>

            </div> <!-- / row -->

        </div>
    </section>

</main><!-- End #main -->

<?php include_once __DIR__ . '/header/footer.php'; ?>