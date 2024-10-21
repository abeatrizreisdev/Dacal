<?php

    ini_set('display_errors', 0); // Desativar exibição de erros em produção
    header('Content-Type: application/json'); // Defina o cabeçalho JSON

    require '../conexaoBD/conexaoBD.php'; 
    require "../crud/crudOrcamento.php";
    require "../conexaoBD/configBanco.php";

    try {
        
        $conexao = new ConexaoBD();
        $conexao->setHostBD(BD_HOST);
        $conexao->setPortaBD(BD_PORTA);
        $conexao->setEschemaBD(BD_ESCHEMA);
        $conexao->setSenhaBD(BD_PASSWORD);
        $conexao->setUsuarioBD(BD_USERNAME);
        $conexao->getConexao(); // Iniciando a conexão com o banco

        $crudOrcamento = new CrudOrcamento($conexao);

        if (isset($_POST['numeroOrcamento']) && isset($_POST['status'])) {

            $numeroOrcamento = $_POST['numeroOrcamento'];
            $status = $_POST['status'];

            $resultado = $crudOrcamento->atualizarStatusOrcamento($numeroOrcamento, $status);

            if ($resultado) {

                echo json_encode(['sucesso' => true, 'mensagem' => 'Status do orçamento atualizado com sucesso.']);


            } else {

                echo json_encode(['erro' => false, 'mensagem' => 'Erro ao atualizar status do orçamento.']);

            }
            
        } else {

            echo json_encode(['erro' => false, 'mensagem' => 'Número do orçamento ou status não fornecido.']);

        }

    } catch (Exception $excecao) {

        echo json_encode(['erro' => false, 'mensagem' => 'Erro ao atualizar status do orçamento: ' . $excecao->getMessage()]);

    }

