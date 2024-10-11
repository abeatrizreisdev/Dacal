document.addEventListener("DOMContentLoaded", function() {

    // Faz uma solicitação para o servidor para buscar os orçamentos
    fetch('../PHP/buscarOrcamentos/buscarOrcamentos.php')
        .then(resposta => resposta.json()) // Converte a resposta para JSON.
        .then(dados => {

            if (Array.isArray(dados)) { // Verifica se a resposta é um array.

                let saida = "<h2>Orçamentos Cadastrados</h2><ul>";

                // Itera sobre cada orçamento no array
                dados.forEach(orcamento => {

                    saida += `<li>
                        Orçamento ${orcamento.numeroOrcamento}: 
                        Cliente: ${orcamento.nomeCliente}, 
                        Valor: ${orcamento.valorOrcamento}, 
                        Data: ${orcamento.dataCriacao}, 
                        Status: ${orcamento.status}, 
                        Quantidade total de itens: ${orcamento.quantidadeTotal}</li>
                        <a href='../PHP/verInformacoesOrcamento.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações </a>
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
