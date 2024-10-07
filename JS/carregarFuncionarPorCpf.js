// Carregar funcionário especifico pesquisado pelo cpf.
document.getElementById('buscar').addEventListener('click', () => {
    
    const cpf = document.getElementById('inputCpf').value;
    const container = document.getElementById('container-funcionarios');
    const mensagemErro = document.getElementById('mensagem-erro');

    container.innerHTML = '';
    mensagemErro.textContent = '';

    fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
        .then(resposta => resposta.json())
        .then(dados => {

            const div = document.createElement('div');
            div.classList.add('funcionario');

            if (dados.length > 0) {
                
                const funcionario = dados[0];
                div.innerHTML = `
                    <p>Nome: ${funcionario.nome}</p>
                    <p>CPF: ${funcionario.cpf}</p>
                    <p>Usuário: ${funcionario.tipoConta}</p>
                `;

            } else {

                div.innerHTML = '<p>Funcionário não encontrado.</p>';
            }

            container.appendChild(div);
        })
        .catch(erro => {

            console.error('Erro ao buscar funcionário:', erro);
            mensagemErro.textContent = 'Ocorreu um erro ao buscar o funcionário. Por favor, tente novamente mais tarde.';

        });

});