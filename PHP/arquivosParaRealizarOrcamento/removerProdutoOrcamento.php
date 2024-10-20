<?php
require '../sessao/sessao.php';
require '../entidades/orcamento.php';
require '../entidades/produto.php';

$sessao = new Sessao();
$data = json_decode(file_get_contents('php://input'), true);

header('Content-Type: application/json'); // Assegure-se de que o cabeçalho da resposta seja JSON

if ($data && isset($data['produtoId'])) {
    $produtoId = $data['produtoId'];
    $orcamento_serializado = $sessao->getValorSessao('orcamento');
    if ($orcamento_serializado && is_string($orcamento_serializado)) {
        $orcamento = unserialize($orcamento_serializado);
        $orcamento->removerProduto($produtoId);
        $sessao->setChaveEValorSessao('orcamento', serialize($orcamento));
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Orçamento não encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}
?>
