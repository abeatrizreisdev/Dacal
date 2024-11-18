<?php
require_once '../conexaoBD/conexaoBD.php';
require_once '../entidades/produto.php';
require_once '../entidades/orcamento.php';
require_once "../sessao/sessao.php";

header('Content-Type: application/json'); 
$sessaoFuncionario = new Sessao();
$resposta = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {

    try {

        $produto = new Produto();
        $produto->setId($_POST['produto_id']);
        $produto->setNome($_POST['nomeProduto']);
        $produto->setValor($_POST['valorProduto']);
        $produto->setImagem($_POST['imagemProduto']); // Usando o caminho relativo
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

        $resposta['sucesso'] = true;
        $resposta['mensagem'] = 'Produto adicionado ao orçamento!';

    } catch (Exception $erro) {

        $resposta['sucesso'] = false;
        $resposta['mensagem'] = 'Erro ao adicionar produto: ' . $erro->getMessage();
    }

} else {
    $resposta['sucesso'] = false;
    $resposta['mensagem'] = 'Requisição inválida.';
}

echo json_encode($resposta);
