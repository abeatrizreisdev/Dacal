<?php 
    ini_set('display_errors', 0); // Desativar exibição de erros em produção

    require "../conexaoBD/conexaoBD.php";
    require "../conexaoBD/configBanco.php";
    require "../crud/crudOrcamento.php";
    require "../entidades/orcamento.php";

    try {

        $conexao = new ConexaoBD();
        $conexao->setHostBD(BD_HOST);
        $conexao->setPortaBD(BD_PORTA);
        $conexao->setEschemaBD(BD_ESCHEMA);
        $conexao->setSenhaBD(BD_PASSWORD);
        $conexao->setUsuarioBD(BD_USERNAME);
        $conexao->getConexao(); // Iniciando a conexão com o banco.


        if (isset($_GET['id'])) { 

            $idCliente = $_GET['id'];

            $crudOrcamento = new CrudOrcamento($conexao);

            $orcamentos = $crudOrcamento->buscarOrcamentosPorCliente($idCliente);

            header('Content-Type: application/json');
            
            if ($orcamentos) {

                echo json_encode($orcamentos);

            } else {

                echo json_encode(['mensagem' => 'Nenhum orçamento encontrado']);

            }

        }

        

    } catch (Exception $excecao) {

        header('Content-Type: application/json');
        echo json_encode(['erro' => 'Erro na busca por orçamentos cadastrados: ' . $excecao->getMessage()]);

    }

?>
