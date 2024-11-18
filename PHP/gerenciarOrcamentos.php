<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();

$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');

if ($tipoContaAutenticada !== "admin" && $tipoContaAutenticada !== "funcionario") {
    if ($tipoContaAutenticada === "cliente") {
        header("Location: ./acessoNegado.php");
        exit();
    } else {
        header("Location: ../login.php");
    }
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
    <link rel="stylesheet" href="../CSS/gerenciarOrcamentos.css">
</head>
<header>
    <div id="barraSuperior"></div>
</header>

<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas" href="./homeAdm.php">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoFuncionario->getValorSessao('nome'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas" href="./perfilFuncionario.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>

            <?php

            // Já se a conta que está logada for adm, então aparecerá a opção de gerencia de contas que é a funcionalidade que só esse tipo de conta tem.
            if ($tipoContaAutenticada == "admin") {
                echo '<br>
                    <a class="abas" href="./visualizarContasCadastradas.php">
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
            <p id="titulo">Orçamentos</p>
            <div class="buscar">
                <button id="buscarNumero" class="btnSelecionado">Número do orçamento</button>
                <button id="buscarEmpresa">Nome da Empresa</button>
            </div>
            <div class="busca-conteiner"></div>
            <div class="quadradoGeral">
                <div id="orcamentos"></div>
            </div>
        </section>
    </div>

    <script src="../JS/gerenciarOrcamentos/carregarOrcamentos_adm.js"></script>
    <script src="../JS/gerenciarOrcamentos/buscarOrcamentos.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>