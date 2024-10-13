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
const formatarTelefone = (telefone) => {
    return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
};

// Função para formatar o CEP
const formatarCEP = (cep) => {
    return cep.replace(/^(\d{5})(\d{3})$/, "$1-$2");
};
