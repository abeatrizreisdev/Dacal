<?php 

    require "./sessao/sessao.php";

    $sessao = new Sessao();

    $tipoContaAutenticada = $sessao->getValorSessao('tipoConta');

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
    <link rel="stylesheet" href="../CSS/catalogoProdutos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="<?php echo $tipoContaAutenticada == 'admin'? 'homeAdm.php' : 'homeFuncionario.php'; ?>">Homepage</li></a>
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
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php echo $sessao->getValorSessao('nome'); ?> </p>
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
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>

            <?php 

                if ($tipoContaAutenticada == "admin") {
                   echo '<br>';
                   echo '<a class="abas" href="./visualizarContasCadastradas.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">';
                    echo '<p class="tituloAbas"> Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar contas</p>
                    <p class="descricaoAbas">funcionários e empresas</p>
                </div>';
                echo '</a>';
                }

            ?>
            
        </div>
        <section class="quadrado">
            
            <nav>
                <ul class="containerCategorias">
                    <li><a href="#" onclick="carregarProdutos(1)">Móveis</a></li>
                    <li><a href="#" onclick="carregarProdutos(2)">Cadeiras</a></li>
                    <li><a href="#" onclick="carregarProdutos(3)">Cozinha</a></li>
                    <li><a href="#" onclick="carregarProdutos(4)">Utensílios</a></li>
                    <li><a href="#" onclick="carregarProdutos(5)">Aparelhos</a></li>
                </ul>
            </nav>
            
            <div id="containerProdutos">
                <!-- Produtos serão carregados aqui -->
            </div>
           
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/verificarStatusCadastroProduto.js"></script>
    <script src="../JS/carregarProdutos.js"></script>

</body>

</html>