<?php

    require '../conexaoBD/conexaoBD.php'; 
    require "../crud/crudProduto.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD( BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

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
