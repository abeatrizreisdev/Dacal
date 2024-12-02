<?php

class Sessao {

    public function __construct() {
        session_start();
    }

    public function setChaveEValorSessao($chave, $valor): void {

        $valorSerializado = serialize($valor);
        error_log("Armazenando na sessão ($chave): $valorSerializado"); // Logando
        $_SESSION[$chave] = $valorSerializado;

    }

    public function getValorSessao($chave): mixed {

        $valor = isset($_SESSION[$chave]) ? $_SESSION[$chave] : null;

        if ($valor !== null) {
            
            // Verificação adicional para garantir que é uma string serializada corretamente
            if ($this->is_serialized($valor)) {

                try {

                    $deserializedValue = unserialize($valor);
                    return $deserializedValue !== false || $valor === 'b:0;' ? $deserializedValue : $valor;

                } catch (Exception $e) {

                    error_log("Erro ao deserializar a sessão ($chave): " . $e->getMessage());
                    return $valor; 
                }

            } else {

                error_log("Esperado uma string serializada, mas recebeu um tipo diferente para a sessão ($chave): " . gettype($valor)); 
                return $valor; 
            }

        }

        return $valor;
    }

    private function is_serialized($data): bool {

        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' === $data) {
            return true;
        }
        if (preg_match('/^([adObis]):/', $data, $badions)) {
            switch ($badions[1]) {
                case 'a':
                case 'O':
                case 's':
                    if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data)) {
                        return true;
                    }
                    break;
                case 'b':
                case 'i':
                case 'd':
                    if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data)) {
                        return true;
                    }
                    break;
            }

        }

        return false;

    }

    public function excluirChaveSessao($chave): bool {

        if (isset($_SESSION[$chave])) {
            unset($_SESSION[$chave]);
            return true;
        } else {
            return false;
        }

    }

    public function encerrarSessao(): void {
        session_unset();
        session_destroy();
    }

}
