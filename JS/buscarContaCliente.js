    // Função para configurar o campo de busca para empresas.
    function configurarBuscaEmpresa() {

        const buscaContainer = document.getElementById('busca-container');

        buscaContainer.innerHTML = `
            <button id="buscarNome">Nome</button>
            <input type="text" id="inputNome" placeholder="Digite o nome">   
        `;

        document.getElementById('buscarNome').addEventListener('click', buscarEmpresaPorNome);

    };

    // Função para buscar uma empresa pelo nome.
    function buscarEmpresaPorNome() {

        const nome = document.getElementById('inputNome').value;
        const container = document.getElementById('container-funcionarios');
        const mensagemErro = document.getElementById('mensagem-erro');

        container.innerHTML = '';
        mensagemErro.textContent = '';

        fetch(`../PHP/buscarCliente/buscarClientePeloNome.php?nome=${nome}`)
            .then(resposta => resposta.text())
            .then(texto => {

                try {

                    const dados = JSON.parse(texto);
                    exibirEmpresa(dados, container);

                } catch (erro) {

                    mensagemErro.textContent = 'Cliente não encontrado.';
                }

            })
            .catch(erro => {

                mensagemErro.textContent = 'Ocorreu um erro ao buscar a empresa. Por favor, tente novamente mais tarde.';

            });

    };

    // Função para buscar todas as empresas cadastradas.
    function buscarTodasEmpresas() {

        const container = document.getElementById('container-funcionarios');
        container.innerHTML = ''; // Limpa o container aqui.
        const mensagemErro = document.getElementById('mensagem-erro');
        mensagemErro.textContent = '';
        
        fetch(`../PHP/buscarCliente/buscarTodosClientes.php`)
            .then(resposta => {

                if (!resposta.ok) {

                    throw new Error('Erro na resposta do servidor');

                }
                
                return resposta.json();

            })
            .then(dados => {

                if (dados.length) {

                    dados.forEach(empresa => exibirEmpresa(empresa, container));

                } else {

                    container.innerHTML = '<p>Nenhuma empresa cadastrada.</p>';

                }

            })
            .catch(erro => {

                console.error('Erro ao buscar as empresas:', erro); // Log para depuração.
                mensagemErro.textContent = 'Ocorreu um erro ao buscar as empresas. Por favor, tente novamente mais tarde.';

            });

    };

    // Função para exibir informações de uma empresa.
    function exibirEmpresa(empresa, container) {

        const div = document.createElement('div');

        div.classList.add('empresa');
        div.innerHTML = `
            <p>${empresa.nomeEmpresa}</p>
            <button onclick="excluirPerfilEmpresa('${empresa.idCliente}')"> Excluir Conta </button>
            <button onclick="editarPerfilEmpresa('${empresa.nomeEmpresa}')"> Editar Perfil </button>
        `;

        container.appendChild(div);

    };

    // Função para navegar até a página de edição do funcionário.
    function editarPerfilEmpresa(nome) {

        fetch(`../PHP/buscarCliente/buscarClientePeloNome.php?nome=${nome}`)
            .then(resposta => resposta.json())
            .then(dados => {

                const url = new URL('../Dacal/PHP/editarViaAdmContaCliente.php', window.location.origin);

                url.searchParams.set('idEmpresa', dados.idCliente);
                url.searchParams.set('nomeEmpresa', dados.nomeEmpresa);
                url.searchParams.set('inscricaoEstadual', dados.inscricaoEstadual);
                url.searchParams.set('razaoSocial', dados.razaoSocial);
                url.searchParams.set('cnpjEmpresa', dados.cnpj);
                url.searchParams.set('emailEmpresa', dados.email);
                url.searchParams.set('senhaEmpresa', dados.senha);
                url.searchParams.set('telefoneEmpresa', dados.telefone);
                url.searchParams.set('estadoEmpresa', dados.estado);
                url.searchParams.set('municipioEmpresa', dados.municipio);
                url.searchParams.set('bairroEmpresa', dados.bairro);
                url.searchParams.set('logradouroEmpresa', dados.logradouro);
                url.searchParams.set('cepEmpresa', dados.cep);
                url.searchParams.set('numeroEnderecoEmpresa', dados.numeroEndereco);

                window.location.href = url.toString();

            })
            .catch(erro => {

                console.error('Erro ao buscar os dados do funcionário:', erro); // Log para depuração.
                
            });

    };


    // Função para excluir o perfil do funcionário.
    function excluirPerfilEmpresa(id) {

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

    

    document.getElementById('empresa').addEventListener('click', () => {

        document.getElementById('empresa').classList.add('selecionado');
        document.getElementById('funcionario').classList.remove('selecionado');
        configurarBuscaEmpresa();
        buscarTodasEmpresas();
        
    });
