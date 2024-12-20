
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

                // Titulo da página, mas pode ser retirado se não tiver necessidade.
                // Mas a tag "ul" precisa continuar.
                let saida = "<h2></h2>";
                // Itera sobre cada orçamento no array.
                dadosOrcamento.forEach(orcamento => {

                    // Exibindo os elementos html com os dados dos orçamentos.
                    // Para cada orçamento encontrado será criado esses elementos.
                    saida += `
                    <div class="orcamentosGeral">
                        <p class="tituloOrcamento"><strong>Orçamento nº</strong> ${orcamento.numeroOrcamento}</p> 
                        <div class="infoOrcamento">
                            <div class="labelInfo">
                                <p><strong>Data:</strong> ${formatarData(orcamento.dataCriacao)}</p> 
                                <p><strong>Status:</strong> ${orcamento.status}</p>
                            </div>
                            <div class="labelInfo">
                                <p><strong>Valor:</strong> ${formatarValor(orcamento.valorOrcamento)}</p> 
                            </div>
                            <div class="labelInfo">
                                <p><strong>Quantidade total de itens:</strong>${orcamento.quantidadeTotal}</p>
                            <a href='../PHP/infoOrcamentoCliente.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações</a>
                            </div>
                        </div>
                    </div>`
                        ;
                      

                });

                saida += "";

                // Insere a lista de orçamentos no elemento HTML da página "orcamentosEmpresa.php" com id 'orcamentos'.
                document.getElementById('orcamentos').innerHTML = saida;

            } else {

                // Se a resposta não for um array com orçamentos, mostra uma mensagem de erro.
                document.getElementById('orcamentos').innerHTML = `<p>${dadosOrcamento.mensagem || 'Erro ao carregar orçamentos.'}</p>`;

            }

        })
        .catch(erro => 
            console.error('Erro:', erro)
        ); // Lida com erros na solicitação, para encontrar possíveis problemas no console do navegador.
        
});