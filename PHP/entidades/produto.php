<?php

    class Produto {

        /* 
        
        Atributos: 

        - id: Int
        - nome: String
        - valor: Double
        - descricao: String
        - imagem: String
        - categoria: Int
        
        */

        private int $id;
        private string $nome;
        private float $valor;
        private string $descricao;
        private int $categoria;
        private string $imagem;
    
        public function __construct() {
            
        }

        public function setId(int $id): void {

            // Se for um valor númerico (int, por exemplo) e maior que 0.
            if (is_numeric($id) && $id <= 0) {

                throw new Exception("Erro. O id deve ser um número maior que 0.");

            } else if(is_null($id)) {

                throw new Exception("Erro. O id não pode ser nulo.");

            }

            $this->id = $id;
            
        }

        public function setNome(string $nome): void {

            if (empty($nome)) {

                throw new Exception("Erro. O nome do produto não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome do produto deve ser do tipo texto.");

            }

            $this->nome = $nome;

        }

        public function setValor(float $valor): void {

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

        public function setDescricao(string $descricao): void {

            if (empty($descricao)) {

                throw new Exception("Erro. A descrição do produto não pode ser vazia.");

            } elseif (!is_string($descricao)) {

                throw new Exception("Erro. A descrição do produto deve ser do tipo texto.");

            }

            $this->descricao = $descricao;

        }

        public function setImagem(string $imagem): void {

            if ($imagem == null) {

                throw new Exception("Imagem do produto inválida.");

            }

            $this->imagem = $imagem;

        }

        public function setCategoria(int $categoria) {

            if ($categoria == null or !is_numeric($categoria)) {

                throw new Exception("Categoria do produto inválida.");

            }

            $this->categoria = $categoria;

        }

        public function getId(): int {
            return $this->id;
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function getValor(): float {
            return $this->valor;
        }

        public function getDescricao(): string {
            return $this->descricao;
        }

        public function getImagem(): string {
            return $this->imagem;
        }

        public function getCategoria(): int {
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
        + getImagem(): String
        + getCategoria(): Int
        
        */

    }

