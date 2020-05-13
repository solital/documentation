<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Reescrita de URL</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p class="h2">Alterando rota atual</p>
        <p>Às vezes, pode ser útil manipular a rota a ser carregada. O simple-php-router permite que você manipule e altere
        facilmente as rotas que estão prestes a serem renderizadas. Todas as informações sobre a rota atual são
        armazenadas na propriedade <code>loadedRoute</code> da instância <code>\Solital\Course\Router</code>.</p>

        <p>Para facilitar o acesso, você pode usar o helper <code>request()</code> em vez de chamar a classe
        diretamente <code>\Solital\Course\Course::router()</code>.</p>

        <pre><code>
        <span class="txt-1">request</span>()-><span class="txt-1">setRewriteCallback</span>('<span class="txt-1">Example\MyCustomClass@hello</span>');

        <span class="comment">// -- or you can rewrite by url --</span>

        <span class="txt-1">request</span>()-><span class="txt-1">setRewriteUrl</span>('/my-rewrite-url');
        </code></pre>

        <h2>Bootmanager: carregando rotas dinamicamente</h2>
        <p>Às vezes, pode ser necessário manter os URLs armazenados no banco de dados, arquivo ou similar. Neste exemplo,
        queremos que o url <code>/my-cat-is-beautiful</code> carregue a rota <code>/article/view/1</code> que o roteador conhece, porque
        está definida no arquivo <code>routes.php</code>.</p>

        <p>Para interferir no roteador, criamos uma classe que implementa a interface <code>IRouterBootManager</code>. Essa classe será
        carregada antes de qualquer outra regra no <code>routes.php</code> e nos permitirá "alterar" a rota atual, se algum de nossos
        critérios for atendido (como vindo do url <code>/my-cat-is-beautiful</code>).</p>

        <pre><code>
        <span class="txt-7">use</span> <span class="txt-1">Solital\Http\Request</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\IRouterBootManager</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Course</span>;

        <span class="txt-1">class</span> CustomRouterRules <span class="txt-1">implement</span> IRouterBootManager 
        {

            <span class="comment">/**
            * Called when router is booting and before the routes is loaded.
            *
            * @param \Solital\Course\Course $router
            * @param \Solital\Http\Request $request
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">boot</span>(<span class="txt-1">\Solital\Course\Course</span> $router, <span class="txt-1">\Solital\Http\Request</span> $request): <span class="txt-1">void</span>
            {

                $rewriteRules = [
                    <span class="txt-3">'/my-cat-is-beatiful' => '/article/view/1'</span>,
                    <span class="txt-3">'/horses-are-great'   => '/article/view/2'</span>
                ];

                <span class="txt-1">foreach</span>($rewriteRules <span class="txt-1">as</span> $url => $rule) {

                    <span class="comment">// If the current url matches the rewrite url, we use our custom route</span>

                    <span class="txt-1">if</span>($request-><span class="txt-1">getUrl</span>()-><span class="txt-1">getPath</span>() === $url) {
                        $request-><span class="txt-1">setRewriteUrl</span>($rule);
                    }
                }

            }

        }
        </code></pre>

        <p>O exemplo acima deve ser bastante auto-explicativo e pode ser facilmente alterado para passar pelo armazenamento
        de URLs no banco de dados, arquivo ou cache.</p>

        <p>O que acontece é que, se a rota atual corresponder à rota definida no índice da nossa matriz <code>$rewriteRules</code>,
        definiremos a rota para o valor do array.</p>

        <p>Ao fazer isso, a rota agora carregará o url <code>/article/view/1</code> em vez de <code>/my-cat-is-beautiful</code>.</p>

        <p>A última coisa que precisamos fazer é adicionar nosso gerenciador de inicialização personalizado ao arquivo
        <code>routes.php</code>. Você pode criar quantos gerenciadores de inicialização quiser e adicioná-los facilmente ao seu
        arquivo <code>routes.php</code>.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">addBootManager</span>(<span class="txt-7">new</span> <span class="txt-1">CustomRouterRules</span>());
        </code></pre>

        <h2>Adicionando rotas manualmente</h2>
        A classe <code>Course</code> mencionada no exemplo anterior é apenas uma classe auxiliar simples que sabe como se
        comunicar com a classe <code>Router</code>. Se você está pronto para um desafio, deseja o controle total ou simplesmente
        deseja criar sua própria classe auxiliar <code>Router</code>, este exemplo é para você.

        <pre><code>
        <span class="txt-7">use</span> <span class="txt-1">\Solital\Course\Course</span>;
        <span class="txt-7">use</span> <span class="txt-1">\Solital\Course\Route\RouteUrl</span>;

        <span class="comment">/* Create new course instance */</span>
        $course = <span class="txt-7">new</span> <span class="txt-1">Course</span>();

        $route = <span class="txt-7">new</span> <span class="txt-1">RouteUrl</span>('/answer/1', <span class="txt-1">function</span>() {

            <span class="txt-1">die</span>('this callback will match /answer/1');

        });

        $route-><span class="txt-1">addMiddleware</span>(<span class="txt-1">\Demo\Middlewares\AuthMiddleware::class</span>);
        $route-><span class="txt-1">setNamespace</span>(<span class="txt-1">'\Demo\Controllers'</span>);
        $route-><span class="txt-1">setPrefix</span>('v1');

        <span class="comment">/* Add the route to the router */</span>
        $course-><span class="txt-1">addRoute</span>($route);
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>