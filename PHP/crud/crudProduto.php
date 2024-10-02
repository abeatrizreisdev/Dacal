<?php 

    require "crud.php";

    class CrudProduto extends Crud {

        public function __construct($conexao) {

            // Instanciando o construtor da superclasse.
            parent::__construct($conexao, "produto");

        }

        public function cadastrarProduto($produto) {

            // Separando por virgulas os campos da tabela que receberão os valores da inserção.
            $camposTabela = $this->organizarCamposDaTabela($produto);

            // Separando os valores que serão inseridos na tabela.
            $valores = $this->organizarValoresParaTabela($produto);

            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";

                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $produto);

                if ($resultadoCadastro > 0) {

                    echo "<br>Cadastro de produto realizado com sucesso.";
                    return true;

                } else {

                    echo "<br>Cadastro de produto não realizado.";
                    return false;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro no cadastro do funcionário: " . $excecao->getMessage();
                return false;

            }

        }

        public function buscarInfoProduto($idProduto) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE codigoProduto = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idProduto]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    echo "<br>Busca por produto realizada com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum produto encontrado com este id {$idProduto}.";

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do produto: " . $excecao->getMessage();

            }

        }

        public function buscarTodosProdutos() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {

                    echo "<br>A busca pelos produtos cadastrados foi realizada com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum produto cadastrado.";

                    return null;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca por produtos cadastrados: " . $excecao->getMessage();

            }


        }


        public function editarProduto($idProduto, $produto) {
            
            try {

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($produto);

                // Comando sql para editar as informações do produto.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE codigoProduto = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($produto, ['id' => $idProduto]));
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {

                    echo "<br>Produto editado com sucesso.";

                    return true;

                } else {

                    echo "<br>Produto não encontrado.";

                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição do produto: " . $excecao->getMessage();
                
                return false;
            }

        }

        public function excluirProduto($idProduto) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE codigoProduto = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idProduto]);
                
                if ($resultadoConsulta > 0) {
                    
                    echo "<br>Produto excluido com sucesso.";

                    return true;

                } else {

                    echo "<br>O produto não foi encontrado.";

                    return false;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na exclusão do produto: " . $excecao->getMessage();

            }


        }

        
    }

?>