<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Entrada e parâmetros</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>O simple-router oferece bibliotecas e auxiliares que facilitam o gerenciamento e a manipulação de parâmetros
            de
            entrada como <code>$_POST</code>, <code>$_GET</code> e <code>$_FILE</code>.</p>

        <h2>Usando a classe Input para gerenciar parâmetros</h2>
        <p>Você pode usar a classe <code>InputHandler</code> para acessar e gerenciar facilmente parâmetros de sua
            solicitação. A classe
            <code>InputHandler</code> oferece recursos estendidos, como copiar/mover arquivos carregados diretamente no
            objeto, obter
            extensão de arquivo, tipo MIME etc.</p>

        <h2>Obter valor de parâmetro único</h2>
        <pre><code>
        <span class="txt-1">input</span>($index, $defaultValue, ...$methods);
        </code></pre>

        <p>Para obter rapidamente um valor de um parâmetro, você pode usar a função <code>input</code> do helper.</p>

        <p>Isso irá aparar automaticamente o valor e garantir que ele não esteja vazio. Se estiver vazio, o
            <code>$defaultValue</code>
            será retornado.</p>

        <p><strong>Nota:</strong> Essa função retorna uma <code>string</code>, a menos que os parâmetros sejam
            agrupados, nesse caso, retornará um array de valores.</p>

        <h3>Exemplo:</h3>

        <p>Este exemplo corresponde aos métodos de solicitação POST e GET e, se o nome estiver vazio, o valor padrão
            "Guest" será retornado.</p>

        <pre><code>
        $name = <span class="txt-1">input</span>('name', 'Guest', 'post', 'get');
        </code></pre>

        <h2>Obter objeto de parâmetro</h2>
        <p>Ao lidar com uploads de arquivos, pode ser útil recuperar o objeto de parâmetro bruto.</p>

        <strong>Procure um objeto com valor padrão em vários métodos de solicitação específicos ou:</strong>

        <p>O exemplo abaixo retornará um objeto <code>InputItem</code> se o parâmetro foi encontrado ou retornará o
            <code>$defaultValue</code>. Se
            os parâmetros forem agrupados, ele retornará um array de objetos <code>InputItem</code>.</p>

        <pre><code>
        $object = <span class="txt-1">input</span>()-><span class="txt-1">find</span>($index, $defaultValue = <span class="txt-7">null</span>, ...$methods);
        </code></pre>

        <h2>Obtendo o parâmetro <code>$_GET</code> específico como objeto <code>InputItem</code>:</h2>

        <p>O exemplo abaixo retornará um objeto <code>InputItem</code> se o parâmetro foi encontrado ou retornará o
            <code>$defaultValue</code>. Se
            os parâmetros forem agrupados, ele retornará um array de objetos InputItem.</p>

        <pre><code>
        $object = <span class="txt-1">input</span>()-><span class="txt-1">get</span>($index, $defaultValue = <span class="txt-7">null</span>);
        </code></pre>

        <h2>Obtendo o parâmetro <code>$_POST</code> específico como objeto <code>InputItem</code>:</h2>

        <p>O exemplo abaixo retornará um objeto <code>InputItem</code> se o parâmetro foi encontrado ou retornará o
            <code>$defaultValue</code>. Se
            os parâmetros forem agrupados, ele retornará um array de objetos <code>InputItem</code>.</p>

        <pre><code>
        $object = <span class="txt-1">input</span>()-><span class="txt-1">post</span>($index, $defaultValue = <span class="txt-7">null</span>);
        </code></pre>

        <h2>Obtendo o parâmetro <code>$_FILE</code> específico como objeto <code>InputFile</code>:</h2>

        <p>O exemplo abaixo retornará um objeto <code>InputFile</code> se o parâmetro foi encontrado ou retornará o
            <code>$defaultValue</code>. Se
            os parâmetros forem agrupados, ele retornará um array de objetos <code>InputFile</code>.</p>

        <pre><code>
        $object = <span class="txt-1">input</span>()-><span class="txt-1">file</span>($index, $defaultValue = <span class="txt-7">null</span>);
        </code></pre>

        <h2>Gerenciando arquivos</h2>

        <pre><code>
        <span class="comment">/**
        * Loop through a collection of files uploaded from a form on the page like this
        * &lt;input type="file" name="images[]" />
        */

        /* @var $image \Solital\Http\Input\InputFile */</span>
        <span class="txt-1">foreach</span>(<span class="txt-1">input</span>()-><span class="txt-1">file</span>('images', []) <span class="txt-1">as</span> $image)
        {
            <span class="txt-1">if</span>($image-><span class="txt-1">getMime</span>() === 'image/jpeg') 
            {
                $destinationFilname = <span class="txt-1">sprintf</span>(<span class="txt-3">'%s.%s'</span>, <span class="txt-1">uniqid</span>(), $image-><span class="txt-1">getExtension</span>());
                $image-><span class="txt-1">move</span>(<span class="txt-1">sprintf</span>(<span class="txt-3">'/uploads/%s'</span>, $destinationFilename));
            }
        }
        </code></pre>

        <h2>Obter todos os parâmetros</h2>
        <pre><code>
        <span class="comment"># Get all</span>
        $values = <span class="txt-1">input</span>()-><span class="txt-1">all</span>();

        <span class="comment"># Only match specific keys</span>
        $values = <span class="txt-1">input</span>()-><span class="txt-1">all</span>([
            'company_name',
            'user_id'
        ]);
        </code></pre>

        <p>Todo objeto implementa a interface <code>IInputItem</code> e sempre conterá estes métodos:</p>

        <ul class="ml-5">
            <li><code>getIndex()</code> - retorna o índice / chave da entrada.</li>
            <li><code>getName()</code> - retorna um nome amigável para a entrada (nome_da_empresa será Nome da empresa etc).</li>
            <li><code>getValue()</code> - retorna o valor da entrada.</li>
        </ul>

        <p><code>InputFile</code> possui os mesmos métodos acima, juntamente com outros métodos específicos de arquivos, como:</p>

        <ul class="ml-5">
            <li><code>getFilename</code> - obtém o nome do arquivo.</li>
            <li><code>getTmpName()</code> - obtém o nome temporário do arquivo.</li>
            <li><code>getSize()</code> - obtém o tamanho do arquivo.</li>
            <li><code>move($ destination)</code> - move o arquivo para o destino.</li>
            <li><code>getContents()</code> - obtém o conteúdo do arquivo.</li>
            <li><code>getType()</code> - obtém o tipo MIME para arquivo.</li>
            <li><code>getError()</code> - obtém erro de upload de arquivo.</li>
            <li><code>hasError()</code> - retorna bool se ocorrer um erro durante o upload (se getError não for 0).</li>
            <li><code>toArray()</code> - retorna um array bruto</li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>