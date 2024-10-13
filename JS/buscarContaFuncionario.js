    // Função para configurar o campo de busca para funcionários.
    function configurarBuscaFuncionario() {

        const buscaContainer = document.getElementById('busca-container');

        buscaContainer.innerHTML = `
            <button id="buscarCpf">Buscar CPF</button>
            <input type="text" id="inputCpf" placeholder="Digite o CPF">
        `;

        document.getElementById('buscarCpf').addEventListener('click', buscarFuncionarioPorCpf);

    };

    // Função para buscar um funcionário pelo CPF.
    function buscarFuncionarioPorCpf() {

        const cpf = document.getElementById('inputCpf').value;
        const container = document.getElementById('container-funcionarios');
        const mensagemErro = document.getElementById('mensagem-erro');

        container.innerHTML = '';
        mensagemErro.textContent = '';

        fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
            .then(resposta => resposta.json())
            .then(dados => {

                exibirFuncionario(dados, container);

            })
            .catch(erro => {

                mensagemErro.textContent = 'Funcionário(a) não encontrado(a).';

            });

    };

    // Função para buscar todos os funcionários cadastrados.
    const buscarTodosFuncionarios = () => {

        const container = document.getElementById('container-funcionarios');
        container.innerHTML = ''; // Limpa o container aqui.
        const mensagemErro = document.getElementById('mensagem-erro');
        mensagemErro.textContent = '';

        fetch(`../PHP/crud/retornarDados/retornarTodosFuncionarios.php`)
            .then(resposta => {

                if (!resposta.ok) {

                    throw new Error('Erro na resposta do servidor');

                }

                return resposta.json();

            })
            .then(dados => {

                if (dados.length) {

                    dados.forEach(funcionario => exibirFuncionario(funcionario, container));

                } else {

                    container.innerHTML = '<p>Nenhum funcionário cadastrado.</p>';

                }

            })
            .catch(erro => {

                console.error('Erro ao buscar os funcionários:', erro); // Log para depuração.
                mensagemErro.textContent = 'Ocorreu um erro ao buscar os funcionários. Por favor, tente novamente mais tarde.';

            });
    };

    // Função para exibir informações de um funcionário.
    const exibirFuncionario = (funcionario, container) => {

        const div = document.createElement('div');

        div.classList.add('funcionario');
        div.innerHTML = `
            <p>Nome: ${funcionario.nome}</p>
            <p>CPF: ${formatarCPF(funcionario.cpf)}</p>
            <p>Usuário: ${funcionario.tipoConta}</p>
        `;

        container.appendChild(div);

    };

    document.getElementById('funcionario').addEventListener('click', () => {

        document.getElementById('funcionario').classList.add('selecionado');
        document.getElementById('empresa').classList.remove('selecionado');
        configurarBuscaFuncionario();
        buscarTodosFuncionarios();
        
    });
