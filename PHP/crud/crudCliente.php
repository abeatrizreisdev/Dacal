<?php 

    require "../crud/crud.php";

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

                    echo "<br>Cadastro de cliente realizado com sucesso.";

                    return true;

                } else {

                    echo "<br>Cadastro de cliente não realizado.";

                    return false;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro no cadastro do cliente: " . $excecao->getMessage();

                return false;

            }

        }

        public function autenticarCliente($cnpj, $senha) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cnpj = :cnpj AND senha = :senha";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cnpj' => $cnpj, 'senha' => $senha]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    echo "<br>Cliente encontrado com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum cliente encontrado com esse cnpj e senha informada.";

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do funcionário: " . $excecao->getMessage();

            }

        }

        public function buscarInfoCliente($idCliente) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE idCliente = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idCliente]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    echo "<br>Busca por cliente realizada com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum cliente encontrado.";

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do cliente: " . $excecao->getMessage();

            }

        }

        public function buscarInfoTodosClientes() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {

                    echo "<br>A busca pelos clientes cadastrados foi realizado com sucesso.";

                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum cliente encontrado.";

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações dos clientes: " . $excecao->getMessage();

            }


        }

        public function editarCliente($idCliente, $dados) {
            
            try {

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($dados);

                // Comando sql para editar as informações do funcionário.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE idCliente = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($dados, ['id' => $idCliente]));
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {

                    echo "<br>Cliente editado com sucesso.";

                    return true;

                } else {

                    echo "<br>Cliente não encontrado.";

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

                    echo "<br>Email do cliente editado com sucesso.";

                    return true;

                } else {

                    echo "<br>Cliente não encontrado.";

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

                    echo "<br>Senha do cliente editada com sucesso.";

                    return true;

                } else {

                    echo "<br>Cliente não encontrado.";

                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição da senha do cliente: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function excluirCliente($idCliente) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE idCliente = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idCliente]);
                
                if ($resultadoConsulta > 0) {
                    
                    echo "<br>Cliente excluido com sucesso.";

                    return $resultadoConsulta;

                } else {

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na exclusão do cliente: " . $excecao->getMessage();

                return null;

            }


        }


    }

?>