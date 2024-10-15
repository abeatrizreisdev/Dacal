document.getElementById('formExcluirConta').addEventListener('submit', function(event) {
    event.preventDefault();

    const idFuncionario = document.getElementById('idFuncionarioExcluir').value;
    const formData = new FormData();
    formData.append('idFuncionario', idFuncionario);

    fetch('../PHP/excluirFuncionario/excluirFuncionario.php', {

        method: 'POST',
        body: formData

    })
    .then(resposta => resposta.json())
    .then(dados => {

        const mensagemFeedback = document.getElementById('mensagemFeedback');

        if (dados.status === 'success') {
            
            mensagemFeedback.textContent = data.message;
            mensagemFeedback.style.color = 'green';

            // Redireciona após 2 segundos o usuário para a página de exibição das contas cadastradas, após a exclusão com sucesso.
            setTimeout(() => {
                window.location.href = '../PHP/visualizarContasCadastradas.php';
            }, 2000);

        } else {

            mensagemFeedback.textContent = data.message;
            mensagemFeedback.style.color = 'red';

        }

        mensagemFeedback.style.display = 'block';

    })
    .catch(erro => {

        console.error('Erro:', erro);

    });

});
