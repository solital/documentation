<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Parâmetros</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Você saberá adequadamente como você analisa os parâmetros de seus URLs. Por exemplo, convém capturar o ID do
        usuário de um URL. Você pode fazer isso definindo parâmetros de rota.</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{id}', <span class="txt-1">function</span> ($userId) {
                <span class="txt-7">return</span> 'User with id: ' . $userId;
            });
        </code></pre>

        <p>Você pode definir quantos parâmetros de rota forem necessários para sua rota:</p>

        <pre><code>
            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/posts/{post}/comments/{comment}', <span class="txt-1">function</span> ($postId, $commentId) {
                <span class="comment">// ...</span>
            });
        </code></pre>

        <p><strong>Nota:</strong> Os parâmetros da rota são sempre envoltos em <code>{}</code> chaves e devem consistir em caracteres alfabéticos. Os
        parâmetros de rota não podem conter um caractere <code>-</code>. Use um sublinhado <code>(_)</code>.</p>

        <h2>Parâmetros opcionais</h2>
        <p>Ocasionalmente, pode ser necessário especificar um parâmetro de rota, mas tornar opcional a presença desse
        parâmetro de rota. Você pode fazer isso colocando um? marca após o nome do parâmetro. Certifique-se de atribuir
        à variável correspondente da rota um valor padrão:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{name?}', <span class="txt-1">function</span> ($name = null) {
            <span class="txt-7">return</span> $name;
        });

        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{name?}', <span class="txt-1">function</span> ($name = 'Simon') {
            <span class="txt-7">return</span> $name;
        });
        </code></pre>

        <h2>Restrições de expressão regular</h2>
        <p>Você pode restringir o formato dos seus parâmetros de rota usando o método <span class="txt-1">where</span> em uma instância de rota. O
        método <span class="txt-1">where</span> aceita o nome do parâmetro e uma expressão regular que define como o parâmetro deve ser
        restringido:</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{name}', <span class="txt-1">function</span> ($name) {
    
            <span class="comment">// ... do stuff</span>
            
        })-><span class="txt-1">where</span>('name', '[A-Za-z]+');

        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{id}', <span class="txt-1">function</span> ($id) {
            
            <span class="comment">// ... do stuff</span>
            
        })-><span class="txt-1">where</span>('id', '[0-9]+');

        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/user/{id}/{name}', <span class="txt-1">function</span> ($id, $name) {
            
            <span class="comment">// ... do stuff</span>
            
        })-><span class="txt-1">where</span>(['id' => '[0-9]+', 'name' => '[a-z]+']);
        </code></pre>

        <h2>Expressão regular rota-correspondência</h2>
        <p>Você pode definir uma correspondência de expressão regular para toda a rota, se desejar. Isso é útil se, por exemplo, você estiver criando uma caixa de modelo que carrega URLs do ajax.</p>

        <p>O exemplo abaixo está usando a seguinte expressão regular: <code>/ajax/([\w]+)/?([0-9]+)?/?</code> que basicamente
        corresponde a <code>/ajax/</code> e espera que o próximo parâmetro seja uma string - e o próximo seja um número (mas
        opcional).</p>

        <p><strong>Correspondências:</strong> <code>/ajax/abc/</code>, <code>/ajax/abc/123/</code></p>

        <p><strong>Não corresponde:</strong> <code>/ajax/</code></p>

        <p>Os grupos de correspondência especificados na regex serão transmitidos como parâmetros:</p>

        <pre><code>
        <span class="txt-6">Course</span>::all('/ajax/abc/123', <span class="txt-1">function</span>($param1, $param2) {
            <span class="comment">// param1 = abc</span>
            <span class="comment">// param2 = 123</span>
        })-><span class="txt-1">setMatch</span>('/\/ajax\/([\w]+)\/?([0-9]+)?\/?/is');
        </code></pre>

        <h2>Regex personalizada para parâmetros correspondentes</h2>
        <p>Por padrão, o Solital usa a expressão regular <code>\w</code> ao combinar parâmetros. Esta decisão foi tomada com
        velocidade e confiabilidade em mente, pois esta partida corresponderá a ambas as letras, número e a maioria dos
        símbolos usados ​​na internet.</p>

        <p>No entanto, às vezes pode ser necessário adicionar uma expressão regular personalizada para corresponder a
        caracteres mais avançados, como - etc.</p>

        <p>Em vez de adicionar uma expressão regular personalizada a todos os seus parâmetros, você pode simplesmente
        adicionar uma expressão regular global que será usada em todos os parâmetros na rota.</p>

        <p><strong>Nota:</strong> Se a expressão regular estiver disponível, recomendamos o uso do parâmetro global em um grupo, conforme
        demonstrado nos exemplos abaixo.</p>

        <h3>Exemplo</h3>
        <p>Este exemplo garantirá que todos os parâmetros usem a expressão regular [\ w \ -] + ao analisar.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/path/{parameter}', '<span class="txt-1">VideoController@home</span>', ['defaultParameterRegex' => '[\w\-]+']);
        </code></pre>

        <p>Você também pode aplicar essa configuração a um grupo se precisar de várias rotas para usar sua expressão
        regular personalizada ao analisar parâmetros.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">group</span>(['defaultParameterRegex' => '[\w\-]+'], <span class="txt-1">function</span>() {

            <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/path/{parameter}', '<span class="txt-1">VideoController@home</span>');

        });
        </code></pre>
    </div>
</div>

<?php include('footer.php'); ?>