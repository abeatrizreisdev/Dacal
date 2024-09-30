<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../entidades/funcionario.php";
    require "../sessao/sessao.php";

    $conexao = new ConexaoBD();
    $conexao->setEschemaBD("dacal");
    $conexao->setHostBD("localhost");
    $conexao->setPortaBD(3306);
    $conexao->setEschemaBD("dacal");
    $conexao->setSenhaBD("96029958va");
    $conexao->setUsuarioBD("root");
    $conexao->getConexao(); // Iniciando a conexão com o banco.


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $crudFuncionario = new CrudFuncionario($conexao);

        $crudFuncionario->autenticarUsuario($cpf, $senha);

        $resultadoAutenticacao = $crudFuncionario->autenticarUsuario($cpf, $senha);

        switch ($resultadoAutenticacao) {

            case null :

                return null;

            default :

                $sessao = new Sessao();

                // Instanciando um funcionário.
                $funcionarioAutenticado = new Funcionario();

                // Inserindo as informações do funcionário retiradas do banco de dados.
                $funcionarioAutenticado->setId($resultadoAutenticacao['id']);
                $funcionarioAutenticado->setNome($resultadoAutenticacao['nome']);
                $funcionarioAutenticado->setEmail($resultadoAutenticacao['email']);
                $funcionarioAutenticado->setSenha($resultadoAutenticacao['senha']);
                $funcionarioAutenticado->setTelefone($resultadoAutenticacao['senha']);
                $funcionarioAutenticado->setTipoConta($resultadoAutenticacao['tipoConta']);
                $funcionarioAutenticado->setCpf($resultadoAutenticacao['cpf']);
                $funcionarioAutenticado->setEstado(($resultadoAutenticacao['estado']));
                $funcionarioAutenticado->setCidade(($resultadoAutenticacao['cidade']));
                $funcionarioAutenticado->setBairro($resultadoAutenticacao['bairro']);
                $funcionarioAutenticado->setLogradouro(($resultadoAutenticacao['logradouro']));
                $funcionarioAutenticado->setCep(($resultadoAutenticacao['cep']));

                // Passando os dados do funcionário autenticado para criar sua sessão no site.
                $sessao->setChaveEValorSessao('id', $funcionarioAutenticado->getId());
                $sessao->setChaveEValorSessao('nome', $funcionarioAutenticado->getNome());

                header("Location: ../homeFuncionario.php");

                exit();

            }

    }  

?>