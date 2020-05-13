<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Sessions e Cookies</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>Criar session e cookie</h2>
        <p>O funcionamento das sesions e cookies são iguais. Para criar uma session, no primeiro parâmetro informe o index da session, o segundo o seu respectivo valor.</p>

        <pre><code>
            <span class="txt-7">use</span> Solital\Session\Session;

            <span class="txt-6">Session</span>::<span class="txt-1">new</span>(<span class="txt-3">'your_index', 'your_value'</span>);
        </code></pre>

        <p>E para os Cookies.</p>

        <pre><code>
            <span class="txt-7">use</span> Solital\Cookie\Cookie;
            
            <span class="txt-6">Cookie</span>::<span class="txt-1">new</span>(<span class="txt-3">'your_index', 'your_value'</span>);
        </code></pre>

        <h2>Exibir session e cookie</h2>
        <p>Para exibir a session e cookie, utilize a sintaxe abaixo.</p>

        <pre><code>
            <span class="txt-6">Session</span>::<span class="txt-1">show</span>(<span class="txt-3">'your_index'</span>);

            <span class="txt-6">Cookie</span>::<span class="txt-1">show</span>(<span class="txt-3">'your_index'</span>);
        </code></pre>

        <h2>Deletar session e cookie</h2>
        <p>Para deletar a session e cookie, utilize a sintaxe abaixo.</p>

        <pre><code>
            <span class="txt-6">Session</span>::<span class="txt-1">delete</span>(<span class="txt-3">'your_index'</span>);

            <span class="txt-6">Cookie</span>::<span class="txt-1">delete</span>(<span class="txt-3">'your_index'</span>);
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>