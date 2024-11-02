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


    document.addEventListener("DOMContentLoaded", function() {

        const urlParams = new URLSearchParams(window.location.search);
        const numeroOrcamento = urlParams.get('numeroOrcamento');
    
        if (numeroOrcamento) {
    
            fetch(`../PHP/buscarOrcamentos/buscarInfoOrcamento.php?numeroOrcamento=${numeroOrcamento}`)
                .then(resposta => resposta.json())
                .then(dadosOrcamento => {
    
                    if (dadosOrcamento) {
    
                        document.getElementById('numeroOrcamento').value = dadosOrcamento.numeroOrcamento;
                        document.getElementById('nomeCliente').textContent = dadosOrcamento.nomeCliente;
                        document.getElementById('razaoSocial').textContent = dadosOrcamento.razaoSocial;
                        document.getElementById('cnpj').textContent = formatarCNPJ(dadosOrcamento.cnpj);
                        document.getElementById('inscricaoEstadual').textContent = formatarIE(dadosOrcamento.inscricaoEstadual);
                        document.getElementById('telefone').textContent = formatarTelefone(dadosOrcamento.telefone);
                        document.getElementById('email').textContent = dadosOrcamento.email;
                        document.getElementById('municipio').textContent = dadosOrcamento.municipio;
                        document.getElementById('estado').textContent = dadosOrcamento.estado;
                        document.getElementById('bairro').textContent = dadosOrcamento.bairro;
                        document.getElementById('logradouro').textContent = dadosOrcamento.logradouro;
                        document.getElementById('numeroEndereco').textContent = dadosOrcamento.numeroEndereco;
                        document.getElementById('cep').textContent = formatarCEP(dadosOrcamento.cep);
                        document.getElementById('valorOrcamento').textContent = formatarValor(dadosOrcamento.valorOrcamento);
                        document.getElementById('dataCriacao').textContent = formatarData(dadosOrcamento.dataCriacao);
                        document.getElementById('statusAtual').textContent = dadosOrcamento.status;
    
                        document.getElementById('status').value = dadosOrcamento.status;
                        document.getElementById('quantidadeTotal').textContent = dadosOrcamento.quantidadeTotal;
                        document.getElementById('itens').innerHTML = dadosOrcamento.itens.map(item => `
                            <li>
                                <strong>${item.nomeProduto}:</strong> ${item.quantidade}
                                <br>
                                <img src="data:image/jpeg;base64,${item.imagemProduto}" alt="${item.nomeProduto}" style="max-width: 150px; max-height: 150px;">
                            </li>`).join('');
    
                    } else {
    
                        document.getElementById('mensagemErro').textContent = 'Detalhes do orçamento não encontrados.';
    
                    }
                    
                })
                .catch(erro => {
    
                    console.error('Erro:', erro);
    
                    document.getElementById('mensagemErro').textContent = 'Erro ao carregar detalhes do orçamento. Por favor, tente novamente mais tarde.';
    
                });
    
        } else {
    
            document.getElementById('mensagemErro').textContent = 'Número do orçamento não fornecido.';
    
        }
    
        document.getElementById('formEditarStatus').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário.
            const formData = new FormData(this);
        
            fetch('../PHP/editarOrcamento/editarStatusOrcamento.php', {
                method: 'POST',
                body: formData
            })
            .then(resposta => resposta.json())
            .then(dados => {
    
                if (dados.sucesso) {
    
                    toastr.success(dados.mensagem || 'Status do orçamento atualizado com sucesso.');
                    
                    setTimeout(() => {
                        window.location.href = "gerenciarOrcamentos.php";
                    }, 2000);
    
                } else {
    
                    toastr.error(dados.mensagem || 'Erro. O status do orçamento não foi modificado.');
    
                }
                
            })
            .catch(erro => {
    
                console.error('Erro:', erro);
                toastr.error('Erro ao atualizar status do orçamento. Por favor, tente novamente mais tarde.');
    
            });
    
        });
        
    });
    