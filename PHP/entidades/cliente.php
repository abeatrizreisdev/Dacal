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

        private $id;
        private $nome;
        private $razaoSocial;
        private $cnpj;
        private $inscricaoEstadual;
        private $telefone;
        private $email;
        private $orcamentos = [];
        private $senha;
        private $tipoConta;
        private $logradouro;
        private $bairro;
        private $cep;
        private $estado;
        private $municipio;
        private $numeroEndereco;

        public function __construct($dados) {
            
        }

        public function setIdCliente($id) {

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

                throw new Exception("Erro. O nome não não pode ser vazio.");

            } elseif (!is_string($nome)) {

                throw new Exception("Erro. O nome deve ser do tipo texto.");

            }

            $this->nome = $nome;

        }

        public function setRazaoSocial($razaoSocial) {

            if (empty($razaoSocial)) {

                throw new Exception("Erro. A razão social não pode ser vazia.");

            } elseif (!is_string($razaoSocial)) {

                throw new Exception("Erro. A razção social deve ser do tipo texto.");

            }

            $this->razaoSocial = $razaoSocial;

        }

        public function setCnpj($cnpj) {

            if (empty($cnpj)) {

                throw new Exception("Erro. O CNPJ não não pode ser vazio.");

            } elseif (!is_string($cnpj)) {

                throw new Exception("Erro. O CNPJ deve ser do tipo texto.");

            }

            $this->cnpj = $cnpj;

        }

        public function setInscricaoEstadual($inscricaoEstadual) {

            if (empty($inscricaoEstadual)) {

                throw new Exception("Erro. A Inscrição Estadual não não pode ser vazia.");

            } elseif (!is_string($inscricaoEstadual)) {

                throw new Exception("Erro. A Inscrição Estadual deve ser do tipo texto.");

            }

            $this->inscricaoEstadual = $inscricaoEstadual;

        }

        public function setTelefone($telefone) {

            if (empty($telefone)) {

                throw new Exception("Erro. O Telefone não não pode ser vazio.");

            } elseif (!is_string($telefone)) {

                throw new Exception("Erro. O telefone deve ser do tipo texto.");

            }

            $this->telefone = $telefone;

        }

        public function setEmail($email) {

            if (empty($email)) {

                throw new Exception("Erro. O Email não não pode ser vazio.");

            } elseif (!is_string($email)) {

                throw new Exception("Erro. O email deve ser do tipo texto.");

            }

            $this->email = $email;

        }

        public function setOrcamento($orcamento) {

            if (is_null($orcamento)) {

                throw new Exception("Erro. O Orçamento está como null e não pode ser salvo.");

            }

            $this->orcamentos[] = $orcamento;

        }


        public function setSenha($senha) {

            if (empty($senha)) {

                throw new Exception("Erro. A senha não pode ser vazia.");

            } elseif (!is_string($senha)) {

                throw new Exception("Erro. A senha deve ser do tipo texto.");

            }

            $this->senha = $senha;

        }

        public function setTipoConta($tipoConta) {

            if (empty($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do cliente não pode ser vazio.");

            } elseif (!is_string($tipoConta)) {

                throw new Exception("Erro. O tipo da conta do cliente deve ser do tipo texto.");

            }

            $this->tipoConta = $tipoConta;

        }

        public function setEstado($estado) {

            if (empty($estado)) {

                throw new Exception("Erro. O Estado do cliente não pode ser vazio.");

            } elseif (!is_string($estado)) {

                throw new Exception("Erro. O Estado do cliente deve ser do tipo texto.");

            }

            $this->estado = $estado;

        }

        public function setMunicipio($municipio) {

            if (empty($cidade)) {

                throw new Exception("Erro. O Municipio do cliente não pode ser vazio.");

            } elseif (!is_string($cidade)) {

                throw new Exception("Erro. O Municipio do cliente deve ser do tipo texto.");

            }

            $this->municipio = $municipio;

        }

        public function setLogradouro($logradouro) {

            if (empty($logradouro)) {

                throw new Exception("Erro. O Logradouro do cliente não pode ser vazio.");

            } elseif (!is_string($logradouro)) {

                throw new Exception("Erro. O Logradouro do cliente deve ser do tipo texto.");

            }

            $this->logradouro = $logradouro;

        }

        public function setBairro ($bairro) {

            if (empty($bairro)) {

                throw new Exception("Erro. O bairro do usuário não pode ser vazio.");

            } elseif (!is_string($bairro)) {

                throw new Exception("Erro. O bairro do usuário deve ser do tipo texto.");

            }

            $this->bairro = $bairro;

        }

        public function setCep($cep) {
            
            if (empty($cep)) {

                throw new Exception("Erro. O Cep do cliente não pode ser vazio.");

            } elseif (!is_string($cep)) {

                throw new Exception("Erro. O Cep do cliente deve ser do tipo texto.");

            }

            $this->cep = $cep;

        }

        public function setNumeroEndereco($numeroEndereco) {
            
            if (empty($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do cliente não pode ser vazio.");

            } elseif (!is_numeric($numeroEndereco)) {

                throw new Exception("Erro. O número do endereço do cliente deve ser do tipo númerico.");

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

        public function getRazaoSocial() {
            return $this->razaoSocial;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function getTipoConta() {
            return $this->tipoConta;
        }

        public function getCnpj() {
            return $this->cnpj;
        }

        public function getInscricaoEstadual() {
            return $this->inscricaoEstadual;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function getMunicipio() {
            return $this->municipio;
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

        public function getOrcamentos() {
            return $this->orcamentos;
        }

        public function getOrcamento($idOrcamento) {
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

?>