<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Verificar login</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O método <code>verifyLogin()</code> verifica se existe o usuário informado na tabela. O primerio campo irá verificar a tabela na qual o usuário e a senha estão, o segundo campo será informado o usuário ou e-mail que está na tabela e o terceiro campo será a senha. Se o usuário ou a senha estiverem incorretos, o método retornará <code>false</code>. Caso contrário irá retornar <code>true</code>.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">verifyLogin(<span class="txt-3">'your_table', 'your_email@gmail.com', 'your_password'</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>Para poder validar o sistema de login, utilize o <span class="txt-1">Guardian</span> (consulte "Segurança->Guardian") para salvar, verificar, validar e fazer logoff.</p>
    </div>
</div>

<?php include('footer.php'); ?>