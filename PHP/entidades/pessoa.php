<?php 

    class Pessoa {

        private int $id ;
        private string $nome;
        private string $email;
        private string $senha;
        private string $telefone;
        private string $tipoConta;
        private string $cpf;
        private string $estado;
        private string $cidade;
        private string $bairro;
        private string $logradouro;
        private string $cep;
        private int $numeroEndereco;


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

                throw new Exception("Erro. O nome não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome deve ser do tipo texto.");

            }

            $this->nome = $nome;

        }

        public function setEmail(string $email) {

            if (empty($email)) {

                throw new Exception("Erro. O email não pode ser vazio.");

            } elseif (!is_string($email)) {

                throw new Exception("Erro. O email deve ser do tipo texto.");

            }

            $this->email = $email;

        }

        public function setSenha(string $senha) {

            if (empty($senha)) {

                throw new Exception("Erro. A senha não pode ser vazia.");

            } elseif (!is_string($senha)) {

                throw new Exception("Erro. A senha deve ser do tipo texto.");

            }

            $this->senha = $senha;


        }

        public function setTelefone(string $telefone) {

            if (empty($telefone)) {

                throw new Exception("Erro. O número do telefone não pode ser vazio.");

            } elseif (!is_string($telefone)) {

                throw new Exception("Erro. O número do telefone deve ser do tipo texto.");

            }

            $this->telefone = $telefone;

        }

        public function setTipoConta(string $tipoConta) {

            if (empty($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do usuário não pode ser vazio.");

            } elseif (!is_string($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do usuário deve ser do tipo texto.");

            }

            $this->tipoConta = $tipoConta;

        }

        public function setCpf(string $cpf) {

            if (empty($cpf)) {

                throw new Exception("Erro. O cpf não pode ser vazio.");

            } elseif (!is_string($cpf)) {

                throw new Exception("Erro. O cpf deve ser do tipo texto.");

            }

            $this->cpf = $cpf;

        }

        public function setEstado(string $estado) {

            if (empty($estado)) {

                throw new Exception("Erro. O estado do usuário não pode ser vazio.");

            } elseif (!is_string($estado)) {

                throw new Exception("Erro. O estado do usuário deve ser do tipo texto.");

            }

            $this->estado = $estado;

        }

        public function setCidade(string $cidade) {

            if (empty($cidade)) {

                throw new Exception("Erro. A cidade do usuário não pode ser vazio.");

            } elseif (!is_string($cidade)) {

                throw new Exception("Erro. A cidade do usuário deve ser do tipo texto.");

            }

            $this->cidade = $cidade;

        }

        public function setBairro (string $bairro) {

            if (empty($bairro)) {

                throw new Exception("Erro. O bairro do usuário não pode ser vazio.");

            } elseif (!is_string($bairro)) {

                throw new Exception("Erro. O bairro do usuário deve ser do tipo texto.");

            }

            $this->bairro = $bairro;

        }

        public function setLogradouro(string $logradouro) {

            if (empty($logradouro)) {

                throw new Exception("Erro. O logradouro do usuário não pode ser vazio.");

            } elseif (!is_string($logradouro)) {

                throw new Exception("Erro. O logradouro do usuário deve ser do tipo texto.");

            }

            $this->logradouro = $logradouro;

        }


        public function setCep(string $cep) {
            
            if (empty($cep)) {

                throw new Exception("Erro. O cep do usuário não pode ser vazio.");

            } elseif (!is_string($cep)) {

                throw new Exception("Erro. O cep do usuário deve ser do tipo texto.");

            }

            $this->cep = $cep;

        }

        public function setNumeroEndereco(int $numeroEndereco) {
            
            if (empty($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do usuário não pode ser vazio.");

            } elseif (!is_numeric($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do usuário deve ser do tipo númerico.");

            }

            $this->numeroEndereco = $numeroEndereco;

        }

        public function getId(): int {
            return $this->id;
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getSenha(): string {
            return $this->senha;
        }

        public function getTelefone(): string {
            return $this->telefone;
        }

        public function getTipoConta(): string {
            return $this->tipoConta;
        }

        public function getCpf(): string {
            return $this->cpf;
        }

        public function getEstado(): string {
            return $this->estado;
        }

        public function getCidade(): string {
            return $this->cidade;
        }

        public function getBairro(): string {
            return $this->bairro;
        }

        public function getLogradouro(): string {
            return $this->logradouro;
        }

        public function getCep(): string {
            return $this->cep;
        }

        public function getNumeroEndereco(): int {
            return $this->numeroEndereco;
        }

    }

