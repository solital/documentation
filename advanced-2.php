<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Estendendo</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Esta seção contém dicas e truques avançados sobre a extensão do uso de parâmetros.</p>

        <p>Este é um exemplo simples de integração em uma estrutura.</p>

        <p>A estrutura possui sua própria classe <code>Course</code>, que herda da classe <code>Course</code>. Isso permite que a estrutura
        adicione funcionalidades personalizadas, como carregar um arquivo <code>routes.php</code> personalizado ou adicionar
        informações de depuração etc.</p>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo</span>;

        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Course</span>;

        <span class="txt-1">class</span> Course <span class="txt-1">extends</span> Course {

            <span class="txt-7">public static function</span> <span class="txt-1">start</span>() {

                <span class="comment">// change this to whatever makes sense in your project</span>
                <span class="txt-7">require_once</span> 'routes.php';

                <span class="comment">// change default namespace for all routes</span>
                <span class="txt-6">parent</span>::<span class="txt-1">setDefaultNamespace</span>(<span class="txt-1">'\Demo\Controllers'</span>);

                <span class="comment">// Do initial stuff</span>
                <span class="txt-6">parent</span>::<span class="txt-1">start</span>();

            }

        }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>