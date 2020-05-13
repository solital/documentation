<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Consumer API</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Consumer API é uma lib básica que auxilia na hora de consumir API REST. Para trabalhar com o Consumer API,
            certifique-se de que seu ambiente de trabalho ou hospedagem esteja com o CURL habilitado.</p>

        <h2>Iniciando</h2>
        <p>Para começar a utilizar o Consume API, instancie a classe passando no construtor a url do site que você quer
            consumir.</p>

        <pre><code>
            <span class="txt-7">use</span> Component\Consumer\Consumer;

            $consumer = <span class="txt-7">new</span> <span class="txt-1">Consumer</span>(<span class="txt-3">https://your_endpoint</span>);
        </code></pre>

        <h2>Requisições</h2>
        <p>Abaixo está a lista de métodos do Consumer API.</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Método</th>
                    <th>Código</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>GET</td>
                    <td><code>$consumer->get(<span class="txt-7">string</span> $token, <span class="txt-7">bool</span> $decode, <span class="txt-7">string</span> $accept, <span class="txt-7">string</span> $contentType)</code></td>
                </tr>

                <tr>
                    <td>POST</td>
                    <td><code>$consumer->post(<span class="txt-7">array</span> $data, <span class="txt-7">string</span> $token, <span class="txt-7">string</span> $accept, <span class="txt-7">string</span> $contentType)</code></td>
                </tr>

                <tr>
                    <td>PUT</td>
                    <td><code>$consumer->put(<span class="txt-7">array</span> $data, <span class="txt-7">string</span> $token, <span class="txt-7">string</span> $accept, <span class="txt-7">string</span> $contentType)</code></td>
                </tr>

                <tr>
                    <td>DELETE</td>
                    <td><code>$consumer->delete(<span class="txt-7">string</span> $token, <span class="txt-7">string</span> $accept, <span class="txt-7">string</span> $contentType)</code></td>
                </tr>
            </tbody>
        </table>

        <ul class="ml-5">
            <li><code>$token</code>: (opcional) por padrão é <code>false</code>.</li>
            <li><code>$decode</code>: (opcional) por padrão é <code>false</code>. Este parâmetro retorna um array caso seja <code>true</code>.</li>
            <li><code>$accept</code>: por padrão é <code>application/json</code>.</li>
            <li><code>$contentType</code>: por padrão é <code>application/json</code>.</li>
            <li><code>$data</code>: envia dados para o endpoint.</li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>