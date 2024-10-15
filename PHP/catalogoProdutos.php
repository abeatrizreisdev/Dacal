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
            <li><a href="<?php echo $tipoContaAutenticada == 'admin' ? 'homeAdm.php' : ($tipoContaAutenticada == 'funcionario' ? 'homeFuncionario.php' : 'homeEmpresa.php'); ?>">Homepage</li></a>
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
            <a class="abas" href="<?php echo $tipoContaAutenticada == 'admin' ? 'perfilADM.php' : ($tipoContaAutenticada == 'funcionario' ? 'perfilFuncionario.php' : 'perfilEmpresa.php'); ?>">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>

            <?php 

                // Já se a conta que está logada for adm, então aparecerá a opção de gerencia de contas que é a funcionalidade que só esse tipo de conta tem.
                if ($tipoContaAutenticada == "admin") {
                    echo '<br>
                    <a class="abas" href="./visualizarContasCadastradas.php">
                    <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                    <div id="info">
                        <p class="tituloAbas"> Gerenciar Contas</p>
                        <p class="descricaoAbas">Gerenciar funcionários</p>
                        <p class="descricaoAbas">e empresas</p>
                    </div>
                </a>';
                }

            ?>

            <?php 

                // Se a conta autenticada for um cliente, então vai renderizar as opções de "Orcamento" "Atendimento" na esquerda da tela.
                if (!$tipoContaAutenticada == "admin" or !$tipoContaAutenticada == "funcionario") {


                    echo '<br> 
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
                        </a>';

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
    <script src="../JS/scriptsParaPagCatalogoProdutos/verificarStatusCadastroProduto.js"></script>
    <script src="../JS/scriptsParaPagCatalogoProdutos/verificarStatusEdicaoProduto.js"></script>
    <script src="../JS/scriptsParaPagCatalogoProdutos/excluirProduto.js"></script>
    <script src="../JS/scriptsParaPagCatalogoProdutos/carregarProdutos.js"></script>

</body>

</html>