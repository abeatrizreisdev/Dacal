<?php

    class Cliente {

        /*
        
        Atributos:
    
        - id: Int
        - nome: String
        - razaoSocial: String
        - cnpj: String
        - inscricaoEstadual: String
        - telefone: String
        - email: String
        - orcamentos: ArrayList<Orcamento>
        - senha: String
        - tipoConta: String
        - logradouro : String
        - bairro: String
        - cep: String
        - estado: String
        - municipio: String
        - numeroEndereco: Int
        
        */

        private int $id;
        private string $nomeFantasia;
        private string $razaoSocial;
        private string $cnpj;
        private string $inscricaoEstadual;
        private string $telefone;
        private string $email;
        private $orcamentos = [];
        private string $senha;
        private string $tipoConta;
        private string $logradouro;
        private string $bairro;
        private string $cep;
        private string $estado;
        private string $municipio;
        private int $numeroEndereco;

        public function __construct() {
            
        }

        public function setIdCliente(int $id) {

             // Se for um valor númerico (int, por exemplo) e maior que 0.
             if (is_numeric($id) && $id <= 0) {

                throw new Exception("Erro. O id deve ser um número maior que 0.");

            } else if(is_null($id)) {

                throw new Exception("Erro. O id não pode ser nulo.");

            }

            $this->id = $id;

        }

        public function setNomeFantasia(string $nome) {

            if (empty($nome)) {

                throw new Exception("Erro. O nome não não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome deve ser do tipo texto.");

            }

            $this->nomeFantasia = $nome;

        }

        public function setRazaoSocial(string $razaoSocial) {

            if (empty($razaoSocial)) {

                throw new Exception("Erro. A razão social não pode ser vazia.");

            } elseif (!is_string($razaoSocial)) {

                throw new Exception("Erro. A razção social deve ser do tipo texto.");

            }

            $this->razaoSocial = $razaoSocial;

        }

        public function setCnpj(string $cnpj) {

            if (empty($cnpj)) {

                throw new Exception("Erro. O CNPJ não não pode ser vazio.");

            } elseif (!is_string($cnpj)) {

                throw new Exception("Erro. O CNPJ deve ser do tipo texto.");

            }

            $this->cnpj = $cnpj;

        }

        public function setInscricaoEstadual(string $inscricaoEstadual) {

            if (empty($inscricaoEstadual)) {

                throw new Exception("Erro. A Inscrição Estadual não não pode ser vazia.");

            } elseif (!is_string($inscricaoEstadual)) {

                throw new Exception("Erro. A Inscrição Estadual deve ser do tipo texto.");

            }

            $this->inscricaoEstadual = $inscricaoEstadual;

        }

        public function setTelefone(string $telefone) {

            if (empty($telefone)) {

                throw new Exception("Erro. O Telefone não não pode ser vazio.");

            } elseif (!is_string($telefone)) {

                throw new Exception("Erro. O telefone deve ser do tipo texto.");

            }

            $this->telefone = $telefone;

        }

        public function setEmail(string $email) {

            if (empty($email)) {

                throw new Exception("Erro. O Email não não pode ser vazio.");

            } elseif (!is_string($email)) {

                throw new Exception("Erro. O email deve ser do tipo texto.");

            }

            $this->email = $email;

        }

        public function setOrcamento(Orcamento $orcamento) {

            if (is_null($orcamento)) {

                throw new Exception("Erro. O Orçamento está como null e não pode ser salvo.");

            }

            $this->orcamentos[] = $orcamento;

        }


        public function setSenha(string $senha) {

            if (empty($senha)) {

                throw new Exception("Erro. A senha não pode ser vazia.");

            } elseif (!is_string($senha)) {

                throw new Exception("Erro. A senha deve ser do tipo texto.");

            }

            $this->senha = $senha;

        }

        public function setTipoConta(string $tipoConta) {

            if (empty($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do cliente não pode ser vazio.");

            } elseif (!is_string($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do cliente deve ser do tipo texto.");

            }

            $this->tipoConta = $tipoConta;

        }

        public function setEstado(string $estado) {

            if (empty($estado)) {

                throw new Exception("Erro. O Estado do cliente não pode ser vazio.");

            } elseif (!is_string($estado)) {

                throw new Exception("Erro. O Estado do cliente deve ser do tipo texto.");

            }

            $this->estado = $estado;

        }

        public function setMunicipio(string $municipio) {

            if (empty($municipio)) {

                throw new Exception("Erro. O Municipio do cliente não pode ser vazio.");

            } elseif (!is_string($municipio)) {

                throw new Exception("Erro. O Municipio do cliente deve ser do tipo texto.");

            }

            $this->municipio = $municipio;

        }

        public function setLogradouro(string $logradouro) {

            if (empty($logradouro)) {

                throw new Exception("Erro. O Logradouro do cliente não pode ser vazio.");

            } elseif (!is_string($logradouro)) {

                throw new Exception("Erro. O Logradouro do cliente deve ser do tipo texto.");

            }

            $this->logradouro = $logradouro;

        }

        public function setBairro (string $bairro) {

            if (empty($bairro)) {

                throw new Exception("Erro. O bairro do usuário não pode ser vazio.");

            } elseif (!is_string($bairro)) {

                throw new Exception("Erro. O bairro do usuário deve ser do tipo texto.");

            }

            $this->bairro = $bairro;

        }

        public function setCep(string $cep) {
            
            if (empty($cep)) {

                throw new Exception("Erro. O Cep do cliente não pode ser vazio.");

            } elseif (!is_string($cep)) {

                throw new Exception("Erro. O Cep do cliente deve ser do tipo texto.");

            }

            $this->cep = $cep;

        }

        public function setNumeroEndereco(int $numeroEndereco) {
            
            if (empty($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do cliente não pode ser vazio.");

            } elseif (!is_numeric($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do cliente deve ser do tipo númerico.");

            }

            $this->numeroEndereco = $numeroEndereco;

        }

        public function getId(): int {
            return $this->id;
        }

        public function getNomeFantasia(): string {
            return $this->nomeFantasia;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getSenha(): string {
            return $this->senha;
        }

        public function getRazaoSocial(): string {
            return $this->razaoSocial;
        }

        public function getTelefone(): string {
            return $this->telefone;
        }

        public function getTipoConta(): string {
            return $this->tipoConta;
        }

        public function getCnpj(): string {
            return $this->cnpj;
        }

        public function getInscricaoEstadual(): string {
            return $this->inscricaoEstadual;
        }

        public function getEstado(): string {
            return $this->estado;
        }

        public function getMunicipio(): string {
            return $this->municipio;
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

        public function getOrcamentos() {
            return $this->orcamentos;
        }

        public function getOrcamento(int $idOrcamento): Orcamento {
            return $this->orcamentos[$idOrcamento];
        }


    }

    /* 

    Métodos: 

    + setIdCliente(Int id): Void
    + setNome(String nome): Void
    + setRazaoSocial(String razaoSocial): Void
    + setCnpj(String cnpj): Void
    + setInscricaoEstadual(String inscricao): Void
    + setTelefone(String telefone): Void
    + setEmail(String email): Void
    + setOrcamento(Orcamento orcamento): Void
    + setSenha(String senha): Void
    + setTipoConta(String tipoConta): Void
    + setLogradouro(String logradouro): Void
    + setBairro(String bairro): Void
    + setEstado(String estado): Void
    + setMunicipio(String municipio): Void
    + setCep(String cep): Void
    + setNumeroEndereco(Int numeroEndereco): Void
    + getId(): Int
    + getNome(): String
    + getRazaoSocial(): String
    + getEndereco(): String
    + getCnpj(): String
    + getInscricaoEstadual: String
    + getTelefone(): String
    + getEmail: String
    + getOrcamentos(): ArrayList<Orcamento>
    + getOrcamento(): Orcamento
    + getTipoConta(): String
    + getLogradouro(): String
    + getBairro(): String
    + getEstado(): String
    + getMunicipio(): String
    + getCep(): String
    + getNumeroEndereco(): Int
    
    
    */

