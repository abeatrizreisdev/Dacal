
// Função para formatar o valor do orçamento
function formatarValor(valor) {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
}

// Função para formatar a data do orçamento
function formatarData(data) {
    const dataObj = new Date(data);
    return dataObj.toLocaleDateString('pt-BR');
}

document.addEventListener("DOMContentLoaded", function() {

    // Recupera o idCliente do input escondido.
    const idCliente = document.getElementById('clienteId').value;

    // Faz uma solicitação para o servidor para buscar os orçamentos
    fetch(`../PHP/buscarOrcamentos/buscarOrcamentosCliente.php?id=${idCliente}`)
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
                        Quantidade total de itens: ${orcamento.quantidadeTotal}
                        </li>
                        <a href='../PHP/verMaisInfoDoOrcamentoEmpresa.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações</a>`;

                });

                saida += "</ul>";
                // Insere a lista de orçamentos no elemento HTML com id 'orcamentos'.
                document.getElementById('orcamentos').innerHTML = saida;

            } else {

                // Se a resposta não for um array, mostra uma mensagem de erro.
                document.getElementById('orcamentos').innerHTML = `<p>${dadosOrcamento.mensagem || 'Erro ao carregar orçamentos.'}</p>`;

            }

        })
        .catch(erro => console.error('Erro:', erro)); // Lida com erros na solicitação.
});