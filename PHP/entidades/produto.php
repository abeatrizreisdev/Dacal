<?php

    class Produto {

        /* 
        
        Atributos: 

        - id: Int
        - nome: String
        - valor: Double
        - descricao: String
        - imagem: Blob
        - categoria: Int
        
        */

        private $id;
        private $nome;
        private $valor;
        private $descricao;
        private $categoria;
        private $imagem;
    


        public function __construct() {
            
        }

        public function setId($id) {

            // Se for um valor númerico (int, por exemplo) e maior que 0.
            if (is_numeric($id) && $id <= 0) {

                throw new Exception("Erro. O id deve ser um número maior que 0.");

            } else if(is_null($id)) {

                throw new Exception("Erro. O id não pode ser nulo.");

            }

            $this->id = $id;
            
        }

        public function setNome($nome) {

            if (empty($nome)) {

                throw new Exception("Erro. O nome do produto não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome do produto deve ser do tipo texto.");

            }

            $this->nome = $nome;

        }

        public function setValor($valor) {

            // Verifica se o valor é numérico.
            if (!is_numeric($valor)) {

                throw new Exception("Erro. Valor do produto inválido.");
                
            }

            // Verifica se o valor é menor ou igual a zero.
            if ($valor <= 0) {

                throw new Exception("Erro. O valor do produto não pode ser igual ou menor que 0.");
                
            }

            $this->valor = $valor;

        }

        public function setDescricao($descricao) {

            if (empty($descricao)) {

                throw new Exception("Erro. A descrição do produto não pode ser vazia.");

            } elseif (!is_string($descricao)) {

                throw new Exception("Erro. A descrição do produto deve ser do tipo texto.");

            }

            $this->descricao = $descricao;

        }

        public function setImagem($imagem) {

            if ($imagem == null) {

                throw new Exception("Imagem do produto inválida.");

            }

            $this->imagem = $imagem;

        }

        public function setCategoria($categoria) {

            if ($categoria == null or !is_numeric($categoria)) {

                throw new Exception("Categoria do produto inválida.");

            }

            $this->categoria = $categoria;

        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getValor() {
            return $this->valor;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        /*
        Métodos: 

        + setId(Int id): Void
        + setNome(String nome): Void
        + setValor(Double valor): Void
        + setDescricao(String descricao): Void
        + setImagem(String imagem): Void
        + getId(): Int
        + getNome(): String
        + getValor(): Double
        + getDescricao(): String
        + getImagem(): Blob
        + getCategoria(): Int
        
        */

    }

?>