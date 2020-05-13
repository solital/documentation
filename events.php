<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Eventos</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Esta seção o ajudará a entender como registrar seus próprios callbacks em eventos no roteador. Ele
            também abordará os conceitos básicos de manipuladores de eventos; como usar os manipuladores fornecidos com
            o
            roteador e como criar seus próprios manipuladores de eventos personalizados.</p>

        <h2>Eventos disponíveis</h2>
        <p>Esta seção contém todos os eventos disponíveis que podem ser registrados usando o <code>EventHandler</code>.
        </p>

        <p>Todos os retornos de chamada de evento recuperam um objeto <code>EventArgument</code> como parâmetro. Este
            objeto contém
            acesso fácil à instância de nome do evento, roteador e solicitação e a quaisquer argumentos especiais do
            evento
            relacionados ao evento especificado. Você pode ver quais argumentos de eventos especiais cada evento retorna
            na
            lista abaixo.</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Argumentos especiais</th>
                    <th>Descrição</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>EVENT_ALL</td>
                    <td>-</td>
                    <td>Dispara quando um evento é disparado.</td>
                </tr>
                <tr>
                    <td>EVENT_INIT</td>
                    <td>-</td>
                    <td>Dispara quando o roteador está inicializando e antes do carregamento das rotas.</td>
                </tr>

                <tr>
                    <td>EVENT_LOAD</td>
                    <td>loadedRoutes</td>
                    <td>Dispara quando todas as rotas são carregadas e renderizadas, imediatamente antes do retorno da
                        saída.</td>
                </tr>

                <tr>
                    <td>EVENT_ADD_ROUTE</td>
                    <td>route</td>
                    <td>Dispara quando a rota é adicionada ao roteador.</td>
                </tr>
                <tr>
                    <td>EVENT_REWRITE</td>
                    <td>rewriteUrl<br>rewriteRoute</td>
                    <td>Dispara quando uma reescrita de URL é e imediatamente antes das rotas serem reinicializadas.
                    </td>
                </tr>
                <tr>
                    <td>EVENT_BOOT</td>
                    <td>-</td>
                    <td>Dispara quando um evento é disparado.</td>
                </tr>
                <tr>
                    <td>EVENT_ALL</td>
                    <td>bootmanagers</td>
                    <td>Dispara quando o roteador está inicializando. Isso acontece pouco antes da renderização dos
                        gerenciadores de inicialização e antes do carregamento de qualquer rota.</td>
                </tr>
                <tr>
                    <td>EVENT_RENDER_BOOTMANAGER</td>
                    <td>bootmanagers<br>bootmanager</td>
                    <td>Dispara antes que um gerenciador de inicialização seja renderizado.</td>
                </tr>
                <tr>
                    <td>EVENT_LOAD_ROUTES</td>
                    <td>routes</td>
                    <td>Dispara quando o roteador está prestes a carregar todas as rotas.</td>
                </tr>
                <tr>
                    <td>EVENT_FIND_ROUTE</td>
                    <td>name</td>
                    <td>Dispara sempre que o método <code>findRoute</code> é chamado no <code>Router</code>. Isso
                        geralmente acontece quando o roteador tenta encontrar rotas que contenham um determinado URL,
                        geralmente após o evento <code>EventHandler::EVENT_GET_URL</code>.</td>
                </tr>
                <tr>
                    <td>EVENT_GET_URL</td>
                    <td>name<br>parameters<br>getParams</td>
                    <td>Dispara sempre que o método <code>Router::getUrl</code> ou a função de ajuda de url é chamado e
                        o roteador tenta encontrar a rota.</td>
                </tr>
                <tr>
                    <td>EVENT_MATCH_ROUTE</td>
                    <td>route</td>
                    <td>Dispara quando uma rota é correspondida e válida (tipo de solicitação correto, etc.). e antes da
                        rota ser renderizada.</td>
                </tr>
                <tr>
                    <td>EVENT_RENDER_ROUTE</td>
                    <td>route</td>
                    <td>Dispara antes de uma rota ser renderizada.</td>
                </tr>
                <tr>
                    <td>EVENT_LOAD_EXCEPTIONS</td>
                    <td>exception<br>exceptionHandlers</td>
                    <td>Dispara quando o roteador está carregando manipuladores de exceção.</td>
                </tr>
                <tr>
                    <td>EVENT_RENDER_EXCEPTION</td>
                    <td>exception<br>exceptionHandler<br>exceptionHandlers</td>
                    <td>Dispara antes que o roteador esteja processando um manipulador de exceções.</td>
                </tr>
                <tr>
                    <td>EVENT_RENDER_MIDDLEWARES</td>
                    <td>route<br>middlewares</td>
                    <td>Dispara antes que os middlewares para uma rota sejam renderizados.</td>
                </tr>
                <tr>
                    <td>EVENT_RENDER_CSRF</td>
                    <td>csrfVerifier</td>
                    <td>Dispara antes que o verificador CSRF seja renderizado.</td>
                </tr>
            </tbody>
        </table>

        <h2>Registrando novo evento</h2>
        <p>Para registrar um novo evento, você precisa criar uma nova instância do objeto <code>EventHandler</code>. Nesse objeto, você
        pode adicionar quantos retornos de chamada desejar, chamando o método <code>registerEvent</code>.</p>

        <p>Quando você registrar eventos, adicione-o ao roteador chamando <code>Course:: addEventHandler()</code>. Recomendamos
        que você adicione seus manipuladores de eventos no seu <code>routes.php</code>.</p>

        Exemplo:

        <pre><code>
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Handlers\EventHandler</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Event\EventArgument</span>;

        <span class="comment">// --- your routes goes here ---</span>

        $eventHandler = <span class="txt-7">new</span> <span class="txt-1">EventHandler</span>();

        <span class="comment">// Add event that fires when a route is rendered</span>
        $eventHandler-><span class="txt-1">register</span>(<span class="txt-1">EventHandler</span>::<span class="txt-7">EVENT_RENDER_ROUTE</span>, <span class="txt-1">function</span>(<span class="txt-1">EventArgument</span> $argument) {
        
        <span class="comment">// Get the route by using the special argument for this event.</span>
        $route = $argument->route;
        
        <span class="comment">// DO STUFF...</span>
            
        });

        <span class="txt-6">Course</span>::<span class="txt-1">addEventHandler</span>($eventHandler);
        </code></pre>

        <h2>EventHandlers personalizados</h2>
        <p>EventHandler é a classe que gerencia eventos e deve herdar da interface <code>IEventHandler</code>. O manipulador sabe como
        manipular eventos para o tipo de manipulador fornecido.</p>

        <p>Na maioria das vezes, a classe básica <code>\Solital\Course\Handler\EventHandler</code> será mais que suficiente
        para a maioria das pessoas, pois você simplesmente registra um evento que é acionado quando acionado.</p>

        <p>Vamos ver como criar sua própria classe de manipulador de eventos.</p>

        <p>Abaixo está um exemplo básico de um manipulador de eventos personalizado chamado <code>DatabaseDebugHandler</code>. A idéia
        da amostra abaixo é registrar todos os eventos no banco de dados quando acionados. Espero que seja o suficiente
        para lhe dar uma idéia de como os manipuladores de eventos funcionam.</p>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo\Handlers</span>;

        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Event\EventArgument</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Router</span>;

        <span class="txt-1">class</span> DatabaseDebugHandler <span class="txt-1">implements</span> IEventHandler
        {

            <span class="comment">/**
            * Debug callback
            * @var \Closure
            */</span>
            <span class="txt-7">protected</span> $callback;

            <span class="txt-7">public function</span> <span class="txt-1">__construct</span>()
            {
                $this->callback = <span class="txt-1">function</span> (<span class="txt-1">EventArgument</span> $argument) {
                    <span class="comment">// todo: store log in database</span>
                };
            }

            <span class="comment">/**
            * Get events.
            *
            * @param string|null $name Filter events by name.
            * @return array
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">getEvents</span>(?string $name): array
            {
                <span class="txt-7">return</span> [
                    $name => [
                        <span class="txt-6">$this</span>-><span class="txt-1">callback</span>,
                    ],
                ];
            }

            <span class="comment">/**
            * Fires any events registered with given event-name
            *
            * @param Router $router Router instance
            * @param string $name Event name
            * @param array ...$eventArgs Event arguments
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">fireEvents</span>(<span class="txt-1">Router</span> $router, <span class="txt-1">string</span> $name, ...$eventArgs): <span class="txt-1">void</span>
            {
                $callback = <span class="txt-6">$this</span>-><span class="txt-1">callback</span>;
                $callback(<span class="txt-7">new</span> <span class="txt-1">EventArgument</span>($router, $eventArgs));
            }

            <span class="comment">/**
            * Set debug callback
            *
            * @param \Closure $event
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">setCallback</span>(<span class="txt-1">\Closure</span> $event): <span class="txt-1">void</span>
            {
                <span class="txt-6">$this</span>-><span class="txt-1">callback</span> = $event;
            }

        }
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>