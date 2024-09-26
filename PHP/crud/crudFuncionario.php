<?php 

    require "../crud/crud.php";
    
    class CrudFuncionario extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "pessoa");
        }

        public function cadastrarFuncionario($dados) {

            $camposTabela = $this->organizarCamposDaTabela($dados);
            $valores = $this->organizarValoresParaTabela($dados);

            try {

                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";

                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $dados);

                if ($resultadoCadastro > 0) {

                    echo "<br>Cadastro de funcionário realizado com sucesso.";
                    return true;

                } else {

                    echo "<br>Cadastro de funcionário não realizado.";
                    return false;

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro no cadastro do funcionário: " . $excecao->getMessage();

                return false;

            }

        }

        public function autenticarUsuario($cpf, $senha) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cpf = :cpf AND senha = :senha";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cpf' => $cpf, 'senha' => $senha]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    echo "<br>Funcionário encontrado com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum funcionário encontrado com esse cpf e senha informados.";

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do funcionário: " . $excecao->getMessage();

            }

        }

        public function buscarInfoFuncionario($idFuncionario) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idFuncionario]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    echo "<br>Busca por funcionário realizada com sucesso.";

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum funcionário encontrado.";

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do funcionário: " . $excecao->getMessage();

            }

        }

        public function buscarInfoTodosFuncionarios() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {

                    echo "<br>A busca pelos funcionários cadastrados foi realizado com sucesso.";

                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    echo "<br>Nenhum funcionário encontrado.";

                }

            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações dos funcionários: " . $excecao->getMessage();

            }


        }

        public function editarFuncionario($idFuncionario, $dados) {
            
            try {

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($dados);

                // Comando sql para editar as informações do funcionário.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE id = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($dados, ['id' => $idFuncionario]));
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {

                    echo "<br>Funcionário editado com sucesso.";

                    return true;

                } else {

                    echo "<br>Funcionário não encontrado.";

                    return false;

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na edição do funcionário: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function excluirFuncionario($idFuncionario) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE id = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idFuncionario]);
                
                if ($resultadoConsulta > 0) {
                    
                    echo "<br>Funcionário excluido com sucesso.";

                    return $resultadoConsulta;

                } else {

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na exclusão do funcionário: " . $excecao->getMessage();

            }


        }


    }

?>