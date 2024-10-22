<?php
    require_once '../conexaoBD/conexaoBD.php';
    require_once '../entidades/produto.php';
    require_once '../entidades/orcamento.php';
    require_once "../sessao/sessao.php";

    header('Content-Type: application/json'); // Certifique-se de que a resposta é JSON
    $sessaoFuncionario = new Sessao();
    $response = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {

        try {

            $produto = new Produto();
            $produto->setId($_POST['produto_id']);
            $produto->setNome($_POST['nomeProduto']);
            $produto->setValor($_POST['valorProduto']);
            $produto->setImagem(base64_decode($_POST['imagemProduto']));
            $produto->setCategoria($_POST['categoriaProduto']);
            $quantidade = $_POST['quantidade'];

            $orcamento_serializado = $sessaoFuncionario->getValorSessao('orcamento');

            if ($orcamento_serializado && is_string($orcamento_serializado)) {

                $orcamento = unserialize($orcamento_serializado);

            } else {

                $orcamento = new Orcamento();

            }

            $orcamento->adicionarProduto($produto, $quantidade);
            $sessaoFuncionario->setChaveEValorSessao('orcamento', serialize($orcamento));

            $response['success'] = true;
            $response['message'] = 'Produto adicionado ao orçamento!';

        } catch (Exception $erro) {

            $response['success'] = false;
            $response['message'] = 'Erro ao adicionar produto: ' . $e->getMessage();
            
        }

    } else {

        $response['success'] = false;
        $response['message'] = 'Requisição inválida.';

    }

    echo json_encode($response);

