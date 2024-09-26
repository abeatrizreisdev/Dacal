<?php

    // Nesta superclasse, terão métodos comuns a todas as entidades (usuario, cliente, pedido, orcamento, produto)
    class Crud {

        protected $conexaoBD;
        protected $tabela;

        public function __construct($conexao, $tabela) {

            $this->conexaoBD = $conexao;
            $this->tabela = $tabela;

        }

        public function create($dados) {
            
            
            $camposTabela = $this->organizarCamposDaTabela($dados);
            $valores = $this->organizarValoresParaTabela($dados);

            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";

                $this->conexaoBD->queryBanco($sql, $dados);

                echo "Inserção realizada com sucesso.";

            } catch (PDOException $excecao) {

                echo "Erro na inserção: " . $excecao->getMessage();

            }

            
            
        }

        // Esté método é utilizado para estruturar os nomes dos campos de uma tabela no banco de dados.
        // Por exemplo, quando for passado uma estrutura semelhante a essa "['nome' => 'Valter', 'email' => '0000@gmail.com']", as chaves 'nome', 'email' etc serão separadas por virgulas.
        public function organizarCamposDaTabela($dados) {

            // Separando por virgulas os campos da tabela que receberão os valores da inserção.
            $camposTabela = implode(", ", array_keys($dados));

            return $camposTabela;
                
        }

        // Esté método é utilizado para estruturar os valores que serão informados as tabelas no banco de dados.
        public function organizarValoresParaTabela($dados) {

            // Separando os valores que serão inseridos na tabela.
            $valores = ":" . implode(", :", array_keys($dados));

            return $valores;
                
        }

        // Este método é utilizado nas funções de UPDATE dos CRUD.
        public function inserirCamposTabelaEmUmaLista($dados) {

            // Instanciando uma lista para armazenar os campos da tabela.
            $campos = [];

            // Atribuindo os campos na lista.
            foreach ($dados as $campo => $valor) {
                
                $campos[] = "$campo = :$campo";

            }

            return $campos;

        }

        

    }

?>