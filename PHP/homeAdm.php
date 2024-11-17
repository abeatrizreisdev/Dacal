<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();

$tipoContaAutenticada = $sessaoFuncionario->getValorSessao("tipoConta");

if ($tipoContaAutenticada !== "admin") {
    // O usuário autenticado que não for admin, será direcionado para a página de acesso não permitido.
    if ($tipoContaAutenticada === "cliente" or $tipoContaAutenticada === "funcionario") {
        header("Location: ./acessoNegado.php");
        exit();
    } else { // o usuário que não tiver autenticado, será direcionado para a página de login.
        header("Location: ../login.php");
        exit();
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
    <link rel="stylesheet" href="../CSS/homeFuncionario.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="./homeAdm.php">Homepage</li></a>
            <li><a href="./catalogoProdutos.php">Catálogo</li></a>
            <li><a href="">Sobre Nós</li></a>
        </ul>
        <ul class="icons">
            <a href="./autenticacao/logout.php">
                <button class="sair" href="/IMAGENS/Homepage/logoDacal.png">
                    <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
                </button>
            </a>
        </ul>
    </nav>
</header>

<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas" href="../PHP/homeAdm.php">
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
            <a class="abas" href="./perfilAdm.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas" href="./gerenciarContas.php">
                <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar funcionários</p>
                    <p class="descricaoAbas">e empresas</p>
                </div>
            </a>
        </div>
        <section class="quadrado">
            <div id="textoPrincipal">
                <div id="infoPrincipal">
                    <br>
                    <a href="catalogoProdutos.php">
                        <div class="containerFuncionalidades">
                            <h2> Gerenciar catálogo </h2>
                            <img src="../IMAGENS/homeFuncionario/gerenciarCatalogo.png" class="imgIcons">
                        </div>
                    </a>
                    <a href="cadastrarProduto.php">
                        <div class="containerFuncionalidades">
                            <h2> Cadastrar produtos </h2>
                            <img src="../IMAGENS/homeFuncionario/cadastrarProduto.png" class="imgIcons">
                        </div>
                    </a>
                    <a href="gerenciarOrcamentos.php">
                        <div class="containerFuncionalidades">
                            <h2> Visualizar orçamentos </h2>
                            <img src="../IMAGENS/homeFuncionario/visualizarOrcamentos.png" class="imgIcons">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>


</body>

</html>