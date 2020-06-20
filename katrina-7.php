<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Manipulando tabelas</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O método <code>createTable()</code> inicia a abertura da tabela, após inserir os campos e os tipos de dados que as tabelas irão ter, utilize <code>closeTable()</code> para fechar a tabela. Para um melhor entendimento veja a sintaxe abaixo.</p>

        <pre><code>
        $res = <span class="txt-6">$this</span>-><span class="txt-1">instance</span>()
                    <span class="comment">/* Inicia a tabela especificando seu nome */</span>
                    -><span class="txt-1">createTable</span>(<span class="txt-3">"your_table_name"</span>)
                    <span class="comment">/* Campos e tipo da tabela */</span>
                    -><span class="txt-1">int</span>(<span class="txt-3">"id_orm"</span>)-><span class="txt-1">primary</span>()-><span class="txt-1">increment</span>()
                    -><span class="txt-1">varchar</span>(<span class="txt-3">"nome"</span>, 20)-><span class="txt-1">unique</span>()-><span class="txt-1">notNull</span>()-><span class="txt-1">default</span>(<span class="txt-3">"brenno"</span>)
                    -><span class="txt-1">int</span>(<span class="txt-3">"idade"</span>, 3)-><span class="txt-1">unsigned</span>()-><span class="txt-1">notNull</span>()
                    -><span class="txt-1">varchar</span>(<span class="txt-3">"email"</span>, 30)-><span class="txt-1">default</span>(<span class="txt-3">"brenno.gnr@gmail.com"</span>)-><span class="txt-1">notNull</span>()
                    -><span class="txt-1">varchar</span>(<span class="txt-3">"profissao"</span>, 40)
                    -><span class="txt-1">int</span>(<span class="txt-3">"tipo"</span>)
                    -><span class="txt-1">constraint</span>(<span class="txt-3">"dev_cons_fk"</span>)-><span class="txt-1">foreign</span>(<span class="txt-3">"tipo"</span>)-><span class="txt-1">references</span>(<span class="txt-3">"dev", "iddev"</span>)
                    <span class="comment">/* Fecha o comando para criar a tabela */</span>
                    -><span class="txt-1">closeTable</span>()
                    <span class="comment">/* Compila o código acima */</span>
                    -><span class="txt-1">build</span>();
        </code></pre>

        <p><a href="#">Veja aqui</a> para ter uma lista completa dos tipos de dados suportados.</p>

        <h2>Listar tabelas</h2>
        <p>Para ter uma lista de todas as tabelas do seu banco de dados, utilize o método <code>listTables()</code> passando <span class="txt-3">ALL</span> no <code>build()</code></p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listTables()</span>-><span class="txt-1">build(<span class="txt-3">"ALL"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Listar colunas</h2>
        <p>Para listar as colunas de uma tabela, utilize o método <code>describeTable()</code> passando como parâmetro o nome da sua tabela juntamente com o <span class="txt-3">ALL</span> no <code>build()</code></p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">describeTable(<span class="txt-3">"your_table"</span>)</span>-><span class="txt-1">build(<span class="txt-3">"ALL"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Alterar tabela</h2>
        <p>A função <code>alter()</code> realiza os procedimentos de adicionar, alterar e excluir um campo da tabela do banco de dados.</p>

        <h2>Adicionar novo campo</h2>
        <p>Utilize o <code>add()</code> juntamente com o tipo de dado para adicionar um campo novo.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">instance</span>()
                            -><span class="txt-1">alter</span>(<span class="txt-3">"mensagens"</span>)-><span class="txt-1">add</span>()
                            -><span class="txt-1">varchar</span>(<span class="txt-3">"primeiro_campo"</span>, 10)
                            -><span class="txt-1">build</span>();
            }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>