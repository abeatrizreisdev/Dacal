<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../entidades/cliente.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $novaSenha = $_POST['senha'];

        $sessaoCliente = new Sessao(); 
        
        $resultadoEdicao = $crudCliente->editarSenhaCliente($sessaoCliente->getValorSessao('idCliente'), $novaSenha);

        switch ($resultadoEdicao) {

            case true :

                header("Location: ../homeEmpresa.php");
                exit();

            case false :

                header("Location: ../perfilEmpresa.php");
                exit();

        }

    }

?>