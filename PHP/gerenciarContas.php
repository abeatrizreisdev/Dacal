<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();
$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');

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
    <link rel="stylesheet" href="../CSS/gerenciarContas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="<?php echo $tipoContaAutenticada == 'admin' ? 'homeAdm.php' : 'homeFuncionario.php'; ?>">Homepage
            </li></a>
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
            <a class="abas" href="./visualizarContasCadastradas.php">
                <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar funcionários</p>
                    <p class="descricaoAbas">e empresas</p>
                </div>
            </a>
        </div>
        <section class="quadrado">
            <div class="quadradoGeral">
                <br>
                <h1 id="titulo"> Tipo de Conta </h1>
                <button id="empresa" class="selecionado">Empresa</button>
                <button id="funcionario">Funcionário</button>
                <div id="busca-container">
                    <!-- Input de busca para empresa será inserido aqui -->
                </div>
                <div id="container-funcionarios">

                    <!-- O elemento "p" com id "mensagem-erro" será criado dinamicamente pelo js aqui, para evitar erros. -->
                     
                </div>
                
                <div class="cadastro">
                    <!-- Inserir a página de cadastro do funcionário dentro do href. -->
                    <a href="javascript:void(0);" onclick="popUpCadastrarFuncionario()">
                        <button class="btnCadastro">Cadastrar Funcionário</button>
                    </a>
                </div>
            </div>
        </section>

    </div>

    <script src="../JS/gerenciarContas/buscarContaCliente.js"></script>
    <script src="../JS/gerenciarContas/buscarContaFuncionario.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/gerenciarContas/statusAlteracaoDeContas.js"></script>
    <script src="../JS/cadastrarFuncionario/cadastrarFuncionario.js"></script>

</body>

</html>