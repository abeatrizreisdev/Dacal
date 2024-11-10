<?php 

class Sessao {

    public function __construct() {

        session_start();

    }

    public function setChaveEValorSessao($chave, $valor) {

        $valorSerializado = serialize($valor);
        error_log("Armazenando na sessão ($chave): $valorSerializado"); // Logando
        $_SESSION[$chave] = $valorSerializado;
        
    }

    public function getValorSessao($chave) {

        $valor = isset($_SESSION[$chave]) ? $_SESSION[$chave] : null;

        if ($valor) {

            // Verificação adicional para garantir que estamos lidando com uma string serializada corretamente
            if (is_string($valor)) {

                return unserialize($valor);

            } else {

                error_log("Esperado uma string serializada, mas recebeu um tipo diferente para a sessão ($chave): " . gettype($valor)); // Logando

            }

        }

        return $valor;
        
    }

    public function excluirChaveSessao($chave) {

        if (isset($_SESSION[$chave])) {

            unset($_SESSION[$chave]);

            return true;

        } else {

            return false;

        }

    }

    public function encerrarSessao() {

        session_unset();
        session_destroy();

    }

}
