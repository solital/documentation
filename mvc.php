<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 bg-name">
        <h1 class="p-4 font-weight-normal">Arquitetura MVC</h1>
    </div>
    <div class="col-md-12 mt-3">
        <h2>O que é Model-View-Controller (MVC)</h2>
        <p>É um padrão de arquitetura de aplicações que divide a aplicação em três camadas: a visão (view), o modelo
        (model), e o controlador (controller). Traduzido para o português, a expressão significa:
        modelo-visão-controlador.</p>

        <h2>O que é Arquitetura de Aplicação</h2>
        <p>A arquitetura de uma aplicação nada mais é do que um modelo que define as suas estruturas. Tal estrutrua
        engloba:</p>

        <ul class="ml-5">
            <li>componentes de software,</li>
            <li>propriedades dos componentes / elementos,</li>
            <li>os relacionamento entre os componentes / elementos,</li>
            <li>e , enfim, todos os elementos que fazem parte da estrutura básica padrão do software e como estes elementos
        interagem / interagem entre si.</li>
            <li>Alguns exemplos de elementos: utilitários, elementos de interação, elementos de conexão, elementos de
        persistência.</li>
        </ul>
        
        <p>Existem arquiteturas padrão de mercado e arquiteturas específicas, criadas e usadas por empresas que desenvolvem
        software (neste segundo caso, configura o papel de um arquiteto de software).</p>

        <h2>Model-View-Controller (MVC) na Prática</h2>
        <p>Em termos práticas, e de forma resumida, utilizar do padão MVC significa:</p>

        <ul class="ml-5">
            <li>Dividir a aplicação em camadas: uma da interface do usuário denominada View, uma para manipulação lógica de
        dados chamada Model, e uma terceira caama de fluxo da aplicação chamada Control)</li>
            <li>Criar a possibilidade de exibir uma mesma lógica de negócios através de várias interfaces.</li>
            <li>Isolar a camada de negócios (Model) das demais camadas do sistema, de forma a facilitar a sustentabilidade do
        código</li>
            <li>A implementação do controlador deve permitir que esta camada receba os eventos da interface e e os converta em
        ações no modelo.</li>
        </ul>
        
        <p>Toda a estrutura de diretórios do Solital você pode ver na documentação do <span class="txt-1">Vinci</span>.</p>
    </div>
</div>

<?php include('footer.php'); ?>