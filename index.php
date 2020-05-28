<?php include_once('header-index.php'); ?>

<main style="margin-top: 100px;">
    <section class="container-fluid" style="margin-top: -15px;">
        <div class="row bg-9 p-5">
            <div class="col-md-6">
                <div class="mt-4">
                    <img src="assets/img/productivity.png" class="w-75 img-fluid wow animated fadeInLeft"
                        data-wow-delay="2s">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <h1 class="display-3 mt-5 wow animated fadeInRight" data-wow-delay="2s">Rápido, fácil e prático</h1>
                <p class="h5 font-weight-normal mt-5 wow animated fadeInRight" data-wow-delay="2s">Solital é um
                    framework PHP completo com
                    tudo o que você precisa para criar projetos
                    de alto valor.</p>
                <a href="starting.php" class="btn btn-8 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                    Documentação
                </a>
                <a href="#" class="btn btn-8 mt-5 p-3 mr-3 wow animated fadeInUp" data-wow-delay=".4s">
                    Github
                </a>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="row margin-lg">
            <div class="col-md-12">
                <hr>
                <h2 class="display-4 mb-5 text-center txt-1">Instalação e execução</h2>

                <p>Navegue até a pasta do projeto no terminal e execute o seguinte comando:</p>

                <pre><code>
                <span class="txt-1">composer</span> <span class="txt-7">require</span> solital/solital
                </code></pre>

                <p>São necessárias apenas algumas linhas de código para começar:</p>

                <pre><code>
                <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/', <span class="txt-1">function</span>() {
                    <span class="txt-7">return</span> 'Hello world';
                });
                </code></pre>

                <p>Para poder executar o projeto, utilize o servidor embutido do PHP ou crie um virtual host:</p>

                <pre><code>
                <span class="txt-5">php -S localhost:8000 -t public/</span>
                </code></pre>

            </div>
        </div>

        <div class="row text-center margin-lg">
            <div class="col-md-12">
                <hr>
                <h2 class="display-4 mb-5 txt-1">Componentes</h2>
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
                        <small class="txt-5">Componente para auxiliar na manipulação do banco de dados</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3 ticket form-inline p-3 bg-8">
                    <div class="col-md-4 text-center h1">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="col-md-8">
                        <p class="h4 txt-5"><a href="#" class="resources-text">Vinci</a></p>
                        <small class="txt-5">Assistente para criar componentes em modo gráfico</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-6">
                <div class="mb-3 ticket form-inline p-3 bg-8">
                    <div class="col-md-4 text-center h1">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="col-md-8">
                        <p class="h4 txt-5"><a href="#" class="resources-text">Consumer API</a></p>
                        <small class="txt-5">Lib básica que auxilia na hora de consumir API REST</small>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="mb-3 ticket form-inline p-3 bg-8">
                    <div class="col-md-4 text-center h1">
                        <i class="fab fa-wolf-pack-battalion"></i>
                    </div>
                    <div class="col-md-8">
                        <p class="h4 txt-5"><a href="#" class="resources-text">Template Wolf</a></p>
                        <small class="txt-5">Sistema de template padrão do Solital</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center margin-lg">
            <div class="col-md-12">
                <hr>
                <h2 class="display-4 mb-5 txt-1">Últimas notícias</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <p>25/05/2020</p>
                    <p class="h4 txt-1">Solital 1.0.0 released</p>
                </div>
                <hr>

                <div class="mb-3">
                    <p>24/05/2020</p>
                    <p class="h4 txt-1">Solital 0.10.0 released</p>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-1 mt-3">Ver mais no blog</a>
            </div>
        </div>

        <div id="voltarTopo">
            <a href="#" id="up" class="up btn btn-3">
                <i class="fas fa-arrow-up p-2"></i>
            </a>
        </div>
    </section>
</main>

<?php include_once('footer-index.php'); ?>