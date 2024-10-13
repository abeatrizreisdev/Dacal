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
            <button> Excluir Conta </button>
            <button> Editar Perfil </button>
        `;

        container.appendChild(div);

    };

    document.getElementById('empresa').addEventListener('click', () => {

        document.getElementById('empresa').classList.add('selecionado');
        document.getElementById('funcionario').classList.remove('selecionado');
        configurarBuscaEmpresa();
        buscarTodasEmpresas();
        
    });
