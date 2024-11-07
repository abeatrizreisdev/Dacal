<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudProduto.php";
require_once "./PHP/entidades/produto.php";

class TesteCadastroProduto extends TestCase {

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

    // Teste de cadastro de produto válido
    public function testCadastroProdutoValido() {
        // Iniciar o buffer de saída
        ob_start();
    
        // Dados simulados para o teste
        $produto = new Produto();
        $produto->setNome("Produto A");
        $produto->setDescricao("Descrição do Produto A");
        $produto->setValor(99.90);
        $produto->setCategoria(1);
        $produto->setImagem("imagemA.jpg");
    
        // Executar o método de cadastro de produto com array associativo
        $cadastroRealizado = $this->crudProduto->cadastrarProduto([
            'nomeProduto' => $produto->getNome(),
            'descricaoProduto' => $produto->getDescricao(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
        ]);
    
        // Capturar a saída e limpar o buffer
        $output = ob_get_clean();
    
        // Exibir a saída no terminal
        echo $output;
    
        // Verificar se o cadastro foi realizado com sucesso
        $this->assertTrue($cadastroRealizado, "Falha ao cadastrar o produto válido.");
    }
    

    // Teste de cadastro de produto com valor inválido
    public function testCadastroProdutoValorInvalido() {
        // Dados simulados para o teste
        $produto = new Produto();
        $produto->setNome("Produto B");
        $produto->setDescricao("Descrição do Produto B");
    
        // Capturar a exceção esperada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erro. O valor do produto não pode ser igual ou menor que 0.");
    
        // Definir um valor inválido que deve lançar uma exceção
        $produto->setValor(-10.00); // Valor inválido
        $produto->setCategoria(2);
        $produto->setImagem("imagemB.jpg");
    
        // Executar o método de cadastro de produto com array associativo
        $cadastroRealizado = $this->crudProduto->cadastrarProduto([
            'nomeProduto' => $produto->getNome(),
            'descricaoProduto' => $produto->getDescricao(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
        ]);
    
        // Verificar se o cadastro foi rejeitado (retornado false)
        $this->assertFalse($cadastroRealizado, "Cadastro de produto com valor inválido foi aceito.");
    }
    

    // Teste de cadastro de produto com dados obrigatórios faltando
    public function testCadastroProdutoDadosIncompletos() {

        // Dados simulados para o teste, sem a descrição do produto
        $produto = new Produto();
        $produto->setNome("Produto C");
        $produto->setValor(49.90);
        $produto->setCategoria(3);
        $produto->setImagem("imagemC.jpg");

        // Executar o método de cadastro de produto com array associativo, faltando a descrição
        $cadastroRealizado = $this->crudProduto->cadastrarProduto([
            'nomeProduto' => $produto->getNome(),
            'valorProduto' => $produto->getValor(),
            'categoria' => $produto->getCategoria(),
            'imagemProduto' => $produto->getImagem()
            // Sem a descrição do produto
        ]);

        // Verificar se o cadastro foi rejeitado (retornado false)
        $this->assertFalse($cadastroRealizado, "Cadastro de produto com dados obrigatórios faltando foi aceito.");

    }

}
