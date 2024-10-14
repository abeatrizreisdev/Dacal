// Função para formatar a Inscrição Estadual da Bahia
const formatarIE = (inscricaoEstadual) => {
    const partes = inscricaoEstadual.match(/^(\d{2})(\d{3})(\d{3})(\d{1})$/);
    if (partes) {
        return `${partes[1]}.${partes[2]}.${partes[3]}-${partes[4]}`;
    } else {
        return inscricaoEstadual;
    }
};

// Função para formatar o CNPJ
const formatarCNPJ = (cnpj) => {
    return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
};

// Função para formatar o CPF
const formatarCPF = (cpf) => {
    return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
};

// Função para formatar o telefone
function formatarTelefone(telefone) {

    // Remove espaços
    telefone = telefone.replace(/\s+/g, '');


    return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
    
}
// Função para formatar o CEP
const formatarCEP = (cep) => {
    return cep.replace(/^(\d{5})(\d{3})$/, "$1-$2");
};

// Função para desformatar CNPJ
const desformatarCNPJ = (cnpj) => {
    return cnpj.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
};

// Função para desformatar Inscrição Estadual
const desformatarIE = (inscricaoEstadual) => {
    return inscricaoEstadual.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
};

// Função para desformatar Telefone
const desformatarTelefone = (telefone) => {
    return telefone.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
};

// Função para desformatar CEP
const desformatarCEP = (cep) => {
    return cep.replace(/[^\d]/g, ''); // Remove todos os caracteres que não são dígitos
};


document.getElementById('formEditarConta').addEventListener('submit', function(event) {
    event.preventDefault();

    // Obter os campos do formulário
    const cnpjInput = document.getElementById('cnpjEmpresa');
    const inscricaoEstadualInput = document.getElementById('inscricaoEstadual');
    const telefoneInput = document.getElementById('telefone');
    const cepInput = document.getElementById('cep');

    // Desformatar os valores
    cnpjInput.value = desformatarCNPJ(cnpjInput.value);
    inscricaoEstadualInput.value = desformatarIE(inscricaoEstadualInput.value);
    telefoneInput.value = desformatarTelefone(telefoneInput.value);
    cepInput.value = desformatarCEP(cepInput.value);

    // Submeter o formulário
    this.submit();
});

    // Este arquivo js é responsável por carregar os dados de uma conta cliente
    // Para que somente o adm possa editar esses dados
    // Para o próprio cliente editar seus dados, não precisa usar esse arquivo

    // Função para obter os parâmetros da URL.
    function obterParametrosDaUrlEmpresa() {

        const parametros = new URLSearchParams(window.location.search);

        return {

            id: parametros.get('idEmpresa'),
            nome: parametros.get('nomeEmpresa'),
            cnpj: parametros.get('cnpjEmpresa'),
            inscricaoEstadual: parametros.get('inscricaoEstadual'),
            razaoSocial: parametros.get('razaoSocial'),
            email: parametros.get('emailEmpresa'),
            senha: parametros.get('senhaEmpresa'),
            telefone: parametros.get('telefoneEmpresa'),
            estado: parametros.get('estadoEmpresa'),
            municipio: parametros.get('municipioEmpresa'),
            bairro: parametros.get('bairroEmpresa'),
            numeroEndereco: parametros.get('numeroEnderecoEmpresa'),
            logradouro: parametros.get('logradouroEmpresa'),
            cep: parametros.get('cepEmpresa')

        };

    }

    // Função para preencher os campos de edição com os dados do funcionário.
    function preencherCamposDeEdicaoEmpresa() {

        const dados = obterParametrosDaUrlEmpresa();

        document.getElementById('idCliente').value = dados.id;
        document.getElementById('nome').value = dados.nome;        
        document.getElementById('razaoSocial').value = dados.razaoSocial;
        document.getElementById('inscricaoEstadual').value = formatarIE(dados.inscricaoEstadual);
        document.getElementById('cnpjEmpresa').value =  formatarCNPJ(dados.cnpj);
        document.getElementById('trocarEmail').value = dados.email;
        document.getElementById('trocarSenha').value = dados.senha;
        document.getElementById('telefone').value = formatarTelefone(dados.telefone);
        document.getElementById('estado').value = dados.estado;
        document.getElementById('municipio').value = dados.municipio;
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('logradouro').value = dados.logradouro;
        document.getElementById('numeroEndereco').value = dados.numeroEndereco;
        document.getElementById('cep').value = formatarCEP(dados.cep);

    }

    // Chama a função para preencher os campos quando a página é carregada.
    document.addEventListener('DOMContentLoaded', preencherCamposDeEdicaoEmpresa);


    
