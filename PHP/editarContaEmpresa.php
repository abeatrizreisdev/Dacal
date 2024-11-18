<?php

require "./sessao/sessao.php";
require "./carregarApiIbge/carregarApiNosPerfis.php";

$sessaoCliente = new Sessao();

$contaAutenticada = $sessaoCliente->getValorSessao('tipoConta');

if ($contaAutenticada !== "admin") {
    // O usuário autenticado que não for admin, será direcionado para a página de acesso não permitido.
    if ($contaAutenticada === "cliente" or $contaAutenticada === "funcionario") {
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
    <link rel="stylesheet" href="../CSS/geral.css">
    <link rel="stylesheet" href="../CSS/editarContaEmpresa.css">
    <link rel="stylesheet" href="../CSS/perfilEmpresa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>


<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $contaAutenticada; ?>"></div> 
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
                    <p>Bem vindo,</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoCliente->getValorSessao('nome'); ?> </p>
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
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>

            <?php

            if ($contaAutenticada != 'admin' && $contaAutenticada != 'funcionario') {

                echo '<br>';
                echo '<a class="abas" href="./orcamentosEmpresa.php">';
                echo '<img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">';
                echo '<div id="info">';
                echo '<p class="tituloAbas">Orçamentos</p>';
                echo '<p class="descricaoAbas">Confira todos os seus</p>';
                echo '<p class="descricaoAbas">orçamentos.</p>';
                echo '</div>';
                echo '</a>';
                echo '<br>';
                echo '<a class="abas" href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">';
                echo '<img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">';
                echo '<div id="info">';
                echo '<p class="tituloAbas">Atendimento</p>';
                echo '<p class="descricaoAbas">Precisando de ajuda?</p>';
                echo '<p class="descricaoAbas">Clique aqui..</p>';
                echo '</div>';
                echo '</a>';

            }

            ?>

            <?php

            // Já se a conta que está logada for adm, então aparecerá a opção de gerencia de contas que é a funcionalidade que só esse tipo de conta tem.
            if ($contaAutenticada == "admin") {
                echo '<br>
                <a class="abas" href="gerenciarContas.php">
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
            <div class="geral">
                <p id="tituloInfo">Informações da Conta</p>
                <div class="infoConta">
                    <div class="dadosGerais">

                        <p id="titulo">Dados da Conta</p>

                        <form action="edicoesDeDadosCliente/editarInfoGeraisCliente.php" method="post" class="formDados" id="formEditarConta">

                            <input type="hidden" name="idCliente" id="idCliente">

                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Razão Social</p>
                                    <input type="text" id="razaoSocial" name="razaoSocial" class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>CNPJ da Empresa</p>
                                    <input type="text" id="cnpjEmpresa" name="cnpjEmpresa" class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Nome Fantasia</p>
                                    <input type="text" id="nomeFantasia" name="nomeFantasia" class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Inscrição Estadual</p>
                                    <input type="text" id="inscricaoEstadual" name="inscricaoEstadual" class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="telefone" name="telefone" class="input">
                                </div>
                            </div>
                            <div class="endereço">
                                <p>Endereço</p>
                                <select id="estado" name="estado" class="inputAPI" required>
                                    <option value="">Selecione um estado</option>
                                </select>
                                <select id="municipio" name="municipio" class="inputAPI" required>
                                    <option value="">Selecione um município</option>
                                </select>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Logradouro</p>
                                    <input type="text" id="logradouro" name="logradouro" class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Nº</p>
                                    <input type="text" id="numeroEndereco" name="numeroEndereco" class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Bairro</p>
                                    <input type="text" id="bairro" name="bairro" class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>CEP</p>
                                    <input type="text" id="cep" name="cep" class="input">
                                </div>
                            </div>
                            <div class="btn">
                                <button type="button" id="btnSalvar">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                    <div class="alterarDados">
                        <form action="./edicoesDeDadosCliente/editarEmailCliente.php" method="POST"
                            class="alterarEmail">
                            <p class="tituloAlterar">E-mail</p>
                            <input type="hidden" name="idClienteEmail" id="idClienteEmail">
                            <input type="email" id="trocarEmail" name="email" class="input">
                            <button type="submit" class="btnAlterarEmail">Alterar E-mail</button>
                        </form>
                        <form action="./edicoesDeDadosCliente/editarSenhaCliente.php" method="POST"
                            class="alterarSenha">
                            <p class="tituloAlterar">Senha</p>
                            <input type="hidden" name="idClienteSenha" id="idClienteSenha">
                            <input type="password" id="trocarSenha" name="senha" class="input">
                            <button type="submit" class="btnAlterarSenha">Alterar Senha</button>
                        </form>
                        <a href="./gerenciarContas.php">
                            <button type="submit" class="btnVoltar">Voltar a página</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarCliente_adm/carregarDadosCliente.js"></script>
    <script src="../JS/editarCliente_adm/enviarFormulario.js"></script>
    <script src="../JS/scriptsApi/ibge.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>