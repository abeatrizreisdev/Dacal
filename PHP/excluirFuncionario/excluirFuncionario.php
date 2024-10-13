<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $idFuncionario = $_POST['idFuncionario'];

        $sessaoCliente = new Sessao(); 
        
        $resultadoExclusao = $crudFuncionario->excluirFuncionario($idFuncionario);

        if ($resultadoExclusao > 0) {

            echo json_encode(['status' => 'success', 'message' => 'Conta excluída com sucesso.']);

        } else {

            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir a conta.']);

        }


    } else {

        echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        
    }

?>