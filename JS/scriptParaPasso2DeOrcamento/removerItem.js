

console.log('realizarOrcamento.js carregado');

function removerProduto(produtoId) {
    console.log('Remover produto ID: ' + produtoId);
    fetch(`../PHP/arquivosParaRealizarOrcamento/removerProdutoOrcamento.php?produtoId=${produtoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ produtoId: produtoId })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            alert('Produto removido com sucesso!');
            location.reload(); // Recarrega a página para atualizar a lista de produtos
        } else {
            alert('Erro ao remover produto: ' + data.message);
        }
    })
    .catch(error => console.error('Erro ao remover produto:', error));
}


function alterarQuantidade(produtoId, delta) {
    const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);
    let quantidadeAtual = parseInt(inputQuantidade.value);
    quantidadeAtual += delta;
    if (quantidadeAtual < 1) quantidadeAtual = 1; // Garantir que a quantidade não seja menor que 1
    inputQuantidade.value = quantidadeAtual;

    console.log('Produto ID:', produtoId, 'Nova quantidade:', quantidadeAtual); // Log para depuração

    // Atualiza a quantidade no backend
    fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ produtoId: produtoId, quantidade: quantidadeAtual })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualiza o valor total dinamicamente
            const valorProduto = parseFloat(document.querySelector(`#produto-${produtoId} .valor`).textContent.trim());
            const totalElemento = document.getElementById('total');
            let total = 0;
            
            document.querySelectorAll('.produto').forEach(produto => {
                const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');
                if (produtoQuantidadeInput) {
                    const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
                    const produtoValor = parseFloat(produto.querySelector('.valor').textContent.trim());
                    total += produtoQuantidade * produtoValor;
                }
            });

            totalElemento.textContent = total.toFixed(2);
        } else {
            alert('Erro ao atualizar a quantidade: ' + data.message);
        }
    })
    .catch(error => console.error('Erro ao atualizar a quantidade:', error));
}


function visualizarProduto(produtoId) {
    window.location.href = '../PHP/buscarProdutos/detalhesProduto.php?id=' + produtoId;
}
