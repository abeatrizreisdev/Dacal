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

    $crudProduto = new CrudProduto($conexao);

    if (isset($_GET['categoria_id'])) {

        $categoria_id = $_GET['categoria_id'];

        $produtos = $crudProduto->buscarProdutosPorCategoria($categoria_id);

        if ($produtos) {

            foreach ($produtos as $produto) {

                $imagem_base64 = base64_encode($produto['imagemProduto']); // Converte o BLOB em base64
                echo "<div>";
                echo "<img src='data:image/png;base64," . $imagem_base64 . "' alt='" . "'>";
                echo "</div>";
            }
        } else {
            echo "<div>Nenhum produto encontrado para esta categoria.</div>";
        }
        
    }

?>
