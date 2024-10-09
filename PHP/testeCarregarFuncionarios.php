<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <button id="empresa">Empresa</button>
    <button id="funcionario">Funcionário</button>

    <div id="busca-container">
        <!-- Conteúdo dinâmico será inserido aqui -->
    </div>

    <div id="container-funcionarios"></div>
    <p id="mensagem-erro"></p>

    <script src="../JS/carregarTodosFuncionarios.js"></script>
    <script src="../JS/carregarFuncionarioPorCpf.js"></script>
    <script>

        document.getElementById('empresa').addEventListener('click', () => {

        const buscaContainer = document.getElementById('busca-container');
        buscaContainer.innerHTML = `
            <input type="text" id="inputNome" placeholder="Digite o nome">
            <button id="buscarNome">Buscar Nome</button>
        `;

        document.getElementById('buscarNome').addEventListener('click', () => {

        const nome = document.getElementById('inputNome').value;
        const container = document.getElementById('container-funcionarios');
        const mensagemErro = document.getElementById('mensagem-erro');

        container.innerHTML = '';
        mensagemErro.textContent = '';

        fetch(`../PHP/buscarCliente/buscarClientePeloNome.php?nome=${nome}`)
    .then(resposta => {
        console.log('Resposta recebida:', resposta);

        if (!resposta.ok) {
            throw new Error('Erro na resposta do servidor');
        }

        return resposta.text(); // Primeiro, obter como texto
    })
    .then(texto => {
        console.log('Texto recebido:', texto); // Log do texto recebido

        try {
            const dados = JSON.parse(texto); // Tentar converter para JSON
            console.log('Dados recebidos:', dados); // Log para depuração

            const div = document.createElement('div');
            div.classList.add('empresa');

            if (dados && !dados.erro && !dados.mensagem) {
                div.innerHTML = `
                    <p>Nome: ${dados.nomeEmpresa}</p>
                    <p>Razão Social: ${dados.razaoSocial}</p>
                    <p>Cnpj: ${dados.cnpj}</p>
                `;
            } else {
                div.innerHTML = `<p>${dados.mensagem || 'Empresa não encontrada.'}</p>`;
            }

            container.appendChild(div);
        } catch (erro) {
            console.error('Erro ao analisar JSON:', erro); // Log para depuração
            mensagemErro.textContent = 'Ocorreu um erro ao analisar a resposta do servidor. Por favor, tente novamente mais tarde.';
        }
    })
    .catch(erro => {
        console.error('Erro ao buscar empresa:', erro); // Log para depuração
        mensagemErro.textContent = 'Ocorreu um erro ao buscar a empresa. Por favor, tente novamente mais tarde.';
    });


    });

});

document.getElementById('funcionario').addEventListener('click', () => {
    const buscaContainer = document.getElementById('busca-container');
    buscaContainer.innerHTML = `
        <input type="text" id="inputCpf" placeholder="Digite o CPF">
        <button id="buscarCpf">Buscar CPF</button>
    `;

    document.getElementById('buscarCpf').addEventListener('click', () => {
        const cpf = document.getElementById('inputCpf').value;
        const container = document.getElementById('container-funcionarios');
        const mensagemErro = document.getElementById('mensagem-erro');

        container.innerHTML = '';
        mensagemErro.textContent = '';

        fetch(`../PHP/crud/retornarDados/buscarFuncionarioPeloCpf.php?cpf=${cpf}`)
            .then(resposta => {
                console.log('Resposta recebida:', resposta); // Log para depuração
                if (!resposta.ok) {
                    throw new Error('Erro na resposta do servidor');
                }
                return resposta.json();
            })
            .then(dados => {
                console.log('Dados recebidos:', dados); // Log para depuração
                const div = document.createElement('div');
                div.classList.add('funcionario');

                if (dados && dados.cpf) {
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
                console.error('Erro ao buscar funcionário:', erro); // Log para depuração
                mensagemErro.textContent = 'Ocorreu um erro ao buscar o funcionário. Por favor, tente novamente mais tarde.';
            });
    });
});

    </script>
</body>
</html>
