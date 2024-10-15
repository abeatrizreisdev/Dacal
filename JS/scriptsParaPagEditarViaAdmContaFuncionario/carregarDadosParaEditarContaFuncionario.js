document.addEventListener('DOMContentLoaded', function() {

    function formatarTelefone(telefone) {

        // Remove espaços
        telefone = telefone.replace(/\s+/g, '');

        return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");

    }
    

    function formatarCEP(cep) {
        return cep.replace(/^(\d{5})(\d{3})$/, "$1-$2");
    }

    function formatarCPF(cpf) {
        return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
    }

    
    // Função para desformatar Telefone
    function desformatarTelefone(telefone) {
        return telefone.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
    };

    // Função para desformatar CEP
    function desformatarCEP(cep) {
        return cep.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
    };

    function obterParametrosDaUrl() {
        const parametros = new URLSearchParams(window.location.search);
        return {
            id: parametros.get('idFuncionario'),
            nome: parametros.get('nomeFuncionario'),
            cpf: parametros.get('cpfFuncionario'),
            email: parametros.get('emailFuncionario'),
            senha: parametros.get('senhaFuncionario'),
            telefone: parametros.get('telefoneFuncionario'),
            estado: parametros.get('estadoFuncionario'),
            cidade: parametros.get('cidadeFuncionario'),
            bairro: parametros.get('bairroFuncionario'),
            logradouro: parametros.get('logradouroFuncionario'),
            cep: parametros.get('cepFuncionario')
        };
    }

    function preencherCamposDeEdicao() {
        const dados = obterParametrosDaUrl();
        document.getElementById('inputId').value = dados.id;
        document.getElementById('inputNome').value = dados.nome;
        document.getElementById('inputCpf').value = formatarCPF(dados.cpf);
        document.getElementById('inputEmail').value = dados.email;
        document.getElementById('inputSenha').value = dados.senha;
        document.getElementById('inputTelefone').value = formatarTelefone(dados.telefone);
        document.getElementById('inputEstado').value = dados.estado;
        document.getElementById('inputCidade').value = dados.cidade;
        document.getElementById('inputBairro').value = dados.bairro;
        document.getElementById('inputLogradouro').value = dados.logradouro;
        document.getElementById('inputCep').value = formatarCEP(dados.cep);
        document.getElementById('idOcultoFunc').value = dados.id;
    }

    // Função para excluir perfil
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
                        window.location.href = '../PHP/visualizarContasCadastradas.php';
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

    document.getElementById('botaoExcluirConta').addEventListener('click', function() {
        const idFuncionario = document.getElementById('inputId').value;
        excluirPerfil(idFuncionario);
    });

    preencherCamposDeEdicao();
});
