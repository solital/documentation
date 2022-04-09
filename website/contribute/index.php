<?php

include_once __DIR__ . '/../config.php';

$title = "Contribute | Solital Framework";

include_once __DIR__ . '/../header/header.php';

?>

<main id="main">
    <!-- ======= what-is Section ======= -->
    <section>
        <div class="container mt-5" data-aos="fade-up">
            <header class="section-header">
                <h2>We need your help!</h2>
            </header>

            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <p class="h5 font-weight-normal mt-5 txt-5">Solital is a recent project, so the collaboration
                            of whoever uses the project will be very useful. Feel free to improve the translation of
                            this documentation as well. All help is welcome, from typos to more serious errors.</p>
                        <p class="h5 font-weight-normal mt-5 txt-5">If the library is missing
                            a feature that you need in your project or if you have feedback, we'd love to hear from you. Feel
                            free to leave us feedback</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Contributor Guidelines</h2>
            </header>

            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <p>
                        <ul>
                <li>Write the code following PSR-2 and PSR-12</li>
                <li>Remove trailing white space</li>
                <li>Use 4 spaces instead of tabs</li>
            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Pull requests</h2>
            </header>

            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <p>
                        Separate each new feature or improvement into a separate branch in your bifurcated repository. Submit a pull request for each resource branch to the development branch of the Solital repository.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once __DIR__ . '/../header/footer.php'; ?>