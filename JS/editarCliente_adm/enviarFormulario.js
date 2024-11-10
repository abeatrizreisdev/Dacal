function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, '');

    if (cnpj.length !== 14) return false;

    let soma1 = 0, soma2 = 0;
    const peso1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    const peso2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    for (let i = 0; i < 12; i++) {
        soma1 += cnpj[i] * peso1[i];
        soma2 += cnpj[i] * peso2[i];
    }

    let resto = soma1 % 11;
    let digito1 = resto < 2 ? 0 : 11 - resto;

    soma2 += digito1 * peso2[12];
    resto = soma2 % 11;
    let digito2 = resto < 2 ? 0 : 11 - resto;

    return (cnpj[12] == digito1 && cnpj[13] == digito2);
}

document.getElementById("btnSalvar").addEventListener("click", function (event) {

    let cnpj = document.getElementById("cnpjEmpresa").value;

    if (!validarCNPJ(cnpj)) {

        toastr.error("CNPJ inválido!");

        event.preventDefault(); // Impede o envio do formulário.

    } else {

        document.getElementById("formEditarConta").submit();

    }
    
});
