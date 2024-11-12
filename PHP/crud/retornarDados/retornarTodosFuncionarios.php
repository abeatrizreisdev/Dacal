<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudFuncionario.php";
    require "../../sessao/sessao.php";
    require "../../entidades/funcionario.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);

    $funcionariosEncontrados = $crudFuncionario->buscarInfoTodosFuncionarios();

    try {
        
        $funcionariosEncontrados = $crudFuncionario->buscarInfoTodosFuncionarios();
    
        // Retorna os dados em formato JSON para o front.
        header('Content-Type: application/json');
        echo json_encode($funcionariosEncontrados);

    } catch (PDOException $excecao) {

        echo json_encode(['error' => 'Erro ao buscar funcionários: ' . $excecao->getMessage()]);

    }
    

?>
