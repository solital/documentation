<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Grupos</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Os grupos de rotas permitem compartilhar atributos de rota, como middleware ou namespaces, em um grande número
        de rotas sem a necessidade de definir esses atributos em cada rota individual. Atributos compartilhados são
        especificados em um formato de matriz como o primeiro parâmetro para o método <code>Course::group</code>.</p>

        <h2>Middleware</h2>
        <p>Para atribuir o middleware a todas as rotas dentro de um grupo, você pode usar a chave do middleware na matriz
        de atributos do grupo. O middleware é executado na ordem em que estão listados na matriz:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['middleware' => \Demo\Middleware\Auth::class], <span class="txt-1">function</span> () {
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/', <span class="txt-1">function</span> ()    {
                <span class="comment">// Uses Auth Middleware</span>
            });

            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/profile', <span class="txt-1">function</span> () {
                <span class="comment">// Uses Auth Middleware</span>
            });
        });
        </code></pre>

        <h2>Namespaces</h2>
        <p>Outro caso de uso comum para grupos de rotas é atribuir o mesmo namespace PHP a um grupo de controladores usando
        o parâmetro namespace na matriz de grupos:</p>

        <p><strong>Nota:</strong> Os espaços para nome do grupo serão adicionados apenas às rotas com retornos de chamada relativos. Por exemplo,
        se sua rota tiver um retorno de chamada absoluto como <code>\Demo\Controller\DefaultController@home</code>, o espaço
        para nome da rota não será anexado. Para corrigir isso, você pode tornar o retorno de chamada relativo,
        removendo o <code>\</code> no início do retorno de chamada.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['namespace' => 'Admin'], <span class="txt-1">function</span> () {
            <span class="comment">// Controllers Within The "App\Http\Controllers\Admin" Namespace</span>
        });
        </code></pre>

        <h2>Roteamento de subdomínio</h2>
        <p>Grupos de rotas também podem ser usados ​​para lidar com o roteamento de subdomínio. Os subdomínios podem
        receber parâmetros de rota atribuídos, assim como os URLs da rota, permitindo capturar uma parte do subdomínio
        para uso em sua rota ou controlador. O subdomínio pode ser especificado usando a chave de domínio na matriz de
        atributos do grupo:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['domain' => '{account}.myapp.com'], <span class="txt-1">function</span> () {
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{id}', <span class="txt-1">function</span> ($account, $id) {
                <span class="comment">//</span>
            });
        });
        </code></pre>

        <h2>Prefixos de rota</h2>
        <p>O atributo <code>prefix</code> do grupo pode ser usado para prefixar cada rota no grupo com um determinado URL. Por
        exemplo, convém prefixar todos os URLs de rota dentro do grupo com admin:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['prefix' => '/admin'], <span class="txt-1">function</span> () {
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/users', <span class="txt-1">function</span> ()    {
                <span class="comment">// Matches The "/admin/users" URL</span>
            });
        });
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>