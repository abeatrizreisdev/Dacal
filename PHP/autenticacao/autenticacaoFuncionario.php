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

    $sessao = new Sessao();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $crudFuncionario = new CrudFuncionario($conexao);

        $crudFuncionario->autenticarUsuario($cpf, $senha);

        $resultadoAutenticacao = $crudFuncionario->autenticarUsuario($cpf, $senha);

        switch ($resultadoAutenticacao) {

            case null :

                $sessao->setChaveEValorSessao( 'erro', "Login ou senha inválida.");


                header("Location: ../login.php");

                exit();

            default :

                echo "Usuário autenticado.";
                // Instanciando um funcionário.
                $funcionarioAutenticado = new Funcionario();

                // Inserindo as informações do funcionário retiradas do banco de dados.
                $funcionarioAutenticado->setId($resultadoAutenticacao['id']);
                $funcionarioAutenticado->setNome($resultadoAutenticacao['nome']);
                $funcionarioAutenticado->setTipoConta($resultadoAutenticacao['tipoConta']);
                

                // Passando os dados do funcionário autenticado para criar sua sessão no site.
                $sessao->setChaveEValorSessao('id', $funcionarioAutenticado->getId());
                $sessao->setChaveEValorSessao('nome', $funcionarioAutenticado->getNome());
                $sessao->setChaveEValorSessao('tipoConta', $funcionarioAutenticado->getTipoConta());
               
                
                $tipoConta = $funcionarioAutenticado->getTipoConta();

                if ($tipoConta == "funcionario") {

                    header("Location: ../homeFuncionario.php");

                    exit();

                } else if($tipoConta == "admin") {

                    header("Location: ../homeAdm.php");

                    exit();

                }
                

            }

    }  

?>