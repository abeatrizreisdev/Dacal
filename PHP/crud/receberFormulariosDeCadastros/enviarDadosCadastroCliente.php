<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudCliente.php";
    require "../../sessao/sessao.php";
    require "../../entidades/cliente.php";
    require "../../conexaoBD/configBanco.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);


    function validarCNPJ($cnpj) {

        // Remove caracteres não numéricos do CNPJ
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    
        // Verifica se o CNPJ tem 14 dígitos
        if (strlen($cnpj) != 14) {
            return false;
        }
    
        // Verifica se todos os dígitos são iguais.
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
    
        $tamanhoSemDigitos = strlen($cnpj) - 2;
        $numerosBase = substr($cnpj, 0, $tamanhoSemDigitos);
        $digitosVerificadores = substr($cnpj, $tamanhoSemDigitos);
    
        $soma = 0;
        $peso = $tamanhoSemDigitos - 7;

        for ($indice = $tamanhoSemDigitos; $indice >= 1; $indice--) {

            $soma += $numerosBase[$tamanhoSemDigitos - $indice] * $peso--;

            if ($peso < 2) {

                $peso = 9;

            }

        }

        $digitoCalculado = $soma % 11 < 2 ? 0 : 11 - $soma % 11;
        if ($digitoCalculado != $digitosVerificadores[0]) {

            return false;

        }
    
        $tamanhoComPrimeiroDigito = $tamanhoSemDigitos + 1;
        $numerosBase = substr($cnpj, 0, $tamanhoComPrimeiroDigito);
        $soma = 0;
        $peso = $tamanhoComPrimeiroDigito - 7;
        for ($indice = $tamanhoComPrimeiroDigito; $indice >= 1; $indice--) {

            $soma += $numerosBase[$tamanhoComPrimeiroDigito - $indice] * $peso--;

            if ($peso < 2) {

                $peso = 9;

            }
            
        }

        $digitoCalculado = $soma % 11 < 2 ? 0 : 11 - $soma % 11;
        if ($digitoCalculado != $digitosVerificadores[1]) {

            return false;

        }

        return true;
        
    }
    
       

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Pegando os valores dos campos de entradas do formulário de cadastro de cliente e atribuindo-os as suas variáveis.
        $nomeFantasia = $_POST['nomeFantasia'];
        $razaoSocial = $_POST['razaoSocial'];
        $cnpj = preg_replace('/[^0-9]/', '', $_POST['cnpjEmpresa']);
        $inscricaoEstadual = $_POST['inscricaoEstadual'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $tipoConta = 'cliente';
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $numeroEndereco = $_POST['numeroEndereco'];
        
        if (!validarCNPJ($cnpj)) {
            header("Location: ../../login.php?statusCadastroCliente=erro");
            exit();
        }

        try {

            // Instanciando o objeto que representa o cliente e passando os valores recebidos do formulário de cadastro...
            // para o objeto do tipo cliente.
            $cliente = new Cliente();
            $cliente->setNome($nomeFantasia);
            $cliente->setRazaoSocial($razaoSocial);
            $cliente->setCnpj($cnpj);
            $cliente->setInscricaoEstadual($inscricaoEstadual);
            $cliente->setTelefone($telefone);
            $cliente->setEmail($email);
            $cliente->setSenha($senha);
            $cliente->setTipoConta($tipoConta);
            $cliente->setLogradouro($logradouro);
            $cliente->setBairro($bairro);
            $cliente->setCep($cep);
            $cliente->setEstado($estado);
            $cliente->setMunicipio($municipio);
            $cliente->setNumeroEndereco($numeroEndereco);

            // Enviando os dados do cliente que será cadastrado para o banco de dados.
            $cadastroRealizado = $crudCliente->cadastrarCliente(['nomeFantasia' => $cliente->getNome(), 'razaoSocial' => $cliente->getRazaoSocial(), 'cnpj' => $cliente->getCnpj(), 'inscricaoEstadual' => $cliente->getInscricaoEstadual(), 'telefone' => $cliente->getTelefone(), 'email' => $cliente->getEmail(), 'senha' => $cliente->getSenha(), 'logradouro' => $cliente->getLogradouro(), 'bairro' => $cliente->getBairro(), 'cep' => $cliente->getCep(), 'estado' => $cliente->getEstado(), 'municipio' => $cliente->getMunicipio(), 'numeroEndereco' => $cliente->getNumeroEndereco()]);

            // Se o cadastro foi efetuado com sucesso, então entrará nessa condicional pois será retornado true.
            if ($cadastroRealizado) {

                // Vai direcionar o usuário para a página de login, com status para receber a notificação de que foi feito com sucesso o cadastro.
               header("Location: ../../login.php?statusCadastroCliente=sucesso");
               exit();

               

            } else {
                
                // Vai direcionar o usuário para a página de login, com status para receber a notificação de que houve erro no cadastro.
                header("Location: ../../login.php?statusCadastroCliente=erro");
                exit();

            }

        } catch(Exception $excecao) {

            echo "Erro ao cadastrar o cliente: " . $excecao->getMessage();
            header("Location: ../../login.php?statusCadastroCliente=erro");
            exit();

        }

    } else {

        echo 'Requisição inválida.';

    }

?>
