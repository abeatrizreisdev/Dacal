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
            <li><a href="">Homepage</li></a>
            <li><a href="">Catálogo</li></a>
            <li><a href="">Sobre Nós</li></a>
        </ul>

        <ul class="icons">
            <button class="sair" href="../IMAGENS/Homepage/logoDacal.png">
                <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
            </button>
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
                    <p>Bem vinda,</p>
                    <p id="nomeEmpresa">EMPRESA FANTASIA</p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Orçamentos</p>
                    <p class="descricaoAbas">Confira todos os seus</p>
                    <p class="descricaoAbas">orçamentos.</p>

                </div>
            </a>
            <br>
            <a class="abas">
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
            <div class="infoConta">
                <div class="dadosGerais">
                    <p id="titulo">Dados da Conta</p>
                    <form class="formDados">
                        <div class="infoGerais">
                            <div class="parteGeral">
                            <p>CNPJ da Empresa</p>
                            <input type="password" id="trocarSenha" name="senha" class="input">
                        </div>
                        <div class="parteGeral">
                            <p>Razão Social</p>
                            <input type="password" id="trocarSenha" name="senha" class="input">
                        </div>
                        </div>
                        <div class="Endereço">
                            
                        </div>
                        <button type="submit" id="btnLogin">Salvar Alterções</button>
                    </form>
                </div>
                <div class="alterarDados">
                    <div class="alterarEmail">
                        <p class="tituloAlterar">E-mail</p>
                        <input type="password" id="trocarSenha" name="senha" class="input">
                        <button type="submit" id="btnLogin">Alterar E-mail</button>
                    </div>
                    <div class="alterarSenha">
                        <p class="tituloAlterar">Senha</p>
                        <input type="password" id="trocarSenha" name="senha" class="input">
                        <button type="submit" id="btnLogin">Alterar Senha</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

</body>

</html>