<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Começando</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Solital é um framework completo com tudo o que você precisa para criar projetos de alto valor.</p>

        <h2>Instalando via Composer</h2>
        <p>Navegue até a pasta do projeto no terminal e execute o seguinte comando:</p>

        <pre><code>
        <span class="txt-1">composer</span> <span class="txt-7">require</span> solital/solital
        </code></pre>

        <p>Com o Solital, você pode criar um novo projeto rapidamente, sem depender de uma estrutura.</p>

        <p>São necessárias apenas algumas linhas de código para começar:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/', <span class="txt-1">function</span>() {
            <span class="txt-7">return</span> 'Hello world';
        });
        </code></pre>

        <h2>Executando</h2>
        <p>Para poder executar o projeto, utilize o servidor embutido do PHP ou crie um virtual host:</p>

        <pre><code>
        <span class="txt-5">php -S localhost:8000 -t public/</span>
        </code></pre>

        <h2>Requisitos</h2>
        <ul class="ml-5">
            <li>PHP 7.1 ou superior (a versão 3.xe abaixo suporta PHP 5.5+)</li>
            <li>Extensão PHP JSON ativada.</li>
        </ul>
        
        <h2>Recursos</h2>
        <ul class="ml-5">
            <li>Roteamento básico (GET, POST, PUT, PATCH, UPDATE, DELETE) com suporte para vários verbos personalizados.</li>
            <li>Restrições de expressão regular para parâmetros.</li>
            <li>Rotas nomeadas.</li>
            <li>Gerando URL para rotas.</li>
            <li>Grupos de rotas.</li>
            <li>Middleware (classes que interceptam antes da rota ser renderizada).</li>
            <li>Namespaces.</li>
            <li>Prefixos de rota.</li>
            <li>Proteção CSRF.</li>
            <li>Parâmetros opcionais.</li>
            <li>Roteamento de subdomínio.</li>
            <li>Gerenciadores de inicialização personalizados para reescrever os URLs nos mais "agradáveis".</li>
            <li>Gerenciador de entrada; gerenciar facilmente os valores GET, POST e FILE.</li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>