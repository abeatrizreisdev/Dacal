    // Função para formatar a data no formato brasileiro
    function formatarData(data) {

        const dataObj = new Date(data);
        return dataObj.toLocaleDateString('pt-BR');

    };

    // Função para formatar o valor em formato brasileiro
    function formatarValor(valor) {

        return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    };


    document.addEventListener("DOMContentLoaded", function() {

        // Faz uma solicitação para o servidor para buscar os orçamentos
        fetch('../PHP/buscarOrcamentos/buscarOrcamentos.php')
            .then(resposta => resposta.json()) // Converte a resposta para JSON.
            .then(dadosOrcamento => {

                if (Array.isArray(dadosOrcamento)) { // Verifica se a resposta é um array com os orçamentos.

                    let saida = "";

                    // Itera sobre cada orçamento no array.
                    dadosOrcamento.forEach(orcamento => {

                        // Elementos html que irá exibir todos os orçamentos cadastrados no sistema.
                        saida += `
                        <div class="orcamentosGeral">
                        <p class="tituloOrcamento"><strong>Orçamento nº</strong> ${orcamento.numeroOrcamento}</p> 
                            <div class="infoOrcamento">
                            <div class="labelInfo">
                            <p><strong>Cliente:</strong> ${orcamento.nomeCliente} </p>
                            </div>
                            <div class="labelInfo">
                                <p><strong>Data:</strong> ${formatarData(orcamento.dataCriacao)}</p> 
                                <p><strong>Status:</strong> ${orcamento.status}</p>
                            </div>
                            <div class="labelInfo">
                                <p><strong>Valor:</strong> ${formatarValor(orcamento.valorOrcamento)}</p> 
                            </div>
                            <div class="labelInfo">
                                <p><strong>Quantidade total de itens:</strong>${orcamento.quantidadeTotal}</p>
                            <a href='../PHP/editarStatusOrcamento.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações</a>
                            </div>
                            </div>
                        </div>`;


                    });

                    saida += "";

                    // Insere a lista de orçamentos no elemento HTML com id 'orcamentos'.
                    document.getElementById('orcamentos').innerHTML = saida;

                } else {

                    // Se a resposta não for um array, mostra uma mensagem de erro.
                    document.getElementById('orcamentos').innerHTML = `<p>${dados.mensagem || 'Erro ao carregar orçamentos.'}</p>`;

                };

            })
            .catch(erro => console.error('Erro:', erro)); // Lida com erros na solicitação.
            
    });
