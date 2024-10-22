<?php
require "../sessao/sessao.php";
require_once "../entidades/orcamento.php";
require "../entidades/produto.php";

$sessaoCliente = new Sessao();
$orcamento_serializado = $sessaoCliente->getValorSessao('orcamento');

header('Content-Type: application/json');

if ($orcamento_serializado && is_string($orcamento_serializado)) {
    // Assegure que a classe está carregada antes da deserialização
    if (class_exists('Orcamento')) {
        $orcamento = unserialize($orcamento_serializado);
    } else {
        $orcamento = new Orcamento();
    }
} else {
    $orcamento = new Orcamento();
}

$response = [];

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
            'imagem' => base64_encode($produto->getImagem()),
            'quantidade' => $quantidade,
            'valor' => $produto->getValor(),
        ];
    }

    $response['produtos'] = $produtos;
    $response['total'] = $total;
    $response['quantidadeTotal'] = $quantidadeTotal;
}

echo json_encode($response);
?>
