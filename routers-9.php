<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Mais exemplos</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Você pode encontrar muitos outros exemplos no arquivo de exemplo abaixo:</p>

        <pre><code>
        &lt;?php
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Course</span>;

        <span class="comment">/* Adding custom csrfVerifier here */</span>
        <span class="txt-6">Course</span>::<span class="txt-1">csrfVerifier</span>(<span class="txt-7">new</span> <span class="txt-1">\Demo\Middlewares\CsrfVerifier</span>());

        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['middleware' => <span class="txt-1">\Demo\Middlewares\Site::class</span>, 'exceptionHandler' => <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="txt-1">\Demo\Handlers\CustomExceptionHandler::class</span>], <span class="txt-1">function</span>() {


            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/answers/{id}', '<span class="txt-1">ControllerAnswers@show</span>', ['where' => ['id' => '[0-9]+']]);


            <span class="comment">/**
            * Restful resource (see IRestController interface for available methods)
            */</span>

            <span class="txt-6">Course</span>::<span class="txt-1">resource</span>('/rest', <span class="txt-1">ControllerRessource::class</span>);


            <span class="comment">/**
            * Load the entire controller (where url matches method names - getIndex(), postIndex(), putIndex()).
            * The url paths will determine which method to render.
            *
            * For example:
            *
            * GET  /animals         => getIndex()
            * GET  /animals/view    => getView()
            * POST /animals/save    => postSave()
            *
            * etc.
            */</span>

            <span class="txt-6">Course</span>::<span class="txt-1">controller</span>('/animals', <span class="txt-1">ControllerAnimals::class</span>);

        });

        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/page/404', '<span class="txt-1">ControllerPage@notFound</span>', ['as' => 'page.notfound']);
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>