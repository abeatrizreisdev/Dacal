<?php

require "./sessao/sessao.php";

$sessaoCliente = new Sessao();

$usuarioAutenticado = $sessaoCliente->getValorSessao('tipoConta');

// Redirecionando o usuário para a página de login, caso ele não esteja em uma conta do tipo de Cliente.
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
    <link rel="stylesheet" href="../CSS/homeEmpresa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="homeEmpresa.php">Homepage</li></a>
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
        <div class="quadrado">
            <div id="textoPrincipal">
                <div id="infoPrincipal">
                    <p id="tituloPrincipal">Seja Bem Vinda,
                        <strong><?php echo $sessaoCliente->getValorSessao('nomeFantasia'); ?></strong>
                    </p>
                    <br>
                    <p id="descricao">É um prazer ter você aqui, somos a <strong>DACAL</strong>, a empresa que fornece
                        os produtos para a
                        sua
                        empresa de forma automatizada, dando a liberdade que você precisa para fazer os pedidos quando
                        quiser e da forma que desejar.
                        <br>
                        Não sabe ainda como usar a nossa plataforma? Temos o tutorial logo abaixo:
                        <br>
                        Na aba <strong>Meu perfil</strong>, você terá acesso aos seus dados cadastrais como CNPJ,
                        E-mail, Telefone,
                        Endereço,
                        Senha
                        e também será possível fazer a atualização dos mesmos.<br>
                        Na aba <strong>Orçamentos</strong>, você terá acesso a todos os orçamentos que já foram feitos
                        pela sua empresa
                        nesse
                        site e será onde ira iniciar novos orçamentos.<br>
                        Na aba <strong>Atendimento</strong>, você terá acesso a contato direto com algum funcionário da
                        nossa empresa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/scriptsParaCliente.js/verificarStatusEdicaoCliente.js"></script>

</body>

</html>