<?php

include_once '../config.php';

$title = "Contribute | Solital Framework";

include_once('../header/header.php');

?>

<section class="container">
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h2 class="display-4 mt-5 txt-1">We need your help!</h2>
            <p class="h5 font-weight-normal mt-5 txt-5">Solital is a recent project, so the collaboration
                of whoever uses the project will be very useful. Feel free to improve the translation of
                this documentation as well. All help is welcome, from typos to more serious errors.</p>
            <p class="h5 font-weight-normal mt-5 txt-5">If the library is missing
                a feature that you need in your project or if you have feedback, we'd love to hear from you. Feel
                free to leave us feedback</p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h2 class="display-4 mb-5 txt-1">Contributor Guidelines</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul>
                <li>Write the code following PSR-2 and PSR-12</li>
                <li>Remove trailing white space</li>
                <li>Use 4 spaces instead of tabs</li>
            </ul>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h2 class="display-4 mb-5 txt-1">Pull requests</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            Separate each new feature or improvement into a separate branch in your bifurcated repository.
            Submit a pull request for each resource branch to the development branch of the Solital repository.
        </div>
    </div>
</section>

<?php include_once('../header/footer.php'); ?>