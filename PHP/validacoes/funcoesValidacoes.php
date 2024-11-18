<?php

function validarCPF($cpf) {

    // Remove qualquer caractere que não seja número
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores
    for ($tamanho = 9; $tamanho < 11; $tamanho++) {

        $somaDigitos = 0;

        for ($posicao = 0; $posicao < $tamanho; $posicao++) {

            $somaDigitos += $cpf[$posicao] * (($tamanho + 1) - $posicao);

        }

        $digitoVerificador = ((10 * $somaDigitos) % 11) % 10;

        if ($cpf[$posicao] != $digitoVerificador) {

            return false;

        }
        
    }

    return true;
}

function validarCNPJ($cnpj) {
    // Extrai os números
    $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);

    // Valida tamanho
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Verifica sequência de digitos repetidos. Ex: 11.111.111/111-11
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Valida dígitos verificadores
    for ($t = 12; $t < 14; $t++) {
        for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
            $d += $cnpj[$i] * $m;
            $m = ($m == 2 ? 9 : --$m);
        }

        $d = ((10 * $d) % 11) % 10;

        if ($cnpj[$i] != $d) {
            return false;
        }
    }

    return true;
}
