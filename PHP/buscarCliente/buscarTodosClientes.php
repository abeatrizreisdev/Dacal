<?php
    ini_set('display_errors', 0); // Desativar exibição de erros em produção
    require "../conexaoBD/conexaoBD.php";
    require "../conexaoBD/configBanco.php";
    require "../crud/crudCliente.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    try {

        $crudCliente = new CrudCliente($conexao);
        
        header('Content-Type: application/json'); // Garante que o cabeçalho seja sempre definido antes do output.

        $resultadoConsulta = $crudCliente->buscarInfoTodosClientes();

        if ($resultadoConsulta != null) {

            echo json_encode($resultadoConsulta);

        } else {

            echo json_encode(['mensagem' => 'Nenhuma empresa encontrada.']);

        }

    } catch (Exception $excecao) {

        echo json_encode(['erro' => 'Erro na busca por empresas cadastradas: ' . $excecao->getMessage()]);

    }

?>