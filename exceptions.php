<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Exceções</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p><code>ExceptionHandler</code> são classes que manipulam todas as exceções. <code>ExceptionsHandlers</code> deve implementar a interface
        <code>IExceptionHandler</code>.</p>

        <h2>Manipulando 404, 403 e outros erros</h2>
        <p>Se você simplesmente deseja capturar um 404 (página não encontrada) etc., pode usar o método auxiliar estático
        <code>Course::error($callback)</code>.</p>

        <p>Isso adicionará um método de retorno de chamada que é acionado sempre que ocorrer um erro em todas as rotas.</p>

        <p>O exemplo básico abaixo simplesmente redireciona a página para <code>/not-found</code> se ocorrer uma
        <code>NotFoundHttpException</code> (404). O código deve ser colocado no arquivo que contém suas rotas.</p>

        <pre><code>
        <span class="txt-6">Course</span>::<span class="txt-1">get</span>('/not-found', '<span class="txt-1">PageController@notFound</span>');

        <span class="txt-6">Course</span>::<span class="txt-1">error</span>(<span class="txt-1">function</span>(Request $request, <span class="txt-1">\Exception</span> $exception) {

            <span class="txt-1">if</span>($exception instanceof <span class="txt-1">NotFoundHttpException</span> && $exception-><span class="txt-1">getCode</span>() === 404) {
                <span class="txt-1">response</span>()->redirect('/not-found');
            }
            
        });
        </code></pre>

        <h2>Usando manipuladores de exceção personalizados</h2>
        <p>Este é um exemplo básico de implementação de ExceptionHandler (consulte "Substituir facilmente a rota prestes a
        ser carregada" para obter exemplos de como alterar o retorno de chamada).</p>

        <pre><code>
        <span class="txt-7">namespace</span> <span class="txt-1">Demo\Handlers</span>;

        <span class="txt-7">use</span> <span class="txt-1">Solital\Http\Request</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Handlers\IExceptionHandler</span>;
        <span class="txt-7">use</span> <span class="txt-1">Solital\Course\Exceptions\NotFoundHttpException;</span>

        <span class="txt-1">class</span> CustomExceptionHandler <span class="txt-1">implements</span> IExceptionHandler
        {
            <span class="txt-7">public function</span> <span class="txt-1">handleError</span>(Request $request, <span class="txt-1">\Exception</span> $error): <span class="txt-1">void</span>
            {

                <span class="comment">/* You can use the exception handler to format errors depending on the request and type. */</span>

                <span class="txt-1">if</span> ($request-><span class="txt-1">getUrl</span>()-><span class="txt-1">contains</span>('/api')) {

                    <span class="txt-1">response</span>()-><span class="txt-1">json</span>([
                        'error' => $error-><span class="txt-1">getMessage</span>(),
                        'code'  => $error-><span class="txt-1">getCode</span>(),
                    ]);

                }

                <span class="comment">/* The Course will throw the NotFoundHttpException on 404 */</span>
                <span class="txt-1">if</span>($error instanceof <span class="txt-1">NotFoundHttpException</span>) {

                    // Render custom 404-page
                    $request-><span class="txt-1">setRewriteCallback</span>('<span class="txt-1">Demo\Controllers\PageController@notFound</span>');
                    <span class="txt-7">return</span>;
                    
                }

                <span class="txt-7">throw</span> $error;

            }

        }
        </code></pre>

    </div>
</div>

<?php include('footer.php'); ?>