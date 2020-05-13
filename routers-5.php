<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Grupos parciais</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Grupos de roteadores parciais têm os mesmos benefícios que um grupo normal, mas oferecem suporte a parâmetros e
        são renderizados somente quando o URL corresponde.</p>

        <p>Isso pode ser extremamente útil em situações em que você deseja adicionar rotas especiais apenas quando um
        determinado critério ou lógica for atendido.</p>

        <p><strong>Nota:</strong> use grupos parciais com cuidado, pois as rotas adicionadas somente serão renderizadas e estarão
        disponíveis quando o URL do grupo parcial corresponder. Isso pode fazer com que url () não encontre URLs para as
        rotas adicionadas.</p>

        <h3>Exemplo:</h3>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">partialGroup</span>('/admin/{applicationId}', <span class="txt-1">function</span> ($applicationId) {

            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/', <span class="txt-1">function</span>($applicationId) {

                <span class="comment">// Matches The "/admin/applicationId" URL</span>

            });

        });
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>