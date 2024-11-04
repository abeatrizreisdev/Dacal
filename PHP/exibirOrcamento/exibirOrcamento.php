<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../sessao/sessao.php";
require_once "../entidades/orcamento.php";
require "../entidades/produto.php";

$sessaoCliente = new Sessao();
$orcamento_serializado = $sessaoCliente->getValorSessao('orcamento');

header('Content-Type: application/json');

$response = [];

try {
    if ($orcamento_serializado && is_string($orcamento_serializado)) {
        if (class_exists('Orcamento')) {
            $orcamento = unserialize($orcamento_serializado);
            if ($orcamento === false) {
                throw new Exception('Falha na deserialização.');
            }
        } else {
            throw new Exception('Classe Orcamento não encontrada.');
        }
    } else {
        $orcamento = new Orcamento();
    }

    if (empty($orcamento->getProdutos())) {
        $response['message'] = 'Nenhum produto adicionado ao orçamento.';
    } else {
        $produtos = [];
        $total = 0;
        $quantidadeTotal = 0;

        foreach ($orcamento->getProdutos() as $produto) {
            $quantidade = $orcamento->getQuantidadeProdutos()[$produto->getId()];
            $total += $produto->getValor() * $quantidade;
            $quantidadeTotal += $quantidade;

            $produtos[] = [
                'id' => $produto->getId(),
                'nome' => $produto->getNome(),
                'categoria' => $produto->getCategoria(),
                'imagem' => $produto->getImagem(), 
                'quantidade' => $quantidade,
                'valor' => $produto->getValor(),
            ];
        }

        $response['produtos'] = $produtos;
        $response['total'] = $total;
        $response['quantidadeTotal'] = $quantidadeTotal;
    }

    echo json_encode($response);
} catch (Exception $e) {
    $response['message'] = 'Erro: ' . $e->getMessage();
    echo json_encode($response);
    exit;
}
?>
