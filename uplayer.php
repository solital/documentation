<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal w-100">Uplayer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Uplayer é um componente que realiza o upload de arquivos a partir de um formulário.</p>

        <h2>Upload de um único arquivo</h2>
        <p>Insira o <code>enctype="multipart/form-data"</code> e o <code>name</code> no seu formulário</p>

        <pre><code>
            <span class="txt-1">&lt;form action=<span class="txt-3">"/upload"</span> method=<span class="txt-3">"post"</span> enctype=<span class="txt-3">"multipart/form-data"</span>></span>
                <span class="txt-1">&lt;input type=<span class="txt-3">"file"</span> name=<span class="txt-3">"file_upload"</span>></span>

                <span class="txt-1">&lt;button type=<span class="txt-3">"submit"</span>><span class="txt-5">Upload</span>&lt;/button></span>
            <span class="txt-1">&lt;/form></span>
        </code></pre>

        <p>Na sua classe, utilize o método <code>uploadFile()</code>. No parâmetro do Uplayer, insira o diretório da pasta onde os arquivos serão upados.</p>
        <pre><code>
            <span class="txt-7">use</span> Component\Uplayer\Uplayer <span class="txt-7">as</span> Uplayer;

            $up = <span class="txt-7">new</span> <span class="txt-1">Uplayer</span>('Images');
            $res = $up-><span class="txt-1">uploadFile</span>(<span class="txt-3">'file_upload'</span>);

            <span class="txt-1">var_dump</span>($res);
        </code></pre>

        <h2>Upload de vários arquivos</h2>
        <p>Para realizar o upload de vários arquivos, no <code>name</code> no seu formulário, insira em formato de array como mostrado abaixo</p>

        <pre><code>
            <span class="txt-1">&lt;form action=<span class="txt-3">"/upload"</span> method=<span class="txt-3">"post"</span> enctype=<span class="txt-3">"multipart/form-data"</span>></span>
                <span class="txt-1">&lt;input type=<span class="txt-3">"file"</span> name=<span class="txt-3">"files_upload[]"</span> multiple></span>

                <span class="txt-1">&lt;button type=<span class="txt-3">"submit"</span>><span class="txt-5">Upload</span>&lt;/button></span>
            <span class="txt-1">&lt;/form></span>
        </code></pre>

        <p>Utilize o método <code>uploadFiles()</code> para realizar o upload de múltipos arquivos.</p>
        <pre><code>
            <span class="txt-7">use</span> Component\Uplayer\Uplayer <span class="txt-7">as</span> Uplayer;

            $up = <span class="txt-7">new</span> <span class="txt-1">Upload</span>('Images');
            $res = $up-><span class="txt-1">uploadFiles</span>(<span class="txt-3">'files_upload'</span>);

            <span class="txt-1">var_dump</span>($res);
        </code></pre>

        <h2>Especificando os arquivos</h2>
        <p>Para realizar upload de arquivos específicos, utilize um array com extensões.</p>

        <pre><code>
            <span class="txt-7">use</span> Component\Uplayer\Uplayer <span class="txt-7">as</span> Uplayer;

            $up = <span class="txt-7">new</span> <span class="txt-1">Upload</span>('Images');
            $res = $up-><span class="txt-1">uploadFiles</span>(<span class="txt-3">'files_upload', ['png', 'jpg']</span>);

            <span class="txt-1">var_dump</span>($res);
        </code></pre>

        <h2>Nomes únicos para cada arquivo</h2>
        <p>Caso necessite ter nomes únicos para os arquivos, utilize <code>true no terceiro parâmetro</code>.</p>

        <pre><code>
            <span class="txt-7">use</span> Component\Uplayer\Uplayer <span class="txt-7">as</span> Uplayer;

            $up = <span class="txt-7">new</span> <span class="txt-1">Upload</span>('Images');
            $res = $up-><span class="txt-1">uploadFiles</span>(<span class="txt-3">'files_upload'</span>,<span class="txt-7">null, true</span>);

            <span class="txt-1">var_dump</span>($res);
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>