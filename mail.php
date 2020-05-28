<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Mail é uma classe do Solital que utiliza o <code>mail</code> nativo do PHP para enviar e-mail.</p>

        <h2>Utilização</h2>
        <p>A sitaxe abaixo é utilizada para poder realizar o envio básico do e-mail.</p>

        <pre><code>
        <span class="txt-7">use</span> Solital\Mail\Mail;

        <span class="txt-6">Mail</span>::<span class="txt-1">send</span>(<span class="txt-3">"your_sender@email.com", "your_recipient@email.com", "your_subject", "your_message"</span>);
        </code></pre>

        <h2>Parâmetros opcionais</h2>
        <p>Para adicionar um reply, tipo de texto, charset e prioridade, utilize os parâmetros opcionais.</p>

        <pre><code>
        <span class="txt-7">use</span> Solital\Mail\Mail;

        <span class="txt-6">Mail</span>::<span class="txt-1">send</span>(<span class="txt-3">"your_sender@email.com", "your_recipient@email.com", "your_subject", "your_message", 
                ["your_reply@email.com", "type_text", "your_charset"</span>, your_priority]);
        </code></pre>

        <p>Os parâmetros opcionais possuem os seguintes valores por padrão:</p>

        <ul class="ml-5">
            <li><code>Reply to:</code> (<span class="txt-7">string</span>) null</li>
            <li><code>Type:</code> (<span class="txt-7">string</span>) text/plan</li>
            <li><code>Charset:</code> (<span class="txt-7">string</span>) UTF-8</li>
            <li><code>Priority:</code> (<span class="txt-7">int</span>) 3</li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>