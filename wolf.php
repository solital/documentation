<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Template Wolf</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Wolf é o sistema de template padrão do Solital. Você consegue carregar qualquer template dentro da pasta <code>resource/views</code></p>

        <strong>AVISO: NÃO APAGUE A PASTA <code>VINCI</code>. VINCI É O ASSISTENTE DE DESENVOLVIEMNTO DO SOLITAL E APAGAR A PASTA PODE ACARRETAR EM ERROS NO PROJETO</strong>

        <h2>Básico</h2>
        <p>Abaixo está o código básico para carregar qualquer template:</p>

        <pre><code>
        <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>(<span class="txt-3">'home'</span>);
        </code></pre>

        <h2>Parâmetros</h2>
        <p>A sitaxe abaixo carrega os parâmetros para serem visualizados no seu template.</p>
        <pre><code>
        <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>(<span class="txt-3">'home'</span>, [
            <span class="txt-3">'title' => 'My Title'</span>
        ]);
        </code></pre>

        <p>E na sua <code>home.php</code> recupere o valor informado dessa maneira:</p>
        <pre><code>
        <span class="txt-1">&lt;title><span class="txt-5">$title</span>&lt;/title></span>
        </code></pre>

        <h2>Extensões personalizadas</h2>
        <p>O Wolf irá buscar arquivos em formato <code>php</code>, mas para buscar um formato diferente, utilize o último parâmetro.</p>
        <pre><code>
        <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>(<span class="txt-3">'home'</span>, [
            <span class="txt-3">'title' => 'My Title'</span>
        ], <span class="txt-7">false</span>, <span class="txt-3">"html"</span>);
        </code></pre>

        <h2>Carregando CSS, JS e imagens</h2>
        <p>Certifique-se que os arquivos existam na pasta <code>public/assets/css</code>, <code>public/assets/js</code> e <code>public/assets/img</code></p>

        <p>Para carregar um arquivo CSS, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
        <span class="txt-1">&lt;link rel="<span class="txt-3">stylesheet</span>" href="<span class="txt-1"><span class="txt-5">&lt;?</span> <span class="txt-6">self</span>::<span class="txt-1">loadCss</span><span class="txt-5">('style.css'); ?></span></span>"></span>
        </code></pre>

        <p>Para carregar um arquivo JS, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
        <span class="txt-1">&lt;link rel="<span class="txt-3">stylesheet</span>" href="<span class="txt-1"><span class="txt-5">&lt;?</span> <span class="txt-6">self</span>::<span class="txt-1">loadJs</span><span class="txt-5">('file.js'); ?></span></span>"></span>
        </code></pre>

        <p>Para carregar uma imagem, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
        <span class="txt-1">&lt;img src="<span class="txt-5">&lt;? <span class="txt-6">self</span>::<span class="txt-1">loadImg</span>('image.png'); ?></span>"></span>
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>