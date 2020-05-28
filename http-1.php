<?php

htmlentities("

<h1>url</h1>
isSecure() : ;
setParams() : ;
getParams() : ;

");

?>

<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Cliente HTTP</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O Solital possui classes para se comunicar com API e requisições HTTP. Utilize os métodos auxiliares <code>request()</code>, <code>response()</code> e <code>url()</code> para realizar esta comunicação. Abaixo um exemplo de como realizar esse procedimento.</p>

        <pre><code>
            $res = <span class="txt-1">request()->getMethod()</span>;

            <span class="comment">/** Exibe GET, POST, PUT ou DELETE */</span>
            <span class="txt-1">echo</span> $res;
        </code></pre>

        <h2>Requisições</h2>
        <p>Para requisições, utilize o método auxiliar <code>request()</code> encadeando um dos métodos abaixo.</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Função</th>
                    <th>Descrição</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>isSecure()</code></td>
                    <td>Verifica se existe o método HTTPS, retorna false se não existir</td>
                </tr>
                <tr>
                    <td><code>getHost()</code></td>
                    <td>Retorna o host http</td>
                </tr>
                <tr>
                    <td><code>getMethod()</code></td>
                    <td>Retorna o método da requisição</td>
                </tr>
                <tr>
                    <td><code>getHeaders()</code></td>
                    <td>Lista todos os headers do servidor</td>
                </tr>
                <tr>
                    <td><code>getIp()</code></td>
                    <td>Retorna o ip do servidor</td>
                </tr>
                <tr>
                    <td><code>getUserAgent()</code></td>
                    <td>Retorna o user agent do servidor</td>
                </tr>
            </tbody>
        </table>

        <h2>Resposta</h2>
        <p>Para respostas, utilize o método auxiliar <code>response()</code> encadeando um dos métodos abaixo.</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Função</th>
                    <th>Descrição</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>auth()</code></td>
                    <td>Autenticação basic</td>
                </tr>
            </tbody>
        </table>

        <h2>Url</h2>
        <p>Para informações referentes a url, utilize o método auxiliar <code>url()</code> encadeando um dos métodos abaixo.</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Função</th>
                    <th>Descrição</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>isSecure()</code></td>
                    <td>Verifica se existe o método HTTPS, retorna false se não existir</td>
                </tr>
                <tr>
                    <td><code>setParams()</code></td>
                    <td>Envia parâmetros para a requisição</td>
                </tr>
                <tr>
                    <td><code>getParams()</code></td>
                    <td>Recupera os valores passados no <code>setParams()</code></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

<?php include('footer.php'); ?>
