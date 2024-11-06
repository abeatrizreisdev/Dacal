<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudFuncionario.php";
require_once "./PHP/entidades/funcionario.php";

class TesteCadastroFuncionario extends TestCase {

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

    // Teste de cadastro de funcionário válido.
    public function testCadastroFuncionarioValido() {

        // Dados simulados para o teste
        $funcionario = new Funcionario();
        $funcionario->setNome("João Silva");
        $funcionario->setTelefone("11987654321");
        $funcionario->setEmail("joao.silva@gmail.com");
        $funcionario->setSenha("senha123");
        $funcionario->setCpf("12345678909");
        $funcionario->setTipoConta("funcionario");
        $funcionario->setLogradouro("Rua A");
        $funcionario->setBairro("Centro");
        $funcionario->setCep("12345678");
        $funcionario->setEstado("BA");
        $funcionario->setCidade("Catu");
        $funcionario->setNumeroEndereco("123");

        // Executar o método de cadastro de funcionário com array associativo.
        $cadastroRealizado = $this->crudFuncionario->cadastrarFuncionario([
            'nome' => $funcionario->getNome(),
            'telefone' => $funcionario->getTelefone(),
            'email' => $funcionario->getEmail(),
            'senha' => $funcionario->getSenha(),
            'cpf' => $funcionario->getCpf(),
            'tipoConta' => $funcionario->getTipoConta(),
            'logradouro' => $funcionario->getLogradouro(),
            'bairro' => $funcionario->getBairro(),
            'cep' => $funcionario->getCep(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
        ]);

    
        // Verifica se o cadastro foi realizado com sucesso.
        $this->assertTrue($cadastroRealizado, "Falha ao cadastrar o funcionário.");

    }

    // Teste de cadastro de funcionário com CPF inválido.
    public function testCadastroFuncionarioCpfInvalido() {

        // Dados simulados para o teste.
        $funcionario = new Funcionario();
        $funcionario->setNome("Maria Silva");
        $funcionario->setTelefone("11987654322");
        $funcionario->setEmail("maria.silva@gmail.com");
        $funcionario->setSenha("senha1234");
        $funcionario->setCpf("00000000000"); // CPF inválido.
        $funcionario->setTipoConta("usuario");
        $funcionario->setLogradouro("Rua B");
        $funcionario->setBairro("Centro");
        $funcionario->setCep("12345679");
        $funcionario->setEstado("RJ");
        $funcionario->setCidade("Rio de Janeiro");
        $funcionario->setNumeroEndereco("124");

        // Executar o método de cadastro de funcionário com array associativo.
        $cadastroRealizado = $this->crudFuncionario->cadastrarFuncionario([
            'nome' => $funcionario->getNome(),
            'telefone' => $funcionario->getTelefone(),
            'email' => $funcionario->getEmail(),
            'senha' => $funcionario->getSenha(),
            'cpf' => $funcionario->getCpf(),
            'tipoConta' => $funcionario->getTipoConta(),
            'logradouro' => $funcionario->getLogradouro(),
            'bairro' => $funcionario->getBairro(),
            'cep' => $funcionario->getCep(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
        ]);

        // Verificar se o cadastro foi rejeitado (retornado false).
        $this->assertFalse($cadastroRealizado, "Cadastro de funcionário com CPF inválido foi aceito.");

    }

    // Teste de cadastro de funcionário com dados obrigatórios faltando.
    public function testCadastroFuncionarioDadosIncompletos() {

        // Dados simulados para o teste, sem a senha e bairro.
        $funcionario = new Funcionario();
        $funcionario->setNome("Carlos Souza");
        $funcionario->setTelefone("11987654323");
        $funcionario->setEmail("carlos.souza@empresa.com");
        $funcionario->setCpf("12345678909"); // CPF válido
        $funcionario->setTipoConta("funcionario");
        $funcionario->setLogradouro("Rua C");
        $funcionario->setBairro("Centro");
        $funcionario->setCep("12345670");
        $funcionario->setEstado("BA");
        $funcionario->setCidade("Catu");
        $funcionario->setNumeroEndereco("125");
    
        // Executar o método de cadastro de funcionário com array associativo, faltando a senha
        $cadastroRealizado = $this->crudFuncionario->cadastrarFuncionario([
            'nome' => $funcionario->getNome(),
            'telefone' => $funcionario->getTelefone(),
            'email' => $funcionario->getEmail(),
            'cpf' => $funcionario->getCpf(),
            'tipoConta' => $funcionario->getTipoConta(),
            'logradouro' => $funcionario->getLogradouro(),
            'bairro' => $funcionario->getBairro(),
            'cep' => $funcionario->getCep(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
            // Sem a senha e bairro.
        ]);
    
        // Verificar se o cadastro foi rejeitado (retornado false)
        $this->assertFalse($cadastroRealizado, "Cadastro de funcionário com dados obrigatórios faltando foi aceito.");

    }
    
    

}
