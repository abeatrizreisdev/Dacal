<?php

require "./sessao/sessao.php";

$sessao = new Sessao();

$tipoContaAutenticada = $sessao->getValorSessao('tipoConta');

// Redirecionando o usuário para a página de login, caso ele não esteja em uma conta do tipo "admin" ou "funcionario" ou "cliente".
if ($tipoContaAutenticada !== "admin" && $tipoContaAutenticada !== "funcionario" && $tipoContaAutenticada !== "cliente") {
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Beatriz Reis e Valter Filho">
    <meta name="description" content="Site de automoção da Dacal">
    <title>Dacal</title>
    <link rel="stylesheet" href="../CSS/geral.css">
    <link rel="stylesheet" href="../CSS/catalogoProdutos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>


<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $sessao->getValorSessao('tipoConta'); ?>"></div> 
    <header> 
        <div id="barraSuperior"></div> 
    </header>

    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas" href="<?php
            if ($sessao->getValorSessao('tipoConta') === 'admin') {
                echo './homeAdm.php';
            } elseif ($sessao->getValorSessao('tipoConta') === 'funcionario') {
                echo './homeFuncionario.php';
            } else {
                echo './homeEmpresa.php';
            }
            ?>">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php
                    if ($sessao->getValorSessao('tipoConta') === 'admin' || $sessao->getValorSessao('tipoConta') === 'funcionario') {
                        ?>
                        <p id="nomeEmpresa"><?php echo $sessao->getValorSessao('nome'); ?></p>
                        <?php
                    } else {
                        ?>
                        <p id="nomeEmpresa"><?php echo $sessao->getValorSessao('nomeFantasia'); ?></p>
                        <?php
                    }
                    ?>
                    </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas"
                href="<?php echo $tipoContaAutenticada == 'admin' ? 'perfilADM.php' : ($tipoContaAutenticada == 'funcionario' ? 'perfilFuncionario.php' : 'perfilEmpresa.php'); ?>">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>

            <?php

            if ($tipoContaAutenticada != 'admin' && $tipoContaAutenticada != 'funcionario') {

                echo '<br>';
                echo '<a class="abas" href="./orcamentosEmpresa.php">';
                echo '<img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">';
                echo '<div id="info">';
                echo '<p class="tituloAbas">Orçamentos</p>';
                echo '<p class="descricaoAbas">Confira todos os seus</p>';
                echo '<p class="descricaoAbas">orçamentos.</p>';
                echo '</div>';
                echo '</a>';
                echo '<br>';
                echo '<a class="abas" href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">';
                echo '<img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">';
                echo '<div id="info">';
                echo '<p class="tituloAbas">Atendimento</p>';
                echo '<p class="descricaoAbas">Precisando de ajuda?</p>';
                echo '<p class="descricaoAbas">Clique aqui..</p>';
                echo '</div>';
                echo '</a>';

            }

            ?>

            <?php

            // Já se a conta que está logada for adm, então aparecerá a opção de gerencia de contas que é a funcionalidade que só esse tipo de conta tem.
            if ($tipoContaAutenticada == "admin") {
                echo '<br>
                    <a class="abas" href="gerenciarContas.php">
                    <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                    <div id="info">
                        <p class="tituloAbas"> Gerenciar Contas</p>
                        <p class="descricaoAbas">Gerenciar funcionários</p>
                        <p class="descricaoAbas">e empresas</p>
                    </div>
                </a>';
            }

            ?>
        </div>
        <section class="quadrado">

            <div class="containerPesquisar">
                <input type="text" id="buscarProdutoNome" placeholder="Digite o nome do produto.">
                <button onclick="buscarProdutoPorNome()">Buscar</button>
            </div>

            <nav>
                <ul class="containerCategorias">
                    <li><a href="#" onclick="carregarProdutos(0)">Geral</a></li>
                    <li><a href="#" onclick="carregarProdutos(1)">Móveis</a></li>
                    <li><a href="#" onclick="carregarProdutos(2)">Escritório</a></li>
                    <li><a href="#" onclick="carregarProdutos(3)">Diversos</a></li>
                </ul>
            </nav>

            <div id="containerProdutos">
                <!-- Produtos serão carregados aqui -->

            </div>


            <?php
            if ($tipoContaAutenticada == "admin" | $tipoContaAutenticada == "funcionario") {
                echo '<a class="btn-ca" href="./cadastrarProduto.php">
                <button class="btnCadastro">Cadastrar Novo Produto</button>
            </a>';
            }
            ?>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/catalogoProdutos/verificarStatusCadastroProduto.js"></script>
    <script src="../JS/catalogoProdutos/excluirProduto.js"></script>
    <script src="../JS/catalogoProdutos/carregarProdutos.js"></script>
    <script src="../JS/catalogoProdutos/buscarProdutoPorNome.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>