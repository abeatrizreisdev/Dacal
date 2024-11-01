
document.getElementById('formLogin').onsubmit = function(e) {
    e.preventDefault(); // Impede o envio do formulário até que todas as validações sejam feitas

    var cnpj = document.getElementById('cnpjEmpresa').value.trim();
    var razaoSocial = document.getElementById('razaoSocial').value.trim();
    var inscricaoEstadual = document.getElementById('inscricaoEstadual').value.trim();
    var telefone = document.getElementById('telefone').value.trim();
    var email = document.getElementById('email').value.trim();
    var senha = document.getElementById('senha').value.trim();
    var estado = document.getElementById('estado').value.trim();
    var municipio = document.getElementById('municipio').value.trim();
    var logradouro = document.getElementById('logradouro').value.trim();
    var numeroEndereco = document.getElementById('numeroEndereco').value.trim();
    var bairro = document.getElementById('bairro').value.trim();
    var cep = document.getElementById('cep').value.trim();

    // Validações simples
    if (!cnpj || !validarCNPJ(cnpj)) {
        alert("CNPJ inválido.");
        return false;
    }
    if (!razaoSocial) {
        alert("Razão Social é obrigatória.");
        return false;
    }
    if (!inscricaoEstadual) {
        alert("Inscrição Estadual é obrigatória.");
        return false;
    }
    if (!telefone) {
        alert("Telefone é obrigatório.");
        return false;
    }
    if (!email || !validarEmail(email)) {
        alert("Email inválido.");
        return false;
    }
    if (!senha) {
        alert("Senha é obrigatória.");
        return false;
    }
    if (!estado) {
        alert("Estado é obrigatório.");
        return false;
    }
    if (!municipio) {
        alert("Município é obrigatório.");
        return false;
    }
    if (!logradouro) {
        alert("Logradouro é obrigatório.");
        return false;
    }
    if (!numeroEndereco) {
        alert("Número do Endereço é obrigatório.");
        return false;
    }
    if (!bairro) {
        alert("Bairro é obrigatório.");
        return false;
    }
    if (!cep) {
        alert("CEP é obrigatório.");
        return false;
    }

    // Se todas as validações forem bem-sucedidas, envia o formulário
    this.submit();
};

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '' || cnpj.length != 14) {
        return false;
    }

    // Elimina CNPJs inválidos conhecidos
    if (/^(\d)\1+$/.test(cnpj)) {
        return false;
    }

    // Valida DVs
    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) {
            pos = 9;
        }
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) {
        return false;
    }

    tamanho += 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) {
            pos = 9;
        }
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) {
        return false;
    }

    return true;
}

function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
