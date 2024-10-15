<?php
require '../conexaoBD/conexaoBD.php';
require "../crud/crudProduto.php";
require "../conexaoBD/configBanco.php";
require "../entidades/produto.php";
require "../entidades/orcamento.php";
require "../sessao/sessao.php";

// Configurações do banco de dados
$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco

$sessao = new Sessao();

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];
    $crudProduto = new CrudProduto($conexao);
    $resultadoBuscaDoProduto = $crudProduto->buscarInfoProduto($produto_id);
    if ($resultadoBuscaDoProduto) {
        // Exibir as informações do produto
        echo "<h2>" . htmlspecialchars($resultadoBuscaDoProduto['nomeProduto']) . "</h2>";
        echo "<p>" . htmlspecialchars($resultadoBuscaDoProduto['descricaoProduto']) . "</p>";
        echo "<img src='data:image/png;base64," . base64_encode($resultadoBuscaDoProduto['imagemProduto']) . "' alt='Produto'>";
        echo "<p> R$ " . htmlspecialchars($resultadoBuscaDoProduto['valorProduto']) . " </p>";
        echo "<a href='../realizarOrcamento.php'><button>Voltar para o Catálogo</button></a>";

        // Formulário para adicionar o produto ao orçamento
        echo "<form method='post'>";
        echo "<input type='hidden' name='produto_id' value='" . htmlspecialchars($produto_id) . "'>";
        echo "<input type='hidden' name='nomeProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['nomeProduto']) . "'>";
        echo "<input type='hidden' name='valorProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['valorProduto']) . "'>";
        echo "<input type='hidden' name='imagemProduto' value='" . base64_encode($resultadoBuscaDoProduto['imagemProduto']) . "'>"; // Passando a imagem como BLOB
        echo "<input type='hidden' name='categoriaProduto' value='" . htmlspecialchars($resultadoBuscaDoProduto['categoria']) . "'>";
        echo "<label for='quantidade'>Quantidade:</label>";
        echo "<input type='number' id='quantidade' name='quantidade' value='1' min='1' required>";
        echo "<button type='submit' name='adicionar'>Adicionar</button>";
        echo "</form>";
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
    $produto->setImagem(base64_decode($_POST['imagemProduto'])); // Decodificando a imagem de volta para BLOB
    $produto->setCategoria($_POST['categoriaProduto']);
    $quantidade = $_POST['quantidade'];

    $orcamento_serializado = $sessao->getValorSessao('orcamento');
    if ($orcamento_serializado && is_string($orcamento_serializado)) {
        error_log("Unserializing orcamento: $orcamento_serializado"); // Logging
        $orcamento = unserialize($orcamento_serializado);
    } else {
        error_log("Orcamento not found or not a serialized string. Creating new Orcamento."); // Logging
        $orcamento = new Orcamento();
    }

    $orcamento->adicionarProduto($produto, $quantidade);
    $sessao->setChaveEValorSessao('orcamento', serialize($orcamento));
    echo "<p>Produto adicionado ao orçamento.</p>";
}

?>
