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
    <link rel="stylesheet" href="../CSS/perfilFuncionario.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="./homeFuncionario.php">Homepage</li></a>
            <li><a href="">Catálogo</li></a>
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
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            
        </div>
        <div class="quadrado">
            
            <div class="geral">
            <h1> Informações da conta </h1>
                <div class="infoConta">
                    <div class="dadosGerais">
                        <h2 id="subtitulo"> Dados gerais </h2>
                        <div action="#" method="" class="formDados">
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Nome</p>
                                    <input type="text" id="nome" name="nome" class="input" value="<?php echo $sessaoFuncionario->getValorSessao('nome') ?>" readonly>
                                </div>
                                <div class="parteGeral">
                                    <p>CPF</p>
                                    <input type="text" id="cpf" name="cpf" class="input" value="<?php echo $sessaoFuncionario->getValorSessao('cpf'); ?>" readonly>
                                </div>
                            </div>
                            <div class="infoGerais">
                                <div class="parteGeral">
                                    <p>Email</p>
                                    <input type="text" id="email" name="email" class="input" value="<?php echo $sessaoFuncionario->getValorSessao('email') ?>" readonly>
                                </div>
                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="telefone" name="telefone" class="input" value="<?php echo $sessaoFuncionario->getValorSessao('telefone'); ?>" readonly>
                                </div>
                                
                            </div>
                            <div class="endereco">
                                <p>Endereço</p>
                                <input type="text" id="endereco" name="endereco" class="inputEndereco" value="<?php echo $sessaoFuncionario->getValorSessao('logradouro') . ", " . $sessaoFuncionario->getValorSessao('bairro') . ", " . $sessaoFuncionario->getValorSessao('cidade') . "/" . $sessaoFuncionario->getValorSessao("estado") . ", " . $sessaoFuncionario->getValorSessao('cep'); ?>">
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>