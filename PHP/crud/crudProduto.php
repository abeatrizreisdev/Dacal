<?php 

    require_once "crud.php";

    class CrudProduto extends Crud {

        public function __construct($conexao) {

            // Instanciando o construtor da superclasse.
            parent::__construct($conexao, "produto");

        }

        public function cadastrarProduto($produto) {
            // Verificação de campos obrigatórios
            if (empty($produto['nomeProduto']) || empty($produto['descricaoProduto']) || empty($produto['valorProduto']) || empty($produto['categoria']) || empty($produto['imagemProduto'])) {
                fwrite(STDERR, "Erro no cadastro do produto: Dados incompletos.\n");
                return false; // Dados incompletos
            }
        
            // Verificação de valor válido
            if ($produto['valorProduto'] <= 0) {
                fwrite(STDERR, "Erro no cadastro do produto: Valor inválido.\n");
                return false; // Valor inválido
            }
        
            $camposTabela = $this->organizarCamposDaTabela($produto);
            $valores = $this->organizarValoresParaTabela($produto);
        
            try {
                $sql = "INSERT INTO {$this->tabela} ($camposTabela) VALUES ($valores)";
                $resultadoCadastro = $this->conexaoBD->queryBanco($sql, $produto);
        
                if ($resultadoCadastro > 0) {
                    fwrite(STDOUT, "Cadastro realizado com sucesso. Linhas afetadas: $resultadoCadastro.\n");
                    return true;
                } else {
                    fwrite(STDERR, "Erro no cadastro do produto: Nenhuma linha afetada.\n");
                    return false;
                }
            } catch (PDOException $excecao) {
                fwrite(STDERR, "Erro no cadastro do produto: " . $excecao->getMessage() . "\n");
                fwrite(STDERR, "Código do erro SQLSTATE: " . $excecao->getCode() . "\n");
                fwrite(STDERR, "Arquivo onde ocorreu o erro: " . $excecao->getFile() . "\n");
                fwrite(STDERR, "Linha onde ocorreu o erro: " . $excecao->getLine() . "\n");
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

                // Instanciando uma lista para armazenar os campos da tabela.
                $campos = $this->inserirCamposTabelaEmUmaLista($produto);

                // Comando sql para editar as informações do produto.
                $sql = "UPDATE {$this->tabela} SET " . implode(", ", $campos) . " WHERE codigoProduto = :id";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, array_merge($produto, ['id' => $idProduto]));
                
                // Verificando se a linha correspondente ao usuário foi afetada no banco.
                if ($resultadoConsulta > 0) {


                    return true;

                } else {


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
                    

                    return true;

                } else {


                    return false;

                }


            } catch (Exception $excecao) {

                echo "<br>Erro na exclusão do produto: " . $excecao->getMessage();

            }


        }

        
    }

?>