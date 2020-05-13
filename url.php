<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">URL's</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Por padrão, todas as rotas de controlador e recurso usarão uma versão simplificada de seu URL como nome.</p>

        <p>Você usa facilmente a função auxiliar de atalho <code>url()</code> para recuperar URLs para suas rotas ou manipular a URL
        atual.</p>

        <p><code>url()</code> retornará um objeto <code>Url</code> que retornará uma string quando renderizada, para que possa ser usada com
        segurança em templates etc., mas contém todos os métodos auxiliares úteis na classe <code>Url</code>, como <code>contains</code>, <code>indexOf</code>
        etc. Verifique os truques úteis de URL abaixo.</p>

        <h2>Obter o URL atual</h2>
        <p>Nunca foi tão fácil obter e / ou manipular o URL atual.</p>

        <p>O exemplo abaixo mostra como obter o URL atual:</p>

        <pre><code>
        <span class="comment"># output: /current-url</span>
        <span class="txt-1"><span class="txt-1">url</span>();
        </code></pre>

        <h2>Obter por nome (rota única)</h2>
        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/product-view/{id}', '<span class="txt-1">ProductsController@show</span>', ['as' => 'product']);

        <span class="comment"># output: /product-view/22/?category=shoes</span>
        <span class="txt-1">url</span>('product', ['id' => 22], ['category' => 'shoes']);

        <span class="comment"># output: /product-view/?category=shoes</span>
        <span class="txt-1">url</span>('product', <span class="txt-7">null</span>, ['category' => 'shoes']);
        </code></pre>

        <h2>Obter por nome (rota do controlador)</h2>
        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">controller</span>('/images', <span class="txt-1">ImagesController::class</span>, ['as' => 'picture']);

        <span class="comment"># output: /images/view/?category=shows</span>
        <span class="txt-1">url</span>('<span class="txt-1">picture@getView</span>', null, ['category' => 'shoes']);

        <span class="comment"># output: /images/view/?category=shows</span>
        <span class="txt-1">url</span>('picture', 'getView', ['category' => 'shoes']);

        <span class="comment"># output: /images/view/</span>
        <span class="txt-1">url</span>('picture', 'view');
        </code></pre>

        <h2>Obter por classe</h2>
        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/product-view/{id}', '<span class="txt-1">ProductsController@show</span>', ['as' => 'product']);
        <span class="txt-6">Course</span>::controller('/images', 'ImagesController');

        <span class="comment"># output: /product-view/22/?category=shoes</span>
        <span class="txt-1">url</span>('<span class="txt-1">ProductsController@show</span>', ['id' => 22], ['category' => 'shoes']);

        <span class="comment"># output: /images/image/?id=22</span>
        <span class="txt-1">url</span>('<span class="txt-1">ImagesController@getImage</span>', <span class="txt-7">null</span>, ['id' => 22]);
        </code></pre>
        
        <h2>Usando nomes personalizados para métodos em uma rota de controlador / recurso</h2>
        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">controller</span>('gadgets', <span class="txt-1">GadgetsController::class</span>, ['names' => ['getIphoneInfo' => 'iphone']]);

        <span class="txt-1">url</span>('gadgets.iphone');

        <span class="comment"># output
        # /gadgets/iphoneinfo/</span>
        </code></pre>
        
        <h2>Obtendo URL's de REST / Controlador de Recursos</h2>
        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">resource</span>('/phones', <span class="txt-1">PhonesController::class</span>);

        <span class="comment"># output: /phones/</span>
        <span class="txt-1">url</span>('phones');

        <span class="comment"># output: /phones/</span>
        <span class="txt-1">url</span>('phones.index');

        <span class="comment"># output: /phones/create/</span>
        <span class="txt-1">url</span>('phones.create');

        <span class="comment"># output: /phones/edit/</span>
        <span class="txt-1">url</span>('phones.edit');
        </code></pre>

        <h2>Manipulando URL</h2>
        <p>Você pode manipular facilmente as strings de consulta adicionando seus argumentos get param.</p>

        <pre><code>
        <span class="comment"># output: /current-url?q=cars</span>
        <span class="txt-1">url</span>(<span class="txt-7">null</span>, <span class="txt-7">null</span>, ['q' => 'cars']);
        </code></pre>

        <p>Você pode remover um parâmetro de cadeia de caracteres de consulta, definindo o valor como nulo.</p>

        <p>O exemplo abaixo removerá qualquer parâmetro de string de consulta chamado q da <span class="txt-1">url</span>, mas manterá todos os outros
        parâmetros de string de consulta:</p>

        <pre><code>
        $url = <span class="txt-1">url</span>()-><span class="txt-1">removeParam</span>('q');
        </code></pre>

        <p>Para mais informações, consulte a seção Truques úteis de URL da documentação.</p>

        <h2>Truques úteis de URL</h2>
        <p>A chamada de URL sempre retornará um objeto de URL. Quando renderizado, ele retornará uma <code>string</code> do URL
        relativo, portanto é seguro usá-lo em modelos etc.</p>

        <p>No entanto, isso nos permite usar os métodos úteis no objeto <code>Url</code>, como <code>indexOf</code>, e <code>contains</code> ou recupera partes
        específicas da URL, como o caminho, parâmetros da string de consulta, host etc. Você também pode manipular a
        URL, como remover ou adicionar parâmetros, alterar host e Mais.</p>

        <p>No exemplo abaixo, verificamos se o URL atual contém a parte <code>/api</code>.</p>

        <pre><code>
        if(<span class="txt-1">url</span>()-><span class="txt-1">contains</span>('/api')) {
                // ... do stuff
            }
        </code></pre>

        <p>Como mencionado anteriormente, você também pode usar o objeto <code>Url</code> para mostrar partes específicas da URL ou
        controlar qual parte da URL você deseja.</p>

        <pre><code>
        <span class="comment"># Grab the query-string parameter id from the current-url.</span>
        $id = <span class="txt-1">url</span>()-><span class="txt-1">getParam</span>('id');

        <span class="comment"># Get the absolute url for the current url.</span>
        $absoluteUrl = <span class="txt-1">url</span>()-><span class="txt-1">getAbsoluteUrl</span>();
        </code></pre>

        <p>Para obter mais métodos disponíveis, verifique a classe <code>Solital\Http\Url</code>.</p>

        <h2>Falsificação de método de formulário</h2>
        <p>Os formulários HTML não suportam ações <code>PUT</code>, <code>PATCH</code> ou <code>DELETE</code>. Portanto, ao definir rotas <code>PUT</code>, <code>PATCH</code> ou <code>DELETE</code>
        chamadas a partir de um formulário HTML, você precisará adicionar um campo <code>_method</code> oculto ao formulário. O valor
        enviado com o campo <code>_method</code> será usado como o método de solicitação HTTP:</p>

        <pre><code>
            &lt;input type="hidden" name="_ method" value="PUT" />
        </code></pre>

        <h2>Acessando a rota atual</h2>
        <p>Você pode acessar informações sobre a rota atual carregada usando o seguinte método:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">request</span>()-><span class="txt-1">getLoadedRoute</span>();
        <span class="txt-1">request</span>()-><span class="txt-1">getLoadedRoute</span>();
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>