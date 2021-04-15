<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Solital is a fast PHP framework for creating projects, containing a template system, login structure, Console and more." />
    <meta name="robots" content="<?= $meta_index ?>, follow" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= fullUrl() ?>/assets/css/reset.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= fullUrl() ?>/assets/css/custom.css" />
    <link rel="stylesheet" href="<?= fullUrl() ?>/assets/css/animate.css">
    <link rel="stylesheet" href="<?= fullUrl() ?>/assets/css/style.css">
    <!-- Font awesome 5.13 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- favicon -->
    <link rel="icon" href="<?= fullUrl() ?>/assets/img/favicon.ico">
    <style>
        .main {
            margin-top: 50px;
        }

        @media (max-width: 540px) {
            h1, h2 {
                font-size: 40px !important;
            }

            .logo {
                text-align: center !important;
            }

            .main {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white shadow p-2">
        <button class="navbar-toggler btn btn-2" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item li-main-menu">
                    <a class="nav-link itens-main-menu font-weight-bold txt-5" href="<?= fullUrl() ?>">Home</a>
                </li>
                <li class="nav-item li-main-menu">
                    <a class="nav-link itens-main-menu font-weight-bold txt-5" href="<?= fullUrl() ?>/docs/2.x">Documentation</a>
                </li>
                <li class="nav-item li-main-menu">
                    <a class="nav-link itens-main-menu font-weight-bold txt-5" href="https://github.com/solital/core/blob/master/CHANGELOG.md">News</a>
                </li>
                <li class="nav-item li-main-menu">
                    <a class="nav-link itens-main-menu font-weight-bold txt-5" href="<?= fullUrl() ?>/contribute">Contribute</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="main">