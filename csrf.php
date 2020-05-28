<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Proteção CSRF</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Quaisquer formulários postados nas rotas <code>POST</code>, <code>PUT</code> ou <code>DELETE</code> devem incluir o token CSRF. É altamente
        recomendável que você ative a verificação de CSRF no seu site para maximizar a segurança.</p>

        <p>Você pode usar o <code>BaseCsrfVerifier</code> para ativar a validação de CSRF em todas as solicitações. Se você precisar
        desativar a verificação de URLs específicos, consulte a seção "Verificador personalizado de CSRF" abaixo.</p>

        <p>Por padrão, o Solital usará a classe <code>CookieTokenProvider</code>. Esse provedor armazenará o token de
        segurança em um cookie na máquina do cliente. Se você deseja armazenar o token em outro lugar, consulte a seção
        "Criando um provedor de token personalizado" abaixo.</p>

        <h2>Adicionando verificador CSRF</h2>
        <p>Quando você criou o seu verificador de CSRF, precisa informar ao simple-php-router que ele deve ser usado. Você
        pode fazer isso adicionando a seguinte linha no seu arquivo routes.php:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">csrfVerifier</span>(<span class="txt-7">new</span> <span class="txt-1">\Demo\Middlewares\CsrfVerifier</span>());
        </code></pre>

        <h2>Obtendo o token CSRF</h2>
        <p>Ao postar em qualquer um dos URLs com a verificação de CSRF ativada, você precisa postar seu token de CSRF, caso
        contrário a solicitação será rejeitada.</p>

        <p>Você pode obter o token CSRF chamando o método auxiliar:</p>

        <pre><code>
        <span class="txt-1">csrf_token</span>();
        </code></pre>

        <p>Você também pode obter o token diretamente:</p>

        <pre><code>
        <span class="txt-7">return</span> <span class="txt-6">Course</span>::<span class="txt-1">router</span>()-><span class="txt-1">getCsrfVerifier</span>()-><span class="txt-1">getTokenProvider</span>()-><span class="txt-1">getToken</span>();
        </code></pre>

        <p>O nome/chave padrão para o campo de entrada é <code>csrf_token</code> e é definido na constante <code>POST_KEY</code> na classe
        BaseCsrfVerifier. Você pode alterar a chave substituindo a constante em sua própria classe de verificador de
        CSRF.</p>

        <h3>Exemplo:</h3>

        <p>O exemplo abaixo será publicado no URL atual com um campo oculto "csrf_token".</p>

        <pre><code>
        <span class="txt-1">&lt;form method="<span class="txt-3">post</span>" action="<span class="txt-5">&lt;?= <span class="txt-7">url()</span>; ?></span>"></span>
            <span class="txt-1">&lt;input type="<span class="txt-3">hidden</span>" name="<span class="txt-3">csrf_token</span>" value="<span class="txt-5">&lt;?= <span class="txt-7">csrf_token()</span>; ?></span>"></span>
            <span class="comment">&lt;! - outros elementos de entrada aqui -></span>
        <span class="txt-1">&lt;/form></span>
        </code></pre>

        <h2>Verificador CSRF personalizado</h2>
        <p>Crie uma nova classe e estenda a classe de middleware <code>BaseCsrfVerifier</code> fornecida por padrão com a biblioteca
        simple-php-router.</p>

        <p>Adicione a propriedade <code>except</code> com um array de URLs, às rotas que você deseja excluir/lista de permissões da
        validação do CSRF. Usar <code>*</code> no final do URL corresponderá ao URL inteiro.</p>

        <p>Aqui está um exemplo básico de uma classe de verificador de CSRF:</p>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo\Middlewares</span>;

        <span class="txt-7">use</span> <span class="txt-1">Solital\Http\Middleware\BaseCsrfVerifier</span>;

        <span class="txt-1">class</span> CsrfVerifier <span class="txt-1">extends</span> BaseCsrfVerifier
        {
            <span class="comment">/**
            * CSRF validation will be ignored on the following urls.
            */</span>
            <span class="txt-7">protected</span> $except = ['/api/*'];
        }
        </code></pre>

        <h2>Provedor de token personalizado</h2>
        <p>Por padrão, o <code>BaseCsrfVerifier</code> usará o <code>CookieTokenProvider</code> para armazenar o token em um cookie na máquina do
        cliente.</p>

        <p>Se você precisar armazenar o token em outro lugar, poderá fazer isso criando sua própria classe e implementando
        a classe ITokenProvider.</p>

        <pre><code>
        <span class="txt-1">class</span> SessionTokenProvider <span class="txt-1">implements</span> ITokenProvider
        {

            <span class="comment">/**
            * Refresh existing token
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">refresh</span>(): <span class="txt-1">void</span>
            {
                <span class="comment">// Implement your own functionality here...</span>
            }

            <span class="comment">/**
            * Validate valid CSRF token
            *
            * @param string $token
            * @return bool
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">validate</span>($token): <span class="txt-1">bool</span>
            {
                <span class="comment">// Implement your own functionality here...</span>
            }
            
            <span class="comment">/**
            * Get token token
            *
            * @param string|null $defaultValue
            * @return string|null
            */</span>
            <span class="txt-7">public function</span> <span class="txt-1">getToken</span>(?string $defaultValue = <span class="txt-7">null</span>): <span class="txt-1">?string</span> 
            {
                <span class="comment">// Implement your own functionality here...</span>
            }

        }
        </code></pre>

        <p>Em seguida, você precisa definir sua implementação personalizada do <code>ITokenProvider</code> na classe <code>BaseCsrfVerifier</code> no
        arquivo de rotas:</p>

        <pre><code>
        $verifier = <span class="txt-7">new</span> <span class="txt-1">\dscuz\Middleware\CsrfVerifier</span>();
        $verifier-><span class="txt-1">setTokenProvider</span>(<span class="txt-7">new</span> <span class="txt-1">SessionTokenProvider</span>());

        <span class="txt-6">Course</span>::<span class="txt-1">csrfVerifier</span>($verifier);
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>