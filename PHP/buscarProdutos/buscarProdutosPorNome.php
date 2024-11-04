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

    if ($conexao->getConexao() === null) {
        echo json_encode(['error' => 'Erro na conexão com o banco de dados']);
        exit();
    }

    $sessao = new Sessao();
    $crudProduto = new CrudProduto($conexao);

    $resposta = array();

    if (isset($_GET['produtoNome'])) {
        $nomeProduto = $_GET['produtoNome'];

        $produtos = $crudProduto->buscarProdutosPorNome($nomeProduto);

        if ($produtos) {

            foreach ($produtos as &$produto) {

                $produto['imagemProduto'] = $produto['imagemProduto'];

                // Sanitiza dados para garantir que sejam codificados em UTF-8.
                $produto = array_map('utf8_encode', $produto);

            }

            $resposta['produtos'] = $produtos;
            $resposta['tipoConta'] = $sessao->getValorSessao('tipoConta');

        } else {

            $resposta['erro'] = "Nenhum produto encontrado com este nome.";

        }

    } else {

        $resposta['erro'] = "Valor do nome do produto inválido.";

    }

    // Limpa o buffer de saída para evitar conteúdo inesperad.o
    if (ob_get_length()) ob_clean();

    header('Content-Type: application/json');

    $jsonResposta = json_encode($resposta);

    // Verifica se o JSON está sendo gerado corretamente
    if ($jsonResposta === false) {

        $jsonErro = json_last_error_msg();
        echo json_encode(['error' => 'Erro ao gerar JSON: ' . $jsonErro]);
        exit();

    }

    echo $jsonResposta;
    
?>
