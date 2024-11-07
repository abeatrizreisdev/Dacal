<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudCliente.php"; 
require_once "./PHP/entidades/cliente.php"; 

class TesteEdicaoEmpresa extends TestCase {

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

    // Teste de edição de cliente/empresa válido
    public function testEdicaoClienteValido() {
    
        // Dados simulados para o teste
        $cliente = new Cliente();
        $cliente->setNome("Empresa A Editada");
        $cliente->setRazaoSocial("Razão Social A Editada");
        $cliente->setCnpj("12345678000195");
        $cliente->setInscricaoEstadual("123456789");
        $cliente->setTelefone("11987654321");
        $cliente->setEmail("contato@empresaAeditada.com");
        $cliente->setSenha("senhaSegura123");
        $cliente->setLogradouro("Rua A, 123");
        $cliente->setBairro("Centro");
        $cliente->setCep("12345678");
        $cliente->setEstado("BA");
        $cliente->setMunicipio("Alagoinhas");
        $cliente->setNumeroEndereco(123);
    
        // Executar o método de edição de cliente com array associativo
        $edicaoRealizada = $this->crudCliente->editarCliente(5, [
            'nomeFantasia' => $cliente->getNome(),
            'razaoSocial' => $cliente->getRazaoSocial(),
            'cnpj' => $cliente->getCnpj(),
            'inscricaoEstadual' => $cliente->getInscricaoEstadual(),
            'telefone' => $cliente->getTelefone(),
            'email' => $cliente->getEmail(),
            'senha' => $cliente->getSenha(),
            'logradouro' => $cliente->getLogradouro(),
            'bairro' => $cliente->getBairro(),
            'cep' => $cliente->getCep(),
            'estado' => $cliente->getEstado(),
            'municipio' => $cliente->getMunicipio(),
            'numeroEndereco' => $cliente->getNumeroEndereco()
        ]);
    
        // Verificar se a edição foi realizada com sucesso
        $this->assertTrue($edicaoRealizada, "Falha ao editar o cliente.");

    }
    

    // Teste de edição de cliente com Cnpj inválido.
    public function testEdicaoClienteCnpjInvalido() {

        // Dados simulados para o teste
        $cliente = new Cliente();
        $cliente->setNome("Empresa D Editada");
        $cliente->setRazaoSocial("Razão Social D Editada");
    
        $cliente->setCnpj("12345678000100"); // CNPJ inválido
        $cliente->setInscricaoEstadual("123456790");
        $cliente->setTelefone("11987654323");
        $cliente->setEmail("contato@empresaDeditada.com");
        $cliente->setSenha("senhaSegura123");
        $cliente->setLogradouro("Rua D, 321");
        $cliente->setBairro("Centro");
        $cliente->setCep("12345679");
        $cliente->setEstado("BA");
        $cliente->setMunicipio("Pojuca");
        $cliente->setNumeroEndereco(321);
    
        // Executar o método de edição de cliente com array associativo
        $edicaoRealizada = $this->crudCliente->editarCliente(5, [
            'nomeFantasia' => $cliente->getNome(),
            'razaoSocial' => $cliente->getRazaoSocial(),
            'cnpj' => $cliente->getCnpj(),
            'inscricaoEstadual' => $cliente->getInscricaoEstadual(),
            'telefone' => $cliente->getTelefone(),
            'email' => $cliente->getEmail(),
            'senha' => $cliente->getSenha(),
            'logradouro' => $cliente->getLogradouro(),
            'bairro' => $cliente->getBairro(),
            'cep' => $cliente->getCep(),
            'estado' => $cliente->getEstado(),
            'municipio' => $cliente->getMunicipio(),
            'numeroEndereco' => $cliente->getNumeroEndereco()
        ]);
    
        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de cliente com CNPJ inválido foi aceita.");

    }
    

    // Teste de edição de cliente com dados obrigatórios faltando
    public function testEdicaoClienteDadosIncompletos() {

        // Dados simulados para o teste, sem o email do cliente
        $cliente = new Cliente();
        $cliente->setNome("Empresa C Editada");
        $cliente->setRazaoSocial("Razão Social C Editada");
        $cliente->setCnpj("12345678000197");
        $cliente->setInscricaoEstadual("123456787");
        $cliente->setTelefone("11987654322");
        $cliente->setLogradouro("Rua C, 789");
        $cliente->setBairro("Centro");
        $cliente->setCep("12345678");
        $cliente->setEstado("BA");
        $cliente->setMunicipio("Salvador");
        $cliente->setNumeroEndereco(789);

        // Executar o método de edição de cliente com array associativo, faltando o email
        $edicaoRealizada = $this->crudCliente->editarCliente(5, [
            'nomeFantasia' => $cliente->getNome(),
            'razaoSocial' => $cliente->getRazaoSocial(),
            'cnpj' => $cliente->getCnpj(),
            'inscricaoEstadual' => $cliente->getInscricaoEstadual(),
            'telefone' => $cliente->getTelefone(),
            'logradouro' => $cliente->getLogradouro(),
            'bairro' => $cliente->getBairro(),
            'cep' => $cliente->getCep(),
            'estado' => $cliente->getEstado(),
            'municipio' => $cliente->getMunicipio(),
            'numeroEndereco' => $cliente->getNumeroEndereco()
            // Sem o email do cliente
        ]);

        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de cliente com dados obrigatórios faltando foi aceita.");

    }

    // Teste de edição de email válido do cliente
    public function testEdicaoEmailClienteValido() {

        // ID do cliente e novo email
        $idCliente = 5;
        $novoEmail = "novoemail@cliente.com";

        // Executar o método de edição de email do cliente
        $edicaoRealizada = $this->crudCliente->editarEmailCliente($idCliente, $novoEmail);

        // Verificar se a edição foi realizada com sucesso
        $this->assertTrue($edicaoRealizada, "Falha ao editar o email do cliente.");

    }

    // Teste de edição de email inválido do cliente
    public function testEdicaoEmailClienteInvalido() {

        // ID do cliente e email inválido
        $idCliente = 100;
        $novoEmail = null; // Email inválido

        // Executar o método de edição de email do cliente
        $edicaoRealizada = $this->crudCliente->editarEmailCliente($idCliente, $novoEmail);

        // Verificar se a edição foi rejeitada
        $this->assertFalse($edicaoRealizada, "Edição de email inválido foi aceita.");

    }

    // Teste de edição de senha válida do cliente
    public function testEdicaoSenhaClienteValida() {

        // ID do cliente e nova senha
        $idCliente = 5;
        $novaSenha = "novaSenhaSegura123";

        // Executar o método de edição de senha do cliente
        $edicaoRealizada = $this->crudCliente->editarSenhaCliente($idCliente, $novaSenha);

        // Verificar se a edição foi realizada com sucesso
        $this->assertTrue($edicaoRealizada, "Falha ao editar a senha do cliente.");

    }

    // Teste de edição de senha inválida do cliente
    public function testEdicaoSenhaClienteInvalida() {

        // ID do cliente e senha inválida
        $idCliente = 100;
        $novaSenha = null; // Senha inválida

        // Executar o método de edição de senha do cliente
        $edicaoRealizada = $this->crudCliente->editarSenhaCliente($idCliente, $novaSenha);

        // Verificar se a edição foi rejeitada
        $this->assertFalse($edicaoRealizada, "Edição de senha inválida foi aceita.");

    }



}
