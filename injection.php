<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Injeção de dependência</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O Solital suporta injeção de dependência usando a biblioteca <a href="http://php-di.org/">php-di</a>.
        </p>

        <p>A injeção de dependência permite que a estrutura "injete" automaticamente (carga) as classes adicionadas como
            parâmetros. Isso pode simplificar seu código, pois você pode evitar a criação de novas instâncias de objetos
            que
            você está usando frequentemente em seus Controladores, etc.</p>

        <p>Aqui está um exemplo básico de uma classe de controlador usando injeção de dependência:</p>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo\Controllers</span>;

        <span class="txt-1">class</span> DefaultController {
            
            <span class="txt-7">public function</span> <span class="txt-1">login</span>(User $user): string 
            {
                <span class="comment">// ...</span>
            }
            
        }
        </code></pre>

        <p>O exemplo acima criará automaticamente uma nova instância <code>User</code> a partir do parâmetro
            <code>$user</code>. Isso
            significa que a classe <code>$user</code> contém uma nova instância da classe <code>User</code> e não
            precisamos criar uma nova instância
            por conta própria.</p>

        <p><strong>AVISO:</strong> a injeção de dependência pode ter algum impacto negativo no desempenho. Se você tiver
            algum problema de
            desempenho, recomendamos desativar essa funcionalidade.</p>

        <h2>Ativando a injeção de dependência</h2>
        <p>A injeção de dependência é desativada por padrão para evitar problemas de desempenho.</p>

        <p>Antes de habilitar a injeção de dependência, recomendamos que você leia a seção de configuração Container da
            documentação do php-di. Esta seção aborda como configurar o php-di em diferentes ambientes e acelerar o
            desempenho.</p>

        <h3>Ativando para o ambiente de desenvolvimento</h3>
        <p>O exemplo abaixo deve ser usado SOMENTE em um ambiente de desenvolvimento.</p>

        <pre><code>
        <span class="comment">// Create our new php-di container</span>
        $container = (<span class="txt-7">new</span> <span class="txt-1">\DI\ContainerBuilder</span>())
                    -><span class="txt-1">useAutowiring</span>(<span class="txt-7">true</span>)
                    -><span class="txt-1">build</span>();

        <span class="comment">// Add our container to Solital and enable dependency injection</span>
        <span class="txt-6">Course</span>::<span class="txt-1">enableDependencyInjection</span>($container);
        </code></pre>

        <p>Verifique a seção Mais leituras da documentação para obter links úteis e tutoriais sobre php-di.</p>

        <h3>Ativando para o ambiente de produção</h3>
        <p>O exemplo abaixo compila as injeções, o que pode ajudar a acelerar o desempenho.</p>

        <p><strong>Nota:</strong> Você deve alterar o <code>$cacheDir</code> para um armazenamento em cache no seu
            projeto.</p>

        <pre><code>
        <span class="comment">// Cache directory</span>
        $cacheDir = <span class="txt-1">sys_get_temp_dir</span>('Solital');

        <span class="comment">// Create our new php-di container</span>
        $container = (<span class="txt-7">new</span> <span class="txt-1">\DI\ContainerBuilder</span>())
                    -><span class="txt-1">enableCompilation</span>($cacheDir)
                    -><span class="txt-1">writeProxiesToFile</span>(<span class="txt-7">true</span>, $cacheDir . '/proxies')
                    -><span class="txt-1">useAutowiring</span>(<span class="txt-7">true</span>)
                    -><span class="txt-1">build</span>();

        <span class="comment">// Add our container to Solital and enable dependency injection</span>
        <span class="txt-6">Course</span>::<span class="txt-1">enableDependencyInjection</span>($container);
        </code></pre>

        <p>Verifique a seção Mais leituras da documentação para obter links úteis e tutoriais sobre php-di.</p>

        <h2>Mais leitura</h2>
        <p>Para obter mais informações sobre injeção de dependência, configurações e ajustes - recomendamos que você
            verifique a documentação do php-di ou alguns dos links úteis que reunimos abaixo.</p>

        <h2>Links Úteis</h2>
        <ul class="ml-5">
            <li><a href="http://php-di.org/doc/">Documentação do php-di</a></li>
            <li><a href="http://php-di.org/doc/understanding-di.html">Entendendo a injeção de dependência</a></li>
            <li><a href="http://php-di.org/doc/best-practices.html">Guia de melhores práticas</a></li>
            <li><a href="http://php-di.org/doc/container-configuration.html">Configurando o Contêiner</a></li>
            <li><a href="http://php-di.org/doc/definition.html">Definições</a></li>
        </ul>

    </div>
</div>

<?php include('footer.php'); ?>