<?php

require '../sessao/sessao.php';
require '../conexaoBD/conexaoBD.php';
require "../crud/crudProduto.php";
require "../conexaoBD/configBanco.php";
require "../entidades/produto.php";
require "../entidades/orcamento.php";


$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao();

$sessaoFuncionario = new Sessao();

$verificarUsuarioAutenticado = $sessaoFuncionario->getValorSessao('tipoConta');


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
    <link rel="stylesheet" href="../../CSS/detalhesProduto.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
</head>
<body class="fundo">
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>
    <nav class="nav-superior">
        <img class="logoDacal" src="../../IMAGENS/Homepage/logoDacal.png">
        <ul class="nav-list">
            <li><a href="<?php echo $verificarUsuarioAutenticado == 'admin' ? '../homeAdm.php' : ($verificarUsuarioAutenticado == 'funcionario' ? '../homeFuncionario.php' : '../homeEmpresa.php'); ?>">Homepage</li></a>
            <li><a href="../catalogoProdutos.php">Catálogo</li></a>
            <li><a href="">Sobre Nós</li></a>
        </ul>
        <ul class="icons">
            <a href="../autenticacao/logout.php">
                <button class="sair" href="../../IMAGENS/Homepage/logoDacal.png">
                <img src="../../IMAGENS/HomeEmpresa/sair.png" class="sair">
            </button>
            </a>
        </ul>
    </nav>
