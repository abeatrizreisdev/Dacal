    // Função para configurar o campo de busca para funcionários.
    function configurarBuscaFuncionario() {

        const buscaContainer = document.getElementById('busca-container');
        buscaContainer.innerHTML = `
            <button id="buscarCpf">Buscar CPF</button>
            <input type="text" id="inputCpf" placeholder="Digite o CPF">
        `;
        document.getElementById('buscarCpf').addEventListener('click', buscarFuncionarioPorCpf);
        
    }

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
    }

    // Função para buscar todos os funcionários cadastrados.
    function buscarTodosFuncionarios() {

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

    }

    // Função para exibir informações de um funcionário.
    function exibirFuncionario(funcionario, container) {

        const div = document.createElement('div');
        div.classList.add('funcionario');
        div.innerHTML = `
            <p>${funcionario.nome}</p>
            <button onclick="excluirPerfil(${funcionario.id})">Excluir Conta</button>
            <button onclick="editarPerfil(${funcionario.cpf})">Editar Perfil</button>
            <p id="mensagemFeedback"> Feedback Exclusão </p>
        `;
        container.appendChild(div);

    };

    // Função para navegar até a página de edição do funcionário.
    function editarPerfil(cpf) {

        fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
            .then(resposta => resposta.json())
            .then(dados => {

                const url = new URL('../Dacal/PHP/editarViaAdmContaFuncionario.php', window.location.origin);

                url.searchParams.set('idFuncionario', dados.id);
                url.searchParams.set('nomeFuncionario', dados.nome);
                url.searchParams.set('cpfFuncionario', dados.cpf);
                url.searchParams.set('emailFuncionario', dados.email);
                url.searchParams.set('senhaFuncionario', dados.senha);
                url.searchParams.set('telefoneFuncionario', dados.telefone);
                url.searchParams.set('estadoFuncionario', dados.estado);
                url.searchParams.set('cidadeFuncionario', dados.cidade);
                url.searchParams.set('bairroFuncionario', dados.bairro);
                url.searchParams.set('logradouroFuncionario', dados.logradouro);
                url.searchParams.set('cepFuncionario', dados.cep);

                
                window.location.href = url.toString();

            })
            .catch(erro => {

                console.error('Erro ao buscar os dados do funcionário:', erro); // Log para depuração.
                
            });

    };

    // Função para excluir o perfil do funcionário.
    function excluirPerfil(id) {

        const formData = new FormData();
        formData.append('idFuncionario', id);

        fetch('../PHP/excluirFuncionario/excluirFuncionario.php', {
            method: 'POST',
            body: formData
        })
        .then(resposta => {

            if (!resposta.ok) {

                throw new Error('Erro na requisição');

            }

            return resposta.json();

        })
        .then(dados => {

            const mensagemFeedback = document.getElementById('mensagemFeedback');

            if (dados.status === 'success') {

                mensagemFeedback.textContent = dados.message;
                mensagemFeedback.style.color = 'green';

                // Redireciona após 2 segundos
                setTimeout(() => {
                    window.location.href = '../PHP/visualizarContasCadastradas.php';
                }, 2000);

            } else {

                mensagemFeedback.textContent = dados.message;
                mensagemFeedback.style.color = 'red';

            }

            mensagemFeedback.style.display = 'block';

        })
        .catch(error => {

            console.error('Erro:', error);

        });
    }

    document.getElementById('funcionario').addEventListener('click', () => {

        document.getElementById('funcionario').classList.add('selecionado');
        document.getElementById('empresa').classList.remove('selecionado');
        configurarBuscaFuncionario();
        buscarTodosFuncionarios();

    });
