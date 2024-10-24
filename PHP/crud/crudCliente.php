<?php 

    require "crud.php";

    class CrudCliente extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "cliente");
        }

        public function cadastrarCliente($dados) {

            $camposTabela = $this->organizarCamposDaTabela($dados);
            $valores = $this->organizarValoresParaTabela($dados);

            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";

                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $dados);

                if ($resultadoCadastro > 0) {

                    return true;

                } else {

                    return false;

                }

            } catch (Exception $excecao) {

                echo "<br>Erro no cadastro do cliente: " . $excecao->getMessage();

                return false;

            }

        }

        public function autenticarCliente($cnpj, $senha) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cnpj = :cnpj";


                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cnpj' => $cnpj]);
                
                if ($resultadoConsulta->rowCount() > 0) {

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    return null;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na busca de informações do cliente para autenticação: " . $excecao->getMessage();

                return null;

            }

        }

        public function buscarInfoCliente($idCliente) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE idCliente = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idCliente]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do cliente: " . $excecao->getMessage();

                return null;

            }

        }

        public function buscarClientePeloNome($nomeCliente) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE nomeEmpresa LIKE :nome";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['nome' => $nomeCliente]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do cliente: " . $excecao->getMessage();

                return null;

            }

        }

        public function buscarInfoTodosClientes() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {


                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    return null;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações dos clientes: " . $excecao->getMessage();

                return null;

            }


        }

        public function editarCliente($idCliente, $dados) {
            
            try {

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($dados);

                // Comando sql para editar as informações do funcionário.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE idCliente = :id";

                // Debug: Print SQL and parameters
                echo "SQL: $sql<br>";
                print_r(array_merge($dados, ['id' => $idCliente]));
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($dados, ['id' => $idCliente]));

                // Check the result of the query
                if ($resultadoConsulta === false) {
                    echo "<br>Erro na execução da consulta.";
                } else {
                    echo "<br>Número de linhas afetadas: $resultadoConsulta";
                }
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {


                    return true;

                } else {


                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição do cliente: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function editarEmailCliente($idCliente, $novoEmail) {

            try {

                // Comando sql para editar as informações do funcionário.
                $sql = "UPDATE {$this->tabela} SET email = :novoEmail WHERE idCliente = :idCliente";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['novoEmail' => $novoEmail, 'idCliente' => $idCliente]);
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {


                    return true;

                } else {


                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição do email do cliente: " . $excecao->getMessage();
                
                return false;

            }


        }

        public function editarSenhaCliente($idCliente, $novaSenha) {

            try {

                // Comando sql para editar as informações do funcionário.
                $sql = "UPDATE {$this->tabela} SET senha = :novaSenha WHERE idCliente = :idCliente";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['novaSenha' => $novaSenha, 'idCliente' => $idCliente]);
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {


                    return true;

                } else {


                    return false;

                }
        
            } catch (Exception $excecao) {

                echo "Erro na edição da senha do cliente: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function excluirCliente($idCliente) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE idCliente = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idCliente]);
                
                if ($resultadoConsulta > 0) {
                    

                    return $resultadoConsulta;

                } else {

                    return null;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na exclusão do cliente: " . $excecao->getMessage();

                return null;

            }


        }


    }

?>