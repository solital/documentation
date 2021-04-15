<?php

include_once 'config.php';

$title = "Solital Framework | Not Found";
$meta_index = "noindex";

include_once('header/header.php');

?>

<section class="container-fluid mb-5" style="margin-top: -15px;">
    <div class="row p-5">
        <div class="col-md-12 col-sm-12 text-center">
            <h1 class="display-3 txt-1 mt-5">Not Found</h1>
            <p class="h5 font-weight-normal mt-5 txt-5">The reported URL does not exist </p>
            <a href="<?= fullUrl() ?>" class="btn btn-3 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                Back to home page
            </a>
        </div>
    </div>
</section>

<?php include_once('header/footer.php'); ?>