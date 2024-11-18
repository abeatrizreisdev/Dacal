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
