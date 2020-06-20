<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Tipos de dados</h1>
    </div>
    <div class="col-md-12 mt-3">
        <p>Abaixo esta listado os atributos e dadso suportados pela Katrina ORM</p>
        
        <h3>Dados em string</h3>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipos</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>varchar(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>char(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>tinytext(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>mediumtext(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>longtext(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>text(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
            </tbody>
        </table>

        <h3>Dados numéricos</h3>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipos</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>tinyint(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>smallint(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>mediumint(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>bigint(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>int(<span class="txt-3">"column_name"</span>, <span class="txt-5">size</span>)</code></td>
                </tr>
                <tr>
                    <td><code>decimal(<span class="txt-3">"column_name"</span>, <span class="txt-5">value1, value2</span>)</code></td>
                </tr>
            </tbody>
        </table>

        <h3>Data e hora</h3>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipos</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>date(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
                <tr>
                    <td><code>year(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
                <tr>
                    <td><code>time(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
                <tr>
                    <td><code>datetime(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
                <tr>
                    <td><code>timestamp(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
            </tbody>
        </table>

        <h3>Boleano</h3>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipos</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>boolean(<span class="txt-3">"column_name"</span>)</code></td>
                </tr>
            </tbody>
        </table>

        <h2>Atributos</h2>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Tipos</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><code>default(<span class="txt-3">"default_value"</span>)</code></td>
                </tr>
                <tr>
                    <td><code>unique()</code></td>
                </tr>
                <tr>
                    <td><code>unsigned()</code></td>
                </tr>
                <tr>
                    <td><code>incremet()</code></td>
                </tr>
                <tr>
                    <td><code>notNull()</code></td>
                </tr>
                <tr>
                    <td><code>primary()</code></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>