<?php 

    require_once "crud.php";
    
    class CrudFuncionario extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "pessoa");
        }

        public function cadastrarFuncionario($dados) {

            // Validação de CPF.
            if (!$this->verificarCpf($dados['cpf'])) {
                return false; // CPF inválido.
            }
        
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
            } catch (PDOException $excecao) {

                echo "Erro no cadastro do funcionário: " . $excecao->getMessage();
                return false;

            }

        }
        
        
        public function autenticarUsuario($cpf, $senha) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cpf = :cpf";
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cpf' => $cpf]);
        
                if ($resultadoConsulta->rowCount() > 0) {

                    $usuario = $resultadoConsulta->fetch(PDO::FETCH_ASSOC);
        
                    // Verificando se a senha fornecida é igual a senha armazenada.
                    if ($senha === $usuario['senha']) 
                    {
                        return $usuario; // Autenticação bem-sucedida

                    } else {

                        return null; // Senha incorreta.

                    }

                } else {

                    return null; // CPF não encontrado.

                }
        
            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do funcionário: " . $excecao->getMessage();
                return null;

            }
            
        }
        

        public function buscarInfoFuncionario($idFuncionario) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idFuncionario]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    

                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na busca de informações do funcionário: " . $excecao->getMessage();

            }

        }

        public function buscarFuncionarioPeloCpf($cpf) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cpf = :cpf";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cpf' => $cpf]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    
                    return $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                } else {

                    return null;           

                }


            } catch (PDOException $excecao) {

                echo "Erro na busca de informações do funcionário: " . $excecao->getMessage();
                return null;
                
            }

        }

        public function buscarInfoTodosFuncionarios() {

            try {

                $sql = "SELECT * FROM {$this->tabela}";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {

                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    return null;

                }

            } catch (PDOException $excecao) {

                echo "Erro na busca de informações dos funcionários: " . $excecao->getMessage();

                return null;

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


                    return true;

                } else {

                    return false;

                }
        
            } catch (Exception $excecao) {

                echo "<br>Erro na edição do funcionário: " . $excecao->getMessage();
                
                return false;

            }

        }

        public function excluirFuncionario($idFuncionario) {

            try {

                $sql = "DELETE FROM {$this->tabela} WHERE id = :id";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idFuncionario]);
                
                if ($resultadoConsulta > 0) {
                    

                    return $resultadoConsulta;

                } else {

                    return null;

                }


            } catch (PDOException $excecao) {

                echo "<br>Erro na exclusão do funcionário: " . $excecao->getMessage();

                return null;

            }


        }


        private function verificarCpf($cpf) {

            // Remove caracteres não numéricos
            $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
        
            // Verifica se o CPF tem 11 dígitos
            if (strlen($cpf) != 11) {
                return false;
            }
        
            // Verifica se todos os dígitos são iguais
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }
        
            // Valida os dígitos verificadores
            for ($tamanho = 9; $tamanho < 11; $tamanho++) {
                $soma = 0;
                for ($posicao = 0; $posicao < $tamanho; $posicao++) {
                    $soma += $cpf[$posicao] * (($tamanho + 1) - $posicao);
                }
        
                $digitoVerificadorCalculado = ((10 * $soma) % 11) % 10;
                if ($cpf[$posicao] != $digitoVerificadorCalculado) {
                    return false;
                }
            }
        
            return true;
        }
        


    }

?>