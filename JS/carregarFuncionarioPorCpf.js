document.getElementById('buscar').addEventListener('click', () => {
    
    const cpf = document.getElementById('inputCpf').value;
    console.log('CPF digitado:', cpf); // Log para depuração
    const container = document.getElementById('container-funcionarios');
    const mensagemErro = document.getElementById('mensagem-erro');

    container.innerHTML = '';
    mensagemErro.textContent = '';

    fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
        .then(resposta => {
            
            return resposta.json();

        })
        .then(dados => {

            const div = document.createElement('div');
            div.classList.add('funcionario');

            if (dados && dados.cpf) { // Verifica se os dados têm a propriedade cpf.
                
                div.innerHTML = `
                    <p>Nome: ${dados.nome}</p>
                    <p>CPF: ${dados.cpf}</p>
                    <p>Usuário: ${dados.tipoConta}</p>
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
