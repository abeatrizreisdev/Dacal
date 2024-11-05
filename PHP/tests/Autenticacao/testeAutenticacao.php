<?php

    use PHPUnit\Framework\TestCase;

    require_once "./PHP/conexaoBD/conexaoBD.php";
    require_once "./PHP/conexaoBD/configBanco.php";
    require_once "./PHP/crud/crudCliente.php";
    require_once "./PHP/crud/crudFuncionario.php";


    class TesteAutenticacao extends TestCase {

        private $conexao;
        private $crudCliente;
        private $crudFuncionario;
        private $cpf;
        private $cnpj;
        private $senha;

        // Método de configuração da classe de teste.
        protected function setUp(): void
        {

            $this->conexao = new ConexaoBD(); 
            $this->conexao->setHostBD(BD_HOST); 
            $this->conexao->setPortaBD(BD_PORTA); 
            $this->conexao->setEschemaBD(BD_ESCHEMA); 
            $this->conexao->setSenhaBD(BD_PASSWORD); 
            $this->conexao->setUsuarioBD(BD_USERNAME); $this->conexao->getConexao(); // Iniciando a conexão com o banco. 

            if (!$this->conexao->getConexao()) {
                throw new Exception("Conexão com o banco de dados falhou."); 
            } 

            $this->crudCliente = new CrudCliente($this->conexao);

            $this->crudFuncionario = new CrudFuncionario($this->conexao);

        }

        // Teste para verificar autenticação de Empresa com cnpj e senha válidos.
        public function testLoginEmpresaValido(){

            // Cnpj e senha válidos.
            $this->cnpj = '12345678000195';
            $this->senha = '12345678';
            
            $resultado = $this->crudCliente->autenticarCliente($this->cnpj, $this->senha);
            
            // Verificando se o resultado retornado é um vetor com os dados da empresa que foi autenticada.
            // Quando o cnpj e senha são validas.
            $this->assertIsArray($resultado, "Autenticação não retornou um vetor com os dados da Empresa autenticada.");
            
        }

        // Teste para verificar autenticação de Empresa com cnpj inválido e senha válida.
        public function testLoginEmpresaCnpjInvalido(){

            // Cnpj inválido e senha válida.
            $this->cnpj = '000000000000';
            $this->senha = '12345678';
            
            $resultado = $this->crudCliente->autenticarCliente($this->cnpj, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cnpj inválido e uma senha válida e o valor retornado é nulo, login inválido.
            $this->assertNull($resultado, "Empresa com cnpj inválido foi autenticada.");

        }

        // Teste para verificar autenticação de Empresa com cnpj e senha inválida.
        public function testLoginEmpresaCnpjSenhaInvalidos(){

            // Cnpj inválido e senha inválida.
            $this->cnpj = '000000000000';
            $this->senha = '000000000';
            
            $resultado = $this->crudCliente->autenticarCliente($this->cnpj, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cnpj inválido e uma senha válida e o valor retornado é nulo, login inválido.
            $this->assertNull($resultado, "Empresa com cnpj e senha inválidas foi autenticada.");

        }

        // Teste para verificar autenticação de Empresa com cnpj válido e senha inválida.
        public function testLoginEmpresaSenhaInvalida(){

            // Cnpj válido e senha inválida.
            $this->cnpj = '12345678000195';
            $this->senha = '12345';
            
            $resultado = $this->crudCliente->autenticarCliente($this->cnpj, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cnpj válido e uma senha inválida.
            $this->assertNull($resultado, "Empresa com senha inválida foi autenticada.");

        }
        

        // Teste para verificar autenticação de Funcionário com cpf e senha válidos.
        public function testLoginFuncionarioValido(){

            // Cpf e senha válidos.
            $this->cpf = '01234567890';
            $this->senha = '1234567';
            
            $resultado = $this->crudFuncionario->autenticarUsuario($this->cpf, $this->senha);
            
            // Verificando se o resultado retornado é um vetor com os dados do funcionário que foi autenticado.
            // Quando o cpf e senha são validas.
            $this->assertIsArray($resultado, "Autenticação não retornou um vetor com os dados do funcionário autenticado.");
            
        }

        // Teste para verificar autenticação de Funcionário com cpf inválido e senha válida.
        public function testLoginFuncionarioCpfInvalido(){

            // Cpf inválido e senha válida.
            $this->cpf = '0000000000000';
            $this->senha = '1234567';
            
            $resultado = $this->crudFuncionario->autenticarUsuario($this->cpf, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cpf inválido e uma senha válida.
            $this->assertNull($resultado, "Funcionário com cpf inválido foi autenticado.");

        }

        // Teste para verificar autenticação de Funcionário com cpf válido e senha inválida.
        public function testLoginFuncionarioSenhaInvalida(){

            // Cpf válido e senha inválida.
            $this->cpf = '01234567890';
            $this->senha = '12345';
            
            $resultado = $this->crudFuncionario->autenticarUsuario($this->cpf, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cpf válido e uma senha inválida.
            $this->assertNull($resultado, "Funcionário com senha inválida foi autenticado.");

        }

        // Teste para verificar autenticação de Funcionário com cpf válido e senha inválida.
        public function testLoginFuncionarioCPFeSenhaInvalidos(){

            // Cpf inválido e senha inválida.
            $this->cpf = '000000000000';
            $this->senha = '1234567890';
            
            $resultado = $this->crudFuncionario->autenticarUsuario($this->cpf, $this->senha);

            // Vericando se o resultado retornado da tentativa de autenticação é null, ou seja...
            // Foi inserido um cpf válido e uma senha inválida.
            $this->assertNull($resultado, "Funcionário com cpf e senha inválidos foi autenticado.");

        }


    }
