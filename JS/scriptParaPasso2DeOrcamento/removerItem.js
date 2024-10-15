

console.log('realizarOrcamento.js carregado');

// Teste do Toastr
toastr.info('Toastr está funcionando!');

// Função para recalcular e atualizar dinamicamente o valor total e a quantidade total
// Função para recalcular e atualizar dinamicamente o valor total e a quantidade total
function atualizarTotais() {
    console.log('Chamando atualizarTotais'); // Log de depuração
    const totalElemento = document.getElementById('total');
    const quantidadeTotalElemento = document.getElementById('quantidadeTotal');
    console.log('totalElemento:', totalElemento); // Log de depuração
    console.log('quantidadeTotalElemento:', quantidadeTotalElemento); // Log de depuração
    let total = 0;
    let quantidadeTotal = 0;

    document.querySelectorAll('.produto').forEach(produto => {
        const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');
        if (produtoQuantidadeInput) {
            const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
            const produtoValor = parseFloat(produto.querySelector('.valor').textContent.trim());
            total += produtoQuantidade * produtoValor;
            quantidadeTotal += produtoQuantidade;
        }
    });

    console.log('Total:', total); // Log de depuração
    console.log('Quantidade Total:', quantidadeTotal); // Log de depuração

    totalElemento.textContent = total.toFixed(2);
    quantidadeTotalElemento.textContent = quantidadeTotal;
}


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
            atualizarTotais(); // Atualiza os totais após remover o produto

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

            atualizarTotais(); // Atualiza os totais após alterar a quantidade
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

// Função para abrir o passo correspondente
function abrirPassoAPassoOrcamento(evento, nomeDoPassoAPassoCorrespondente) {
    var indice, conteudoTabela, linksTabela;

    // Pegando todos os elementos que possuem esssa classe.
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");
    // Iterando sobre cada um dos elementos que tem a classe "conteudoTabela".
    for (indice = 0; indice < conteudoTabela.length; indice++) {
        // E ocultando da tela o seu conteudo.
        conteudoTabela[indice].style.display = "none";
    }

    // Pegando todos os elementos que tem essa classe.
    linksTabela = document.getElementsByClassName("linksTabela");
    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela".
    for (indice = 0; indice < linksTabela.length; indice++) {
        // E adcionando uma nova classe com o nome "ativo", para poder exibir o conteudo dela, o que significa que o cliente clicou naquele passo em especifico.
        linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");
    }

    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";
    evento.currentTarget.className += " ativo";
}

// Função para cancelar o orçamento e redirecionar para a página inicial
function cancelarOrcamento() {
    fetch('../PHP/excluirOrcamento/excluirOrcamento.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Orçamento cancelado com sucesso!');
            setTimeout(() => {
                window.location.href = 'homeEmpresa.php';
            }, 1500);
        } else {
            toastr.error('Erro ao cancelar o orçamento.');
        }
    })
    .catch(error => {
        console.error('Erro ao cancelar o orçamento:', error);
        toastr.error('Erro ao cancelar o orçamento.');
    });
}

function voltarParaPasso2() {
    // Redirecionar para o passo 2 sem excluir o orçamento
    window.location.href = 'realizarOrcamento.php#passo2';
}

function visualizarProduto(produtoId) {
    window.location.href = '../PHP/buscarProdutos/detalhesProduto.php?id=' + produtoId;
}
