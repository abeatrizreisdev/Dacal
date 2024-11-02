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
document.addEventListener("DOMContentLoaded", function () {

    const urlParams = new URLSearchParams(window.location.search);
    const numeroOrcamento = urlParams.get('numeroOrcamento');

    fetch(`../PHP/buscarOrcamentos/buscarInfoOrcamento.php?numeroOrcamento=${numeroOrcamento}`)
        .then(resposta => resposta.json())
        .then(dadosOrcamento => {

            // Elementos de html que irá exibir todos os dados de um orçamento especifico.
            // Para estilizar é só inserir class ou id, normalmente.
            let detalhes = `
                <div class="labelOrca">
                    <div class="labelStatus">
                        <p class="infoForm"><strong>Número do Orçamento:</strong> ${dadosOrcamento.numeroOrcamento}</p>
                        <p class="infoForm"><strong>Status:</strong> ${dadosOrcamento.status}</p>
                    </div>
                    <p class="infoForm"><strong>Cliente:</strong> ${dadosOrcamento.nomeCliente}</p>
                    <p class="infoForm"><strong>Razão Social:</strong> ${dadosOrcamento.razaoSocial}</p>
                    <p class="infoForm"><strong>Cnpj:</strong> ${formatarCNPJ(dadosOrcamento.cnpj)}</p>
                    <p class="infoForm"><strong>InscricaoEstadual:</strong> ${formatarIE(dadosOrcamento.inscricaoEstadual)}</p>
                    <p class="infoForm"><strong>Telefone:</strong> ${formatarTelefone(dadosOrcamento.telefone)}</p>
                    <p class="infoForm"><strong>Email:</strong> ${dadosOrcamento.email}</p>
                    <p class="infoForm"><strong>Municipio:</strong> ${dadosOrcamento.municipio}</p>
                    <p class="infoForm"><strong>Estado:</strong> ${dadosOrcamento.estado}</p>
                    <p class="infoForm"><strong>Bairro:</strong> ${dadosOrcamento.bairro}</p>
                    <p class="infoForm"><strong>Logradouro:</strong> ${dadosOrcamento.logradouro}</p>
                    <p class="infoForm"><strong>Número do Endereço:</strong> ${dadosOrcamento.numeroEndereco}</p>
                    <p class="infoForm"><strong>Cep:</strong> ${formatarCEP(dadosOrcamento.cep)}</p>
                    <p class="infoForm"><strong>Data do orçamento:</strong> ${formatarData(dadosOrcamento.dataCriacao)}</p>
                    <div class="labelForm">
                        <p class="infoForm"><strong>Valor Total:</strong> ${formatarValor(dadosOrcamento.valorOrcamento)}</p>
                        <p class="infoForm"><strong>Quantidade total de itens:</strong> ${dadosOrcamento.quantidadeTotal}</p>
                    </div>
                </div>
                    <p class="titulo">Itens do Orçamento</p>
                    <ul>
                `;

            dadosOrcamento.itens.forEach(item => {

                detalhes += `
                <div class="itensOrcamento">
                    <div class="imagemProduto">
                        <img class="produto-imagem" src="data:image/jpeg;base64,${item.imagemProduto}" alt="${item.nomeProduto}" style="max-width: 150px; max-height: 150px;">
                    </div>
                    <div class="itensInfo">
                        <p class="labelInfo"><strong>${item.nomeProduto}</strong></p>
                        <p class="labelInfo"><strong>Código:</strong> ${item.idProduto}</p>
                        <p class="labelInfo"><strong>Quantidade:</strong> ${item.quantidade}</p>
                    </div>
                </div>
                `;

            });

            detalhes += ``;

            // Botão para retornar para a página de orçamentos.
            detalhes += 

            document.getElementById('detalhesOrcamento').innerHTML = detalhes;

        })
        .catch(erro => {

            document.getElementById('detalhesOrcamento').innerHTML = 'Erro ao carregar detalhes do orçamento.';
            console.error('Erro:', erro);

        });

});




