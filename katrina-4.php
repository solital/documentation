<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Procedure</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Para chamar uma procedure do banco de dados, utilize o método <code>call()</code>.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">call(<span class="txt-3">'procedure_name'</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Para utilizar parâmetros, passe os valores em formato de array.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">call(<span class="txt-3">'procedure_name' , ['param_1, param_2, param_3']</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>