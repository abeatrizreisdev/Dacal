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
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao();

    $sessao = new Sessao();
    $crudProduto = new CrudProduto($conexao);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    if (isset($_GET['categoria_id'])) {
        $categoria_id = $_GET['categoria_id'];
        $produtos = $crudProduto->buscarProdutosPorCategoria($categoria_id);
        
        $contaAutenticada = $sessao->getValorSessao('tipoConta');

        if (is_array($produtos) && count($produtos) > 0) {

            foreach ($produtos as &$produto) {

                // Garantir que a imagem do produto tenha o caminho relativo correto.
                $produto['imagemProduto'] = $produto['imagemProduto'];

            }

            // Adicionar o tipo de conta ao JSON retornado.
            $response = ['produtos' => $produtos, 'tipoConta' => $contaAutenticada];
            echo json_encode($response);

        } else {

            echo json_encode([]);

        }

    } else {

        echo json_encode([]);

    }

?>
