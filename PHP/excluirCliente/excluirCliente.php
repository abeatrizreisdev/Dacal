<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudCliente($conexao);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $idCliente = $_POST['idCliente'];
        
        $resultadoExclusao = $crudCliente->excluirCliente($idCliente);

        if ($resultadoExclusao > 0) {

            echo json_encode(['status' => 'success', 'message' => 'Conta excluída com sucesso.']);

        } else {

            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir a conta.']);

        }


    } else {

        echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        
    }

?>