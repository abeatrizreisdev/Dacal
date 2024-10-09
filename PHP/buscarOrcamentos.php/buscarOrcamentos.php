<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../conexaoBD/configBanco.php";
    require "../crud/crudOrcamento.php";
    require "../entidades/orcamento.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudOrcamento = new CrudOrcamento($conexao);

    $orcamentos = $crudOrcamento->buscarTodosOrcamentos();

    if ($orcamentos) {

        // Retorna os orçamentos em formato JSON para o front.
        header('Content-Type: application/json');

        echo json_encode($orcamentos);

        header("Location: ../homeFuncionario.php");

        exit();

    } else {

        echo json_encode(['mensagem' => 'Nenhum orcamento encontrado']);

        header("Location: ../homeFuncionario.php");

        exit();

    };


    

    

?>
