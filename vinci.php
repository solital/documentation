<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Vinci</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Vinci é o assistente de desenvolvimento do Solital. Você pode criar Controllers, Models, Views, arquivos CSS e arquivos JS em modo gráfico diretamente do seu navegador.</p>

        <strong>AVISO: NÃO APAGUE A PASTA <code>VINCI</code>. VINCI É O ASSISTENTE DE DESENVOLVIEMNTO DO SOLITAL E APAGAR A PASTA PODE ACARRETAR EM ERROS NO PROJETO</strong>

        <h2>Acessar o Vinci</h2>
        <p>Para acessar o Vinci, acesse a url <code>/vinci-mode</code></p>

        <p><strong>Nota:</strong> é altamente recomendado que você desative o Vinci em um ambiente que não seja localhost ou quando o projeto tiver concluido. Para desativar o Vinci, acesse o arquivo <code>config.php</code> dentro da pasta <code>config</code> e altere a constante <code>VINCI_MODE</code> para <code>false</code>.</p>

        <h2>Modo de uso</h2>
        <p>Não existe muito segredo, apenas informe o nome do arquivo que você deseja criar e o Vinci irá gerar automaticamente o arquivo.</p>
        
        <h2>Local dos arquivos</h2>
        <p>Abaixo uma lista de onde os arquivos irão parar quando você cria-los através do Vinci</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipo de arquivo</th>
                    <th>Diretório</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Controller</td>
                    <td><code>app/Solital/Controller</code></td>
                </tr>

                <tr>
                    <td>Model</td>
                    <td><code>app/Solital/Model</code></td>
                </tr>

                <tr>
                    <td>View</td>
                    <td><code>resources/view</code></td>
                </tr>

                <tr>
                    <td>CSS</td>
                    <td><code>public/assets/_css</code></td>
                </tr>

                <tr>
                    <td>Javascript</td>
                    <td><code>public/assets/_js</code></td>
                </tr>
            </tbody>
        </table>

        <h2>Aviso de "Component not created"</h2>
        <p>É normal receber esse aviso antes de criar um componente, mas caso contuinue recebendo esse aviso, verifique as permissões de pasta do seu sistema operacional.</p>
    </div>
</div>

<?php include('footer.php'); ?>