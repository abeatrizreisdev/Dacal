<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudOrcamento.php";
require_once "./PHP/entidades/orcamento.php";
require_once "./PHP/entidades/produto.php";

// Classe para testes unitários da funcionalidade de orçamento.
class TesteOrcamento extends TestCase {

    private $conexao;
    private $crudOrcamento;

    private Orcamento $orcamento;

    protected function setUp(): void {

        $this->conexao = new ConexaoBD();
        $this->conexao->setHostBD(BD_HOST);
        $this->conexao->setPortaBD(BD_PORTA);
        $this->conexao->setEschemaBD(BD_ESCHEMA);
        $this->conexao->setSenhaBD(BD_PASSWORD);
        $this->conexao->setUsuarioBD(BD_USERNAME);
        $this->conexao->getConexao(); // Iniciando a conexão com o banco.

        if (!$this->conexao->getConexao()) {
            throw new Exception("Conexão com o banco de dados falhou.");
        }

        $this->crudOrcamento = new CrudOrcamento($this->conexao);

    }

    // Teste de cadastro de um orçamento válido.
    public function testCadastroOrcamentoValido() {

        // Dados simulados para o teste.
        $produtos = ['Produto A', 'Produto B'];
        $quantidades = [2, 3];
        $valores = [100, 150];
        $produtoIds = [1, 1]; // Id válido dos produtos no banco.
        $valorTotal = 650; // Valor total (2*100 + 3*150).
    
        // Cria o objeto Orcamento.
        $orcamentoRealizado = new Orcamento();
        $orcamentoRealizado->setCliente(1); // ID do cliente válido.
        $orcamentoRealizado->setValor($valorTotal);
        $orcamentoRealizado->setData(date('Y-m-d H:i:s')); // data e horas atuais.
        $orcamentoRealizado->setStatus('pendente');
    
        // Criando os itens do orçamento.
        $itens = [];
        foreach ($produtos as $index => $produtoNome) {

            $produto = new Produto();
            $produto->setId($produtoIds[$index]);
            $produto->setNome($produtoNome);
            $produto->setValor($valores[$index]);
            
            $itens[] = [
                'produto' => $produto,
                'quantidade' => $quantidades[$index]
            ];

        }
    
        // Executa o método de cadastro de orçamento.
        $resultado = $this->crudOrcamento->cadastrarOrcamento($orcamentoRealizado, $itens);
    
        // Verificar se o cadastro foi realizado com sucesso.
        $this->assertTrue($resultado, "Falha ao cadastrar o orçamento.");

    }
    

    // Método de teste para buscar todos os orçamentos realizados por uma Empresa.
    public function testBuscarTodosOrcamentos(){

        // Executando a função que busca todos os orçamentos.
        $resultados = $this->crudOrcamento->buscarTodosOrcamentos();

        // Verifica se o resultado é um array com todos os orçamentos realizados cadastrados no banco. 
        $this->assertIsArray($resultados, "A função de busca de todos os orçamentos não retornou um array de orçamentos.");

        // Verifica se o array contém orçamentos.
        if (is_array($resultados) && count($resultados) > 0) {

            $orcamento = $resultados[0];
            
            // Verifica se o array contém as chaves esperadas.
            $this->assertArrayHasKey('numeroOrcamento', $orcamento, "Falta a chave 'numeroOrcamento'.");
            $this->assertArrayHasKey('valorOrcamento', $orcamento, "Falta a chave 'valorOrcamento'.");
            $this->assertArrayHasKey('dataCriacao', $orcamento, "Falta a chave 'dataCriacao'.");
            $this->assertArrayHasKey('status', $orcamento, "Falta a chave 'status'.");
            $this->assertArrayHasKey('nomeCliente', $orcamento, "Falta a chave 'nomeCliente'.");
            $this->assertArrayHasKey('quantidadeTotal', $orcamento, "Falta a chave 'quantidadeTotal'.");

        } else {

            $this->fail("Nenhum orçamento encontrado.");

        }

    }

