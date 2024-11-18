
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
        
        const valorUnitario = parseFloat(produto.valor).toFixed(2);
        const valorUnitarioFormatado = parseFloat(valorUnitario).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        
        return `
            <div class='produto' id='produto-${produto.id}'>
                <div class="produtoImagem">
                    <img class='produto-imagem' src='../${produto.imagem}' alt='Produto'>
                </div>
                <div class="produtoInfo">
                    <p class='produto-nome'>Produto: ${produto.nome}</p>
                    <div class='produto-quantidade'>
                        Quantidade:
                        <button type='button' onclick='alterarQuantidade(${produto.id}, -1)'>-</button>
                        <input type='number' class="inputQuantidade" name='quantidades[]' data-produto-id='${produto.id}' value='${produto.quantidade}' min='1'>
                        <button type='button' onclick='alterarQuantidade(${produto.id}, 1)'>+</button>
                    </div>
                    <p class='produto-valor'>Valor unitário: <span class='valor' data-valor='${produto.valor}'>${valorUnitarioFormatado}</span></p>
                    <div class="botoes">
                        <button class='btn-remover' onclick="removerProduto('${produto.id}')">REMOVER PRODUTO</button>
                        <button class='btn-visualizar' onclick="visualizarProduto('${produto.id}')">VISUALIZAR PRODUTO</button>
                    </div>
                </div>
            </div>`;
    }


    function criarFormProdutoHTMLPasso3(produto) {

        const valorUnitario = parseFloat(produto.valor).toFixed(2);
        const valorUnitarioFormatado = parseFloat(valorUnitario).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        const quantidadeFormatada = Number.isInteger(produto.quantidade) 
            ? produto.quantidade.toLocaleString('pt-BR') 
            : produto.quantidade;

        return `
            <div class='produto'>
                <div class="produtoImagem">
                    <img class='produto-imagem' src='../${produto.imagem}' alt='Produto'>
                </div>
                <div class="produtoInfo">
                    <p class='produto-nome'>Produto: ${produto.nome}</p>
                    <p class='produto-categoria'>Categoria: ${produto.categoria}</p>
                    <p class='produto-quantidade'>Quantidade: <span class='quantidade' data-produto-id='${produto.id}'>${quantidadeFormatada}</span></p>
                    <p class='produto-valor'>Valor unitário: ${valorUnitarioFormatado}</p>
                    <input type='hidden' name='produtos[]' value='${produto.nome}' required>
                    <input type='hidden' name='valores[]' value='${produto.valor}' required>
                    <input type='hidden' name='produtoIds[]' value='${produto.id}' required>
                    <input type='hidden' name='quantidades[]' data-produto-id='${produto.id}' value='${produto.quantidade}'>
                </div>
            </div>`;

    }


    function exibirOrcamento() {

        fetch('../PHP/exibirOrcamento/exibirOrcamento.php')
            .then(resposta => resposta.json())
            .then(dados => {

                const container = document.getElementById('orcamentoContainer');
                const formContainer = document.getElementById('formOrcamentoContainer');

                if (dados.mensagem) {

                    container.innerHTML = `<p>${dados.mensagem}</p>`;
                    formContainer.innerHTML = `<p>${dados.mensagem}</p>`;

                } else if (dados.produtos && Array.isArray(dados.produtos)) {

                    let htmlPasso2 = '';
                    let formHtmlPasso3 = '';

                    dados.produtos.forEach(produto => {

                        htmlPasso2 += criarProdutoHTMLPasso2(produto);
                        formHtmlPasso3 += criarFormProdutoHTMLPasso3(produto);

                    });

                    const totalFormatado = dados.total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                    const quantidadeTotalFormatada = dados.quantidadeTotal.toLocaleString('pt-BR');

                    htmlPasso2 += `
                        <div class="infoGeral">
                            <h3>Total: <span id='total'>${totalFormatado}</span></h3>
                            <h3>Quantidade Total de Itens: <span id='quantidadeTotal'>${quantidadeTotalFormatada}</span></h3>
                        </div>`;

                    formHtmlPasso3 += `
                        <div class="infoGeral">
                            <p class="produto-valor">Valor Total: <span id="valorTotalSpan">${totalFormatado}</span></p>
                            <p><strong>Quantidade Total de Itens: <span id="quantidadeTotalSpan">${quantidadeTotalFormatada}</span></strong></p>
                            <input type="hidden" name="valorTotal" value="${dados.total}">
                            <input type="hidden" name="quantidadeTotal" value="${dados.quantidadeTotal}">
                        </div>`;

                    container.innerHTML = htmlPasso2;
                    formContainer.innerHTML = formHtmlPasso3;

                    // Adiciona evento de input aos inputs de quantidade no passo 2.
                    document.querySelectorAll('.produto input[type="number"]').forEach(input => {
                        input.addEventListener('input', (event) => {

                            const produtoId = event.target.getAttribute('data-produto-id');
                            alterarQuantidadeManual(produtoId);

                        });
                    });

                } else {

                    container.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';
                    formContainer.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>';

                }
            })
            .catch(erro => {

                console.error('Erro ao exibir o orçamento:', erro);
                const container = document.getElementById('orcamentoContainer');
                const formContainer = document.getElementById('formOrcamentoContainer');
                container.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>' + erro;
                formContainer.innerHTML = '<p>Erro ao carregar os produtos do orçamento.</p>' + erro;

            });

    }





    // Função para atualizar os totais (valor total e quantidade total) no passo 2.
    function atualizarTotais() {

        let total = 0;
        let quantidadeTotal = 0;

        // Itera sobre cada produto para calcular os totais.
        document.querySelectorAll('.produto').forEach(produto => {

            const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');

            if (produtoQuantidadeInput) {

                const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
                const valorElemento = produto.querySelector('.valor');

                if (valorElemento) {

                    // Usa o valor original para cálculos.
                    const produtoValor = parseFloat(valorElemento.dataset.valor);
                    total += produtoQuantidade * produtoValor;
                    quantidadeTotal += produtoQuantidade;

                    // Atualiza os inputs no passo 3.
                    const hiddenInputQuantidade = document.querySelector(`input[data-produto-id='${produtoQuantidadeInput.dataset.produtoId}'][name='quantidades[]']`);

                    if (hiddenInputQuantidade) {

                        hiddenInputQuantidade.value = produtoQuantidade;

                    }

                }

            }

        });

        // Formata os totais para moeda brasileira e número com separadores.
        const totalFormatado = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        const quantidadeTotalFormatada = quantidadeTotal.toLocaleString('pt-BR');

        // Atualiza os elementos do passo 2 com os valores formatados.
        const totalElemento = document.getElementById('total');
        const quantidadeTotalElemento = document.getElementById('quantidadeTotal');

        if (totalElemento) {

            totalElemento.textContent = totalFormatado;

        }

        if (quantidadeTotalElemento) {

            quantidadeTotalElemento.textContent = quantidadeTotalFormatada;

        }

        // Chama a função para atualizar os totais no passo 3.
        atualizarTotaisPasso3(total, quantidadeTotal);

    }


    // Função para atualizar os totais (valor total e quantidade total) no passo 3.
    function atualizarTotaisPasso3(total, quantidadeTotal) {

        const valorTotalSpan = document.getElementById('valorTotalSpan');
        const quantidadeTotalSpan = document.getElementById('quantidadeTotalSpan');
        const totalFormatado = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        const quantidadeTotalFormatada = quantidadeTotal.toLocaleString('pt-BR');

        // Atualiza os elementos do passo 3 com os valores formatados.
        if (valorTotalSpan) {

            valorTotalSpan.textContent = totalFormatado;

        }

        if (quantidadeTotalSpan) {

            quantidadeTotalSpan.textContent = quantidadeTotalFormatada;
            
        }

        // Atualiza os inputs ocultos no passo 3.
        const totalHiddenInput = document.querySelector(`input[name='valorTotal']`);

        if (totalHiddenInput) {

            totalHiddenInput.value = total;

        }

        const quantidadeTotalHiddenInput = document.querySelector(`input[name='quantidadeTotal']`);

        if (quantidadeTotalHiddenInput) {

            quantidadeTotalHiddenInput.value = quantidadeTotal;

        }

        // Atualiza os spans de quantidade no passo 3.
        document.querySelectorAll('.quantidade').forEach(quantidadeSpan => {

            const produtoId = quantidadeSpan.dataset.produtoId;
            const quantidadeInputPasso2 = document.querySelector(`input[data-produto-id='${produtoId}']`);

            if (quantidadeInputPasso2) {

                quantidadeSpan.textContent = parseInt(quantidadeInputPasso2.value).toLocaleString('pt-BR');

            }

        });

        // Atualize os inputs específicos de quantidade no passo 3.
        document.querySelectorAll(`input[data-produto-id][name='quantidades[]']`).forEach(input => {

            const produtoId = input.dataset.produtoId;
            const quantidadeInputPasso2 = document.querySelector(`input[data-produto-id='${produtoId}']`);

            if (quantidadeInputPasso2) {

                input.value = quantidadeInputPasso2.value;



            }

        });

    }

    // Função que altera a quantidade manualmente, digitando no input da quantidade, no passo 2.
    function alterarQuantidadeManual(produtoId) {

        const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);
        let novaQuantidade = parseInt(inputQuantidade.value);
        if (novaQuantidade < 1) novaQuantidade = 1;

        inputQuantidade.value = novaQuantidade;
        atualizarTotais();

        // Envia a nova quantidade para o backend para atualização.
        fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ produtoId: produtoId, quantidade: novaQuantidade })
        })
        .then(resposta => resposta.json())
        .then(dados => {

            if (dados.success) {

                // Atualiza os inputs de quantidade no passo 3.
                document.querySelectorAll(`input[data-produto-id="${produtoId}"][name='quantidades[]']`).forEach(input => {

                    input.value = novaQuantidade;

                });

                atualizarTotais();

            } else {

                toastr.error('Erro ao atualizar a quantidade: ' + dados.message);

            }

        })
        .catch(error => console.error('Erro ao atualizar a quantidade:', error));

    }

    // Função que altera a quantidade usando botões de incremento/decremento no passo 2.
    function alterarQuantidade(produtoId, delta) {

        const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);
        let quantidadeAtual = parseInt(inputQuantidade.value);
        quantidadeAtual += delta;
        if (quantidadeAtual < 1) quantidadeAtual = 1;

        inputQuantidade.value = quantidadeAtual;
        atualizarTotais();

        // Envia a nova quantidade para o backend para atualização.
        fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ produtoId: produtoId, quantidade: quantidadeAtual })
        })
        .then(resposta => resposta.json())
        .then(dados => {

            if (dados.success) {

                // Atualiza os inputs de quantidade no passo 3
                document.querySelectorAll(`input[data-produto-id="${produtoId}"][name='quantidades[]']`).forEach(input => {

                    input.value = quantidadeAtual;

                });

                atualizarTotais();

            } else {

                toastr.error('Erro ao atualizar a quantidade: ' + dados.message);

            }

        })
        .catch(error => console.error('Erro ao atualizar a quantidade:', error));

    }



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

    // Função para evitar que o formulário do orçamento seja enviado para o servidor sem nenhum produto.
    document.getElementById('formOrcamento').addEventListener('submit', function(event) {

        const produtos = document.getElementsByName('produtos[]');

        if (produtos.length === 0) {

            toastr.error('Selecione pelo menos um produto antes de finalizar o orçamento.');
            event.preventDefault();

        }

    });
    
    
    
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

    
