<?php 

    require_once "crud.php";

    class CrudCliente extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "cliente");
        }

        public function cadastrarCliente($dados) {


            // Verificação de campos obrigatórios 
            if (!$this->verificarCamposObrigatorios($dados)) { 

                return false; // Dados incompletos 

            }

            // Validação de CNPJ.
            if (!$this->verificarCnpj($dados['cnpj'])) {

                echo "Erro no cadastro do cliente: CNPJ inválido.";
                
                return false; // CNPJ inválido.

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
                
            } catch (Exception $excecao) {

                echo "Erro no cadastro do cliente: " . $excecao->getMessage();
                return false;

            }

        }
        

        public function autenticarCliente($cnpj, $senha) {

            try {

                $sql = "SELECT * FROM {$this->tabela} WHERE cnpj = :cnpj";
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['cnpj' => $cnpj]);
                
                if ($resultadoConsulta->rowCount() > 0) {

                    $cliente = $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

                    // Verifique a senha fornecida com a senha armazenada.
                    if ($senha === $cliente['senha']) {

                        return $cliente; // Autenticação bem-sucedida;

                    } else {

                        return null; // Senha incorreta
                    }

                } else {

                    return null; // CNPJ não encontrado

                };

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

                $nomeCliente = "%" . $nomeCliente . "%"; 

                $sql = "SELECT * FROM {$this->tabela} WHERE nomeFantasia LIKE :nome";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['nome' => $nomeCliente]);
                
                if ($resultadoConsulta->rowCount() > 0) {
                    

                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

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

                // Verificação de campos obrigatórios 
                if (!$this->verificarCamposObrigatorios($dados)) { 

                    return false; // Dados incompletos 
                }
        
                // Verificação de CNPJ válido
                if (!$this->verificarCnpj($dados['cnpj'])) {
                    return false; // CNPJ inválido
                }
        
                // Instanciando uma lista para armazenar os campos da tabela
                $campos = $this->inserirCamposTabelaEmUmaLista($dados);
        
                // Comando SQL para editar as informações do cliente
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE idCliente = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($dados, ['id' => $idCliente]));
        
                // Verificando se a linha correspondente ao cliente foi afetada no banco
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

        private function verificarCnpj($cnpj) {

            // Remove caracteres não numéricos.
            $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
            
            // Verifica se o CNPJ tem 14 dígitos.
            if (strlen($cnpj) != 14) {
                return false;
            }
        
            // Verifica se todos os dígitos são iguais.
            if (preg_match('/(\d)\1{13}/', $cnpj)) {
                return false;
            }
        
            // Valida os dígitos verificadores.
            for ($tamanho = 12; $tamanho < 14; $tamanho++) {
                $soma = 0;
                $peso = 5;
                for ($posicao = 0; $posicao < $tamanho; $posicao++) {
                    $soma += $cnpj[$posicao] * $peso;
                    $peso = ($peso == 2 ? 9 : $peso - 1);
                }
        
                $digitoVerificadorCalculado = ((10 * $soma) % 11) % 10;
                if ($cnpj[$posicao] != $digitoVerificadorCalculado) {
                    return false;
                }
            }
        
            return true;

        }

        
        private function verificarCamposObrigatorios($dados) { 
            
            $camposObrigatorios = [ 'nomeFantasia', 'razaoSocial', 'cnpj', 'inscricaoEstadual', 'telefone', 'logradouro', 'bairro', 'cep', 'estado', 'municipio', 'numeroEndereco' ]; 

            foreach ($camposObrigatorios as $campo) { 

                if (empty($dados[$campo])) {
                     return false; 
                } 
                
            } 

            return true; 
        
        }





    }

?>