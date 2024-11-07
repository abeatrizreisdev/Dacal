<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudCliente.php"; 
require_once "./PHP/entidades/cliente.php"; 

class TesteBuscarEmpresa extends TestCase {

    private $conexao;
    private $crudCliente;

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

        $this->crudCliente = new CrudCliente($this->conexao);

    }

    // Teste de busca de cliente por ID existente.
    public function testBuscarInfoClienteExistente() {

        // ID do cliente que deve ser buscado (assumindo que o cliente com ID 5 existe)
        $idCliente = 5;

        // Executar o método de busca de informações do cliente
        $resultadoBusca = $this->crudCliente->buscarInfoCliente($idCliente);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do cliente existente.");
        $this->assertArrayHasKey('idCliente', $resultadoBusca, "O resultado não contém a chave 'idCliente'.");
        $this->assertEquals($idCliente, $resultadoBusca['idCliente'], "O ID do cliente não corresponde.");

    }

    // Teste de busca de cliente por ID inexistente.
    public function testBuscarInfoClienteInexistente() {

        // ID de um cliente que não existe
        $idCliente = 999;

        // Executar o método de busca de informações do cliente
        $resultadoBusca = $this->crudCliente->buscarInfoCliente($idCliente);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de informações de cliente inexistente retornou um resultado.");

    }

    // Teste de busca de cliente por nome existente
    public function testBuscarClientePeloNomeExistente() {

        // Nome do cliente que deve ser buscado (assumindo que o cliente com este nome existe)
        $nomeCliente = "Empresa Fictícia Ltda";

        // Executar o método de busca de cliente pelo nome
        $resultadoBusca = $this->crudCliente->buscarClientePeloNome($nomeCliente);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do cliente existente pelo nome.");
        $this->assertArrayHasKey('nomeFantasia', $resultadoBusca, "O resultado não contém a chave 'nomeFantasia'.");
        $this->assertStringContainsString($nomeCliente, $resultadoBusca['nomeFantasia'], "O nome do cliente não corresponde.");

    }

    // Teste de busca de cliente por nome inexistente
    public function testBuscarClientePeloNomeInexistente() {

        // Nome de um cliente que não existe
        $nomeCliente = "Empresa XYZ";

        // Executar o método de busca de cliente pelo nome
        $resultadoBusca = $this->crudCliente->buscarClientePeloNome($nomeCliente);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de informações de cliente inexistente pelo nome retornou um resultado.");

    }

    // Teste de busca de todos os clientes
    public function testBuscarInfoTodosClientes() {

        // Executar o método de busca de informações de todos os clientes
        $resultadoBusca = $this->crudCliente->buscarInfoTodosClientes();

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações de todos os clientes.");
        $this->assertGreaterThan(0, count($resultadoBusca), "A busca não retornou nenhum cliente.");
        $this->assertArrayHasKey('idCliente', $resultadoBusca[0], "O resultado não contém a chave 'idCliente'.");
        
    }

}
