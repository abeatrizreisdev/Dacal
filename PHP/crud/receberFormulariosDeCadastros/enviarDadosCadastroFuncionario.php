<?php
    require "../../conexaoBD/conexaoBD.php";
    require "../crudFuncionario.php";
    require "../../sessao/sessao.php";
    require "../../entidades/funcionario.php";
    require "../../conexaoBD/configBanco.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.
    $crudFuncionario = new CrudFuncionario($conexao);

    header('Content-Type: application/json'); // Define o cabeçalho JSON

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Pegando os valores dos campos de entradas do formulário de cadastro de cliente e atribuindo-os às suas variáveis.
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $tipoConta = 'funcionario';
        $cpf = $_POST['cpf'];
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $estado = $_POST['estado'];
        $cidade = $_POST['municipio'];
        $numeroEndereco = $_POST['numeroEndereco'];

        try {

            // Instanciando o objeto que representa o funcionário e passando os valores recebidos do formulário de cadastro...
            // para o objeto do tipo Funcionário.
            $funcionario = new Funcionario();
            $funcionario->setNome($nome);
            $funcionario->setTelefone($telefone);
            $funcionario->setEmail($email);
            $funcionario->setSenha($senha);
            $funcionario->setCpf($cpf);
            $funcionario->setTipoConta($tipoConta);
            $funcionario->setLogradouro($logradouro);
            $funcionario->setBairro($bairro);
            $funcionario->setCep($cep);
            $funcionario->setEstado($estado);
            $funcionario->setCidade($cidade);
            $funcionario->setNumeroEndereco($numeroEndereco);

            // Enviando os dados do funcionário que serão cadastrados na tabela Pessoa no banco de dados.
            $cadastroRealizado = $crudFuncionario->cadastrarFuncionario([
                'nome' => $funcionario->getNome(),
                'email' => $funcionario->getEmail(),
                'senha' => $funcionario->getSenha(),
                'telefone' => $funcionario->getTelefone(),
                'tipoConta' => $funcionario->getTipoConta(),
                'cpf' => $funcionario->getCpf(),
                'estado' => $funcionario->getEstado(),
                'cidade' => $funcionario->getCidade(),
                'bairro' => $funcionario->getBairro(),
                'logradouro' => $funcionario->getLogradouro(),
                'cep' => $funcionario->getCep()
            ]);

            // Se o cadastro foi efetuado com sucesso, então entrará nessa condicional pois será retornado true.
            if ($cadastroRealizado) {

                echo json_encode(['sucesso' => true, 'mensagem' => 'Funcionário cadastrado com sucesso.']);

            } else {

                echo json_encode(['erro' => true, 'mensagem' => 'Erro ao cadastrar o funcionário.']);

            }

        } catch (Exception $excecao) {

            echo json_encode(['erro' => true, 'mensagem' => 'Erro ao cadastrar o funcionário: ' . $excecao->getMessage()]);

        }

    } else {

        echo json_encode(['erro' => true, 'mensagem' => 'Requisicao inválida.']);

    }
