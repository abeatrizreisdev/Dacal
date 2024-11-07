<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudCliente.php"; 
require_once "./PHP/entidades/cliente.php"; 
class TesteExcluirEmpresa extends TestCase {

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

    // Teste de exclusão de cliente existente
    public function testExclusaoClienteExistente() {

        // ID do cliente que deve ser excluído (assumindo que o cliente com ID 1 existe)
        $idCliente = 3;

        // Executar o método de exclusão de cliente
        $resultadoExclusao = $this->crudCliente->excluirCliente($idCliente);

        // Verificar se a exclusão foi realizada com sucesso.
        $this->assertGreaterThan(0, $resultadoExclusao, "Falha ao excluir o cliente válido.");

    }

    // Teste de exclusão de cliente inexistente
    public function testExclusaoClienteInexistente() {

        // ID de um cliente que não existe
        $idCliente = 999;

        // Executar o método de exclusão de cliente
        $resultadoExclusao = $this->crudCliente->excluirCliente($idCliente);

        // Verificar se a exclusão foi rejeitada (retornado null)
        $this->assertNull($resultadoExclusao, "Exclusão de cliente inexistente foi aceita.");
    }

}
