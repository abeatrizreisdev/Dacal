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

<header>

</header>


<body>
    <div id="homeGeral">
        <img src="../IMAGENS/Homepage/imagemDacalF.png" id="imagemInicial">
        <form action="" class="formularioLogin">
            <img src="../IMAGENS/Homepage/logoDacal.png" id="logoDacal" alt="logoDacal">
            <h1 id="titulo">Tipo de Acesso</h1>
            </br>
            <div class="container">
                <a class="btnAtivado" href="../PHP/loginEmpresa.php">Empresa</a>
                <a class="btn" href="../PHP/loginFuncionario.php">Funcionário</a>
            </div>
            </br>
            <div class="formularioInterior">
                <p class="formularioNomes">CNPJ</p>
                <input type="text" id="cnpj" name="cnpj" class="input">
                <p class="formularioNomes">Senha</p>
                <input type="password" id="senha" name="senha" class="input">
                <p>Ainda não tem conta? <a id="cadastro" href="#">Cadastre-se Aqui.</a></p>
            </div>
            </br>
            </br>
            <button type="submit" id="btnLogin">Login</button>
        </form>
    </div>
</body>
<footer id="footer">
</footer>
</html>