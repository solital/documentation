<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Nome das rotas</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>As rotas nomeadas permitem a geração conveniente de URLs ou redirecionamentos para rotas específicas. Você pode
        especificar um nome para uma rota encadeando o método name na definição de rota:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/profile', <span class="txt-1">function</span> () {
                <span class="comment">// Your code here</span>
            })->name('profile');
        </code></pre>
        
        <p>Você também pode especificar nomes para ações do controlador:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/profile', '<span class="txt-1">UserController@profile</span>')-><span class="txt-1">name</span>('profile');
        </code></pre>

        <h2>Gerando URLs para rotas nomeadas</h2>
        <p>Depois de atribuir um nome a uma determinada rota, você poderá usar o nome da rota ao gerar URLs ou
        redirecionamentos por meio da função de ajuda de URL global (consulte a seção de auxiliares:</p>

        <pre><code>
            <span class="comment">// Generating URLs...</span>
            $url = <span class="txt-1">url(<span class="txt-5">'profile'</span>)</span>;
        </code></pre>

        <p>Se a rota nomeada definir parâmetros, você poderá passar os parâmetros como o segundo argumento para a função
        url. Os parâmetros fornecidos serão automaticamente inseridos no URL em suas posições corretas:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{id}/profile', <span class="txt-1">function</span> ($id) {
                <span class="comment">// ...</span>
            })-><span class="txt-1">name</span>('profile');

            $url = <span class="txt-1">url</span>('profile', ['id' => 1]);
        </code></pre>

        <p>Para mais informações sobre URLs, consulte a seção URLs.</p>

    </div>
</div>

<?php include('footer.php'); ?>