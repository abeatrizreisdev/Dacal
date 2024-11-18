<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();

$usuarioAutenticado = $sessaoFuncionario->getValorSessao('tipoConta');


if ($usuarioAutenticado !== "funcionario") {
    if ($usuarioAutenticado === "cliente" or $usuarioAutenticado === "admin") {
        header("Location: ./acessoNegado.php");
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
    <link rel="stylesheet" href="../CSS/homeFuncionario.css">
</head>


<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $usuarioAutenticado; ?>"></div> 
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
        </div>
        <section class="quadrado">
            <div id="textoPrincipal">
                <div id="infoPrincipal">
                    <br>
                    <a href="./catalogoProdutos.php">
                        <div class="containerFuncionalidades">
                            <h2> Gerenciar catálogo </h2>
                            <img src="../IMAGENS/homeFuncionario/gerenciarCatalogo.png" class="imgIcons">
                        </div>
                    </a>
                    <a href="./cadastrarProduto.php">
                        <div class="containerFuncionalidades">
                            <h2> Cadastrar produtos </h2>
                            <img src="../IMAGENS/homeFuncionario/cadastrarProduto.png" class="imgIcons">
                        </div>
                    </a>
                    <a href="./gerenciarOrcamentos.php">
                        <div class="containerFuncionalidades">
                            <h2> Visualizar orçamentos </h2>
                            <img src="../IMAGENS/homeFuncionario/visualizarOrcamentos.png" class="imgIcons">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>