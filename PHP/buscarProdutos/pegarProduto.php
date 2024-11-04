<?php

    require_once '../conexaoBD/conexaoBD.php';
    require_once '../conexaoBD/configBanco.php';
    require_once '../crud/crudProduto.php';
    require_once '../sessao/sessao.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco

    $sessao = new Sessao();
    $crudProduto = new CrudProduto($conexao);

    header('Content-Type: application/json');

    $contaAutenticada = $sessao->getValorSessao('tipoConta');

    if (isset($_GET['id'])) {
        $produto_id = $_GET['id'];
        $resultadoBuscaDoProduto = $crudProduto->buscarInfoProduto($produto_id);

        if ($resultadoBuscaDoProduto) {

            // Adicionar o tipo de conta ao resultado
            $resultadoBuscaDoProduto['contaAutenticada'] = $contaAutenticada;
            echo json_encode($resultadoBuscaDoProduto);

        } else {

            echo json_encode(['error' => 'Produto não encontrado.']);

        }

    } else {

        echo json_encode(['error' => 'ID do produto não fornecido.']);

    }
?>
