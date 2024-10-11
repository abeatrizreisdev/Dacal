<?php
    require '../conexaoBD/conexaoBD.php'; 
    require "../crud/crudOrcamento.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudOrcamento = new CrudOrcamento($conexao);


    try {

        header('Content-Type: application/json');

        if (isset($_GET['numeroOrcamento'])) {

            $numeroOrcamento = $_GET['numeroOrcamento'];
            $orcamento = $crudOrcamento->buscarInfoOrcamento($numeroOrcamento);
    
            if ($orcamento) {

                echo json_encode($orcamento);

            } else {

                echo json_encode(['mensagem' => 'Nenhum orçamento encontrado.']);
            
            }

        } else {

           
            echo json_encode(['erro' => 'Número do orçamento não fornecido.']);
        }

    } catch (Exception $excecao) {
        
        echo json_encode(['erro' => 'Erro na busca por orçamentos cadastrados: ' . $excecao->getMessage()]);
        
    }


?>
