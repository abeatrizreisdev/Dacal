// Função para configurar o campo de busca para funcionários.
function configurarBuscaFuncionario() {

    const buscaContainer = document.getElementById('busca-container');
    buscaContainer.innerHTML = `
            <button id="buscarCpf">CPF</button>
            <input type="text" id="inputCpf" placeholder="Digite o CPF">
        `;
    document.getElementById('buscarCpf').addEventListener('click', buscarFuncionarioPorCpf);

}


function exibirMensagemErro(container, mensagem) {

   // console.log('Exibindo mensagem de erro:', mensagem); // Log de depuração

    let mensagemErro = document.getElementById('mensagem-erro');

    if (!mensagemErro) {

        mensagemErro = document.createElement('p');
        mensagemErro.id = 'mensagem-erro'; // Basta só utilizar esse id no css para estilizar a mensagem de erro.
        container.appendChild(mensagemErro);
        //console.log('Elemento de mensagem de erro criado:', mensagemErro); // Log de depuração

    }

    mensagemErro.textContent = mensagem;
    mensagemErro.style.display = 'block';
    //console.log('Mensagem de erro exibida:', mensagemErro); // Log de depuração

}


function buscarFuncionarioPorCpf() {

    const cpf = document.getElementById('inputCpf').value;
    const container = document.getElementById('container-funcionarios');
    container.innerHTML = '';

    fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
        .then(resposta => {

            if (!resposta.ok) {

                throw new Error('Erro na resposta do servidor');

            }

            return resposta.json();

        })
        .then(dados => {

            if (dados && dados.nome) {

                exibirFuncionario(dados, container);
                let mensagemErro = document.getElementById('mensagem-erro');
                if (mensagemErro) mensagemErro.style.display = 'none'; // Ocultando a mensagem de erro.

            } else {

                //console.log('Dados recebidos:', dados); // Log de depuração
                exibirMensagemErro(container, dados.error || 'Funcionário(a) não encontrado(a).');

            };

        })
        .catch(erro => {
            console.error('Erro ao buscar os dados do funcionário:', erro);
            exibirMensagemErro(container, 'Erro ao buscar os dados do funcionário.');
        });
        
}


function buscarTodosFuncionarios() {

    const container = document.getElementById('container-funcionarios');
    container.innerHTML = '';

    // Fazendo a requisição para o back-end retornar os funcionários cadastrados.
    fetch(`../PHP/crud/retornarDados/retornarTodosFuncionarios.php`)
        .then(resposta => {

            if (!resposta.ok) {

                throw new Error('Erro na resposta do servidor');

            }

            return resposta.json();

        })
        .then(dados => {

            if (dados && Array.isArray(dados) && dados.length > 0) {

                dados.forEach(funcionario => exibirFuncionario(funcionario, container));
                let mensagemErro = document.getElementById('mensagem-erro');
                if (mensagemErro) mensagemErro.style.display = 'none'; // Ocultando a mensagem de erro

            } else {

                exibirMensagemErro(container, 'Nenhum funcionário cadastrado.');

            };

        })
        .catch(erro => {

            exibirMensagemErro(container, 'Erro ao buscar os funcionários.');
            console.error('Erro ao buscar os funcionários:', erro);
            
        });
}




function exibirFuncionario(funcionario, container) {

    const div = document.createElement('div');

    div.classList.add('funcionario');

    div.innerHTML = `
        <div class="perfil">
            <div class="perfilAjustar">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" id="perfilImg">
                <div class="infoPerfil">
                    <p class="perfilFuncionario">${funcionario.nome}</p>
                    <button class="btnExcluir" onclick="excluirPerfil(${funcionario.id})">Excluir Conta</button>
                    <button class="btnEditar" onclick="editarPerfil('${funcionario.cpf}')">Editar Perfil</button>
                </div>
            </div>
        </div>
    `;

    container.appendChild(div);

}


// Função para navegar até a página de edição do funcionário.
function editarPerfil(cpf) {

    if (!cpf || cpf.length === 0) {

        console.error('CPF inválido:', cpf);
        return;

    }

    fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
        .then(resposta => {
            if (!resposta.ok) {
                throw new Error('Erro na resposta do servidor');
            }
            return resposta.json(); 
        })
        .then(dados => {
            
            if (dados.error) {
                console.error('Erro:', dados.error);
                return;
            }
           // console.log('Dados do funcionário:', dados); // Dados convertidos de JSON
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
           // console.log('URL de redirecionamento:', url.toString());
            window.location.href = url.toString();
        })
        .catch(erro => {
            console.error('Erro ao buscar os dados do funcionário:', erro);
        });
}



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

            //console.log('Resposta do servidor:', texto); // Exibir resposta do servidor no console.

            try {

                const dados = JSON.parse(texto); // Convertendo a resposta do servidor para JSON.

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
