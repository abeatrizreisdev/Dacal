<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudCliente.php";
    require "../../sessao/sessao.php";
    require "../../entidades/cliente.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Pegando os valores dos campos de entradas do formulário de cadastro de cliente e atribuindo-os as suas variáveis.
        $nome = $_POST['nome'];
        $razaoSocial = $_POST['razaoSocial'];
        $cnpj = $_POST['cnpj'];
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

        try {

            // Instanciando o objeto que representa o cliente e passando os valores recebidos do formulário de cadastro...
            // para o objeto do tipo cliente.
            $cliente = new Cliente();
            $cliente->setNome($nome);
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
            $cadastroRealizado = $crudCliente->cadastrarCliente(['nomeEmpresa' => $cliente->getNome(), 'razaoSocial' => $cliente->getRazaoSocial(), 'cnpj' => $cliente->getCnpj(), 'inscricaoEstadual' => $cliente->getInscricaoEstadual(), 'telefone' => $cliente->getTelefone(), 'email' => $cliente->getEmail(), 'senha' => $cliente->getEmail(), 'logradouro' => $cliente->getLogradouro(), 'bairro' => $cliente->getBairro(), 'cep' => $cliente->getCep(), 'estado' => $cliente->getEstado(), 'municipio' => $cliente->getMunicipio(), 'numeroEndereco' => $cliente->getNumeroEndereco()]);

            // Se o cadastro foi efetuado com sucesso, então entrará nessa condicional pois será retornado true.
            if ($cadastroRealizado) {

                // Vai direcionar o usuário para a página de login.
                header("Location: .../login.php");
                exit();

            } 

        } catch(Exception $excecao) {

            echo "Erro ao cadastrar o cliente: " . $excecao->getMessage();

        }

    } else {

        echo 'Requisição inválida.';

    }

?>