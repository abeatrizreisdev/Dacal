<?php
    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../conexaoBD/configBanco.php";
    require "../sessao/sessao.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['idCliente'])) {

            $idCliente = $_POST['idCliente'];
            $resultadoExclusao = $crudCliente->excluirCliente($idCliente);
    
            if ($resultadoExclusao > 0) {
    
                echo json_encode(['status' => 'success', 'message' => 'Conta excluída com sucesso.']);
    
            } else {
    
                echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir a conta.']);
                
            };

        } else {

            echo json_encode(['status' => 'error', 'message' => 'ID do cliente não fornecido.']);

        };

       
    } else {

        echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);

    };

