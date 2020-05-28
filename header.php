<?php 
ini_set("display_errors", true);
error_reporting(E_ALL);

$aspas_simples = "'";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/simple-sidebar.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font awesome 5 -->
    <link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-right bg-menu shadow no-border" id="sidebar-wrapper">
            <div class="sidebar-heading bg-8 shadow">
                <a class="navbar-brand" href="#">
                    <img class="logo d-inline-block align-top" src="#">
                </a>
            </div>
            <div class="scroll">
                <ul class="list-group list-group-flush bg-menu">
                    <a href="starting.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Começando
                    </a>

                    <a href="instalation.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Instalação
                    </a>

                    <a href="mvc.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Arquitetura MVC
                    </a>

                    <a href="vinci.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Vinci
                    </a>

                    <a class="list-group-item list-group-item-action no-border bg-menu" href="#routers"
                        data-toggle="collapse" aria-expanded="false">
                        Rotas
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="routers">
                        <a href="routers-1.php">
                            <li class="padding-submenu">
                                <span>Básico de rotas</span>
                            </li>
                        </a>
                        <a href="routers-2.php">
                            <li class="padding-submenu">
                                <span>Parâmetros</span>
                            </li>
                        </a>
                        <a href="routers-3.php">
                            <li class="padding-submenu">
                                <span>Nome das rotas</span>
                            </li>
                        </a>
                        <a href="routers-4.php">
                            <li class="padding-submenu">
                                <span>Grupos</span>
                            </li>
                        </a>
                        <a href="routers-5.php">
                            <li class="padding-submenu">
                                <span>Grupos parciais</span>
                            </li>
                        </a>
                        <a href="url.php">
                            <li class="padding-submenu">
                                <span>URL's</span>
                            </li>
                        </a>
                        <a href="routers-8.php">
                            <li class="padding-submenu">
                                <span>Injeção de dependência</span>
                            </li>
                        </a>
                        <a href="middlewares.php">
                            <li class="padding-submenu">
                                <span>Middlewares</span>
                            </li>
                        </a>
                        <a href="exceptions.php">
                            <li class="padding-submenu">
                                <span>Exceções</span>
                            </li>
                        </a>
                        <a href="routers-9.php">
                            <li class="padding-submenu">
                                <span>Mais exemplos</span>
                            </li>
                        </a>
                    </ul>

                    <a href="sessions-cookies.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Sessions e Cookies
                    </a>

                    <a href="input_params.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Entrada e parâmetros
                    </a>

                    <a href="events.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Eventos
                    </a>

                    <a class="list-group-item list-group-item-action no-border bg-menu" href="#advanced"
                        data-toggle="collapse" aria-expanded="false">
                        Avançado
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="advanced">
                        <a href="advanced-1.php">
                            <li class="padding-submenu">
                                <span>Reescrita de URL</span>
                            </li>
                        </a>
                        <a href="advanced-2.php">
                            <li class="padding-submenu">
                                <span>Estendendo</span>
                            </li>
                        </a>
                    </ul>

                    <a href="http-1.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Cliente HTTP
                    </a>

                    <a href="#katrina" class="list-group-item list-group-item-action no-border bg-menu"
                        data-toggle="collapse" aria-expanded="false">
                        Katrina ORM
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="katrina">
                        <a href="katrina-1.php">
                            <li class="padding-submenu">
                                <span>Iniciando</span>
                            </li>
                        </a>
                        <a href="katrina-2.php">
                            <li class="padding-submenu">
                                <span>Realizando CRUD</span>
                            </li>
                        </a>
                        <a href="katrina-3.php">
                            <li class="padding-submenu">
                                <span>Listando chave estrangeira</span>
                            </li>
                        </a>
                        <a href="katrina-4.php">
                            <li class="padding-submenu">
                                <span>Procedure</span>
                            </li>
                        </a>
                        <a href="katrina-5.php">
                            <li class="padding-submenu">
                                <span>Verificar login</span>
                            </li>
                        </a>
                        <a href="katrina-6.php">
                            <li class="padding-submenu">
                                <span>Paginação de resultados</span>
                            </li>
                        </a>
                    </ul>

                    <a href="wolf.php" class="list-group-item list-group-item-action no-border bg-menu">
                        Template Wolf
                    </a>

                    <a href="#security" class="list-group-item list-group-item-action no-border bg-menu"
                        data-toggle="collapse" aria-expanded="false">
                        Segurança
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="security">
                        <a href="guardian.php">
                            <li class="padding-submenu">
                                <span>Guardian</span>
                            </li>
                        </a>
                        <a href="csrf.php">
                            <li class="padding-submenu">
                                <span>Proteção CSRF</span>
                            </li>
                        </a>
                    </ul>

                    <a href="#components" class="list-group-item list-group-item-action no-border bg-menu"
                        data-toggle="collapse" aria-expanded="false">
                        Componentes
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="components">
                        <a href="consumer.php">
                            <li class="padding-submenu">
                                <span>Consumer API</span>
                            </li>
                        </a>
                        <a href="message.php">
                            <li class="padding-submenu">
                                <span>Message</span>
                            </li>
                        </a>
                        <a href="uplayer.php">
                            <li class="padding-submenu">
                                <span>Uplayer</span>
                            </li>
                        </a>
                        <a href="mail.php">
                            <li class="padding-submenu">
                                <span>Mail</span>
                            </li>
                        </a>
                    </ul>
                </ul>
            </div>

            <hr>
            <button class="btn btn-1 dropdown-toggle ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Versão do Solital
            </button>
            <div class="dropdown-menu bg-1" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item text-white" href="#">1.0</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-1 w-100" style="margin-left: -1px;">
                <button class="btn btn-2" id="menu-toggle">
                    <i class="fas fa-arrows-alt-h p-1"></i>
                </button>

                <button class="navbar-toggler navbar-icon" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item mr-3">
                            <form action="#">
                                <input type="text" placeholder="&#xf002; Search..." class="input-search">
                            </form>
                        </li>
                        <li class="nav-item mr-3 li-main-menu">
                            <a class="nav-link pl-0 txt-8 font-weight-bold itens-main-menu" href="index.php">
                                Página inicial</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section class="container-fluid section">