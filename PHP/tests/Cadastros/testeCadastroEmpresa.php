<?php

    use PHPUnit\Framework\TestCase;

    require_once "./PHP/conexaoBD/conexaoBD.php";
    require_once "./PHP/conexaoBD/configBanco.php";
    require_once "./PHP/crud/crudCliente.php";
    require_once "./PHP/entidades/cliente.php";

    class TesteCadastroEmpresa extends TestCase {

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

        // Teste de cadastro de cliente válido.
        public function testCadastroClienteValido() {

            // Dados simulados para o teste.
            $cliente = new Cliente();
            $cliente->setNome("Empresa Tal");
            $cliente->setRazaoSocial("Empresa Tal Ltda");
            $cliente->setCnpj("12345678000195");
            $cliente->setSenha("12345678");
            $cliente->setInscricaoEstadual("123456789");
            $cliente->setTelefone("11987654321");
            $cliente->setEmail("contato@empresaTal.com.br");
            $cliente->setLogradouro("Rua A");
            $cliente->setBairro("Centro");
            $cliente->setCep("12345678");
            $cliente->setEstado("BA");
            $cliente->setMunicipio("Catu");
            $cliente->setNumeroEndereco("123");

            // Executar o método de cadastro de cliente com array associativo.
            $cadastroRealizado = $this->crudCliente->cadastrarCliente([ 
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

            // Verifica se o cadastro foi realizado com sucesso.
            $this->assertTrue($cadastroRealizado, "Falha ao cadastrar o cliente.");

        }

        // Teste de cadastro de cliente com CNPJ inválido.
        public function testCadastroClienteCnpjInvalido() {

            // Dados simulados para o teste.
            $cliente = new Cliente();
            $cliente->setNome("Empresa Y");
            $cliente->setRazaoSocial("Empresa Y Ltda");
            $cliente->setCnpj("00000000000000"); // CNPJ inválido
            $cliente->setSenha("12345678");
            $cliente->setInscricaoEstadual("123456789");
            $cliente->setTelefone("11987654321");
            $cliente->setEmail("contato@empresay.com.br");
            $cliente->setLogradouro("Rua B");
            $cliente->setBairro("Centro");
            $cliente->setCep("12345678");
            $cliente->setEstado("SP");
            $cliente->setMunicipio("São Paulo");
            $cliente->setNumeroEndereco("124");

            // Executa o método de cadastro de cliente com array associativo 
            $cadastroRealizado = $this->crudCliente->cadastrarCliente([ 
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


            // Verifica se o cadastro foi rejeitado (retornado false).
            $this->assertFalse($cadastroRealizado, "Cadastro de cliente com CNPJ inválido foi aceito.");

        }

        // Teste de cadastro de cliente com dados obrigatórios faltando.
        public function testCadastroClienteDadosIncompletos() { 

            // Dados simulados para o teste. 
            $cliente = new Cliente(); 

            try { 

                $cliente->setNome("Empresa Z"); 
                $cliente->setRazaoSocial(""); // Razão Social faltando. 
                $cliente->setCnpj("12345678000196"); 
                $cliente->setSenha("12345678"); 
                $cliente->setInscricaoEstadual("123456789"); 
                $cliente->setTelefone(""); // Telefone faltando. 
                $cliente->setEmail(""); // Email faltando.
                $cliente->setLogradouro("Rua C"); 
                $cliente->setBairro("Centro"); 
                $cliente->setCep("12345678"); 
                $cliente->setEstado("BA"); 
                $cliente->setMunicipio("Catu"); 
                $cliente->setNumeroEndereco("125"); 

                // Se chegar até aqui, a razão social vazia foi aceita, o que é um erro. 
                $this->fail("Exceção esperada não foi lançada."); 

            } catch (Exception $excecao) { 

                $this->assertEquals("Erro. A razão social não pode ser vazia.", $excecao->getMessage()); 

            };

        }

    }
