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

    $sessaoAtiva = new Sessao(); 
        
    $tipoConta = $sessaoAtiva->getValorSessao('tipoConta');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $idCliente = $_POST['idClienteEmail'];
        $novoEmail = $_POST['email'];

        try {

            $resultadoEdicao = $crudCliente->editarEmailCliente($idCliente, $novoEmail);

            switch ($resultadoEdicao) {
    
                case true :
    
                    if ($tipoConta == "admin") {
    
                        header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaCliente=sucesso");
                        exit();
    
                    } else {
                        
                        $sessaoAtiva->setChaveEValorSessao('email', $novoEmail);
                        header("Location: ../homeEmpresa.php?statusEdicaoContaCliente=sucesso");
                        exit();
    
                    }
                    
    
                case false :
    
                    if ($tipoConta == "admin") {
                        
                        header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaCliente=erro");
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

        echo "Método de requisição inválido.";

    }

?>