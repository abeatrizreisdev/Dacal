<?php

require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();

$id = $sessaoFuncionario->getValorSessao('id');


$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');

if ($tipoContaAutenticada !== "funcionario") {
    // O usuário autenticado que não for admin, será direcionado para a página de acesso não permitido.
    if ($tipoContaAutenticada === "cliente" or $tipoContaAutenticada === "admin") {
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
    <link rel="stylesheet" href="../CSS/perfilFuncionario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
            <a class="abas" href="./homeFuncionario.php">
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
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>

        </div>
        <div class="quadrado">

            <div class="geral">
                <p class="tituloGeral">Informações da conta</p>
                <div class="infoConta">
                    <div class="dadosGerais" data-id-funcionario="<?php echo $id ?>">
                        <p id="subtitulo">Dados Gerais</p>
                        <form action="./editarFuncionario/edicoesGeraisFunc.php" method="post" class="formDados">

                            <input type="hidden" name="idGeral" id="idGeral">

                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Nome</p>
                                    <input type="text" id="nome" name="nome" class="input" required>
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>CPF</p>
                                    <input type="text" id="CPF" name="cpf" class="input" required>
                                </div>
                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="telefone" name="telefone" class="input" required>
                                </div>
                            </div>
                            <div class="endereco">
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
                                    <input type="text" id="numeroEndereco" name="numeroEndereco" class="input">
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
                        <form action="#" method="POST" class="alterarEmail">
                            <p class="tituloAlterar">E-mail</p>
                            <input type="hidden" name="idEmail" id="idEmail">
                            <input type="email" id="trocarEmail" name="email" required class="input">
                            <button type="submit" id="btnLogin">Alterar E-mail</button>
                        </form>
                        <form method="POST" class="alterarSenha">
                            <p class="tituloAlterar">Senha</p>
                            <input type="hidden" name="idSenha" id="idSenha">
                            <input type="password" id="trocarSenha" name="senha" required class="input">
                            <button type="submit" id="btnLogin">Alterar Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/perfilFuncionario/carregarDados.js"></script>
    <script src="../JS/scriptsApi/ibge.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>