

console.log('realizarOrcamento.js carregado');

// Teste do Toastr
toastr.info('Toastr está funcionando!');

function removerProduto(produtoId) {
    fetch(`../PHP/arquivosParaRealizarOrcamento/removerProdutoOrcamento.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ produtoId: produtoId })
    })
    .then(respostaRequisicao => respostaRequisicao.json())
    .then(dados => {
        if (dados.success) {
            toastr.success('Produto removido com sucesso!');
            document.getElementById(`produto-${produtoId}`).remove();

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
            toastr.error('Erro ao remover produto: ' + dados.message);
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
