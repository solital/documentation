<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Iniciando</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>O que é a Katrina ORM</h2>
        <p>Katrina ORM é um componente  para aproximar o paradigma de desenvolvimento de aplicações orientadas a objetos ao paradigma do banco de dados relacional. Ela auxilia na hora de realizar rotinas comuns, como o famoso CRUD (criar, ler, editar e deletar), além de possuir um sistema de login e paginação de dados.</p>

        <h2>Requisitos</h2>
        <p>Certifique-se de que o PDO esteja habilitado no seu ambiente de desenvolvimento ou na sua hospedagem.</p>

        <h2>Configurações</h2>
        <p>Para configurar o seu banco de dados, edite o arquivo <code>db.php</code> dentro da pasta <code>config</code>.</p>

        <pre><code>
        <span class="txt-7">define</span>(<span class="txt-3">'DB_CONFIG', [
                            'DRIVE' => 'your_drive',
                            'HOST' => 'your_host',
                            'DBNAME' => 'your_database_name',
                            'USER' => 'your_user',
                            'PASS' => 'your_password'
                    ]</span>);
        </code></pre>

        <h2>Estrutura inicial</h2>
        <p>Para inicializar, instancie a Katrina ORM na sua classe model seguindo a estrutura abaixo.</p>

        <pre><code>
            &lt;?php

            <span class="txt-7">use</span> <span class="txt-1">Component\Katrina\Katrina</span> as <span class="txt-1">Katrina</span>;

            <span class="txt-7">class</span> <span class="txt-1">User</span>
            {

                <span class="comment"># Formato String</span>
                <span class="txt-7">private</span> $table = <span class="txt-3">'tabela_do_seu_banco'</span>;
                <span class="comment"># Formato String</span>
                <span class="txt-7">private</span> $columnPrimaryKey = <span class="txt-3">'chave_primária'</span>;
                <span class="comment"># Formato Array</span>
                <span class="txt-7">private</span> $columns = [
                    <span class="txt-3">'primeira_coluna_da_tabela'</span>, 
                    <span class="txt-3">'segunda_coluna_da_tabela'</span>,
                    ...
                ];

                <span class="txt-7">public function</span> <span class="txt-1">dbInstance()</span>
                {
                    $orm = <span class="txt-7">new</span> <span class="txt-1">Katrina</span>(<span class="txt-6">$this</span>->table, <span class="txt-6">$this</span>->columnPrimaryKey, <span class="txt-6">$this</span>->columns);
                    <span class="txt-7">return</span> $orm;
                }

                <span class="txt-7">public function</span> <span class="txt-1">get()</span>
                {
                    $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">listAll()</span>;
                    <span class="txt-7">return</span> $res;
                }
            }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>