<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../entidades/funcionario.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudFuncionario = new CrudFuncionario($conexao);

    $sessao = new Sessao();

    $tipoContaTrocarSenha = $sessao->getValorSessao('tipoConta');


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $id = $_POST['idOcultoFunc'];
        $senha = $_POST['senha'];
     
        $funcionario = new Funcionario();
    
        $funcionario->setId($id);
        $funcionario->setSenha($senha);        
        
        $resultadoEdicao = $crudFuncionario->editarFuncionario($funcionario->getId(), 
        ['senha' => $funcionario->getSenha()]);

        switch ($resultadoEdicao) {

            case true :
                
                
                if ($tipoContaTrocarSenha == 'admin' ) {

                    header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaFuncionario=sucesso");
                    exit();

                } elseif ($tipoContaTrocarSenha == 'funcionario') {

                    header("Location: ../homeFuncionario.php?statusEdicaoContaFuncionario=sucesso");
                    exit();
                    
                } 
                    

            case false :

                
                if ($tipoContaTrocarSenha == 'admin' ) {

                    header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaFuncionario=erro");
                    exit();

                } elseif ($tipoContaTrocarSenha == 'funcionario'){

                    header("Location: ../HomeFuncionario.php?statusEdicaoContaFuncionario=erro");
                    exit();

                } 

        }

    } 
  
?>