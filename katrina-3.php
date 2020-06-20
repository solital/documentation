<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Listando chave estrangeira</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>Inner join</h2>
        <p>O método <code>innerJoin()</code> retorna os valores de duas tabelas que possuiem chave estrangeira. Informe o nome da tabela e o campo da outra tabela que possui a chave primária da sua tabela principal.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">innerJoin(<span class="txt-3">"address", "idAddress"</span>)</span>-><span class="txt-1">build(<span class="txt-3">"ALL"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Se quiser retornar apenas um único valor, utilize o terceiro parâmetro passando a achave primária</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">innerJoin(<span class="txt-3">"address", "idAddress"</span>, 2)-><span class="txt-1">build(<span class="txt-3">"ALL"</span>)</span></span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Você pode informar quais campos deseja retornar. "a" é a sua tabela principal enquanto "b" é a sua tabela que possui a chave estrangeira.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>
                -><span class="txt-1">innerJoin(<span class="txt-3">"address", "idAddress"</span>, 2 <span class="txt-3">"a.idPerson, a.name, b.street", "address", "idAddress"</span>)-><span class="txt-1">build(<span class="txt-3">"ALL"</span>)</span></span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>