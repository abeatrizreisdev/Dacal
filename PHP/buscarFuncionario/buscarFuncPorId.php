<?php

    ini_set('display_errors', 0); // Desativar exibição de erros em produção

    require "../conexaoBD/conexaoBD.php";
    require "../conexaoBD/configBanco.php";
    require "../crud/crudFuncionario.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    try {
        
        $crudFuncionario = new CrudFuncionario($conexao);

        header('Content-Type: application/json'); // Garante que o cabeçalho seja sempre definido antes do output.

        if (isset($_GET['idFuncionario'])) {

            $idFuncionario = $_GET['idFuncionario'];

            $resultadoConsulta = $crudFuncionario->buscarInfoFuncionario($idFuncionario);

            if ($resultadoConsulta != null) {

                echo json_encode($resultadoConsulta);

            } else {

                echo json_encode(['mensagem' => 'Nenhum funcionario encontrado.']);

            }

        } else {

            echo json_encode(['erro' => 'Parâmetro idFuncionario não fornecido.']);

        }

    } catch (Exception $excecao) {

        echo json_encode(['erro' => 'Erro na busca por funcionário cadastrado: ' . $excecao->getMessage()]);
        
    }