    public function testBuscarInfoOrcamentoValido(){

        $idOrcamento = 1; // Id do orçamento a ser buscado

        // Executar a função que busca as informações do orçamento
        $resultado = $this->crudOrcamento->buscarInfoOrcamento($idOrcamento);

        // Verificar se o resultado é um array
        $this->assertIsArray($resultado, "A função não retornou um array com as informações do orçamento.");

        // Verificar se o array contém as chaves esperadas
        $this->assertArrayHasKey('numeroOrcamento', $resultado, "Falta a chave 'numeroOrcamento'.");
        $this->assertArrayHasKey('valorOrcamento', $resultado, "Falta a chave 'valorOrcamento'.");
        $this->assertArrayHasKey('dataCriacao', $resultado, "Falta a chave 'dataCriacao'.");
        $this->assertArrayHasKey('status', $resultado, "Falta a chave 'status'.");
        $this->assertArrayHasKey('nomeCliente', $resultado, "Falta a chave 'nomeCliente'.");
        $this->assertArrayHasKey('razaoSocial', $resultado, "Falta a chave 'razaoSocial'.");
        $this->assertArrayHasKey('cnpj', $resultado, "Falta a chave 'cnpj'.");
        $this->assertArrayHasKey('inscricaoEstadual', $resultado, "Falta a chave 'inscricaoEstadual'.");
        $this->assertArrayHasKey('telefone', $resultado, "Falta a chave 'telefone'.");
        $this->assertArrayHasKey('email', $resultado, "Falta a chave 'email'.");
        $this->assertArrayHasKey('logradouro', $resultado, "Falta a chave 'logradouro'.");
        $this->assertArrayHasKey('bairro', $resultado, "Falta a chave 'bairro'.");
        $this->assertArrayHasKey('cep', $resultado, "Falta a chave 'cep'.");
        $this->assertArrayHasKey('estado', $resultado, "Falta a chave 'estado'.");
        $this->assertArrayHasKey('municipio', $resultado, "Falta a chave 'municipio'.");
        $this->assertArrayHasKey('numeroEndereco', $resultado, "Falta a chave 'numeroEndereco'.");
        $this->assertArrayHasKey('quantidadeTotal', $resultado, "Falta a chave 'quantidadeTotal'.");
        $this->assertArrayHasKey('itens', $resultado, "Falta a chave 'itens'.");

        // Verificar se a chave 'itens' é um array e contém itens
        $this->assertIsArray($resultado['itens'], "A chave 'itens' não é um array.");
        $this->assertNotEmpty($resultado['itens'], "A chave 'itens' está vazia.");

        // Verificar se cada item no array 'itens' contém as chaves esperadas
        foreach ($resultado['itens'] as $item) {
            $this->assertArrayHasKey('idProduto', $item, "Falta a chave 'idProduto' em um item.");
            $this->assertArrayHasKey('quantidade', $item, "Falta a chave 'quantidade' em um item.");
            $this->assertArrayHasKey('nomeProduto', $item, "Falta a chave 'nomeProduto' em um item.");
            $this->assertArrayHasKey('imagemProduto', $item, "Falta a chave 'imagemProduto' em um item.");
        }

    }

    // Método para testar a funcionalidade de atualização do status de um orçamento.
    public function testAtualizarStatusOrcamento(){
    
        $numeroOrcamento = 1; // Número do orçamento a ser atualizado.
        $novoStatus = 'Finalizado'; // Novo status válido a ser definido.

        // Executa a função que atualiza o status do orçamento.
        $linhasAfetadas = $this->crudOrcamento->atualizarStatusOrcamento($numeroOrcamento, $novoStatus);

        // Verifica se a atualização foi realizada com sucesso (pelo menos uma linha afetada).
        $this->assertGreaterThan(0, $linhasAfetadas, "Falha ao atualizar o status do orçamento.");

        // Verifica se o status foi realmente atualizado no banco de dados.
        $orcamentoAtualizado = $this->crudOrcamento->buscarInfoOrcamento($numeroOrcamento);
        $this->assertEquals($novoStatus, $orcamentoAtualizado['status'], "O status do orçamento não foi atualizado corretamente.");

    }


    // Método que testa a funcionalidade de busca dos orçamentos realizados por uma determinada empresa, passando o id válido da empresa.
    public function testBuscarOrcamentosPorClienteValido(){

        $idCliente = 1; // ID do cliente a ser buscado.

        // Executa a função que busca os orçamentos pelo ID do cliente.
        $resultados = $this->crudOrcamento->buscarOrcamentosPorCliente($idCliente);

        // Verifica se o resultado é um array.
        $this->assertIsArray($resultados, "A função não retornou um array de orçamentos.");

        // Verifica se o array contém orçamentos.
        if (is_array($resultados) && count($resultados) > 0) {

            $orcamento = $resultados[0];
            
            // Verifica se o array contém as chaves esperadas.
            $this->assertArrayHasKey('numeroOrcamento', $orcamento, "Falta a chave 'numeroOrcamento'.");
            $this->assertArrayHasKey('valorOrcamento', $orcamento, "Falta a chave 'valorOrcamento'.");
            $this->assertArrayHasKey('dataCriacao', $orcamento, "Falta a chave 'dataCriacao'.");
            $this->assertArrayHasKey('status', $orcamento, "Falta a chave 'status'.");
            $this->assertArrayHasKey('nomeCliente', $orcamento, "Falta a chave 'nomeCliente'.");
            $this->assertArrayHasKey('quantidadeTotal', $orcamento, "Falta a chave 'quantidadeTotal'.");

        } else {

            $this->fail("Nenhum orçamento encontrado para o cliente com ID $idCliente.");

        }

    }

    // Método que testa a funcionalidade de busca do orçamento passando um número válido do orçamento.
    public function testBuscarOrcamentoPorNumero(){
    
        $numeroOrcamento = 1; // Número do orçamento a ser buscado.

        // Executa a função que busca o orçamento pelo número.
        $resultado = $this->crudOrcamento->buscarOrcamentoPorNumero($numeroOrcamento);

        // Verifica se o resultado é um array.
        $this->assertIsArray($resultado, "A função não retornou um array com as informações do orçamento.");

        // Verifica se o array contém as chaves esperadas.
        $orcamento = $resultado[0];
        $this->assertArrayHasKey('numeroOrcamento', $orcamento, "Falta a chave 'numeroOrcamento'.");
        $this->assertArrayHasKey('valorOrcamento', $orcamento, "Falta a chave 'valorOrcamento'.");
        $this->assertArrayHasKey('dataCriacao', $orcamento, "Falta a chave 'dataCriacao'.");
        $this->assertArrayHasKey('status', $orcamento, "Falta a chave 'status'.");
        $this->assertArrayHasKey('nomeCliente', $orcamento, "Falta a chave 'nomeCliente'.");
        $this->assertArrayHasKey('quantidadeTotal', $orcamento, "Falta a chave 'quantidadeTotal'.");

    }

   




}
