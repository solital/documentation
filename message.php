<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Message</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Message lhe auxilia na hora de exibir mensagens na sua view. A sua sintaxe é básica conforme é mostrado abaixo.</p>

        <p>Para criar uma nova mensagem:</p>
        <pre><code>
            <span class="txt-7">use</span> Solital\Message\Message;

            <span class="txt-6">Message</span>::<span class="txt-1">newMessage</span>(<span class="txt-3">"your_index_message", "your_messsage"</span>);
        </code></pre>
        
        <p>Para recuperar uma mensagem:</p>
        <pre><code>
            <span class="txt-7">use</span> Solital\Message\Message;

            <span class="txt-6">Message</span>::<span class="txt-1">getMessage</span>(<span class="txt-3">"your_index_message"</span>);
        </code></pre>
        
        <p>Para apagar uma mensagem:</p>
        <pre><code>
            <span class="txt-7">use</span> Solital\Message\Message;

            <span class="txt-6">Message</span>::<span class="txt-1">clearMessage</span>(<span class="txt-3">"your_index_message"</span>);
        </code></pre>

        <p>Para recuperar e em seguida apagar uma mensagem:</p>
        <pre><code>
            <span class="txt-7">use</span> Solital\Message\Message;

            <span class="txt-6">Message</span>::<span class="txt-1">getMessage</span>(<span class="txt-3">"your_index_message"</span>);
            <span class="txt-6">Message</span>::<span class="txt-1">clearMessage</span>(<span class="txt-3">"your_index_message"</span>);
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>