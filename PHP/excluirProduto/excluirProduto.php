<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudProduto.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudProduto = new CrudProduto($conexao);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $idProduto = $_POST['idProduto'];
        
        $resultadoExclusao = $crudProduto->excluirProduto($idProduto);

        if ($resultadoExclusao > 0) {

            echo json_encode(['status' => 'success', 'message' => 'Produto excluído com sucesso.']);

        } else {

            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir o produto.']);

        }


    } else {

        echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        
    }

?>