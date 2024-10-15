<?php 

    class Sessao {

        public function __construct() {

            session_start();

        }

        public function setChaveEValorSessao($chave, $valor) {
            $serializedValue = serialize($valor);
            error_log("Storing in session ($chave): $serializedValue"); // Logging
            $_SESSION[$chave] = $serializedValue;
        }
    
        public function getValorSessao($chave) {
            $valor = isset($_SESSION[$chave]) ? $_SESSION[$chave] : null;
            if ($valor) {
                // Verificação adicional para garantir que estamos lidando com uma string serializada corretamente
                if (is_string($valor)) {
                    error_log("Retrieving from session ($chave): $valor"); // Logging
                    return unserialize($valor);
                } else {
                    error_log("Expected a serialized string but got a different type for session ($chave): " . gettype($valor)); // Logging
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

?> 