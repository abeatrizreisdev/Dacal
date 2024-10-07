<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudFuncionario.php";
    require "../../sessao/sessao.php";
    require "../../entidades/funcionario.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: "localhost");
    $conexao->setPortaBD(porta: 3306);
    $conexao->setEschemaBD(eschema: "dacal");
    $conexao->setSenhaBD(senha: "96029958va");
    $conexao->setUsuarioBD(user: "root");
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);

    try {
        
        if (isset($_GET['cpf'])) {

            $cpf = $_GET['cpf'];
            
            $funcionarioEncontrado = $crudFuncionario->buscarFuncionarioPeloCpf($cpf);
            
            if ($funcionarioEncontrado != null) {

                // Retorna os dados em formato JSON para o front.
                header('Content-Type: application/json');
                echo json_encode($funcionarioEncontrado);

            } else {

                echo json_encode(['error' => 'Funcionário com CPF ' . $cpf . ' não encontrado.']);

            }
            

        }
        

    } catch (PDOException $pdoExcecao) {
        echo json_encode(['error' => 'Erro de banco de dados: ' . $$pdoExcecao->getMessage()]);
    } catch (Exception $excecao) {
        echo json_encode(['error' => 'Erro inesperado: ' . $excecao->getMessage()]);
    }
    

?>
