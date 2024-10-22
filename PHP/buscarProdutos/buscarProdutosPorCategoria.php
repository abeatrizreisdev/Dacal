<?php
require '../conexaoBD/conexaoBD.php'; 
require "../crud/crudProduto.php";
require "../conexaoBD/configBanco.php";
require "../sessao/sessao.php";

$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD( BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco.
$sessao = new Sessao();
$crudProduto = new CrudProduto($conexao);

// Habilitar exibição de erros na página
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//echo "DEBUG: Entrou no script PHP<br>";

if (isset($_GET['categoria_id'])) {
    $categoria_id = $_GET['categoria_id'];
   // echo "DEBUG: Categoria ID recebida: " . $categoria_id . "<br>";
    $produtos = $crudProduto->buscarProdutosPorCategoria($categoria_id);
    header('Content-Type: application/json');
    
    if (is_array($produtos) && count($produtos) > 0) {
        //echo "DEBUG: Produtos encontrados: " . count($produtos) . "<br>";
        // Codificar imagem em base64
        foreach ($produtos as &$produto) {
            $produto['imagemProduto'] = base64_encode($produto['imagemProduto']);
        }
        // Remova mensagens de depuração da resposta JSON
        echo json_encode($produtos);
    } else {
        //echo "DEBUG: Nenhum produto encontrado<br>";
        echo json_encode([]);
    }
} else {
   // echo "DEBUG: Nenhum ID de categoria fornecido<br>";
    echo json_encode([]);
}
?>
