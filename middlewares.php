<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Middlewares</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Middlewares são classes que são carregadas antes da rota ser renderizada. Um middleware pode ser usado para verificar se um usuário está conectado - ou para definir parâmetros específicos para a solicitação/rota atual. Os middlewares devem implementar a interface <code>IMiddleware</code>.</p>

        <h3>Exemplo</h3>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo\Middlewares</span>;

        <span class="txt-7">use</span> <span class="txt-1">Solital\Http\Middleware\IMiddleware</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Http\Request</span>;

        <span class="txt-1">class</span> CustomMiddleware <span class="txt-1">implements</span> IMiddleware {

            <span class="txt-7">public function</span> <span class="txt-1">handle</span>(Request $request): void 
            {
            
                // Authenticate user, will be available using request()->user
                $request->user = <span class="txt-1">User</span>::<span class="txt-1">authenticate</span>();

                // If authentication failed, redirect request to user-login page.
                <span class="txt-1">if</span>($request->user === <span class="txt-7">null</span>) {
                    $request-><span class="txt-1">setRewriteUrl</span>(<span class="txt-1">url</span>('user.login'));
                }

            }
        }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>