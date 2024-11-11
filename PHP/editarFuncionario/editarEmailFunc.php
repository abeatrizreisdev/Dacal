<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../entidades/funcionario.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);
    $sessao = new Sessao();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $id = $_POST['idEmail'];
        $email = $_POST['email'];

        $funcionario = new Funcionario();
        $funcionario->setId($id);
        $funcionario->setEmail($email); 

        $resultadoEdicao = $crudFuncionario->editarEmailUsuario($funcionario->getId(), $funcionario->getEmail());

        if ($resultadoEdicao) {

            header('Content-Type: application/json');
            echo json_encode(['status' => 'sucesso']);

        } else {

            header('Content-Type: application/json');
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ocorreu um erro ao editar o email do funcionário. Verifique os dados fornecidos e tente novamente.']);

        }

    } else {

        header('Content-Type: application/json');
        echo json_encode(['status' => 'erro', 'mensagem' => 'Requisição inválida.']);
        
    }

