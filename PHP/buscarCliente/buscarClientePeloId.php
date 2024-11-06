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

    if (isset($_GET['idCliente'])) {

        $idCliente = $_GET['idCliente'];

        $resultadoConsulta = $crudCliente->buscarInfoCliente($idCliente);

        if ($resultadoConsulta != null) {

            echo json_encode($resultadoConsulta);

        } else {

            echo json_encode(['mensagem' => 'Nenhum cliente encontrado.']);

        }

    } else {

        echo json_encode(['erro' => 'Parâmetro idCliente não fornecido.']);

    }

} catch (Exception $excecao) {

    echo json_encode(['erro' => 'Erro na busca por clientes cadastrados: ' . $excecao->getMessage()]);
    
}
?>
