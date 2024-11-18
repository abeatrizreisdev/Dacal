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
    <link rel="stylesheet" href="../CSS/editarStatusOrcamento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div id="barraSuperior"></div>
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
            <a class="abas" href="<?php echo $tipoContaAutenticada == 'admin' ? './perfilADM.php' : ($tipoContaAutenticada == 'funcionario' ? './perfilFuncionario.php' : 'perfilEmpresa.php'); ?>">
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
                    <a class="abas" href="./gerenciarContas.php">
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

            <p class="tituloSuperior">Editar Status do Orçamento</p>

            <form id="formEditarStatus">

                <input type="hidden" id="numeroOrcamento" name="numeroOrcamento">
                <div class="labelOrca">
                    <p class="infoForm"><strong>Data do Orçamento:</strong> <span id="dataCriacao"></span></p>
                    <p class="infoForm"><strong>Empresa:</strong> <span id="nomeCliente"></span></p>
                    <p class="infoForm"><strong>CNPJ: </strong><span id="cnpj"></span></p>
                    <p class="infoForm"><strong>Inscricao Estadual:</strong> <span id="inscricaoEstadual"></span></p>
                    <p class="infoForm"><strong>Razão Social:</strong> <span id="razaoSocial"></span></p>
                    <p class="infoForm"><strong>Telefone:</strong> <span id="telefone"></span></p>
                    <p class="infoForm"><strong>Email: </strong><span id="email"></span></p>
                    <p class="infoForm"><strong>Municipio:</strong> <span id="municipio"></span></p>
                    <p class="infoForm"><strong>Estado:</strong> <span id="estado"></span></p>
                    <p class="infoForm"><strong>Bairro: </strong><span id="bairro"></span></p>
                    <p class="infoForm"><strong>Logradouro:</strong> <span id="logradouro"></span></p>
                    <p class="infoForm"><strong>Número do Endereço: </strong><span id="numeroEndereco"></span></p>
                    <p class="infoForm"><strong>Cep: </strong><span id="cep"></span></p>
                    <div class="labelForm">
                        <p class="infoForm"><strong>Valor Total: </strong><span id="valorOrcamento"></span></p>
                        <p class="infoForm"><strong>Quantidade Total de Itens: </strong><span id="quantidadeTotal"></span></p>
                    </div>
                </div>


                <p class="titulo">Itens do Orçamento</p>

                <div id="itens"></div>
                <p class="titulo">Status do Orçamento</p>
                <div class="btnStatus">
                    <p class="estadoStatus"><strong>Atual:</strong> <span id="statusAtual"></span></p>
                    <div class="labelStatus">
                        <label for="status" class="estadoStatus"><strong>Novo Status:</strong></label>
                        <select id="status" name="status">
                            <option value="pendente">Pendente</option>
                            <option value="finalizado">Finalizado</option>
                            <option value="negado">Negado</option>
                        </select>

                        <button type="submit" class="btnAtualizar">Atualizar Status</button>
                    </div>
                </div>
            </form>
            <button class="btnVoltar">
                <a href="../PHP/gerenciarOrcamentos.php">Voltar</a>
            </button>
            <p id="mensagemSucesso"></p>
            <p id="mensagemErro"></p>


        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarStatusOrcamento/editarStatusOrcamento.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>