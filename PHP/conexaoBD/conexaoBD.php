<?php 

    class ConexaoBD {

        private $hostBD; // Endereço do servidor do banco.
        private $eschemaBD; // Nome do database.
        private $usuarioBD; // Nome do usuário do banco de dados.
        private $senhaBD; // Senha de acesso do banco.
        private $portaBD;
        public $conexao = null;

        public function __construct() {}

        public function setHostBD($host) {
            $this->hostBD = $host;
        }

        public function setEschemaBD($eschema) {
            $this->eschemaBD = $eschema;
        }

        public function setUsuarioBD($user) {
            $this->usuarioBD = $user;
        }

        public function setSenhaBD($senha) {
            $this->senhaBD = $senha;
        }

        public function setPortaBD($porta) {
            $this->portaBD = $porta;
        }

        public function getHostBD() {
            return $this->hostBD;
        }

        public function getEschemaBD() {
            return $this->eschemaBD;
        }

        public function getUsuarioBD() {
            return $this->usuarioBD;
        }

        public function getSenhaBD() {
            return $this->senhaBD;
        }

        public function getPortaBD() {
            return $this->portaBD;
        }

        public function beginTransaction() {
            $this->conexao->beginTransaction();
        }
    
        public function commit() {
            $this->conexao->commit();
        }
    
        public function rollBack() {
            $this->conexao->rollBack();
        }

        public function lastInsertId(): string {

            if ($this->conexao) {

                return $this->conexao->lastInsertId();

            } else {

                throw new Exception("Conexão não estabelecida.");

            }

        }


        // Pegar a conexão com o banco de dados.
        public function getConexao(): PDO {

            try {

                $this->conexao = new PDO("mysql:host=" . $this->hostBD . ";port=" . $this->portaBD .  ";dbname=" . $this->eschemaBD, $this->usuarioBD, $this->senhaBD);

                $this->conexao->exec("set names utf8mb4");


            } catch (PDOException $excecao) {

                echo "Erro de conexão: " . $excecao->getMessage();

            }

            return $this->conexao;

        }

        public function encerrarConexão() {

            if ($this->conexao != null) {

                $this->conexao = null;

                return true;

            } else {

                return false;

            }

        }

        public function queryBanco($sql, $parametros = []) {

            $declaracao = $this->conexao->prepare($sql);

            $declaracao->execute($parametros);

            foreach ($parametros as $chave => $valor) {

                if (is_resource($valor)) {
                    $declaracao->bindParam($chave, $valor, PDO::PARAM_LOB);
                } else {
                    $declaracao->bindValue($chave, $valor);
                }
                
            }

            if (strpos($sql, 'INSERT') === 0) { // Verifica se a consulta é uma inserção

                return $declaracao->rowCount() > 0; // Retorna true se pelo menos uma linha foi afetada

            } else if (strpos($sql, 'SELECT') === 0) { // Verifica se a consulta é uma seleção

                return $declaracao; // Retorna a declaração preparada
                
            } else if (strpos($sql, 'UPDATE') === 0 || strpos($sql, 'DELETE') === 0) { // Verifica se a consulta é uma atualização ou exclusão

                return $declaracao->rowCount(); // Retorna o número de linhas afetadas

            } else {

                return false; // Retorna false para outros tipos de consultas
                
            }

        }

    }

?>