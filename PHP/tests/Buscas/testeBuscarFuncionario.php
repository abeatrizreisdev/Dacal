<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudFuncionario.php"; 
require_once "./PHP/entidades/funcionario.php"; 

class TesteBuscarFuncionario extends TestCase {

    private $conexao;
    private $crudFuncionario;

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

        $this->crudFuncionario = new CrudFuncionario($this->conexao);
    }

    // Teste de busca de funcionário por ID existente
    public function testBuscarInfoFuncionarioExistente() {

        // ID do funcionário que deve ser buscado (assumindo que o funcionário com ID 1 existe)
        $idFuncionario = 1;

        // Executar o método de busca de informações do funcionário
        $resultadoBusca = $this->crudFuncionario->buscarInfoFuncionario($idFuncionario);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do funcionário existente.");
        $this->assertArrayHasKey('id', $resultadoBusca, "O resultado não contém a chave 'id'.");
        $this->assertEquals($idFuncionario, $resultadoBusca['id'], "O ID do funcionário não corresponde.");

    }

    // Teste de busca de funcionário por ID inexistente
    public function testBuscarInfoFuncionarioInexistente() {

        // ID de um funcionário que não existe
        $idFuncionario = 999;

        // Executar o método de busca de informações do funcionário
        $resultadoBusca = $this->crudFuncionario->buscarInfoFuncionario($idFuncionario);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de informações de funcionário inexistente retornou um resultado.");

    }

    // Teste de busca de funcionário por CPF existente
    public function testBuscarFuncionarioPeloCpfExistente() {

        // CPF do funcionário que deve ser buscado (assumindo que o funcionário com este CPF existe)
        $cpfFuncionario = "01234567890";

        // Executar o método de busca de funcionário pelo CPF
        $resultadoBusca = $this->crudFuncionario->buscarFuncionarioPeloCpf($cpfFuncionario);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do funcionário existente pelo CPF.");
        $this->assertArrayHasKey('cpf', $resultadoBusca, "O resultado não contém a chave 'cpf'.");
        $this->assertEquals($cpfFuncionario, $resultadoBusca['cpf'], "O CPF do funcionário não corresponde.");

    }

    // Teste de busca de funcionário por CPF inexistente
    public function testBuscarFuncionarioPeloCpfInexistente() {

        // CPF de um funcionário que não existe
        $cpfFuncionario = "99999999999";

        // Executar o método de busca de funcionário pelo CPF
        $resultadoBusca = $this->crudFuncionario->buscarFuncionarioPeloCpf($cpfFuncionario);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de informações de funcionário inexistente pelo CPF retornou um resultado.");

    }

    // Teste de busca de todos os funcionários
    public function testBuscarInfoTodosFuncionarios() {

        // Executar o método de busca de informações de todos os funcionários
        $resultadoBusca = $this->crudFuncionario->buscarInfoTodosFuncionarios();

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações de todos os funcionários.");
        $this->assertGreaterThan(0, count($resultadoBusca), "A busca não retornou nenhum funcionário.");
        $this->assertArrayHasKey('id', $resultadoBusca[0], "O resultado não contém a chave 'id'.");
        
    }

}
