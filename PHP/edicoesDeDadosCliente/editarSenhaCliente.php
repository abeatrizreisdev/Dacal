<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../entidades/cliente.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);

    $sessaoAtiva = new Sessao(); 
        
    $tipoConta = $sessaoAtiva->getValorSessao('tipoConta');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $idCliente = $_POST['idClienteSenha'];
        $novaSenha = $_POST['senha'];

        try {

            $resultadoEdicao = $crudCliente->editarSenhaCliente($idCliente, $novaSenha);

            switch ($resultadoEdicao) {
    
                case true :
    
                    if ($tipoConta == "admin") {
    
                        header("Location: ../gerenciarContas.php?statusEdicaoContaCliente=sucesso");
                        exit();
    
                    } else {
                        
                        $sessaoAtiva->setChaveEValorSessao('senha', $novaSenha);
                        header("Location: ../homeEmpresa.php?statusEdicaoContaCliente=sucesso");
                        exit();
    
                    }
                    
    
                case false :
    
                    if ($tipoConta == "admin") {
                        
                        header("Location: ../gerenciarContas.php?statusEdicaoContaCliente=erro");
                        exit();
    
                    } else {
    
                        header("Location: ../perfilEmpresa.php?statusEdicaoContaCliente=erro");
                        exit();
    
                    }
    
            }


        } catch(Exception $excecao) {


            echo "Erro ao editar o cliente: " . $excecao->getMessage();

        }

    } else {

        

    }

?>