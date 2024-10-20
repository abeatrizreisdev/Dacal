    // Função para formatar a Inscrição Estadual da Bahia.
    // Ainda precisa de correções, pois não está exibindo corretamente.
    // Talvez pelo valor de teste que cadastrei.
    function formatarIE(inscricaoEstadual) {

        const partes = inscricaoEstadual.match(/^(\d{2})(\d{3})(\d{3})(\d{1})$/);

        if (partes) {

            return `${partes[1]}.${partes[2]}.${partes[3]}-${partes[4]}`;

        } else {

            // Caso a inscrição não esteja no formato esperado
            return inscricaoEstadual;

        }   

    };

    // Função para formatar a data no formato brasileiro
    function formatarData(data) {

        const dataObj = new Date(data);
        return dataObj.toLocaleDateString('pt-BR');

    };

    // Função para formatar o valor em formato brasileiro
    function formatarValor(valor) {

        return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    };

    // Função para formatar o CNPJ
    function formatarCNPJ(cnpj) {

        return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");

    };

    // Função para formatar o telefone
    function formatarTelefone(telefone) {

        return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");

    };

    // Função para formatar o CEP
    function formatarCEP(cep) {

        return cep.replace(/^(\d{5})(\d{3})$/, "$1-$2");

    }
    

    // Quando a página for carregada, será executada esse evento que carregará todas as info. do orcamento.
    document.addEventListener("DOMContentLoaded", function() {

        const urlParams = new URLSearchParams(window.location.search);
        const numeroOrcamento = urlParams.get('numeroOrcamento');

        fetch(`../PHP/buscarOrcamentos/buscarInfoOrcamento.php?numeroOrcamento=${numeroOrcamento}`)
            .then(resposta => resposta.json())
            .then(dadosOrcamento => {

                let detalhes = `
                    <p>Número do Orçamento: ${dadosOrcamento.numeroOrcamento}</p>
                    <p>Cliente: ${dadosOrcamento.nomeCliente}</p>
                    <p>Razão Social: ${dadosOrcamento.razaoSocial}</p>
                    <p>Cnpj: ${formatarCNPJ(dadosOrcamento.cnpj)}</p>
                    <p>InscricaoEstadual: ${formatarIE(dadosOrcamento.inscricaoEstadual)}</p>
                    <p>Telefone: ${formatarTelefone(dadosOrcamento.telefone)}</p>
                    <p>Email: ${dadosOrcamento.email}</p>
                    <p>Municipio: ${dadosOrcamento.municipio}</p>
                    <p>Estado: ${dadosOrcamento.estado}</p>
                    <p>Bairro: ${dadosOrcamento.bairro}</p>
                    <p>Logradouro: ${dadosOrcamento.logradouro}</p>
                    <p>Número do Endereço: ${dadosOrcamento.numeroEndereco}</p>
                    <p>Cep: ${formatarCEP(dadosOrcamento.cep)}</p>
                    <p>Data do orçamento: ${formatarData(dadosOrcamento.dataCriacao)}</p>
                    <p>Valor Total: ${formatarValor(dadosOrcamento.valorOrcamento)}</p>
                    <p>Status: ${dadosOrcamento.status}</p>
                    <p>Quantidade total de itens: ${dadosOrcamento.quantidadeTotal}</p>
                    <h3>Itens:</h3>
                    <ul>
                `;

                dadosOrcamento.itens.forEach(item => {

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




