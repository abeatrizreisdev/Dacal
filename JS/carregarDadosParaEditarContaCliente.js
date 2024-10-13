
    // Função para formatar o telefone.
    function formatarTelefone(telefone) {

        return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");

    };

    // Função para formatar o CEP.
    function formatarCEP(cep) {

        return cep.replace(/^(\d{5})(\d{3})$/, "$1-$2");

    }

    // Função para formatar o CPF.
    function formatarCPF(cpf) {
        return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
    }



    // Este arquivo js é responsável por carregar os dados de uma conta cliente
    // Para que somente o adm possa editar esses dados
    // Para o próprio cliente editar seus dados, não precisa usar esse arquivo

    // Função para obter os parâmetros da URL.
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

    // Função para preencher os campos de edição com os dados do funcionário.
    function preencherCamposDeEdicao() {

        const dados = obterParametrosDaUrl();

        document.getElementById('inputId').value =  dados.id;
        document.getElementById('inputNome').value = dados.nome;
        document.getElementById('inputCpf').value =  formatarCPF(dados.cpf);
        document.getElementById('inputEmail').value = dados.email;
        document.getElementById('inputSenha').value = dados.senha;
        document.getElementById('inputTelefone').value = formatarTelefone(dados.telefone);
        document.getElementById('inputEstado').value = dados.estado;
        document.getElementById('inputCidade').value = dados.cidade;
        document.getElementById('inputBairro').value = dados.bairro;
        document.getElementById('inputLogradouro').value = dados.logradouro;
        document.getElementById('inputCep').value = formatarCEP(dados.cep);

    }

    // Chama a função para preencher os campos quando a página é carregada.
    document.addEventListener('DOMContentLoaded', preencherCamposDeEdicao);
