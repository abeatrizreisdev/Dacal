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
    <link rel="stylesheet" href="../CSS/editarStatusOrcamento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="./homeFuncionario.php">Homepage</li></a>
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
            
            <p class="titulo">Editar Status do Orçamento</p>

            <form id="formEditarStatus">

                <input type="hidden" id="numeroOrcamento" name="numeroOrcamento">
                <div class="labelForm">
                <p class="infoForm">Empresa: <span id="nomeCliente"></span></p>
                <p class="infoForm">Razão Social: <span id="razaoSocial"></span></p>
                <p class="infoForm">CNPJ: <span id="cnpj"></span></p>
                </div>
                <div class="labelForm">
                <p class="infoForm">Inscricao Estadual: <span id="inscricaoEstadual"></span></p>
                <p class="infoForm">Telefone: <span id="telefone"></span></p>
                <p class="infoForm">Email: <span id="email"></span></p>
                </div>
                <div class="labelForm">
                <p class="infoForm">Municipio: <span id="municipio"></span></p>
                <p class="infoForm">Estado: <span id="estado"></span></p>
                <p class="infoForm">Bairro: <span id="bairro"></span></p>
                </div>
                <div class="labelForm">
                <p class="infoForm">Logradouro: <span id="logradouro"></span></p>
                <p class="infoForm">Número do Endereço: <span id="numeroEndereco"></span></p>
                <p class="infoForm">Cep: <span id="cep"></span></p>
                </div>
                <div class="labelForm">
                <p class="infoForm">Data do Orçamento: <span id="dataCriacao"></span></p>
                <p class="infoForm">Valor Total: <span id="valorOrcamento"></span></p>
                <p class="infoForm">Quantidade Total de Itens: <span id="quantidadeTotal"></span></p>
                </div>
                <p>Status Atual: <span id="statusAtual"></span></p>


                <h3>Itens do Orçamento:</h3>

                <ul id="itens"></ul>

                <label for="status">Novo Status:</label>
                <select id="status" name="status">
                    <option value="pendente">Pendente</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="negado">Negado</option>
                </select>

                <button type="submit">Atualizar Status</button>

            </form>

            <p id="mensagemSucesso" ></p>
            <p id="mensagemErro"></p>
            

        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarStatusOrcamento/editarStatusOrcamento.js"></script>
</body>

</html>