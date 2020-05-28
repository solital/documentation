<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Básico de rotas</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>As rotas serão carregadas através do arquivo <code>routes.php</code> dentro da pasta <code>routers</code>. Você pode criar outros arquivos semelhantes ao <code>routes.php</code>, o Solital irá carregar esses arquivos automaticamente.</p>

        <p>Não é necessário, mas você pode definir <code>Course::setDefaultNamespace('\Demo\Controllers')</code>
        prefixar todas as rotas com o namespace para seus controladores. Isso simplificará um pouco as coisas, pois
        você não precisará especificar o namespace dos seus controladores em cada rota.</p>

        <h2>Roteamento básico</h2>
        <p>Abaixo está um exemplo muito básico de configuração de uma rota. O primeiro parâmetro é o URL ao qual a rota
        deve corresponder - o próximo parâmetro é uma função de fechamento ou retorno de chamada que será acionada assim
        que a rota corresponder.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/', <span class="txt-1">function</span>() {
            <span class="txt-7">return</span> 'Hello world';
        });
        </code></pre>

        <h2>Métodos disponíveis</h2>
        <p>Aqui você pode ver uma lista de todas as rotas disponíveis:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>($url,$callback,$settings);
            <span class="txt-6">Course</span>::<span class="txt-1">post</span>($url,$callback,$settings);
            <span class="txt-6">Course</span>::<span class="txt-1">put</span>($url,$callback,$settings);
            <span class="txt-6">Course</span>::<span class="txt-1">patch</span>($url,$callback,$settings);
            <span class="txt-6">Course</span>::<span class="txt-1">delete</span>($url,$callback,$settings);
            <span class="txt-6">Course</span>::<span class="txt-1">options</span>($url,$callback,$settings);
        </code></pre>

        <h2>Vários verbos HTTP</h2>
        <p>Às vezes, você pode precisar criar uma rota que aceite vários verbos HTTP. Se você precisar corresponder a todos
        os verbos HTTP, poderá usar o método <code>any</code>.</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">match</span>(['get', 'post'], '/', <span class="txt-1">function</span>() {
                // ...
            });

            <span class="txt-6">Course</span>::<span class="txt-1">any</span>('foo', <span class="txt-1">function</span>() {
                // ...
            });
        </code></pre>

        <p>Criamos um método simples que corresponde a GET e POST que é mais comumente usado:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">form</span>('foo', <span class="txt-1">function</span>() {
                // ...
            });
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>