<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudFuncionario.php"; 
require_once "./PHP/entidades/funcionario.php"; 

class TesteExcluirFuncionario extends TestCase {

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

    // Teste de exclusão de funcionário existente
    public function testExclusaoFuncionarioExistente() {

        // ID do funcionário que deve ser excluído (assumindo que o funcionário com ID 1 existe)
        $idFuncionario = 7;

        // Executar o método de exclusão de funcionário
        $resultadoExclusao = $this->crudFuncionario->excluirFuncionario($idFuncionario);

        // Verificar se a exclusão foi realizada com sucesso
        $this->assertGreaterThan(0, $resultadoExclusao, "Falha ao excluir o funcionário.");

    }

    // Teste de exclusão de funcionário inexistente
    public function testExclusaoFuncionarioInexistente() {

        // ID de um funcionário que não existe
        $idFuncionario = 999;

        // Executar o método de exclusão de funcionário
        $resultadoExclusao = $this->crudFuncionario->excluirFuncionario($idFuncionario);

        // Verificar se a exclusão foi rejeitada (retornado null)
        $this->assertNull($resultadoExclusao, "Exclusão de funcionário inexistente foi aceita.");

    }

}
