
document.addEventListener("DOMContentLoaded", function() {

    const urlParams = new URLSearchParams(window.location.search);
    const numeroOrcamento = urlParams.get('numeroOrcamento');

    console.log('Numero do Orçamento:', numeroOrcamento); // Log para depuração


    if (numeroOrcamento) {
        document.getElementById('numeroOrcamento').value = numeroOrcamento;
    } else {
        document.getElementById('mensagemErro').textContent = 'Número do orçamento não fornecido.';
    }

    document.getElementById('formEditarStatus').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        const formData = new FormData(this);
        
        console.log('Enviando dados:', Array.from(formData.entries())); // Log para depuração

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