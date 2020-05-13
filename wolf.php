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
            $key['title']
        </code></pre>

        <p>Não é necessário informar um <code>header.php</code> ou <code>footer.php</code>, o Wolf carrega os arquivos automaticamente. Mas caso não queira carregar um <code>header.php</code> ou <code>footer.php</code>, utilize <code>false</code> no terceiro parâmetro</p>

        <pre><code>
        <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>(<span class="txt-3">'home'</span>, [
            <span class="txt-3">'title' => 'My Title'</span>
        ], <span class="txt-7">false</span>);
        </code></pre>

        <h2>Carregando CSS, JS e imagens</h2>
        <p>Certifique-se que os arquivos existam na pasta <code>public/assets/css</code>, <code>public/assets/js</code> e <code>public/assets/img</code></p>

        <p>Para carregar um arquivo CSS, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
            &lt;link rel="stylesheet" href="<span class="txt-1">&lt;?</span> <span class="txt-6">self</span>::<span class="txt-1">loadCss</span>('style.css'); <span class="txt-6">?></span>">
        </code></pre>

        <p>Para carregar um arquivo JS, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
            &lt;style src="<span class="txt-1">&lt;?</span> <span class="txt-6">self</span>::<span class="txt-1">loadJs</span>('file.js'); <span class="txt-1">?></span>">&lt;/style>
        </code></pre>

        <p>Para carregar uma imagem, utilize no seu template a sintaxe abaixo</p>
        <pre><code>
            &lt;img src="<span class="txt-1">&lt;?</span> <span class="txt-6">self</span>::<span class="txt-1">loadImg</span>('image.png'); <span class="txt-1">?></span>">
        </code></pre>

        <h2>Header e footer personalizados</h2>
        <p>Caso tenha um <code>header.php</code> ou <code>footer.php</code> em um diretório diferente de <code>resources/views/</code>, utilize os comandos abaixo no seu template:</p>

        <pre><code>
            &lt;?php <span class="txt-6">self</span>::<span class="txt-1">loadHeader</span>('path/to/header.php'); ?>

            &lt;?php <span class="txt-6">self</span>::<span class="txt-1">loadFooter</span>('path/to/footer.php'); ?>
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>