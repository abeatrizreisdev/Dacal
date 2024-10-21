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

                    let saida = "<h2>Orçamentos Cadastrados</h2><ul>";

                    // Itera sobre cada orçamento no array.
                    dadosOrcamento.forEach(orcamento => {

                        saida += `<li>
                            Orçamento ${orcamento.numeroOrcamento}: 
                            Cliente: ${orcamento.nomeCliente}, 
                            Valor: ${formatarValor(orcamento.valorOrcamento)}, 
                            Data: ${formatarData(orcamento.dataCriacao)}, 
                            Status: ${orcamento.status}, 
                            Quantidade total de itens: ${orcamento.quantidadeTotal}</li>
                            <a href='../PHP/detalhesOrcamento.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações </a>
                            `;


                    });

                    saida += "</ul>";

                    // Insere a lista de orçamentos no elemento HTML com id 'orcamentos'.
                    document.getElementById('orcamentos').innerHTML = saida;

                } else {

                    // Se a resposta não for um array, mostra uma mensagem de erro.
                    document.getElementById('orcamentos').innerHTML = `<p>${dados.mensagem || 'Erro ao carregar orçamentos.'}</p>`;

                };

            })
            .catch(erro => console.error('Erro:', erro)); // Lida com erros na solicitação.
            
    });
