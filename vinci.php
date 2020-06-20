<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Vinci</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Vinci é o assistente de desenvolvimento do Solital. Você pode criar Controllers, Models, Views, arquivos CSS e arquivos JS em modo gráfico diretamente do seu navegador.</p>

        <h2>Acessar o Vinci</h2>
        <p>Para acessar o Vinci, abra o seu terminal dentro da pasta do seu projeto e digite <code>php vinci about</code> para consultar informações.</p>

        <h2>Modo de uso</h2>
        <p>Para acessar informações sobre o Solital e seus componentes, abra o seu terminal dentro da pasta do seu projeto e digite <code>php vinci about</code>.</p>
        
        <h2>Comandos de componente</h2>
        <p>Voce pode criar um novo componente utilizando a sintaxe abaixo.</p>
        <pre><code>
            <span class="txt-7">php</span> vinci <span class="txt-3">[component]</span>:<span class="txt-3">[name_file]</span>
        </code></pre>

        <p>Abaixo um exemplo prático.</p>
        <pre><code>
            <span class="txt-7">php</span> vinci <span class="txt-3">controller</span>:<span class="txt-3">user</span>
        </code></pre>

        <p>Veja a lista de comandos para criar um novo componente abaixo. Ou utilize <code>php vinci show</code> no terminal.</p>
        
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Comando</th>
                    <th>Descrição</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>controller</td>
                    <td><code>Cria um novo Controller</code></td>
                </tr>

                <tr>
                    <td>model</td>
                    <td><code>Cria um novo Model</code></td>
                </tr>

                <tr>
                    <td>view</td>
                    <td><code>Cria uma nova View</code></td>
                </tr>

                <tr>
                    <td>css</td>
                    <td><code>Cria um novo arquivo CSS</code></td>
                </tr>

                <tr>
                    <td>js</td>
                    <td><code>Cria um novo arquivo JavaScript</code></td>
                </tr>

                <tr>
                    <td>router</td>
                    <td><code>Cria um novo arquivo para o sistema de rotas</code></td>
                </tr>
            </tbody>
        </table>

        <h3>Remover arquivos criado com o Vinci</h3>
        <p>Adicione o comando <code>remove-</code> antes de utilizar um dos comandos citado anteriormente.</p>
        <pre><code>
            <span class="txt-7">php</span> vinci <span class="txt-3">remove-controller</span>:<span class="txt-3">user</span>
        </code></pre>

        <h2>Limpando o cache no solital</h2>
        <p>Para limpar todo o cache do solital, executeo o comando abaixo.</p>
        <pre><code>
            <span class="txt-7">php</span> vinci <span class="txt-3">cache-clear</span>
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>