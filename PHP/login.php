<?php

require './sessao/sessao.php';

    $sessao = new Sessao();
    $erro = $sessao->getValorSessao('erro');
    $sessao->excluirChaveSessao('erro'); // Remove a mensagem de erro após exibi-la

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
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<script>
    function metodosLogin(type) {
        const loginEmpresa = document.getElementById('loginEmpresa');
        const loginFuncionario = document.getElementById('loginFuncionario');
        if (type === 'empresa') {
            loginEmpresa.style.display = 'block';
            loginFuncionario.style.display = 'none';
            cadastroOpcao.style.display = 'block';
        } else {
            loginEmpresa.style.display = 'none';
            loginFuncionario.style.display = 'block';
            cadastroOpcao.style.display = 'none';
        }
    }
</script>
<php? 

function entradaBanco{ 
    if (metodosLogin='empresa' ){ 

    }else{

     } 
}

?>
    <header>

    </header>

    <body>
        <div id="homeGeral">
            <img src="../IMAGENS/Homepage/imagemDacalF.png" id="imagemInicial">
            <form action="" class="formularioLogin">
                <img src="../IMAGENS/Homepage/logoDacal.png" id="logoDacal" alt="logoDacal">
                <h1 id="titulo">Tipo de Acesso</h1>
                <div class="container">
                    <a class="btn" href="#" onclick="metodosLogin('empresa')">Empresa</a>
                    <a class="btn" href="#" onclick="metodosLogin('funcionario')">Funcionário</a>
                </div>
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
                    <p id="cadastroOpcao" style="display:'block';">Ainda não tem conta? <a id="cadastro"
                            href="#">Cadastre-se Aqui.</a></p>
                </div>
                <br>
                <button type="submit" id="btnLogin">Login</button>
            </form>
        </div>
    </body>


    <footer id="footer">
    </footer>

</html>