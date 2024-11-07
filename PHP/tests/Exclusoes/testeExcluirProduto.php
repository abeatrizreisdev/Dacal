<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudProduto.php"; 
require_once "./PHP/entidades/produto.php"; 

class TesteExcluirProduto extends TestCase {

    private $conexao;
    private $crudProduto;

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

        $this->crudProduto = new CrudProduto($this->conexao);

    }

    // Teste de exclusão de produto existente.
    public function testExclusaoProdutoExistente() {

        // ID do produto que deve ser excluído (assumindo que o produto com ID 1 existe)
        $idProduto = 1;

        // Executar o método de exclusão de produto
        $resultadoExclusao = $this->crudProduto->excluirProduto($idProduto);

        // Verificar se a exclusão foi realizada com sucesso
        $this->assertTrue($resultadoExclusao, "Falha ao excluir o produto existente.");

    }

    // Teste de exclusão de produto inexistente.
    public function testExclusaoProdutoInexistente() {

        // ID de um produto que não existe
        $idProduto = 999;

        // Executar o método de exclusão de produto
        $resultadoExclusao = $this->crudProduto->excluirProduto($idProduto);

        // Verificar se a exclusão foi rejeitada (retornado false)
        $this->assertFalse($resultadoExclusao, "Exclusão de produto inexistente foi aceita.");

    }

}
