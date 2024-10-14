<?php

require "./sessao/sessao.php";

$sessaoCliente = new Sessao();


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
    <link rel="stylesheet" href="../CSS/perfilEmpresa.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="homeEmpresa.php">Homepage</li></a>
            <li><a href="catalogoProdutos.php">Catálogo</li></a>
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
                    <p id="nomeEmpresa"> <?php echo $sessaoCliente->getValorSessao('nomeEmpresa'); ?> </p>
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
            <a class="abas" href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">
                <img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Atendimento</p>
                    <p class="descricaoAbas">Precisando de ajuda?</p>
                    <p class="descricaoAbas">Clique aqui..</p>
                </div>
            </a>
        </div>
        <div class="quadrado">
            <div class="geral">
                <p id="tituloInfo">Informações da Conta</p>
                <div class="infoConta">
                    <div class="dadosGerais">
                        <p id="titulo">Dados da Conta</p>
                        <form action="#" method="" class="formDados">
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>CNPJ da Empresa</p>
                                    <input type="text" id="cnpjEmpresa" name="cnpjEmpresa" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('cnpj') ?>">
                                </div>
                                <div class="parteGeral">
                                    <p>Razão Social</p>
                                    <input type="text" id="razaoSocial" name="razaoSocial" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('razaoSocial'); ?>">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Inscrição Estadual</p>
                                    <input type="text" id="inscricaoEstadual" name="inscricaoEstadual" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('inscricaoEstadual'); ?>">
                                </div>
                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="telefone" name="telefone" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('telefone'); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="endereço">
                                <p id="">Endereço</p>
                                <input type="text" id="estado" name="estado" class="inputAPI">
                                <input type="text" id="municipio" name="municipio" class="inputAPI">
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Logradouro</p>
                                    <input type="text" id="logradouro" name="logradouro" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('logradouro'); ?>">
                                </div>
                                <div class="parteGeral">
                                    <p>Nº</p>
                                    <input type="text" id="numeroEndereco" name="numeroEndereco" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('numeroEndereco'); ?>">
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Bairro</p>
                                    <input type="text" id="bairro" name="bairro" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('bairro'); ?>">
                                </div>
                                <div class="parteGeral">
                                    <p>CEP</p>
                                    <input type="text" id="cep" name="cep" class="input"
                                        value="<?php echo $sessaoCliente->getValorSessao('cep'); ?>">
                                </div>
                            </div>
                            <div class="btn">
                                <br>
                                <button type="submit" id="btnSalvar">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                    <div class="alterarDados">
                        <form action="./edicoesDeDadosCliente/editarEmailCliente.php" method="POST"
                            class="alterarEmail">
                            <p class="tituloAlterar">E-mail</p>
                            <input type="email" id="trocarEmail" name="email" class="input"
                                value="<?php echo $sessaoCliente->getValorSessao('email'); ?> ">
                            <button type="submit" id="btnLogin">Alterar E-mail</button>
                        </form>
                        <form action="./edicoesDeDadosCliente/editarSenhaCliente.php" method="POST"
                            class="alterarSenha">
                            <p class="tituloAlterar">Senha</p>
                            <input type="password" id="trocarSenha" name="senha" class="input"
                                value="<?php echo $sessaoCliente->getValorSessao('senha'); ?>">
                            <button type="submit" id="btnLogin">Alterar Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>