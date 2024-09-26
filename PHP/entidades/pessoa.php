<?php 

    class Pessoa {

        private $id = null;
        private $nome;
        private $email;
        private $senha;
        private $telefone;
        private $tipoConta;
        private $cpf;
        private $estado;
        private $cidade;
        private $bairro;
        private $logradouro;
        private $cep;
        private $numeroEndereco;


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

                throw new Exception("Erro. O nome não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome deve ser do tipo texto.");

            }

            $this->nome = $nome;

        }

        public function setEmail($email) {

            if (empty($email)) {

                throw new Exception("Erro. O email não pode ser vazio.");

            } elseif (!is_string($email)) {

                throw new Exception("Erro. O email deve ser do tipo texto.");

            }

            $this->email = $email;

        }

        public function setSenha($senha) {

            if (empty($senha)) {

                throw new Exception("Erro. A senha não pode ser vazia.");

            } elseif (!is_string($senha)) {

                throw new Exception("Erro. A senha deve ser do tipo texto.");

            }

            $this->senha = $senha;


        }

        public function setTelefone($telefone) {

            if (empty($telefone)) {

                throw new Exception("Erro. O número do telefone não pode ser vazio.");

            } elseif (!is_string($telefone)) {

                throw new Exception("Erro. O número do telefone deve ser do tipo texto.");

            }

            $this->telefone = $telefone;

        }

        public function setTipoConta($tipoConta) {

            if (empty($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do usuário não pode ser vazio.");

            } elseif (!is_string($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do usuário deve ser do tipo texto.");

            }

            $this->tipoConta = $tipoConta;

        }

        public function setCpf($cpf) {

            if (empty($cpf)) {

                throw new Exception("Erro. O cpf não pode ser vazio.");

            } elseif (!is_string($cpf)) {

                throw new Exception("Erro. O cpf deve ser do tipo texto.");

            }

            $this->cpf = $cpf;

        }

        public function setEstado($estado) {

            if (empty($estado)) {

                throw new Exception("Erro. O estado do usuário não pode ser vazio.");

            } elseif (!is_string($estado)) {

                throw new Exception("Erro. O estado do usuário deve ser do tipo texto.");

            }

            $this->estado = $estado;

        }

        public function setCidade($cidade) {

            if (empty($cidade)) {

                throw new Exception("Erro. A cidade do usuário não pode ser vazio.");

            } elseif (!is_string($cidade)) {

                throw new Exception("Erro. A cidade do usuário deve ser do tipo texto.");

            }

            $this->cidade = $cidade;

        }

        public function setBairro ($bairro) {

            if (empty($bairro)) {

                throw new Exception("Erro. O bairro do usuário não pode ser vazio.");

            } elseif (!is_string($bairro)) {

                throw new Exception("Erro. O bairro do usuário deve ser do tipo texto.");

            }

            $this->bairro = $bairro;

        }

        public function setLogradouro($logradouro) {

            if (empty($logradouro)) {

                throw new Exception("Erro. O logradouro do usuário não pode ser vazio.");

            } elseif (!is_string($logradouro)) {

                throw new Exception("Erro. O logradouro do usuário deve ser do tipo texto.");

            }

            $this->logradouro = $logradouro;

        }


        public function setCep($cep) {
            
            if (empty($cep)) {

                throw new Exception("Erro. O cep do usuário não pode ser vazio.");

            } elseif (!is_string($cep)) {

                throw new Exception("Erro. O cep do usuário deve ser do tipo texto.");

            }

            $this->cep = $cep;

        }

        public function setNumeroEndereco($numeroEndereco) {
            
            if (empty($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do usuário não pode ser vazio.");

            } elseif (!is_numeric($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do usuário deve ser do tipo númerico.");

            }

            $this->numeroEndereco = $numeroEndereco;

        }

        public function getId() {
            return $this->id;
        }

        public function geNome() {
            return $this->nome;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function getTipoConta() {
            return $this->tipoConta;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function getCidade() {
            return $this->cidade;
        }

        public function getBairro() {
            return $this->bairro;
        }

        public function getLogradouro() {
            return $this->logradouro;
        }

        public function getCep() {
            return $this->cep;
        }

        public function getNumeroEndereco() {
            return $this->numeroEndereco;
        }

    }

?>