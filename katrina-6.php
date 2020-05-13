<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Paginação de resultados</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O método <code>pagination()</code> cria um sistema de paginação de resultados. Para inicializar, o primeiro
            parâmetro deve ser a tabela que você quer utilizar para iniciar a paginação. O segundo parâmetro irá listar
            a quantidade de valores que irá retornar da tabela conforme o exemplo abaixo.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">pagination(<span class="txt-3">'your_table'</span><span class="txt-5">, 3</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>O método acima irá retornar um array contendo os índices <code>rows</code> que retornará os valores, e
            <code>arrows</code> que retornará os comandos para a paginação. Para utilizar no template Wolf, utilize
            dessa maneira.</p>

        <pre><code>
            $html = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">pagination(<span class="txt-3">'your_table'</span><span class="txt-5">, 3</span>)</span>;

            <span class="txt-6">Wolf</span>::<span class="txt-1">loadView</span>(<span class="txt-3">'home'</span>, [
                <span class="txt-3">'rows' =></span> $html['rows'],
                <span class="txt-3">'arrows' =></span> $html['arrows']
            ]);
        </code></pre>

        <p>E na sua view, retorne os resultados dessa maneira.</p>

        <pre><code>
            <span class="txt-1">&lt;table></span>
                <span class="txt-1">&lt;thead></span>
                    <span class="txt-1">&lt;tr></span>
                        <span class="txt-1">&lt;th></span>Name<span class="txt-1">&lt;/th></span>
                        <span class="txt-1">&lt;th></span>Age<span class="txt-1">&lt;/th></span>
                        <span class="txt-1">&lt;th></span>Gender<span class="txt-1">&lt;/th></span>
                    <span class="txt-1">&lt;/tr></span>
                <span class="txt-1">&lt;/thead></span>

                <span class="txt-1">&lt;tbody></span>
                    <span class="txt-6">&lt;?php</span> <span class="txt-7">foreach</span> ($key['rows'] <span class="txt-7">as</span> $k): <span class="txt-6">?></span>
                        <span class="txt-1">&lt;tr></span>
                            <span class="txt-1">&lt;td></span><span class="txt-6">&lt;?=</span> $k['name'] <span class="txt-6">?></span><span class="txt-1">&lt;/td></span>
                            <span class="txt-1">&lt;td></span><span class="txt-6">&lt;?=</span> $k['age'] <span class="txt-6">?></span><span class="txt-1">&lt;/td></span>
                            <span class="txt-1">&lt;td></span><span class="txt-6">&lt;?=</span> $k['gender'] <span class="txt-6">?></span><span class="txt-1">&lt;/td></span>
                        <span class="txt-1">&lt;/tr></span>
                    <span class="txt-6">&lt;?php</span> <span class="txt-7">endforeach</span>; <span class="txt-6">?></span>
                <span class="txt-1">&lt;/tbody></span>
            <span class="txt-1">&lt;/table></span>

            <span class="txt-6">&lt;?php</span>
            <span class="txt-7">echo</span> $key['arrows'];
        </code></pre>

        <p>O resultado será a seguinte:</p>

        <table class="table table-action">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Sam</td>
                    <td>47</td>
                    <td>Male</td>
                </tr>

                <tr>
                    <td>Dean</td>
                    <td>49</td>
                    <td>Male</td>
                </tr>

                <tr>
                    <td>Mary</td>
                    <td>52</td>
                    <td>Female</td>
                </tr>
            </tbody>
        </table>

        <p class="ml-5"><span class="txt-1"><<</span> 1 <span class="txt-1">2 3 >></span></p>

        <p>Para alterar as setas (<code><<</code> e <code>>></code>), utilize os dois últimos parâmetros.</p>

        <pre><code>
            <span class="txt-7">public function</span> <span class="txt-1">get()</span>
            {
                $res = <span class="txt-6">$this</span>-><span class="txt-1">dbInstance()</span>-><span class="txt-1">pagination(<span class="txt-3">'tb_users'</span><span class="txt-5">, 3</span>, <span class="txt-3">'First Item', 'Last Item'</span>)</span>;
                <span class="txt-7">return</span> $res;
            }
        </code></pre>

        <p>O resultado será:</p>

        <p class="ml-5"><span class="txt-1">First item</span> 1 <span class="txt-1">2 3 Last item</span></p>

        <h2>Personalizando as setas</h2>

        <h2 style="color: red;">EDITAR ESTA PARTE DA DOCUMENTAÇÃO</h2>
    </div>
</div>

<?php include('footer.php'); ?>