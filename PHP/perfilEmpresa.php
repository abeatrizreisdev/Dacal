<?php

require "./sessao/sessao.php";
include './carregarApiIbge/carregarApiNosPerfis.php';

$sessaoCliente = new Sessao();

$usuarioAutenticado = $sessaoCliente->getValorSessao('tipoConta');

if ($usuarioAutenticado !== "cliente") {
    // O usuário autenticado que não for admin, será direcionado para a página de acesso não permitido.
    if ($usuarioAutenticado === "admin" or $usuarioAutenticado === "funcionario") {
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
    <link rel="stylesheet" href="../CSS/perfilEmpresa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
            <div class="geral" data-id-cliente="<?php echo $sessaoCliente->getValorSessao('idCliente'); ?>">
                <p id="tituloInfo">Informações da Conta</p>
                <div class="infoConta">
                    <div class="dadosGerais">
                        <p id="titulo">Dados da Conta</p>
                        <form action="./edicoesDeDadosCliente/editarInfoGeraisCliente.php" method="POST" class="formDados">
                            <input type="hidden" name="idCliente" id="idCliente" value="<?php $sessaoCliente->getValorSessao('idCliente')?>">
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Razão Social</p>
                                    <input type="text" id="razaoSocial" name="razaoSocial" required class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>CNPJ da Empresa</p>
                                    <input type="text" id="cnpjEmpresa" name="cnpjEmpresa" maxlength="14" required class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Nome Fantasia</p>
                                    <input type="text" id="nomeFantasia" name="nomeFantasia" required class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Inscrição Estadual</p>
                                    <input type="text" id="inscricaoEstadual" required name="inscricaoEstadual" class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="telefone" name="telefone" required class="input">
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
                                    <input type="text" id="logradouro" name="logradouro" required class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>Nº</p>
                                    <input type="text" id="numeroEndereco" name="numeroEndereco" required class="input">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Bairro</p>
                                    <input type="text" id="bairro" name="bairro" required class="input">
                                </div>
                                <div class="parteGeral">
                                    <p>CEP</p>
                                    <input type="text" id="cep" name="cep" required class="input">
                                </div>
                            </div>
                            <div class="btn">
                                <button type="submit" id="btnSalvar">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                    <div class="alterarDados">
                        <form action="./edicoesDeDadosCliente/editarEmailCliente.php" method="POST" class="alterarEmail">
                            <p class="tituloAlterar">E-mail</p>
                            <input type="hidden" name="idClienteEmail" id="idClienteEmail">
                            <input type="email" id="trocarEmail" name="email" required class="input">
                            <button type="submit" id="btnLogin">Alterar E-mail</button>
                        </form>
                        <form action="./edicoesDeDadosCliente/editarSenhaCliente.php" method="POST" class="alterarSenha">
                            <p class="tituloAlterar">Senha</p>
                            <input type="hidden" name="idClienteSenha" id="idClienteSenha">
                            <input type="password" id="trocarSenha" name="senha" required class="input">
                            <button type="submit" id="btnLogin">Alterar Senha</button>
                        </form>
                        <div class="btnApagarConta">
                            <button type="submit" id="btnApagar">
                                <img src="../IMAGENS/HomeEmpresa/imgLixeira.png" id="imgApagar">
                                <p id="infoBtn">Apagar Conta</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarCliente_adm/enviarFormulario.js"></script>
    <script src="../JS/scriptsApi/ibge.js"></script>
    <script src="../JS/scriptsParaCliente.js/carregarDadosCliente.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>