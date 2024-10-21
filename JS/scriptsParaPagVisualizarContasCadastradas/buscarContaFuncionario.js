// Função para configurar o campo de busca para funcionários.
function configurarBuscaFuncionario() {

    const buscaContainer = document.getElementById('busca-container');
    buscaContainer.innerHTML = `
            <button id="buscarCpf">CPF</button>
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
            if (dados && dados.nome) {
                exibirFuncionario(dados, container);
            } else {
                mensagemErro.textContent = 'Funcionário(a) não encontrado(a).';
            }
        })
        .catch(erro => {
            mensagemErro.textContent = 'Erro ao buscar os dados do funcionário.';
            console.error('Erro ao buscar os dados do funcionário:', erro);
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
            mensagemErro.textContent = 'Nenhum funcionário cadastrado no sistema.';

        });

}

// Função para exibir informações de um funcionário.
function exibirFuncionario(funcionario, container) {

    const div = document.createElement('div');
    div.classList.add('funcionario');
    div.innerHTML = `
            <div class="perfil">
            <div class="perfilAjustar">
            <img src="../IMAGENS/HomeEmpresa/imgUser.png" id=perfilImg>
            <div class="infoPerfil">
            <p class="perfilFuncionario">${funcionario.nome}</p>
            <button class ="btnExcluir" onclick="excluirPerfil(${funcionario.id})">Excluir Conta</button>
            <button class ="btnEditar" onclick="editarPerfil(${funcionario.cpf})">Editar Perfil</button>
            </div>
            </div>
            </div>
        `;
    container.appendChild(div);

};

// Função para navegar até a página de edição do funcionário.
function editarPerfil(cpf) {

    fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
        .then(resposta => resposta.json())
        .then(dados => {

            const url = new URL('../Dacal/PHP/editarFuncionario.php', window.location.origin);

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
            return resposta.text(); // Obter texto para depuração
        })
        .then(texto => {
            console.log('Resposta do servidor:', texto); // Exibir resposta no console
            try {
                const dados = JSON.parse(texto); // Tentar converter para JSON
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
            toastr.error('Ocorreu um erro ao excluir a conta');
            console.error('Erro:', error);
        });
}


document.getElementById('funcionario').addEventListener('click', () => {

    document.getElementById('funcionario').classList.add('selecionado');
    document.getElementById('empresa').classList.remove('selecionado');
    configurarBuscaFuncionario();
    buscarTodosFuncionarios();

});
