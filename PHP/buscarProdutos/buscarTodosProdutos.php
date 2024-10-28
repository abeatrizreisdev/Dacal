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
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $sessao = new Sessao();
    $crudProduto = new CrudProduto($conexao);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    // Buscar todos os produtos.
    $produtos = $crudProduto->buscarTodosProdutos();
    $contaAutenticada = $sessao->getValorSessao('tipoConta');

    if (is_array($produtos) && count($produtos) > 0) {

        foreach ($produtos as &$produto) {

            $produto['imagemProduto'] = base64_encode($produto['imagemProduto']);

        }

        $response = ['produtos' => $produtos, 'tipoConta' => $contaAutenticada];
        echo json_encode($response);

    } else {

        echo json_encode([]);

    }

?>
