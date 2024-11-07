<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudProduto.php"; 
require_once "./PHP/entidades/produto.php"; 

class TesteBuscarProduto extends TestCase {

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

    // Teste de busca de produto por ID existente.
    public function testBuscarInfoProdutoExistente() {

        // ID do produto que deve ser buscado (assumindo que o produto com ID 1 existe).
        $idProduto = 2;

        // Executar o método de busca de informações do produto.
        $resultadoBusca = $this->crudProduto->buscarInfoProduto($idProduto);

        // Verificar se a busca foi realizada com sucesso.
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do produto existente.");
        $this->assertArrayHasKey('codigoProduto', $resultadoBusca, "O resultado não contém a chave 'codigoProduto'.");
        $this->assertEquals($idProduto, $resultadoBusca['codigoProduto'], "O ID do produto não corresponde.");

    }

    // Teste de busca de produto por ID inexistente.
    public function testBuscarInfoProdutoInexistente() {

        // ID de um produto que não existe.
        $idProduto = 999;

        // Executar o método de busca de informações do produto.
        $resultadoBusca = $this->crudProduto->buscarInfoProduto($idProduto);

        // Verificar se a busca foi rejeitada (retornado null).
        $this->assertNull($resultadoBusca, "A busca de informações de produto inexistente retornou um resultado.");

    }

    // Teste de busca de produto por nome existente.
    public function testBuscarProdutosPorNomeExistente() {

        // Nome do produto que deve ser buscado (assumindo que o produto com este nome existe).
        $nomeProduto = "Produto A";

        // Executar o método de busca de produto pelo nome
        $resultadoBusca = $this->crudProduto->buscarProdutosPorNome($nomeProduto);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações do produto existente pelo nome.");
        $this->assertGreaterThan(0, count($resultadoBusca), "A busca não retornou nenhum produto.");
        $this->assertArrayHasKey('nomeProduto', $resultadoBusca[0], "O resultado não contém a chave 'nomeProduto'.");
        $this->assertStringContainsString($nomeProduto, $resultadoBusca[0]['nomeProduto'], "O nome do produto não corresponde.");
    }

    // Teste de busca de produto por nome inexistente
    public function testBuscarProdutosPorNomeInexistente() {

        // Nome de um produto que não existe
        $nomeProduto = "Produto ZZZ";

        // Executar o método de busca de produto pelo nome
        $resultadoBusca = $this->crudProduto->buscarProdutosPorNome($nomeProduto);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de informações de produto inexistente pelo nome retornou um resultado.");

    }

    // Teste de busca de todos os produtos
    public function testBuscarTodosProdutos() {

        // Executar o método de busca de informações de todos os produtos
        $resultadoBusca = $this->crudProduto->buscarTodosProdutos();

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar informações de todos os produtos.");
        $this->assertGreaterThan(0, count($resultadoBusca), "A busca não retornou nenhum produto.");
        $this->assertArrayHasKey('codigoProduto', $resultadoBusca[0], "O resultado não contém a chave 'codigoProduto'.");

    }

    // Teste de busca de produtos por categoria existente
    public function testBuscarProdutosPorCategoriaExistente() {

        // Categoria do produto que deve ser buscado (assumindo que a categoria existe)
        $categoriaProduto = 1;

        // Executar o método de busca de produto pela categoria
        $resultadoBusca = $this->crudProduto->buscarProdutosPorCategoria($categoriaProduto);

        // Verificar se a busca foi realizada com sucesso
        $this->assertNotNull($resultadoBusca, "Falha ao buscar produtos pela categoria existente.");
        $this->assertGreaterThan(0, count($resultadoBusca), "A busca não retornou nenhum produto.");
        $this->assertArrayHasKey('categoria', $resultadoBusca[0], "O resultado não contém a chave 'categoria'.");
        $this->assertEquals($categoriaProduto, $resultadoBusca[0]['categoria'], "A categoria do produto não corresponde.");

    }

    // Teste de busca de produtos por categoria inexistente
    public function testBuscarProdutosPorCategoriaInexistente() {

        // Categoria de um produto que não existe
        $categoriaProduto = "10";

        // Executar o método de busca de produto pela categoria
        $resultadoBusca = $this->crudProduto->buscarProdutosPorCategoria($categoriaProduto);

        // Verificar se a busca foi rejeitada (retornado null)
        $this->assertNull($resultadoBusca, "A busca de produtos pela categoria inexistente retornou um resultado.");

    }

}
