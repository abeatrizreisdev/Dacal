<?php

require "./sessao/sessao.php";

$sessaoEmpresa = new Sessao();

$tipoContaAutenticada = $sessaoEmpresa->getValorSessao('tipoConta');

// Redirecionando o usuário para a página de login, caso ele não esteja em uma conta do tipo de Cliente.
if ($tipoContaAutenticada !== "cliente") {
    if ($tipoContaAutenticada === "admin" or $tipoContaAutenticada === "funcionario") {
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
    <link rel="stylesheet" href="../CSS/infoOrcamentoCliente.css">
</head>

<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $tipoContaAutenticada; ?>"></div> 
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
                    <p id="nomeEmpresa"> <?php echo $sessaoEmpresa->getValorSessao('nomeFantasia'); ?> </p>
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
            <p class="tituloSuperior">Informações do Orçamento</p>
            <!-- Div responsável por exibir dentro dela as informações de um orçamento especifico que o arquivo "detalhesOrcamento.js irá renderizar.  -->
            <div id="detalhesOrcamento">Carregando...</div>
            <button class="btnVoltar">
                <a href='../PHP/orcamentosEmpresa.php'>Voltar a página</d>
            </button>
            <script src="../JS/orcamentosEmpresa/detalhesOrcamento.js"></script>
            <script src="../JS/barras/barraSuperior.js"></script>

        </section>
    </div>

</body>

</html>