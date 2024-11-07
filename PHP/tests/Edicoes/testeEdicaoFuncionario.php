<?php

use PHPUnit\Framework\TestCase;

require_once "./PHP/conexaoBD/conexaoBD.php";
require_once "./PHP/conexaoBD/configBanco.php";
require_once "./PHP/crud/crudFuncionario.php"; 
require_once "./PHP/entidades/funcionario.php"; 

class TesteEdicaoFuncionario extends TestCase {

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

    // Teste de edição de funcionário válido.
    public function testEdicaoFuncionarioValido() {

        // Dados simulados para o teste
        $funcionario = new Funcionario();
        $funcionario->setNome("Funcionario A Editado");
        $funcionario->setCpf("08675381557"); // CPF válido
        $funcionario->setEmail("contato@funcionarioa.com");
        $funcionario->setSenha("senhaSegura123");
        $funcionario->setTelefone("11987654321");
        $funcionario->setTipoConta("funcionario");
        $funcionario->setEstado("BA");
        $funcionario->setCidade("Pojuca");
        $funcionario->setBairro("Centro");
        $funcionario->setLogradouro("Rua A, 123");
        $funcionario->setCep("12345678");
        $funcionario->setNumeroEndereco(123);

        // Executar o método de edição de funcionário com array associativo
        $edicaoRealizada = $this->crudFuncionario->editarFuncionario(7, [
            'nome' => $funcionario->getNome(),
            'cpf' => $funcionario->getCpf(),
            'email' => $funcionario->getEmail(),
            'senha' => $funcionario->getSenha(),
            'telefone' => $funcionario->getTelefone(),
            'tipoConta' => $funcionario->getTipoConta(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'bairro' => $funcionario->getBairro(),
            'logradouro' => $funcionario->getLogradouro(),
            'cep' => $funcionario->getCep(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
        ]);

        // Verificar se a edição foi realizada com sucesso
        $this->assertTrue($edicaoRealizada, "Falha ao editar o funcionário.");

    }

    // Teste de edição de funcionário com CPF inválido.
    public function testEdicaoFuncionarioCpfInvalido() {

        // Dados simulados para o teste
        $funcionario = new Funcionario();
        $funcionario->setNome("Funcionario B Editado");
        
        // Definir um CPF inválido
        $funcionario->setCpf("12345678900"); // CPF inválido
        $funcionario->setEmail("contato@funcionariob.com");
        $funcionario->setSenha("senhaSegura123");
        $funcionario->setTelefone("11987654322");
        $funcionario->setTipoConta("funcionario");
        $funcionario->setEstado("BA");
        $funcionario->setCidade("Alagoinhas");
        $funcionario->setBairro("Centro");
        $funcionario->setLogradouro("Rua B, 456");
        $funcionario->setCep("12345678");
        $funcionario->setNumeroEndereco(456);

        // Executar o método de edição de funcionário com array associativo
        $edicaoRealizada = $this->crudFuncionario->editarFuncionario(7, [
            'nome' => $funcionario->getNome(),
            'cpf' => $funcionario->getCpf(),
            'email' => $funcionario->getEmail(),
            'senha' => $funcionario->getSenha(),
            'telefone' => $funcionario->getTelefone(),
            'tipoConta' => $funcionario->getTipoConta(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'bairro' => $funcionario->getBairro(),
            'logradouro' => $funcionario->getLogradouro(),
            'cep' => $funcionario->getCep(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
        ]);

        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de funcionário com CPF inválido foi aceita.");

    }

    // Teste de edição de funcionário com dados obrigatórios faltando
    public function testEdicaoFuncionarioDadosIncompletos() {

        // Dados simulados para o teste, sem o email do funcionário
        $funcionario = new Funcionario();
        $funcionario->setNome("Funcionario C Editado");
        $funcionario->setCpf("12345678902"); // CPF válido
        $funcionario->setSenha("senhaSegura123");
        $funcionario->setTelefone("11987654323");
        $funcionario->setTipoConta("funcionario");
        $funcionario->setEstado("BA");
        $funcionario->setCidade("Salvador");
        $funcionario->setBairro("Centro");
        $funcionario->setLogradouro("Rua C, 789");
        $funcionario->setCep("12345678");
        $funcionario->setNumeroEndereco(789);

        // Executar o método de edição de funcionário com array associativo, faltando o email
        $edicaoRealizada = $this->crudFuncionario->editarFuncionario(7, [
            'nome' => $funcionario->getNome(),
            'cpf' => $funcionario->getCpf(),
            'senha' => $funcionario->getSenha(),
            'telefone' => $funcionario->getTelefone(),
            'tipoConta' => $funcionario->getTipoConta(),
            'estado' => $funcionario->getEstado(),
            'cidade' => $funcionario->getCidade(),
            'bairro' => $funcionario->getBairro(),
            'logradouro' => $funcionario->getLogradouro(),
            'cep' => $funcionario->getCep(),
            'numeroEndereco' => $funcionario->getNumeroEndereco()
            // Sem o email do funcionário
        ]);

        // Verificar se a edição foi rejeitada (retornado false)
        $this->assertFalse($edicaoRealizada, "Edição de funcionário com dados obrigatórios faltando foi aceita.");

    }

}
