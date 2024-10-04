<?php

    require '../conexaoBD/conexaoBD.php'; 
    require "../crud/crudProduto.php";

    $conexao = new ConexaoBD();

    $conexao->setEschemaBD("dacal");
    $conexao->setHostBD("localhost");
    $conexao->setPortaBD(3306);
    $conexao->setEschemaBD("dacal");
    $conexao->setSenhaBD("96029958va");
    $conexao->setUsuarioBD("root");
    $conexao->getConexao(); 

    // Verifica se o ID do produto foi passado na URL.
    if (isset($_GET['id'])) {

        $produto_id = $_GET['id'];

        $crudProduto = new CrudProduto($conexao);

        $resultadoBuscaDoProduto = $crudProduto->buscarInfoProduto($produto_id);

        if ($resultadoBuscaDoProduto) {

            // Exiba as informações do produto
            echo "<h2>" . htmlspecialchars($resultadoBuscaDoProduto['nomeProduto']) . "</h2>";
            echo "<p>" . htmlspecialchars($resultadoBuscaDoProduto['descricaoProduto']) . "</p>";
            echo "<img src='data:image/png;base64," . base64_encode($resultadoBuscaDoProduto['imagemProduto']) . "' alt='Produto'>";
            echo "<p> R$ " . $resultadoBuscaDoProduto['valorProduto'] . " </p>";
            echo "<a> <button> Voltar para o Catálogo </button> </a>";
            echo "<a> <button> Adcionar </button> </a>";

        } else {

            echo "Produto não encontrado.";

        }

    } else {

        echo "ID do produto não fornecido.";

    }

?>