</header>
<div class="homepage">
    <div class="menu">
        <br>
        <br>
        <a class="abas">
            <img src="../../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
            <div id="info">
                <p>Bem-vindo(a),</p>
                <p id="nomeEmpresa"><?php echo $sessaoFuncionario->getValorSessao('nome'); ?></p>
                <button class="sairInfo" href="">
                    <img src="../../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                </button>
            </div>
        </a>
        <br>
        <hr id="linhaMenu">
        <br>
        <a class="abas" href="./perfilFuncionario.php">
            <img src="../../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
            <div id="info">
                <p class="tituloAbas">Meu Perfil</p>
                <p class="descricaoAbas">Visualize e altere seus</p>
                <p class="descricaoAbas">dados.</p>
            </div>
        </a>

        <?php 

            // Se a conta autenticada for um cliente, então vai renderizar as opções de "Orcamento" "Atendimento" na esquerda da tela.
            if (!$verificarUsuarioAutenticado == "admin" or !$verificarUsuarioAutenticado == "funcionario") {


                echo '<br> 
                    <a class="abas" href="./orcamentosEmpresa.php">
                        <img src="../../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">
                    <div id="info">
                        <p class="tituloAbas">Orçamentos</p>
                        <p class="descricaoAbas">Confira todos os seus</p>
                        <p class="descricaoAbas">orçamentos.</p>
                    </div>
                    </a>
                    <br>
                    <a class="abas" href="https://whatsa.me/5571996472678/?t=Vim%20pelo%20site%20DACAL.%20Preciso%20de%20ajuda!">
                        <img src="../../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">
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
        <?php

        // Exibição dos detalhes do produto
        if (isset($_GET['id'])) {

            $produto_id = $_GET['id'];
            $crudProduto = new CrudProduto($conexao);
            $resultadoBuscaDoProduto = $crudProduto->buscarInfoProduto($produto_id);

            if ($resultadoBuscaDoProduto) {

                echo "<div class='containerDetalhesProduto'>";
    echo "<div class='containerImagemProduto'>";
    echo "<img src='data:image/png;base64," . base64_encode($resultadoBuscaDoProduto['imagemProduto']) . "' alt='Produto' class='imagemProduto'>";
    echo "</div>";
    echo "<div class='containerInfoProduto'>";
    echo "<h2 class='tituloProduto'>" . htmlspecialchars($resultadoBuscaDoProduto['nomeProduto']) . "</h2>";
    echo "<div class='containerDescricaoValor'>";
    echo "<p class='valorProduto'>R$ " . htmlspecialchars($resultadoBuscaDoProduto['valorProduto']) . "</p>";
    echo "<p class='descricaoProduto'>" . htmlspecialchars($resultadoBuscaDoProduto['descricaoProduto']) . "</p>";
    echo "</div>";
            

                switch ($verificarUsuarioAutenticado) {

                    case !'admin' or !'funcionario':

                        echo "<form method='post' class='formOrcamento' id='formOrcamento'>";
                        echo "<div class='inputQuantidadeContainer'>";
                        echo "<label for='quantidade' class='labelQuantidade'>Adcionar no orçamento:</label>";
                        echo "<button type='button' class='quantidadeBtn' id='quantidadeMenos'>-</button>";
                        echo "<input type='number' id='quantidade' name='quantidade' value='1' min='1' required>";
                        echo "<button type='button' class='quantidadeBtn' id='quantidadeMais'>+</button>";
                        echo "</div>";
                        echo "<input type='hidden' id='quantidadeFinal' name='quantidadeFinal' value='1'>";
                        echo "<input type='hidden' name='produto_id' value='" . htmlspecialchars($produto_id) . "'>";
                        echo "<input type='hidden' name='nomeProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['nomeProduto']) . "'>";
                        echo "<input type='hidden' name='valorProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['valorProduto']) . "'>";
                        echo "<input type='hidden' name='imagemProduto' value='" . base64_encode($resultadoBuscaDoProduto['imagemProduto']) . "'>";
                        echo "<input type='hidden' name='categoriaProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['categoria']) . "'>";
                        echo "</form>";
                                       
                }

                echo "</div>";
                echo "</div>";
                
                echo "<div class='containerBotoes'>";
                echo "<a href='../realizarOrcamento.php'><button class='botaoVoltar'>Voltar para o Catálogo</button></a>";
                
                // Botão "Adicionar" fora do container do produto

                switch ($verificarUsuarioAutenticado) {

                    case !'admin' or !'funcionario':

                        echo "<button type='submit' form='formOrcamento' name='adicionar' class='botaoAdicionar'>Adicionar</button>";
                
                        echo "</div>";

                }
                
                

            } else {

                echo "Produto não encontrado.";

            }

        } else {

            echo "ID do produto não fornecido.";

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {

            $produto = new Produto();
            $produto->setId($_POST['produto_id']);
            $produto->setNome($_POST['nomeProduto']);
            $produto->setValor($_POST['valorProduto']);
            $produto->setImagem(base64_decode($_POST['imagemProduto']));
            $produto->setCategoria($_POST['categoriaProduto']);
            $quantidade = $_POST['quantidade'];
            $orcamento_serializado = $sessaoFuncionario->getValorSessao('orcamento');

            if ($orcamento_serializado && is_string($orcamento_serializado)) {

                $orcamento = unserialize($orcamento_serializado);

            } else {

                $orcamento = new Orcamento();

            }

            $orcamento->adicionarProduto($produto, $quantidade);
            $sessaoFuncionario->setChaveEValorSessao('orcamento', serialize($orcamento));

            echo "
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
          <script>
            toastr.success('Produto adicionado ao orçamento!');
            setTimeout(function() {
                window.location.href = '../realizarOrcamento.php';
            }, 1500);
          </script>";

        }

        ?>
    </section>

    <script>
document.getElementById('quantidadeMenos').addEventListener('click', function() {
    var quantidade = document.getElementById('quantidade');
    if (quantidade.value > 1) {
        quantidade.value--;
        document.getElementById('quantidadeFinal').value = quantidade.value;
    }
});

document.getElementById('quantidadeMais').addEventListener('click', function() {
    var quantidade = document.getElementById('quantidade');
    quantidade.value++;
    document.getElementById('quantidadeFinal').value = quantidade.value;
});
</script>


</div>
</body>
</html>
