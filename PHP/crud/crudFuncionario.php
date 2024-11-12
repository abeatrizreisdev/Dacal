<?php 

    require "crud.php";
    
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

                $sql = "SELECT * FROM {$this->tabela} WHERE tipoConta = 'Funcionario'";

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

                // Verificação de campos obrigatórios
               if (!$this->verificarCamposObrigatorios($dados)) {

                  return false; // Dados incompletos

                }
        
                // Verificação de CPF válido (exemplo de validação simples, deve ser ajustada conforme necessidade)
                if (!$this->verificarCpf($dados['cpf'])) {

                    return false; // CPF inválido

                }
        
                // Instanciando uma lista para armazenar os campos da tabela
                $campos = $this->inserirCamposTabelaEmUmaLista($dados);
        
                // Comando SQL para editar as informações do funcionário
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE id = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($dados, ['id' => $idFuncionario]));
        
                // Verificando se a linha correspondente ao funcionário foi afetada no banco
                if ($resultadoConsulta > 0) {

                    return true;

                } else {

                    return false;

                }

            } catch (Exception $excecao) {

                echo "Erro na edição do funcionário: " . $excecao->getMessage();

                return false;

            }

        }


        public function editarSenhaUsuario($idFuncionario, $novaSenha) {

            try {

                // Verificação da nova senha.
                if (empty($novaSenha)) {
                    return false; // Senha vazia
                }
        
                // Comando SQL para editar a senha do funcionário
                $sql = "UPDATE {$this->tabela} SET senha = :senha WHERE id = :id";
                
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, [
                    'senha' => $novaSenha,
                    'id' => $idFuncionario
                ]);
        
                // Verificando se a linha correspondente ao funcionário foi afetada no banco
                if ($resultadoConsulta > 0) {

                    return true;

                } else {

                    return false;

                }
        
            } catch (Exception $excecao) {

                echo "Erro na edição da senha do usuário: " . $excecao->getMessage();
                return false;
            }

        }


        public function editarEmailUsuario($idFuncionario, $novoEmail) {

            try {
                
                // Verificação do novo email (apenas verificar se está vazio)
                if (empty($novoEmail)) {
                    return false; // Email vazio
                }
        
                // Comando SQL para editar o email do funcionário
                $sql = "UPDATE {$this->tabela} SET email = :email WHERE id = :id";
                
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, [
                    'email' => $novoEmail,
                    'id' => $idFuncionario
                ]);
        
                // Verificando se a linha correspondente ao funcionário foi afetada no banco
                if ($resultadoConsulta > 0) {

                    return true;

                } else {
                    
                    return false;
                    
                }
        
            } catch (Exception $excecao) {

                echo "Erro na edição do email do usuário: " . $excecao->getMessage();
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
            
                // Extrai somente os números
                $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
                
                // Verifica se foi informado todos os digitos corretamente
                if (strlen($cpf) != 11) {
                    return false;
                }

                // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
                if (preg_match('/(\d)\1{10}/', $cpf)) {
                    return false;
                }

                // Faz o calculo para validar o CPF
                for ($t = 9; $t < 11; $t++) {

                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }

                    $d = ((10 * $d) % 11) % 10;

                    if ($cpf[$c] != $d) {
                        return false;
                    }

                }

                return true;

        }

        private function verificarCamposObrigatorios($dados) {

            $camposObrigatorios = [
                'nome', 'cpf', 'telefone', 
                'estado', 'cidade', 'bairro', 'logradouro', 'cep', 'numeroEndereco'
            ];
        
            foreach ($camposObrigatorios as $campo) {

                if (empty($dados[$campo])) {
                    return false;
                }
                
            }
        
            return true;

        }
        


    }

