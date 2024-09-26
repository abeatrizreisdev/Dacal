<?php 

    class Sessao {

        public function __construct() {

            session_start();

        }

        public function setChaveEValorSessao($chave, $valor) {

            $_SESSION[$chave] = $valor;

        }

        public function getValorSessao($chave) {

            // Verifica se a chave existe na sessão, se sim vai retornar seu valor, se não retorna null.
            return isset($_SESSION[$chave]) ? $_SESSION[$chave] : null;

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