<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudFuncionario.php";
    require "../../sessao/sessao.php";
    require "../../entidades/funcionario.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Pegando os valores dos campos de entradas do formulário de cadastro de cliente e atribuindo-os as suas variáveis.
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
        $cidade = $_POST['cidade'];
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
            $cadastroRealizado = $crudFuncionario->cadastrarFuncionario(['nome' => $funcionario->getNome(), 'email' => $funcionario->getEmail(), 'senha' => $funcionario->getSenha(), 'telefone' => $funcionario->getTelefone(), 'tipoConta' => $funcionario->getTipoConta(), 'cpf' => $funcionario->getCpf(), 'estado' => $funcionario->getEstado(), 'cidade' => $funcionario->getCidade(), 'bairro' => $funcionario->getBairro(), 'logradouro' => $funcionario->getLogradouro(), 'cep' => $funcionario->getCep()]);

            // Se o cadastro foi efetuado com sucesso, então entrará nessa condicional pois será retornado true.
            if ($cadastroRealizado) {

                // Vai direcionar o usuário para a página de login.
                header("Location: .../homeFuncionario.php");
                exit();

            } 

        } catch(Exception $excecao) {

            echo "Erro ao cadastrar o funcionário: " . $excecao->getMessage();

        }

    } else {

        echo 'Requisição inválida.';

    }

?>
