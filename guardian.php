<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Autenticação</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O Guardian auxilia na hora que você utilizar o <code>verifyLogin()</code> da Katrina ORM, para salvar, verificar, validar e fazer logoff.</p>

        <h2>Configuração</h2>
        <p>Antes de tudo, certifique de alterar no <code>config.php</code> dentro da pasta <code>config</code> as constantes do Guardian.</p>

        <pre><code>
            <span class="comment">/**
            * GUARDIAN CONSTANTS
            */</span>

            <span class="comment">/* Rota de login caso a verificação de login for false */</span>
            <span class="txt-7">define</span>(<span class="txt-3">'URL_LOGIN', 'your_login_url'</span>);
            <span class="comment">/* Rota do dashboard caso a verificação de login for true */</span>
            <span class="txt-7">define</span>(<span class="txt-3">'URL_DASHBOARD', 'your_dashboard_url'</span>);
            <span class="comment">/* Index padrão do Guardian */</span>
            <span class="txt-7">define</span>(<span class="txt-3">'INDEX_LOGIN', 'your_index'</span>);
        </code></pre>

        <p>Insira na sua classe o namespace do Guardian.</p>
        <pre><code>
            <span class="txt-7">use</span> Solital\Guardian\Guardian;
        </code></pre>

        <h2>Validar login</h2>
        <p>Para validar o login, utilize o método <code>validate()</code> passando como parâmetro a informação que você queira guardar na sessão.</p>

        <pre><code>
            $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>
                        -><span class="txt-1">verifyLogin(<span class="txt-3">'your_column_email', 'your_column_password', 'your_email', 'your_password'</span>)</span>;
            
            <span class="txt-1">if</span> ($res) {
                <span class="txt-6">Guardian</span>::<span class="txt-1">validade</span>($res['nomeAdm']);
            }
        </code></pre>

        <p>O Guardian irá utilizar o index padrão definido na constante <code>INDEX_LOGIN</code>. Para utilizar um index personalizado, utilize o segundo parâmetro.</p>

        <pre><code>
            <span class="txt-6">Guardian</span>::<span class="txt-1">validade</span>($res['nomeAdm'], <span class="txt-3">'your_index'</span>);
        </code></pre>

        <h2>Checar login</h2>
        <p>Para garantir que o usuário esteja autenticado, utilize <code>checkLogin()</code>. Caso o login não tenha sido validado através do método <code>validate()</code>, o usuário será redirecionado para a rota definida na constante <code>URL_LOGIN</code>. O exemplo abaixo mostra o método junto ao Wolf template.</p>

        <pre><code>
            <span class="txt-6">Guardian</span>::<span class="txt-1">checkLogin</span>();
            
            <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>('home');
        </code></pre>

        <p>Para garantir que o usuário não caia na rota de login quando já tiver sido validado, insira o método <code>checkLogged()</code> na sua rota de login. Esse método irá redirecionar o usuário para o dashboard do seu sistema. Certifique-se de que sua constante <code>URL_DASHBOARD</code> esteja com um valor definido.</p>

        <pre><code>
            <span class="txt-6">Guardian</span>::<span class="txt-1">checkLogged</span>();

            <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>('login');
        </code></pre>

        <h2>Fazer logoff</h2>
        <p>Para realizar o logoff, utilize o método <code>logoff()</code>.</p>

        <pre><code>
            <span class="txt-6">Guardian</span>::<span class="txt-1">logoff</span>();
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>