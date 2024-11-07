<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudProduto.php";
require_once "./PHP/entidades/produto.php";

class TesteEdicaoProduto extends TestCase {

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

    // Teste de edição de produto válido
    public function testEdicaoProdutoValido() {

        // Dados simulados para o teste
        $produto = new Produto();
        $produto->setNome("Produto A Editado");
        $produto->setDescricao("Descrição do Produto A Editada");
        $produto->setValor(109.90);
        $produto->setCategoria(1);
        $produto->setImagem("imagemA_editada.jpg");

        // Executar o método de edição de produto com array associativo
        $edicaoRealizada = $this->crudProduto->editarProduto(3, [
            'nomeProduto' => $produto->getNome(),
            'descricaoProduto' => $produto->getDescricao(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
        ]);

        // Verificar se a edição foi realizada com sucesso
        $this->assertTrue($edicaoRealizada, "Falha ao editar o produto válido.");

    }

    // Teste de edição de produto com valor inválido
    public function testEdicaoProdutoValorInvalido() {

        // Dados simulados para o teste
        $produto = new Produto();
        $produto->setNome("Produto B Editado");
        $produto->setDescricao("Descrição do Produto B Editada");
        
        // Capturar a exceção esperada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erro. O valor do produto não pode ser igual ou menor que 0.");

        // Definir um valor inválido que deve lançar uma exceção
        $produto->setValor(-10.00); // Valor inválido
        $produto->setCategoria(2);
        $produto->setImagem("imagemB_editada.jpg");

        // Executar o método de edição de produto com array associativo
        $edicaoRealizada = $this->crudProduto->editarProduto(2, [
            'nomeProduto' => $produto->getNome(),
            'descricaoProduto' => $produto->getDescricao(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
        ]);

        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de produto com valor inválido foi aceita.");
    }

    // Teste de edição de produto com dados obrigatórios faltando
    public function testEdicaoProdutoDadosIncompletos() {
        // Dados simulados para o teste, sem a descrição do produto
        $produto = new Produto();
        $produto->setNome("Produto C Editado");
        $produto->setValor(59.90);
        $produto->setCategoria(3);
        $produto->setImagem("imagemC_editada.jpg");

        // Executar o método de edição de produto com array associativo, faltando a descrição
        $edicaoRealizada = $this->crudProduto->editarProduto(3, [
            'nomeProduto' => $produto->getNome(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
            // Sem a descrição do produto
        ]);

        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de produto com dados obrigatórios faltando foi aceita.");
    }

}
