
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
        toastr.error("CNPJ inválido.");
        return false;
    }
    if (!razaoSocial) {
        toastr.error("Razão Social é obrigatória.");
        return false;
    }
    if (!inscricaoEstadual) {
        toastr.error("Inscrição Estadual é obrigatória.");
        return false;
    }
    if (!telefone) {
        toastr.error("Telefone é obrigatório.");
        return false;
    }
    if (!email || !validarEmail(email)) {
        toastr.error("Email inválido.");
        return false;
    }
    if (!senha) {
        toastr.error("Senha é obrigatória.");
        return false;
    }
    if (!estado) {
        toastr.error("Estado é obrigatório.");
        return false;
    }
    if (!municipio) {
        toastr.error("Município é obrigatório.");
        return false;
    }
    if (!logradouro) {
        toastr.error("Logradouro é obrigatório.");
        return false;
    }
    if (!numeroEndereco) {
        toastr.error("Número do Endereço é obrigatório.");
        return false;
    }
    if (!bairro) {
        toastr.error("Bairro é obrigatório.");
        return false;
    }
    if (!cep) {
        toastr.error("CEP é obrigatório.");
        return false;
    }

    // Se todas as validações forem bem-sucedidas, envia o formulário
    this.submit();
};

function validarCNPJ(cnpj) {
    
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;

    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;

    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;

}

function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
