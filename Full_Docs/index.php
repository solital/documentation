<?php

include_once 'config.php';

$title = "Solital Framework | The easy-to-use PHP framework";
$meta_index = "index";

include_once('header/header.php');

?>

<section class="container-fluid mb-5" style="margin-top: -15px;">
    <div class="row p-5">
        <div class="col-md-6 col-sm-12 logo">
            <div class="mt-4">
                <img src="<?= fullUrl() ?>/assets/img/solital-logo-profile.png" class="w-75 img-fluid wow animated fadeInLeft" data-wow-delay="2s">
            </div>
        </div>

        <div class="col-md-6 col-sm-12 text-center">
            <h1 class="display-3 txt-1 mt-5 wow animated fadeInRight" data-wow-delay="2s">Fast, easy and practical </h1>
            <p class="h5 font-weight-normal mt-5 txt-5 wow animated fadeInRight" data-wow-delay="2s">Solital is a fast PHP
                framework for creating projects, containing a template system, login structure, Console and more.</p>
            <a href="docs/2.x/" class="btn btn-3 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                Documentation
            </a>
            <a href="https://github.com/solital/solital" target="_blank" class="btn btn-3 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                Github
            </a>
        </div>
    </div>
</section>

<section class="container">
    <div class="row margin-lg text-center">
        <div class="col-md-4">
            <p class="txt-1 h1">
                <i class="fas fa-shield-alt"></i> Security
            <p class="mt-3">Components that make your project safer</p>
            </p>
        </div>

        <div class="col-md-4">
            <p class="txt-1 h1">
                <i class="fas fa-fighter-jet"></i> Fast
            <p class="mt-3">Run your projects quickly</p>
            </p>
        </div>

        <div class="col-md-4">
            <p class="txt-1 h1">
                <i class="far fa-hand-point-up"></i> Easy
            <p class="mt-3">Easy to learn, easy to use</p>
            </p>
        </div>
    </div>

    <div class="row text-center margin-lg mt-5">
        <div class="col-md-12">
            <h2 class="display-4 mb-5 txt-1">Resources</h2>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-6">
            <div class="mb-3 ticket form-inline p-3 bg-8">
                <div class="col-md-4 text-center h1">
                    <i class="fas fa-database"></i>
                </div>
                <div class="col-md-8">
                    <p class="h4 txt-5"><a href="#" class="resources-text">Katrina ORM</a></p>
                    <small class="txt-5">Component that abstracts and manipulates the database</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3 ticket form-inline p-3 bg-8">
                <div class="col-md-4 text-center h1">
                    <i class="fas fa-terminal"></i>
                </div>
                <div class="col-md-8">
                    <p class="h4 txt-5"><a href="#" class="resources-text">Vinci</a></p>
                    <small class="txt-5">Wizard to create components and execute methods in the terminal</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-6">
            <div class="mb-3 ticket form-inline p-3 bg-8">
                <div class="col-md-4 text-center h1">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="col-md-8">
                    <p class="h4 txt-5"><a href="#" class="resources-text">Authentication</a></p>
                    <small class="txt-5">Standard authentication and password change structure </small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3 ticket form-inline p-3 bg-8">
                <div class="col-md-4 text-center h1">
                    <i class="fab fa-wolf-pack-battalion"></i>
                </div>
                <div class="col-md-8">
                    <p class="h4 txt-5"><a href="#" class="resources-text">Wolf Template</a></p>
                    <small class="txt-5">Standard template system. View templates and cache them</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h2 class="display-4 mt-5 txt-1 wow animated fadeInRight" data-wow-delay="2s">What is Solital Framework?</h2>
            <p class="h5 font-weight-normal mt-5 txt-5 wow animated fadeInRight" data-wow-delay="2s">Solital is a new PHP
                framework developed in 2020 for creating projects, containing a template system, login structure, console
                and much more. Solital has a simple syntax to understand.</p>
            <p class="h5 font-weight-normal mt-5 txt-5 wow animated fadeInRight" data-wow-delay="2s">Solital
                framework is based on the <a href="https://github.com/skipperbent/simple-php-router">simple-php-router</a>
                component, but with improvements in the core, in addition to having a cache, template, authentication,
                ORM system and its own console for creating pre-defined structures.</p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h2 class="display-4 mb-5 txt-1">Try using Solital</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            Access the documentation and use this framework in your projects.
        </div>

        <div class="col-md-12 text-center">
            <a href="docs/2.x/" class="btn btn-3 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                Documentation
            </a>
        </div>
    </div>
</section>

<?php include_once('header/footer.php'); ?>