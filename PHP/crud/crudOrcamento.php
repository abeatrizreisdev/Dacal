<?php 

    require_once "crud.php";
    class CrudOrcamento extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "orcamentos");
        }


        public function cadastrarOrcamento($orcamento) {

            // Separando por virgulas os campos da tabela que receberão os valores da inserção.
            $camposTabela = $this->organizarCamposDaTabela($orcamento);

            // Separando os valores que serão inseridos na tabela.
            $valores = $this->organizarValoresParaTabela($orcamento);

            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";

                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $orcamento);

                if ($resultadoCadastro > 0) {

                    return true;

                } else {

                    return false;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro no cadastro do orçamento: " . $excecao->getMessage();

                return false;

            }

        }

        public function buscarInfoOrcamento($idOrcamento) {

            try {

                $sql = "SELECT * FROM {$this->tabela}, itens_orcamento, cliente WHERE orcamentos.numeroOrcamento = :id AND orcamentos.numeroOrcamento = itens_orcamento.numeroOrcamento AND orcamento.";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idOrcamento]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do orçamento: " . $excecao->getMessage();

                return null;

            }

        }

        public function buscarTodosOrcamentos() {

            try {

                $sql = "SELECT 
                        orcamentos.numeroOrcamento, 
                        orcamentos.valorOrcamento, 
                        orcamentos.dataCriacao, 
                        orcamentos.status, 
                        cliente.nomeEmpresa AS nomeCliente, 
                        (SELECT SUM(itens_orcamento.quantidade) 
                        FROM itens_orcamento 
                        WHERE itens_orcamento.numeroOrcamento = orcamentos.numeroOrcamento) AS quantidadeTotal 
                        FROM orcamentos, cliente 
                        WHERE orcamentos.idCliente = cliente.idCliente";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {


                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca por orçamentos cadastrados: " . $excecao->getMessage();

                return null;

            }


        }


        public function editarOrcamento($idOrcamento, $orcamento) {
            
            try {

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($orcamento);

                // Comando sql para editar as informações do produto.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE numeroOrcamento = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($orcamento, ['id' => $idOrcamento]));
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {


                    return true;

                } else {


                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição do orcamento: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function excluirOrcamento($idOrcamento) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE numeroOrcamento = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idOrcamento]);
                
                if ($resultadoConsulta > 0) {
                    

                    return true;

                } else {


                    return false;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na exclusão do orçamento: " . $excecao->getMessage();

            }


        }

    }

?>