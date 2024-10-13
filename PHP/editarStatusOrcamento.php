<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();

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
        </div>
        <section class="quadrado">
            
            <h2>Editar Status do Orçamento</h2>

            <form id="formEditarStatus">

                <input type="hidden" id="numeroOrcamento" name="numeroOrcamento">

                <p>Cliente: <span id="nomeCliente"></span></p>
                <p>Razão Social: <span id="razaoSocial"></span></p>
                <p>CNPJ: <span id="cnpj"></span></p>
                <p>Inscricao Estadual: <span id="inscricaoEstadual"></span></p>
                <p>Telefone: <span id="telefone"></span></p>
                <p>Email: <span id="email"></span></p>
                <p>Municipio: <span id="municipio"></span></p>
                <p>Estado: <span id="estado"></span></p>
                <p>Bairro: <span id="bairro"></span></p>
                <p>Logradouro: <span id="logradouro"></span></p>
                <p>Número do Endereço: <span id="numeroEndereco"></span></p>
                <p>Cep: <span id="cep"></span></p>
                <p>Data do Orçamento: <span id="dataCriacao"></span></p>
                <p>Valor Total: <span id="valorOrcamento"></span></p>
                <p>Status Atual: <span id="statusAtual"></span></p>


                <p>Quantidade Total de Itens: <span id="quantidadeTotal"></span></p>

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

    <script src="../JS/editarStatusOrcamento.js"></script>
</body>

</html>