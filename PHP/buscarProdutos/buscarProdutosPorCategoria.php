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


                $idProduto = $produto['codigoProduto'];

                $imagem_base64 = base64_encode($produto['imagemProduto']); // Converte a imagem do produto que está salva no banco de dados no formato BLOB para base64.

                echo "<div class='produtoEspecifico'>";
                echo "<a class='linkDoProduto' href='./buscarProdutos/detalhesProduto.php?id=$idProduto'>" . "<img src='data:image/png;base64," . $imagem_base64 . "' alt='" . "'> </a>";
                echo "<a class='visualizarDetalhes' href='./buscarProdutos/detalhesProduto.php?id=$idProduto''>" . "<button>Visualizar Detalhes" . "</button>"  . "</a>";
                echo "</div>";

            }

        } else {

            echo "<div>Nenhum produto encontrado para esta categoria.</div>";

        }
        
    }

?>
