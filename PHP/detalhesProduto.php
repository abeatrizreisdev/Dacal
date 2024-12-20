<?php

require './sessao/sessao.php';
require './conexaoBD/conexaoBD.php';
require "./crud/crudProduto.php";
require "./conexaoBD/configBanco.php";
require "./entidades/produto.php";
require "./entidades/orcamento.php";


$sessao = new Sessao();

$contaAutenticada = $sessao->getValorSessao('tipoConta');

// Redirecionando o usuário para a página de login, caso ele não esteja em uma conta autenticada do sistema.
if ($contaAutenticada !== "cliente" && $contaAutenticada !== "admin" && $contaAutenticada !== "funcionario") {
    header("Location: ./login.php");
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
    <link rel="stylesheet" href="../CSS/detalhesProduto.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
</head>
<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $contaAutenticada; ?>"></div> 
    <header> 
        <div id="barraSuperior"></div> 
    </header>


    <div class="homepage">
    
    <div class="menu">
        <br>
        <br>
        <a class="abas">
            <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
            <div id="info">
                <p>Bem-vindo(a),</p>
                <p id="nomeEmpresa"><?php
                    if ($contaAutenticada === 'admin' || $contaAutenticada === 'funcionario') {
                        ?>
                        <p id="nomeEmpresa"><?php echo $sessao->getValorSessao('nome'); ?></p>
                        <?php
                    } else {
                        ?>
                        <p id="nomeEmpresa"><?php echo $sessao->getValorSessao('nomeFantasia'); ?></p>
                        <?php
                    }
                    ?></p>
                <button class="sairInfo" href="">
                    <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                </button>
            </div>
        </a>
        <br>
        <hr id="linhaMenu">
        <br>
        <a class="abas" href="<?php echo $contaAutenticada == 'admin' ? './perfilAdm.php' : ($contaAutenticada == 'funcionario' ? 'perfilFuncionario.php' : 'perfilEmpresa.php'); ?>">
            <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
            <div id="info">
                <p class="tituloAbas">Meu Perfil</p>
                <p class="descricaoAbas">Visualize e altere seus</p>
                <p class="descricaoAbas">dados.</p>
            </div>
        </a>

        <?php 

            // Já se a conta que está logada for adm, então aparecerá a opção de gerencia de contas que é a funcionalidade que só esse tipo de conta tem.
            if ($contaAutenticada == "admin") {
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

        <?php 

            // Se a conta autenticada for um cliente, então vai renderizar as opções de "Orcamento" "Atendimento" na esquerda da tela.
            if ($contaAutenticada === "cliente") {


                echo '<br> 
                    <a class="abas" href="orcamentosEmpresa.php">
                        <img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">
                    <div id="info">
                        <p class="tituloAbas">Orçamentos</p>
                        <p class="descricaoAbas">Confira todos os seus</p>
                        <p class="descricaoAbas">orçamentos.</p>
                    </div>
                    </a>
                    <br>
                    <a class="abas" href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">
                        <img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">
                        <div id="info">
                            <p class="tituloAbas">Atendimento</p>
                            <p class="descricaoAbas">Precisando de ajuda?</p>
                            <p class="descricaoAbas">Clique aqui..</p>
                        </div>
                    </a>';

            }

    ?>

    </div>

    <section class="quadrado">
        <div id="productDetails"></div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/catalogoProdutos/detalhesProduto.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</div>
</body>
</html>
