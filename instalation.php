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
        RewriteCond %{SCRIPT_FILENAME} !-f
        RewriteCond %{SCRIPT_FILENAME} !-d
        RewriteCond %{SCRIPT_FILENAME} !-l
        RewriteRule ^(.*)$ index.php/$1
        </code></pre>

        <h2>Configurando o IIS</h2>
        No IIS, você deve adicionar algumas linhas ao seu arquivo <code>web.config</code> na pasta pública ou criar uma
        nova. Se a reescrita não estiver funcionando para você, verifique se a sua versão do IIS incluiu o módulo de
        reescrita de url ou faça o download e instale-os no site da Microsoft.

        <h3>Exemplo de web.config</h3>
        Abaixo está um exemplo de um arquivo <code>web.config</code> usado pelo simple-php-router.

        Simplesmente crie um novo arquivo <code>web.config</code> no diretório público do seu projeto e cole o conteúdo
        abaixo no seu arquivo recém-criado. Isso redirecionará todas as solicitações para o seu arquivo
        <code>index.php</code> (consulte a seção Configuração abaixo). Se o arquivo <code>web.config</code> já existir,
        adicione a seção <code>&lt;rewrite></code> dentro da ramificação <code>&lt;system.webServer></code>.

        <pre><code>
        <span class="txt-1">&lt;?xml version="<span class="txt-3">1.0</span>" encoding="<span class="txt-3">UTF-8</span>"?></span>
            <span class="txt-1">&lt;configuration></span>
                <span class="txt-1">&lt;system.webServer></span>
                    <span class="txt-1">&lt;rewrite></span>
                        <span class="txt-1">&lt;rules></span>
                            <span class="comment">&lt;!-- Remove slash '/' from the en of the url --></span>
                            <span class="txt-1">&lt;rule name="<span class="txt-3">RewriteRequestsToPublic</span>"></span>
                                <span class="txt-1">&lt;match url="<span class="txt-3">^(.*)$</span>" /></span>
                                <span class="txt-1">&lt;conditions logicalGrouping="<span class="txt-3">MatchAll</span>" trackAllCaptures="<span class="txt-3">false</span>"></span>
                                <span class="txt-1">&lt;/conditions></span>
                                <span class="txt-1">&lt;action type="<span class="txt-3">Rewrite</span>" url="<span class="txt-3">/{R:0}</span>" /></span>
                            <span class="txt-1">&lt;/rule></span>

                            <span class="comment">&lt;!-- When requested file or folder don't exists, will request again through index.php --></span>
                            <span class="txt-1">&lt;rule name="<span class="txt-3">Imported Rule 1</span>" stopProcessing="<span class="txt-3">true</span>"></span>
                                <span class="txt-1">&lt;match url="<span class="txt-3">^(.*)$</span>" ignoreCase="<span class="txt-3">true</span>" /></span>
                                <span class="txt-1">&lt;conditions logicalGrouping="<span class="txt-3">MatchAll</span>"></span>
                                    <span class="txt-1">&lt;add input="<span class="txt-3">{REQUEST_FILENAME}</span>" matchType="<span class="txt-3">IsDirectory</span>" negate="<span class="txt-3">true</span>" /></span>
                                    <span class="txt-1">&lt;add input="<span class="txt-3">{REQUEST_FILENAME}</span>" matchType="<span class="txt-3">IsFile</span>" negate="<span class="txt-3">true</span>" /></span>
                                <span class="txt-1">&lt;/conditions></span>
                                <span class="txt-1">&lt;action type="Rewrite" url="<span class="txt-3">/index.php/{R:1}</span>" appendQueryString="<span class="txt-3">true</span>" /></span>
                            <span class="txt-1">&lt;/rule></span>
                        <span class="txt-1">&lt;/rules></span>
                    <span class="txt-1">&lt;/rewrite></span>
                <span class="txt-1">&lt;/system.webServer></span>
            <span class="txt-1">&lt;/configuration></span>
        </code></pre>

        <h2>Solução de problemas</h2>
        <p>Se você não tiver um arquivo <code>favicon.ico</code> em seu projeto, poderá obter uma <code>NotFoundHttpException</code> (404 - não encontrada).</p>

        Para adicionar <code>favicon.ico</code> à lista de ignorados do IIS, adicione a seguinte linha ao grupo &lt;conditions>:

        <pre><code>
        <span class="txt-1">&lt;add input="<span class="txt-3">{REQUEST_FILENAME}</span>" negate="<span class="txt-3">true</span>" padrão="<span class="txt-3">favicon.ico</span>" ignoreCase="<span class="txt-3">true</span>" /></span>
        </code></pre>

        <p>Você também pode fazer uma exceção para arquivos com algumas extensões:</p>

        <pre><code>
        <span class="txt-1">&lt;add input="<span class="txt-3">{REQUEST_FILENAME}</span>" pattern="<span class="txt-3">\. ico | \ .png | \ .css | \ .jpg</span>" negate="<span class="txt-3">true</span>" ignoreCase="<span class="txt-1">true</span>" /></span>
        </code></pre>

        <p>Se você estiver usando <code>$_SERVER['ORIG_PATH_INFO']</code>, receberá <code>\index.php\</code> como parte do valor retornado.</p>

        <h4>Exemplo:</h4>

        <pre><code>
        /index.php/test/mypage.php
        </code></pre>

        <h2>Helpers - Funções auxiliares</h2>
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