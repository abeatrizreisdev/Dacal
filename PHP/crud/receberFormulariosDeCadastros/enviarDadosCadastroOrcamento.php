<?php
require '../conexaoBD/conexaoBD.php';
require '../sessao/sessao.php';
require '../crud/crudOrcamento.php';

$sessao = new Sessao();
$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco

$crudOrcamento = new CrudOrcamento($conexao);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $produtos = $_POST['produtos'] ?? [];
    $quantidades = $_POST['quantidades'] ?? [];
    $valores = $_POST['valores'] ?? [];
    $produtoIds = $_POST['produtoIds'] ?? [];
    $valorTotal = $_POST['valorTotal'] ?? 0;
    $idCliente = $sessao->getValorSessao('idCliente'); // Obtendo ID do cliente da sessão
    $razaoSocial = $sessao->getValorSessao('razaoSocial'); // Obtendo ID do cliente da sessão
    $cnpj = $sessao->getValorSessao('cnpj'); // Obtendo ID do cliente da sessão
    $inscricaoEstadual = $sessao->getValorSessao('inscricaoEstadual'); // Obtendo ID do cliente da sessão
    $telefone = $sessao->getValorSessao('telefone'); // Obtendo ID do cliente da sessão
    $email = $sessao->getValorSessao('email'); // Obtendo ID do cliente da sessão
    $logradouro = $sessao->getValorSessao('logradouro'); // Obtendo ID do cliente da sessão
    $bairro = $sessao->getValorSessao('bairro'); // Obtendo ID do cliente da sessão
    $cep = $sessao->getValorSessao('cep'); // Obtendo ID do cliente da sessão
    $estado = $sessao->getValorSessao('estado'); // Obtendo ID do cliente da sessão
    $municipio = $sessao->getValorSessao('municipio'); // Obtendo ID do cliente da sessão
    $numeroEndereco = $sessao->getValorSessao('numeroEndereco'); // Obtendo ID do cliente da sessão

    // Calcula a quantidade total de produtos
    $quantidadeTotal = array_sum($quantidades);

    // Criar o objeto Orcamento
    $orcamento = [
        'idCliente' => $idCliente,
        'valorOrcamento' => $valorTotal,
        'dataCriacao' => date('Y-m-d'), // Data atual
        'status' => 'pendente'
    ];



    // Inserir o orçamento na tabela Orcamentos
    $orcamentoId = $crudOrcamento->cadastrarOrcamento($orcamento);

    /* 
    if ($orcamentoId) {
        // Inserir itens do orçamento na tabela itens_orcamento
        $stmtItem = $conexao->getConexao()->prepare("INSERT INTO itens_orcamento (numeroOrcamento, idProduto, quantidade) VALUES (?, ?, ?)");
        foreach ($produtoIds as $index => $produtoId) {
            $quantidade = $quantidades[$index];
            $stmtItem->bind_param("iii", $orcamentoId, $produtoId, $quantidade);
            $stmtItem->execute();
        }

        echo '<h2>Orçamento enviado com sucesso!</h2>';
        echo '<p>Produtos:</p><ul>';
        foreach ($produtos as $index => $produto) {
            echo '<li>' . htmlspecialchars($produto) . ' - Quantidade: ' . htmlspecialchars($quantidades[$index]) . ' - Valor: R$ ' . htmlspecialchars($valores[$index]) . '</li>';
        }
        echo '</ul>';
        echo '<p>Valor Total: R$ ' . htmlspecialchars($valorTotal) . '</p>';
    } else {
        echo '<p>Erro ao enviar o orçamento.</p>';
    } */
} else {
    echo '<p>Método de requisição inválido.</p>';
}
?>
