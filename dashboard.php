<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <p class="p-4 h2 font-weight-normal">Dashboard</p>
    </div>
    <div class="col-md-12">
        <div class="card border-0">
            <div class="card-body">
                <form class="form-signin mt-3" method="POST" action="#">
                    <div class="form-group">
                        <input type="email" id="email" class="input-class" name="email" placeholder="Endereço de email"
                            required autofocus>
                    </div>

                    <div class="form-group">
                        <input type="password" id="password" class="input-class" name="senha" placeholder="Senha"
                            required>
                    </div>

                    <button class="btn btn-3 margem" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-action">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Info</th>
                    <th>State</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>27/09/2013</td>
                    <td>One little text</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>27/09/2013</td>
                    <td>One little text</td>
                    <td>Inactive</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>27/09/2013</td>
                    <td>One little text</td>
                    <td>Draft</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>27/09/2013</td>
                    <td>One little text</td>
                    <td>Scheduled</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-12">
        <div class="card mb-3 card-custom" style="max-width: 18rem;">
            <div class="card-header">Cabeçalho</div>
            <div class="card-body text-primary">
                <h5 class="card-title">Título de Card Primary</h5>
                <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o
                    conteúdo do card.</p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3 ticket form-inline p-3 bg-6" style="max-width: 18rem;">
            <div class="col-md-6 text-center h1">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="col-md-6">
                <p class="h4">Price</p>
                <p>R$ 150,00</p>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>