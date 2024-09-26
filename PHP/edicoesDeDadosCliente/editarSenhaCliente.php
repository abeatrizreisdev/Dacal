<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../entidades/cliente.php";
    require "../sessao/sessao.php";

    $conexao = new ConexaoBD();
    $conexao->setEschemaBD("dacal");
    $conexao->setHostBD("localhost");
    $conexao->setPortaBD(3306);
    $conexao->setEschemaBD("dacal");
    $conexao->setSenhaBD("96029958va");
    $conexao->setUsuarioBD("root");
    $conexao->getConexao();

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