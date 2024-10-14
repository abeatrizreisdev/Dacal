<?php
require "../../conexaoBD/conexaoBD.php";
require "../crudProduto.php";
require "../../sessao/sessao.php";
require "../../entidades/produto.php";
require "../../conexaoBD/configBanco.php";

$conexao = new ConexaoBD();
$conexao->setHostBD(host: BD_HOST);
$conexao->setPortaBD(porta: BD_PORTA);
$conexao->setEschemaBD(eschema: BD_ESCHEMA);
$conexao->setSenhaBD(senha: BD_PASSWORD);
$conexao->setUsuarioBD(user: BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco.

$crudProduto = new CrudProduto($conexao);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = $_POST['idProduto'];
    $nomeProduto = $_POST['nomeProduto'];
    $valorProduto = floatval(str_replace(',', '.', $_POST['precoProduto']));
    $descricaoProduto = $_POST['descricaoProduto'];
    $categoriaProduto = $_POST['categoriaProduto'];

    // Verifica se o arquivo de imagem foi enviado e está sem erros
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemProduto = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        // Se nenhuma nova imagem foi enviada, mantenha a imagem atual
        $imagemProduto = base64_decode($_POST['imagemAtual']);
    }

    try {
        // Cria uma nova instância do Produto
        $produto = new Produto();
        
        // Define os atributos do produto
        $produto->setImagem($imagemProduto); // Armazena a imagem como BLOB
        $produto->setNome($nomeProduto);
        $produto->setValor($valorProduto);
        $produto->setDescricao($descricaoProduto);
        $produto->setCategoria($categoriaProduto);

        // Chamando o método de atualização do produto
        $resultadoEdicaoProduto = $crudProduto->editarProduto($idProduto, [
            'nomeProduto' => $produto->getNome(),
            'imagemProduto' => $produto->getImagem(),
            'valorProduto' => $produto->getValor(),
            'descricaoProduto' => $produto->getDescricao(),
            'categoria' => $produto->getCategoria()
        ]);

        if ($resultadoEdicaoProduto) {
            header("Location: ../../catalogoProdutos.php?statusEdicaoProduto=sucesso");
           exit();
        } else {
            header("Location: ../../catalogoProdutos.php?statusEdicaoProduto=erro");
            exit();
        }
    } catch (Exception $excecao) {
        header("Location: ../../catalogoProdutos.php?statusEdicaoProduto=erro");
        exit();
    }
} else {
    echo 'Requisição inválida.';
}
?>
