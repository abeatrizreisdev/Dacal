    
     // Função para cancelar o orçamento e redirecionar para a página inicial
    function cancelarOrcamento() {

        fetch('../PHP/excluirOrcamento/excluirOrcamento.php', {
            method: 'POST'
        })
        .then(resposta => resposta.json())
        .then(dados => {

            if (dados.success) {

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

    };

    // Função que exibe os dados do orçamento no passo 2 para o usuário.
    function criarProdutoHTMLPasso2(produto) {

        return `
                <div class='produto' id='produto-${produto.id}'>
                    <p class='produto-nome'>Produto: ${produto.nome}</p>
                    <p class='produto-categoria'>Categoria: ${produto.categoria}</p>
                    <img class='produto-imagem' src='data:image/jpeg;base64,${produto.imagem}' alt='Produto'>
                    <p class='produto-quantidade'>
                        Quantidade:
                        <button type='button' onclick='alterarQuantidade(${produto.id}, -1)'>-</button>
                        <input type='number' name='quantidades[]' data-produto-id='${produto.id}' value='${produto.quantidade}' min='1'>
                        <button type='button' onclick='alterarQuantidade(${produto.id}, 1)'>+</button>
                    </p>
                    <p class='produto-valor'>Valor unitário: R$ <span class='valor'>${produto.valor}</span></p>
                    <button class='btn-remover' onclick="removerProduto('${produto.id}')">Remover Produto</button>
                    <button class='btn-visualizar' onclick="visualizarProduto('${produto.id}')">Visualizar Produto</button>
                </div>`;

    };
     
    // Função que exibe os dados do orçamento para o usuário e também contém os inputs com os dados do orçamento para enviar para o back-end processar o orçamento realizado.
    function criarFormProdutoHTMLPasso3(produto) {

        return `
            <div class='produto'>
                <p class='produto-nome'>Produto: ${produto.nome}</p>
                <p class='produto-categoria'>Categoria: ${produto.categoria}</p>
                <img class='produto-imagem' src='data:image/jpeg;base64,${produto.imagem}' alt='Produto'>
                <p class='produto-quantidade'>
                    Quantidade:
                    <input type='number' name='quantidades[]' data-produto-id='${produto.id}' value='${produto.quantidade}' min='1' required readonly>
                </p>
                <p class='produto-valor'>Valor unitário: R$ ${produto.valor}</p>
                <input type='hidden' name='produtos[]' value='${produto.nome}'>
                <input type='hidden' name='valores[]' value='${produto.valor}'>
                <input type='hidden' name='produtoIds[]' value='${produto.id}'>
            </div>`;

    };
    
    
    // Função que exibe os elementos finais do html do passo 2 e 3.
    function exibirOrcamento() {

        fetch('../PHP/exibirOrcamento/exibirOrcamento.php')
            .then(response => response.json())
            .then(data => {

                const container = document.getElementById('orcamentoContainer');
                const formContainer = document.getElementById('formOrcamentoContainer');
    
                if (data.message) {

                    container.innerHTML = `<p>${data.message}</p>`;
                    formContainer.innerHTML = `<p>${data.message}</p>`;

                } else if (data.produtos && Array.isArray(data.produtos)) {

                    let htmlPasso2 = '';
                    let formHtmlPasso3 = '';
    
                    data.produtos.forEach(produto => {

                        htmlPasso2 += criarProdutoHTMLPasso2(produto);
                        formHtmlPasso3 += criarFormProdutoHTMLPasso3(produto);

                    });
    
                    htmlPasso2 += `
                        <h3>Total: R$ <span id='total'>${data.total}</span></h3>
                        <h3>Quantidade Total de Itens: <span id='quantidadeTotal'>${data.quantidadeTotal}</span></h3>`;
    
                    formHtmlPasso3 += `
                        <p class="produto-valor"> Valor Total: <span id="valorTotalSpan">R$ ${data.total}</span> </p>
                        <h3>Quantidade Total de Itens: <span id="quantidadeTotalSpan">${data.quantidadeTotal}</span></h3>
                        <input type="hidden" name="valorTotal" value="${data.total}">
                        <input type="hidden" name="quantidadeTotal" value="${data.quantidadeTotal}">`;
    
                    container.innerHTML = htmlPasso2;
                    formContainer.innerHTML = formHtmlPasso3;
    
                    // Adicionar evento de input aos inputs de quantidade no passo 2.
                    document.querySelectorAll('.produto input[type="number"]').forEach(input => {

                        input.addEventListener('input', (event) => {

                            const produtoId = event.target.getAttribute('data-produto-id');
                            alterarQuantidadeManual(produtoId);

                        });
                        
                    });

                } else {

                    container.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';
                    formContainer.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';

                };

            })
            .catch(erro => {

                console.error('Erro ao exibir o orçamento:', erro);
                const container = document.getElementById('orcamentoContainer');
                const formContainer = document.getElementById('formOrcamentoContainer');
                container.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';
                formContainer.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';

            });

    };
    
    // Função que atualiza dinamicamente a quantidade total de itens e o valor total do orçamento.
    function atualizarTotais() {

        let total = 0;
        let quantidadeTotal = 0;
    
        document.querySelectorAll('.produto').forEach(produto => {

            const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');

            if (produtoQuantidadeInput) {

                const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
                const valorElemento = produto.querySelector('.valor');

                if (valorElemento) {

                    const produtoValor = parseFloat(valorElemento.textContent.trim());
                    total += produtoQuantidade * produtoValor;
                    quantidadeTotal += produtoQuantidade;
    
                    // Atualiza os inputs no passo 3
                    const hiddenInputQuantidade = document.querySelector(`input[data-produto-id='${produtoQuantidadeInput.dataset.produtoId}'][name='quantidades[]']`);

                    if (hiddenInputQuantidade) {

                        hiddenInputQuantidade.value = produtoQuantidade;

                    }
                    
                }

            }

        });
    
        const totalElemento = document.getElementById('total');
        const quantidadeTotalElemento = document.getElementById('quantidadeTotal');
    
        if (totalElemento) {

            totalElemento.textContent = total;

        };

        if (quantidadeTotalElemento) {

            quantidadeTotalElemento.textContent = quantidadeTotal;

        };
    
        atualizarTotaisPasso3(total, quantidadeTotal);

    };
    
    
    // Função que atualiza os valores do valor total do orçamento e a quantidade total de itens no passo 3.
    function atualizarTotaisPasso3(total, quantidadeTotal) {

        // Atualiza os elementos de valor total e quantidade total no passo 3
        const valorTotalSpan = document.getElementById('valorTotalSpan');
        const quantidadeTotalSpan = document.getElementById('quantidadeTotalSpan');
    
        if (valorTotalSpan) {

            valorTotalSpan.textContent = total;
            
        };

        if (quantidadeTotalSpan) {

            quantidadeTotalSpan.textContent = quantidadeTotal;

        };
    
        // Atualiza os inputs de valor total e quantidade total no passo 3
        const totalHiddenInput = document.querySelector(`input[name='valorTotal']`);

        if (totalHiddenInput && !isNaN(total)) {

            totalHiddenInput.value = total; // Assegurar que é um valor numérico

        };
    
        const quantidadeTotalHiddenInput = document.querySelector(`input[name='quantidadeTotal']`);

        if (quantidadeTotalHiddenInput && !isNaN(quantidadeTotal)) {

            quantidadeTotalHiddenInput.value = quantidadeTotal; // Assegurar que é um valor numérico

        };

    };
    
    
    // Função que atualiza dinamicamente os valores totais, caso o usuário digite manualmente a quantidade no input do passo 2 em vez de usar os botões.
    function alterarQuantidadeManual(produtoId) {

        const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);
        let novaQuantidade = parseInt(inputQuantidade.value);

        if (novaQuantidade < 1) novaQuantidade = 1; // Garantir que a quantidade não seja menor que 1

        inputQuantidade.value = novaQuantidade;
    
        atualizarTotais(); // Atualiza os totais após alterar a quantidade
    
        // Atualiza a quantidade no backend sem recarregar toda a página
        fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ produtoId: produtoId, quantidade: novaQuantidade })
        })
        .then(resposta => resposta.json())
        .then(dados => {

            if (dados.success) {

                // Atualiza os inputs ocultos no passo 3
                document.querySelectorAll(`input[data-produto-id="${produtoId}"][name='quantidades[]']`).forEach(input => {
                    input.value = novaQuantidade;
                });
    
                // Pega os valores atualizados de total e quantidade total
                const total = parseFloat(document.getElementById('total').textContent.replace(/[^\d,.-]/g, '').replace(',', '.'));
                const quantidadeTotal = parseInt(document.getElementById('quantidadeTotal').textContent);
    
                atualizarTotaisPasso3(total, quantidadeTotal); // Atualiza os totais no passo 3
            
            } else {

                toastr.error('Erro ao atualizar a quantidade: ' + dados.message);

            };

        })
        .catch(error => console.error('Erro ao atualizar a quantidade:', error));

    }
    
    
    // Função que calcula a quantidade dinamicamente se o usuário optar por usar os botões em vez de digitar no input do passo 2.
    function alterarQuantidade(produtoId, delta) {

        const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);

        let quantidadeAtual = parseInt(inputQuantidade.value);
        quantidadeAtual += delta;

        if (quantidadeAtual < 1) quantidadeAtual = 1; // Garantir que a quantidade não seja menor que 1

        inputQuantidade.value = quantidadeAtual;
    
        atualizarTotais(); // Atualiza os totais após alterar a quantidade
    
        // Atualiza a quantidade no backend sem recarregar toda a página
        fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ produtoId: produtoId, quantidade: quantidadeAtual })
        })
        .then(resposta => resposta.json())
        .then(dados => {

            if (dados.success) {

                // Atualiza os inputs ocultos no passo 3
                document.querySelectorAll(`input[data-produto-id="${produtoId}"][name='quantidades[]']`).forEach(input => {

                    input.value = quantidadeAtual;

                });
    
                // Atualizar a exibição do total e da quantidade total
                const total = parseFloat(document.getElementById('total').textContent.replace(/[^\d,.-]/g, '').replace(',', '.'));

                const quantidadeTotal = parseInt(document.getElementById('quantidadeTotal').textContent);
    
                atualizarTotaisPasso3(total, quantidadeTotal); // Atualiza os totais no passo 3
            
            } else {

                toastr.error('Erro ao atualizar a quantidade: ' + dados.message);

            };

        })
        .catch(error => console.error('Erro ao atualizar a quantidade:', error));

    };
    
    // Função que remove o produto do orçamento.
    function removerProduto(produtoId) {

        fetch('../PHP/arquivosParaRealizarOrcamento/removerProdutoOrcamento.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ produtoId: produtoId })
        })
        .then(respostaRequisicao => respostaRequisicao.json())
        .then(dados => {

            if (dados.success) {

                toastr.success('Produto removido com sucesso!');
                document.getElementById(`produto-${produtoId}`).remove();
                atualizarTotais(); // Atualiza os totais após remover o produto
                exibirOrcamento(); // Chame exibirOrcamento para refletir as mudanças nos passos 2 e 3
            } else {

                toastr.error('Erro ao remover produto: ' + dados.message);
                
            };

        }).catch(erro => console.error('Erro ao remover produto:', erro));
        
    };
        
    // Chamando a função exibirOrcamento para renderizar os produtos assim que a página carregar.
    document.addEventListener('DOMContentLoaded', () => {

        exibirOrcamento();
    
        document.querySelectorAll('.produto input[type="number"]').forEach(input => {
            input.addEventListener('input', (event) => {
                const produtoId = event.target.getAttribute('data-produto-id');
                alterarQuantidadeManual(produtoId);
            });

        });

    });
    