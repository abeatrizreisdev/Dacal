<?php 

    require "crud.php";

    class CrudProduto extends Crud {

        public function __construct($conexao) {

            // Instanciando o construtor da superclasse.
            parent::__construct($conexao, "produto");

        }

        public function cadastrarProduto($produto) {

            if (!$this->verificarCamposObrigatorios($produto)) {

                return false; // Dados incompletos

            }
        
            // Verificação de valor válido
            if ($produto['valorProduto'] <= 0) {

                return false; // Valor inválido

            }
        
            $camposTabela = $this->organizarCamposDaTabela($produto);
            $valores = $this->organizarValoresParaTabela($produto);
        
            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";
                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $produto);
        
                return $resultadoCadastro > 0;

            } catch (PDOException $excecao) {

                echo "Erro no cadastro do produto: " . $excecao->getMessage();
                return false;

            }

        }

        public function buscarInfoProduto($idProduto) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE codigoProduto = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idProduto]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na busca de informações do produto: " . $excecao->getMessage();

            }

        }

        public function buscarProdutosPorNome($nomeProduto) {

            try {

                // Adicionando os caracteres coringa '%' para buscar nomes que contenham a string fornecida.
                $nomeProduto = "%" . $nomeProduto . "%"; 
                
                // Pegando os produtos com o nome parecido ao qual o usuário digitou.
                $sql = "SELECT * FROM {$this->tabela} WHERE nomeProduto LIKE :nomeProduto";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['nomeProduto' => $nomeProduto]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    // Retornando todos os produtos com nome parecido ao que o usuário digitou.
                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    return null;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na busca de informações dos produtos: " . $excecao->getMessage();

            }

        }

        public function buscarTodosProdutos() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {


                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca por produtos cadastrados: " . $excecao->getMessage();

            }


        }

        public function buscarProdutosPorCategoria($categoriaProduto) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE categoria = :categoria";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['categoria' => $categoriaProduto]);

                if ($resultadoConsulta->rowCount() > 0) {


                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca por produtos cadastrados: " . $excecao->getMessage();

            }

        }


        public function editarProduto($idProduto, $produto) {

            try {

                if (!$this->verificarCamposObrigatorios($produto)) {
                    return false; // Dados incompletos
                }
        
                // Verificação de valor válido
                if ($produto['valorProduto'] <= 0) {
                    return false; // Valor inválido
                }
        
                // Instanciando uma lista para armazenar os campos da tabela
                $campos = $this->inserirCamposTabelaEmUmaLista($produto);
        
                // Comando SQL para editar as informações do produto
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE codigoProduto = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($produto, ['id' => $idProduto]));
        
                return $resultadoConsulta > 0;

            } catch (PDOException $excecao) {

                echo "Erro na edição do produto: " . $excecao->getMessage();
                return false;

            }

        }

        public function excluirProduto($idProduto) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE codigoProduto = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idProduto]);
                
                if ($resultadoConsulta > 0) {
                    

                    return true;

                } else {


                    return false;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na exclusão do produto: " . $excecao->getMessage();

            }


        }


        
        
        private function verificarCamposObrigatorios($produto) {

            $camposObrigatorios = ['nomeProduto', 'descricaoProduto', 'valorProduto', 'categoria', 'imagemProduto'];
        
            foreach ($camposObrigatorios as $campo) {

                if (empty($produto[$campo])) {
                    return false;
                }

            }
        
            return true;
        }

        
        
    }
