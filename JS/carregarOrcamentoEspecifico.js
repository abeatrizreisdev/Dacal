document.addEventListener("DOMContentLoaded", function() {

    const urlParams = new URLSearchParams(window.location.search);
    const numeroOrcamento = urlParams.get('numeroOrcamento');

    fetch(`../PHP/buscarOrcamentos/buscarInfoOrcamento.php?numeroOrcamento=${numeroOrcamento}`)
        .then(resposta => resposta.json())
        .then(dados => {

            let detalhes = `
                <p>Número do Orçamento: ${dados.numeroOrcamento}</p>
                <p>Cliente: ${dados.nomeCliente}</p>
                <p>Valor: ${dados.valorOrcamento}</p>
                <p>Data: ${dados.dataCriacao}</p>
                <p>Status: ${dados.status}</p>
                <p>Quantidade total de itens: ${dados.quantidadeTotal}</p>
                <h3>Itens:</h3>
                <ul>
            `;
            dados.itens.forEach(item => {

                detalhes += `<li>Produto: ${item.nomeProduto}, Quantidade: ${item.quantidade}</li>`;

            });

            detalhes += `</ul>`;

            detalhes += `<a href='../PHP/editarStatusOrcamento.php?numeroOrcamento=${numeroOrcamento}'> <button id="editarStatus"> Editar status do orçamento </button> </a>`


            document.getElementById('detalhesOrcamento').innerHTML = detalhes;

        })
        .catch(erro => {

            document.getElementById('detalhesOrcamento').innerHTML = 'Erro ao carregar detalhes do orçamento.';
            console.error('Erro:', erro);

        });

});
