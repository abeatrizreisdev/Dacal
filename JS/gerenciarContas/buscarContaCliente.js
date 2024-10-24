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
        container.innerHTML = '';
    
        fetch(`../PHP/buscarCliente/buscarClientePeloNome.php?nome=${nome}`)
            .then(resposta => {
                if (!resposta.ok) {
                    throw new Error('Erro na resposta do servidor');
                }
                return resposta.json();
            })
            .then(dados => {
                if (dados && Array.isArray(dados) && dados.length > 0) {
                    dados.forEach(empresa => exibirEmpresa(empresa, container));
                    let mensagemErro = document.getElementById('mensagem-erro');
                    if (mensagemErro) mensagemErro.style.display = 'none'; // Ocultando a mensagem de erro
                } else {
                    exibirMensagemErro(container, dados.error || 'Cliente não encontrado.');
                }
            })
            .catch(erro => {
                console.error('Erro ao buscar os dados da empresa:', erro);
                exibirMensagemErro(container, 'Ocorreu um erro ao buscar a empresa. Por favor, tente novamente mais tarde.');
            });
    }
    
    

    function exibirMensagemErro(container, mensagem) {

       // console.log('Exibindo mensagem de erro:', mensagem); // Log de depuração.
        let mensagemErro = document.getElementById('mensagem-erro');

        if (!mensagemErro) {

            // tipo do elemento que será criado para exibir a mensagem de erro.
            mensagemErro = document.createElement('p');
            mensagemErro.id = 'mensagem-erro'; // id do elemento para estilizar no css.

            // Criando o elemento da mensagem de erro dentro da div.
            container.appendChild(mensagemErro);
            console.log('Elemento de mensagem de erro criado:', mensagemErro); // Log de depuração
        }

        mensagemErro.textContent = mensagem;
        mensagemErro.style.display = 'block';

        //console.log('Mensagem de erro exibida:', mensagemErro); // Log de depuração

    }
    

    // Função para buscar todas as empresas cadastradas.
    function buscarTodasEmpresas() {

        const container = document.getElementById('container-funcionarios');
        container.innerHTML = '';
    
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

                    let mensagemErro = document.getElementById('mensagem-erro');
                    if (mensagemErro) mensagemErro.style.display = 'none'; // Ocultando a mensagem de erro.

                } else {

                   // console.log('Dados recebidos:', dados); // Log de depuração
                    exibirMensagemErro(container, 'Nenhuma empresa cadastrada.');

                }
            })
            .catch(erro => {

                console.error('Erro ao buscar as empresas:', erro);
                exibirMensagemErro(container, 'Nenhum cliente cadastrado no sistema.');

            });

    }
    

    // Função para exibir informações de uma empresa.
    function exibirEmpresa(empresa, container) {

        const div = document.createElement('div');

        div.classList.add('empresa');
        div.innerHTML = `
            <div class="perfil">
            <div class="perfilAjustar">
            <img src="../IMAGENS/HomeEmpresa/imgUser.png" id=perfilImg>
            <div class="infoPerfil">
            <p class="perfilEmpresa">${empresa.nomeEmpresa}</p>
            <button class ="btnExcluir" onclick="excluirPerfilEmpresa('${empresa.idCliente}')"> Excluir Conta </button>
            <button class ="btnEditar" onclick="editarPerfilEmpresa('${empresa.nomeEmpresa}')"> Editar Perfil </button>
            </div>
            </div>
            </div>
        `;

        container.appendChild(div);

    };

    // Função para navegar até a página de edição do funcionário.
    function editarPerfilEmpresa(nome) {

        fetch(`../PHP/buscarCliente/buscarClientePeloNome.php?nome=${nome}`)
            .then(resposta => resposta.json())
            .then(dados => {

                const url = new URL('../Dacal/PHP/editarContaEmpresa.php', window.location.origin);

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


    function excluirPerfilEmpresa(id) {
   
        const formData = new FormData();
        formData.append('idCliente', id);


        fetch('../PHP/excluirCliente/excluirCliente.php', {

            method: 'POST',
            body: formData

        })
        .then(resposta => {

            //console.log('Status da resposta:', resposta.status); // log para status da resposta.

            if (!resposta.ok) {

                throw new Error('Erro na requisição');

            }

            return resposta.text(); // Obter texto para depuração.

        })
        .then(texto => {

            // console.log('Resposta do servidor:', texto); // Exibir resposta no console para depurar.

            try {

                const dados = JSON.parse(texto); // Convertendo o texto para JSON.
                
                if (dados.status === 'success') {

                    toastr.success(dados.message);
                    setTimeout(() => {
                        window.location.href = '../PHP/gerenciarContas.php';
                    }, 2000);

                } else {

                    toastr.error(dados.message);

                }

            } catch (erro) {

                console.error('Erro ao analisar JSON:', erro);
                toastr.error('Ocorreu um erro inesperado. Por favor, tente novamente.');

            }

        })
        .catch(error => {

            toastr.error('Ocorreu um erro ao excluir a conta.');
            //console.error('Erro:', error);

        });

    }    

    

    document.getElementById('empresa').addEventListener('click', () => {

        document.getElementById('empresa').classList.add('selecionado');
        document.getElementById('funcionario').classList.remove('selecionado');
        configurarBuscaEmpresa();
        buscarTodasEmpresas();
        
    });
