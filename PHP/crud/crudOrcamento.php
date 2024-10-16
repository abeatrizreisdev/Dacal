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

                $sql = "SELECT 
                            {$this->tabela}.numeroOrcamento, 
                            {$this->tabela}.valorOrcamento, 
                            {$this->tabela}.dataCriacao, 
                            {$this->tabela}.status, 
                            cliente.nomeEmpresa AS nomeCliente,
                            cliente.razaoSocial AS razaoSocial,
                            cliente.cnpj AS cnpj,
                            cliente.inscricaoEstadual AS inscricaoEstadual,
                            cliente.telefone AS telefone,
                            cliente.email AS email,
                            cliente.logradouro AS logradouro,
                            cliente.bairro AS bairro,
                            cliente.cep AS cep,
                            cliente.estado AS estado,
                            cliente.municipio AS municipio,
                            cliente.numeroEndereco AS numeroEndereco, 
                            itens_orcamento.idProduto, 
                            itens_orcamento.quantidade, 
                            produto.nomeProduto
                        FROM 
                            {$this->tabela}, itens_orcamento, cliente, produto
                        WHERE 
                            {$this->tabela}.numeroOrcamento = :id 
                            AND {$this->tabela}.numeroOrcamento = itens_orcamento.numeroOrcamento 
                            AND {$this->tabela}.idCliente = cliente.idCliente
                            AND itens_orcamento.idProduto = produto.codigoProduto";
        
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['id' => $idOrcamento]);
        
                $orcamentoDetalhes = $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);
                
                if ($orcamentoDetalhes) {

                    $orcamento = [
                        "numeroOrcamento" => $orcamentoDetalhes[0]['numeroOrcamento'],
                        "valorOrcamento" => $orcamentoDetalhes[0]['valorOrcamento'],
                        "dataCriacao" => $orcamentoDetalhes[0]['dataCriacao'],
                        "status" => $orcamentoDetalhes[0]['status'],
                        "nomeCliente" => $orcamentoDetalhes[0]['nomeCliente'],
                        "razaoSocial" => $orcamentoDetalhes[0]['razaoSocial'],
                        "cnpj" => $orcamentoDetalhes[0]['cnpj'],
                        "inscricaoEstadual" => $orcamentoDetalhes[0]['inscricaoEstadual'],
                        "telefone" => $orcamentoDetalhes[0]['telefone'],
                        "email" => $orcamentoDetalhes[0]['email'],
                        "logradouro" => $orcamentoDetalhes[0]['logradouro'],
                        "bairro" => $orcamentoDetalhes[0]['bairro'],
                        "cep" => $orcamentoDetalhes[0]['cep'],
                        "estado" => $orcamentoDetalhes[0]['estado'],
                        "municipio" => $orcamentoDetalhes[0]['municipio'],
                        "numeroEndereco" => $orcamentoDetalhes[0]['numeroEndereco'],

                        "quantidadeTotal" => array_sum(array_column($orcamentoDetalhes, 'quantidade')),
                        "itens" => array_map(function($item) {

                            return [
                                "idProduto" => $item['idProduto'],
                                "quantidade" => $item['quantidade'],
                                "nomeProduto" => $item['nomeProduto']
                            ];
                            
                        }, $orcamentoDetalhes)

                    ];

                    return $orcamento;

                } else {

                    return null;

                }

            } catch (Exception $excecao) {

                error_log('Erro: ' . $excecao->getMessage()); // Log para depuração
                return ["erro" => "Erro na busca de informações do orçamento: " . $excecao->getMessage()];

            }

        }
        
        public function atualizarStatusOrcamento($numeroOrcamento, $status) {

            try {

                $sql = "UPDATE {$this->tabela} SET status = :status WHERE numeroOrcamento = :numeroOrcamento";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql, ['numeroOrcamento' => $numeroOrcamento, 'status' => $status]);

                return $resultadoConsulta;
        
                
            } catch (Exception $excecao) {

                error_log('Erro: ' . $excecao->getMessage());
                return false;
                
            }

        }
        
        

        public function buscarTodosOrcamentos() {

            try {

                $sql = "SELECT 
                        {$this->tabela}.numeroOrcamento, 
                        {$this->tabela}.valorOrcamento, 
                        {$this->tabela}.dataCriacao, 
                        {$this->tabela}.status, 
                        cliente.nomeEmpresa AS nomeCliente, 
                        (SELECT SUM(itens_orcamento.quantidade) 
                        FROM itens_orcamento 
                        WHERE itens_orcamento.numeroOrcamento = {$this->tabela}.numeroOrcamento) AS quantidadeTotal 
                        FROM orcamentos, cliente 
                        WHERE {$this->tabela}.idCliente = cliente.idCliente";

                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {


                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {


                    return null;

                }

            } catch (Exception $excecao) {

                echo "<br>Erro na busca por orçamentos cadastrados: " . $excecao->getMessage();

                return null;

            }


        }

        // Método novo para adcionar no diagrama de classes.
        public function buscarOrcamentosPorCliente($idCliente) {

            try {

                $sql = "SELECT 
                            {$this->tabela}.numeroOrcamento, 
                            {$this->tabela}.valorOrcamento, 
                            {$this->tabela}.dataCriacao, 
                            {$this->tabela}.status, 
                            cliente.nomeEmpresa AS nomeCliente, 
                            (SELECT SUM(itens_orcamento.quantidade) 
                             FROM itens_orcamento 
                             WHERE itens_orcamento.numeroOrcamento = {$this->tabela}.numeroOrcamento) AS quantidadeTotal 
                        FROM orcamentos, cliente 
                        WHERE {$this->tabela}.idCliente = cliente.idCliente 
                          AND cliente.idCliente = $idCliente";
                $resultadoConsulta = $this->conexaoBD->queryBanco($sql);

                if ($resultadoConsulta->rowCount() > 0) {

                    return $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    return null;

                }
            } catch (Exception $excecao) {

                echo "<br>Erro na busca por orçamentos do cliente: " . $excecao->getMessage();
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