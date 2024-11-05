<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudOrcamento.php";
require_once "./PHP/entidades/orcamento.php";

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
    public function testCadastroOrcamentoValido(){

        // Dados simulados para o teste.
        $produtos = ['Produto A', 'Produto B'];
        $quantidades = [2, 3];
        $valores = [100, 150];
        $produtoIds = [12, 13]; // Id válido dos produtos no banco.
        $valorTotal = 650; // Valor total (2*100 + 3*150).

        // Criar o objeto Orcamento.
        $orcamentoRealizado = new Orcamento();
        $orcamentoRealizado->setCliente(1); // ID do cliente válido.
        $orcamentoRealizado->setValor($valorTotal);
        $orcamentoRealizado->setData($dateTime = date('Y-m-d H:i:s')); // data e horas atuais.
        
        $orcamentoRealizado->setStatus('pendente');

        $this->orcamento = $orcamentoRealizado;

        // Criando os itens do orçamento.
        $itens = [];

        foreach ($produtos as $index => $produto) {

            $itens[] = [
                'idProduto' => $produtoIds[$index],
                'quantidade' => $quantidades[$index]
            ];

        }

        // Executar o método de cadastro de orçamento
        $resultado = $this->crudOrcamento->cadastrarOrcamento($this->orcamento, $itens);


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



}
