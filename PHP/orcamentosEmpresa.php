<?php

require "./sessao/sessao.php";

$sessaoCliente = new Sessao();

$usuarioAutenticado = $sessaoCliente->getValorSessao('tipoConta');

if ($usuarioAutenticado !== "cliente") {
    if ($usuarioAutenticado === "admin" or $usuarioAutenticado === "funcionario") {
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
    <link rel="stylesheet" href="../CSS/orcamentosEmpresa.css">
</head>
<header>
    <div id="barraSuperior"></div>
</header>

<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas" href="./homeEmpresa.php">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem vinda,</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoCliente->getValorSessao('nomeFantasia'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas" href="./perfilEmpresa.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas" href="./orcamentosEmpresa.php">
                <img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Orçamentos</p>
                    <p class="descricaoAbas">Confira todos os seus</p>
                    <p class="descricaoAbas">orçamentos.</p>

                </div>
            </a>
            <br>
            <a class="abas"
                href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">
                <img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Atendimento</p>
                    <p class="descricaoAbas">Precisando de ajuda?</p>
                    <p class="descricaoAbas">Clique aqui..</p>
                </div>
            </a>
        </div>
        <section class="quadrado">
            <p id="tituloPag">Orçamentos Cadastrados</p>
            <!-- Este é o container, a div que será responsável por exibir dentro dela todos os orçamentos da empresa. Sendo que o html dos orçamentos serão gerados pelo js. -->
            <div id="orcamentos">
                <input type="hidden" id="clienteId" value="<?php echo $sessaoCliente->getValorSessao('idCliente'); ?>">
                
            </div>

            <div id="btn">
                    <a href="realizarOrcamento.php"><button id="btnOrcamento">Realizar Orcamento</button></a>
            </div>
        </section>
    </div>

    <script src="../JS/orcamentosEmpresa/carregarOrcamentos.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>