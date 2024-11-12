<?php

    require 'PHP/sessao/sessao.php';

    $sessao = new Sessao();
    $erro = $sessao->getValorSessao('erro');
    $sessao->excluirChaveSessao('erro'); // Remove a mensagem de erro após exibi-la

    $funcionarioAutenticado = $sessao->getValorSessao('id');
    $clienteAutenticado = $sessao->getValorSessao('idCliente');

    if ($funcionarioAutenticado) {

        $tipoConta = $sessao->getValorSessao('tipoConta');

        if ($tipoConta == "admin") {

            header("Location: PHP/homeAdm.php");

        } elseif ($tipoConta == "funcionario") {

            header("Location: PHP/homeFuncionario.php");

        }

    } elseif ($clienteAutenticado) {
        header("Location: PHP/homeEmpresa.php");
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
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .selecionado {
            /* Cor de fundo do botão selecionado de login. */
            background-color: #f44f4f; 
        }
    </style>
</head>
<body>
    <div id="homeGeral">
        <img src="IMAGENS/Homepage/imagemDacalF.png" id="imagemInicial">
        <form action="" method="post" id="formLogin" class="formularioLogin">
            <img src="IMAGENS/Homepage/logoDacal.png" id="logoDacal" alt="logoDacal">
            <h1 id="titulo">Tipo de Acesso</h1>
            <div class="container">
                <a class="btn selecionado" href="#" onclick="metodosLogin('empresa', this)">Empresa</a>
                <a class="btn" href="#" onclick="metodosLogin('funcionario', this)">Funcionário</a>
            </div>
            <p><?php echo $erro; ?></p>
            <br>
            <div class="formularioInterior">
                <div id="loginEmpresa" style="display:block;">
                    <p class="formularioNomes">CNPJ</p>
                    <input type="text" id="cnpj" name="cnpj" class="input">
                </div>
                <div id="loginFuncionario" style="display:none;">
                    <p class="formularioNomes">CPF</p>
                    <input type="text" id="cpf" name="cpf" class="input">
                </div>
                <p class="formularioNomes">Senha</p>
                <input type="password" id="senha" name="senha" class="input">
                <p id="cadastroOpcao" style="display:block;">Ainda não tem conta?
                    <a id="cadastro" href="PHP/cadastroEmpresa.php">Cadastre-se Aqui.</a>
                </p>
            </div>
            <br>
            <button type="submit" id="btnLogin">Login</button>
        </form>
    </div>
    <footer id="footer">
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="JS/cadastrarCliente/statusCadastroCliente.js"></script>
    <script src="JS/login/selecaoDeLogin.js"></script>
</body>
</html>
