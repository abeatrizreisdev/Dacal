<?php 

require "./sessao/sessao.php";
require_once "./entidades/orcamento.php";
require "./entidades/produto.php";

$sessaoCliente = new Sessao();

function exibirOrcamento() {

    global $sessaoCliente;
    $orcamento_serializado = $sessaoCliente->getValorSessao('orcamento');
    
    if ($orcamento_serializado && is_string($orcamento_serializado)) {
        error_log("Unserializing orcamento: $orcamento_serializado");
        $orcamento = unserialize($orcamento_serializado);
    } else {
        error_log("Orcamento not found or not a serialized string. Creating new Orcamento.");
        $orcamento = new Orcamento();
    }

    if (empty($orcamento->getProdutos())) {
        echo '<p>Nenhum produto adicionado ao orçamento.</p>';
        return;
    }

    $total = 0;
    $quantidadeTotal = 0;
    foreach ($orcamento->getProdutos() as $produto) {

        $quantidade = $orcamento->getQuantidadeProdutos()[$produto->getId()];
        $total += $produto->getValor() * $quantidade;
        $quantidadeTotal += $quantidade;
        $imagem_base64 = base64_encode($produto->getImagem());

        echo "<div class='produto' id='produto-" . $produto->getId() . "'>
                <p class='produto-nome'>Produto: " . htmlspecialchars($produto->getNome()) . "</p>
                <p class='produto-categoria'>Categoria: " . htmlspecialchars($produto->getCategoria()) . "</p>
                <img class='produto-imagem' src='data:image/jpeg;base64," . $imagem_base64 . "' alt='Produto'>
                <p class='produto-quantidade'>
                    Quantidade: 
                    <button type='button' onclick='alterarQuantidade(" . $produto->getId() . ", -1)'>-</button>
                    <input type='number' name='quantidades[]' data-produto-id='" . $produto->getId() . "' value='" . htmlspecialchars($quantidade) . "' min='1' readonly>
                    <button type='button' onclick='alterarQuantidade(" . $produto->getId() . ", 1)'>+</button>
                </p>
                <p class='produto-valor'>Valor unitário: R$ <span class='valor'>" . htmlspecialchars($produto->getValor()) . "</span></p>
                <button class='btn-remover' onclick=\"removerProduto('" . $produto->getId() . "')\">Remover Produto</button>
                <button class='btn-visualizar' onclick=\"visualizarProduto('" . $produto->getId() . "')\">Visualizar Produto</button>
              </div>";

    }

    echo "<h3>Total: R$ <span id='total'>" . htmlspecialchars($total) . "</span></h3>";
    echo "<h3>Quantidade Total de Itens: <span id='quantidadeTotal'>" . htmlspecialchars($quantidadeTotal) . "</span></h3>";

}




?>