
document.addEventListener("DOMContentLoaded", function() {

    const urlParams = new URLSearchParams(window.location.search);
    const numeroOrcamento = urlParams.get('numeroOrcamento');

    if (numeroOrcamento) {

        fetch(`../PHP/buscarOrcamentos/buscarInfoOrcamento.php?numeroOrcamento=${numeroOrcamento}`)
            .then(resposta => resposta.json())
            .then(dados => {

                if (dados) {

                    document.getElementById('numeroOrcamento').value = dados.numeroOrcamento;
                    document.getElementById('nomeCliente').textContent = dados.nomeCliente;
                    document.getElementById('valorOrcamento').textContent = dados.valorOrcamento;
                    document.getElementById('dataCriacao').textContent = dados.dataCriacao;
                    document.getElementById('status').value = dados.status;
                    document.getElementById('quantidadeTotal').textContent = dados.quantidadeTotal;
                    document.getElementById('itens').innerHTML = dados.itens.map(item => `<li>${item.nomeProduto}: ${item.quantidade}</li>`).join('');

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

                document.getElementById('mensagemSucesso').textContent = 'Status do orçamento atualizado com sucesso.';

            } else {

                document.getElementById('mensagemErro').textContent = dados.mensagem || 'Erro ao atualizar status do orçamento.';

            }

        })
        .catch(erro => {

            console.error('Erro:', erro);
            document.getElementById('mensagemErro').textContent = 'Erro ao atualizar status do orçamento. Por favor, tente novamente mais tarde.';
            
        });
    });
});