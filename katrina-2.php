<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Realizando CRUD</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>Listar</h2>
        <p>Para listar todos os campos da tabela, utilize o <code>listAll()</code> como mostrado no exemplo anterior. Por padrão, o metódo irá listar todos os campos da tabela.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listAll()</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Para especificar quais campos deseja listar, passe os valores como parâmetros.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listAll(<span class="txt-3">"name, city, country"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Se precisar da cláusula <code>WHERE</code>, utilize o segundo parâmetro.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listAll(<span class="txt-3">"name, city, country", "name = John AND city = Kansas"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Utilize o <code>listOnlyId()</code> para retornar apenas um único valor da tabela.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listOnlyId(<span class="txt-5">3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Você também pode especificar quais campos da tabela você quer retornar</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listOnlyId(<span class="txt-3">"name, city, country"</span>, <span class="txt-5">3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Ou caso queira a cláusula <code>WHERE</code>.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listOnlyId(<span class="txt-3">"name, city, country"</span>, <span class="txt-5">3</span>, <span class="txt-3">"name = John AND city = Kansas"</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Listagem customizada</h2>
        <p>Para realizar um <code>SELECT</code> personalizado no banco, utilize <code>customQueryAll()</code>. Esse método lista todos os dados sa tabela.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">customQueryAll(<span class="txt-3">SELECT * FROM tb_users</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Se precisar listar apenas um único valor, utilize <code>customQueryOnly()</code>.</p>
        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">customQueryOnly(<span class="txt-3">SELECT * FROM tb_users WHERE id = 3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Inserir</h2>
        <p>O método <code>insert()</code> insere os valores na tabela. Para isso crie um array com os valores que o método irá receber</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">insert()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">insert(<span class="txt-3">['Clark', 'Metropolis', 'EUA']</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Atualizar</h2>
        <p>O método <code>update()</code> atualiza os valores na tabela. Antes utilize o método <code>colUpdate()</code> para especificar as colunas que serão atualizadas. Em seguida crie um array com os valores que o método irá receber junto com a chave primária.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">update()</span>
            {
                <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">colUpdate(<span class="txt-3">['name']</span>)</span>;
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">update(<span class="txt-3">['Clark']</span>, <span class="txt-5">3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <h2>Deletar</h2>
        <p>O método <code>delete()</code> apaga os valores na tabela. Informe a chave primária correspondente a linha da tabela que você quer deletar.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">delete()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">delete(<span class="txt-5">3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Para apagar toda a tabela, informe <code>true</code> no segundo parâmetro</p>
        
        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">delete()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">delete(<span class="txt-5">3</span>, <span class="txt-7">true</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>