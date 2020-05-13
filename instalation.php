<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Instalação</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>Configurando o Nginx</h2>
        Se você estiver usando o Nginx, verifique se a reescrita de URL está ativada.

        Você pode ativar facilmente a reescrita de URL adicionando a seguinte configuração ao arquivo de configuração
        Nginx para o projeto de demonstração.

        <pre><code>
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        </code></pre>

        <h2>Configurando o Apache</h2>
        Nada de especial é necessário para o Apache funcionar. Incluímos o arquivo <code>.htaccess</code> na pasta pública. Se a
        reescrita não estiver funcionando para você, verifique se o módulo mod_rewrite (suporte htaccess) está ativado
        na configuração do Apache.

        <h3>Exemplo de .htaccess</h3>
        Abaixo está um exemplo de um arquivo <code>.htaccess</code> usado pelo Solital.

        Simplesmente crie um novo arquivo <code>.htaccess</code> no diretório público do seu projeto e cole o conteúdo
        abaixo no seu
        arquivo recém-criado. Isso redirecionará todas as solicitações para o seu arquivo <code>index.php</code>
        (consulte a seção
        Configuração abaixo).

        <pre><code>
            RewriteEngine on
            RewriteCond% {SCRIPT_FILENAME}! -F
            RewriteCond% {SCRIPT_FILENAME}! -D
            RewriteCond% {SCRIPT_FILENAME}! -L
            RewriteRule ^ (. *) $ Index.php / $ 1
        </code></pre>

        <h2>Configurando o IIS</h2>
        No IIS, você deve adicionar algumas linhas ao seu arquivo <code>web.config</code> na pasta pública ou criar uma
        nova. Se a reescrita não estiver funcionando para você, verifique se a sua versão do IIS incluiu o módulo de
        reescrita de url ou faça o download e instale-os no site da Microsoft.

        <h3>Exemplo web.config</h3>
        Abaixo está um exemplo de um arquivo <code>web.config</code> usado pelo simple-php-router.

        Simplesmente crie um novo arquivo <code>web.config</code> no diretório público do seu projeto e cole o conteúdo
        abaixo no seu arquivo recém-criado. Isso redirecionará todas as solicitações para o seu arquivo
        <code>index.php</code> (consulte a seção Configuração abaixo). Se o arquivo <code>web.config</code> já existir,
        adicione a seção <code>&lt;rewrite></code> dentro da ramificação <code>&lt;system.webServer></code>.

        <pre><code>
        <?php
        echo htmlentities('
        <?xml version="1.0" encoding="UTF-8"?>
        <configuration>
            <system.webServer>
            <rewrite>
            <rules>
                <!-- Remove slash '.$aspas_simples.'/'.$aspas_simples.' from the en of the url -->
                <rule name="RewriteRequestsToPublic">
                <match url="^(.*)$" />
                <conditions logicalGrouping="MatchAll" trackAllCaptures="false">
                </conditions>
                <action type="Rewrite" url="/{R:0}" />
                </rule>

                <!-- When requested file or folder don'.$aspas_simples.'t exists, will request again through index.php -->
                <rule name="Imported Rule 1" stopProcessing="true">
                <match url="^(.*)$" ignoreCase="true" />
                <conditions logicalGrouping="MatchAll">
                    <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
                    <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
                </conditions>
                <action type="Rewrite" url="/index.php/{R:1}" appendQueryString="true" />
                </rule>
            </rules>
            </rewrite>
            </system.webServer>
        </configuration>');?>
        </code></pre>

        <h2>Solução de problemas</h2>
        <p>Se você não tiver um arquivo <code>favicon.ico</code> em seu projeto, poderá obter uma <code>NotFoundHttpException</code> (404 - não encontrada).</p>

        Para adicionar <code>favicon.ico</code> à lista de ignorados do IIS, adicione a seguinte linha ao grupo &lt;conditions>:

        <pre><code>
            &lt;add input="{REQUEST_FILENAME}" negate="true" padrão="favicon.ico" ignoreCase="true" />
        </code></pre>

            <p>Você também pode fazer uma exceção para arquivos com algumas extensões:</p>

            <pre><code>
            &lt;add input="{REQUEST_FILENAME}" pattern="\. ico | \ .png | \ .css | \ .jpg" negate="true"
                ignoreCase="true" />
            </code></pre>

            <p>Se você estiver usando <code>$_SERVER ['ORIG_PATH_INFO']</code>, receberá <code>\index.php\</code> como parte do valor retornado.</p>

            <h4>Exemplo:</h4>

            <pre><code>
                /index.php/test/mypage.php
            </code></pre>

            <h3>Configuração</h3>
            <p>Crie um novo arquivo, nomeie-o como <code>routes.php</code> e coloque-o na sua pasta da biblioteca. Este será o arquivo
            em que você define todas as rotas para o seu projeto.</p>

            <p><strong>AVISO: NUNCA COLOQUE SEU ROUTES.PHP NA SUA PASTA PÚBLICA!</strong></p>

            <p>No seu <code>index.php</code>, exija as <code>rotas.php</code> recém-criadas e chame o método <code>Course::start()</code>. Isso acionará
            e fará o roteamento real das solicitações.</p>

            <p>Não é necessário, mas você pode definir <code>Course::setDefaultNamespace('\Demo\Controllers')</code>
            prefixar todas as rotas com o namespace para seus controladores. Isso simplificará um pouco as coisas, pois
            você não precisará especificar o espaço para nome dos seus controladores em cada rota.</p>

            <p>Este é um exemplo de um arquivo <code>index.php</code> básico:</p>

            <h2>Funções auxiliares (Helpers)</h2>
            <p>Recomendamos que você adicione essas funções auxiliares ao seu projeto. Isso permitirá que você acesse a funcionalidade do roteador mais facilmente.</p>

            <p>Abaixo uma lista das funções listadas no arquivo <code>helpers.php</code>.</p>

            <ul class="ml-5">
                <li><code>url()</code></li>
                <li><code>response()</code></li>
                <li><code>request()</code></li>
                <li><code>input()</code></li>
                <li><code>redirect()</code></li>
                <li><code>csrf_token()</code></li>
            </ul>
    </div>
</div>

<?php include('footer.php'); ?>