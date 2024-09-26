<?php 

    require "/xampp/htdocs/Dacal/PHP/conexaoBD/conexaoBD.php";
    require "/xampp/htdocs/Dacal/PHP/crud/crudCliente.php";
    require "/xampp/htdocs/Dacal/PHP/entidades/cliente.php";

    $conexao = new ConexaoBD();
    $conexao->setEschemaBD("dacal");
    $conexao->setHostBD("localhost");
    $conexao->setPortaBD(3306);
    $conexao->setEschemaBD("dacal");
    $conexao->setSenhaBD("96029958va");
    $conexao->setUsuarioBD("root");
    $conexao->getConexao();
    
    $crudCliente = new CrudCliente($conexao);
    
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cpf = $_POST['cnpj'];
        $senha = $_POST['senha'];

        $resultadoAutenticacao = $crudCliente->autenticarCliente($cpf, $senha);

        switch ($resultadoAutenticacao) {

            case null :
    
                return "Nenhum Cliente encontrado com este cnpj e senha informada.";
    
            default :
    
                // Instanciando o cliente que fez a autenticação.
                $clienteAutenticado = new Cliente();
    
                // Inserindo as informações do funcionário retiradas do banco de dados.
                $clienteAutenticado->setIdCliente($resultadoAutenticacao['idCliente']);
                $clienteAutenticado->setNome($resultadoAutenticacao['nomeEmpresa']);
                $clienteAutenticado->setEmail($resultadoAutenticacao['email']);
                $clienteAutenticado->setSenha($resultadoAutenticacao['senha']);
                $clienteAutenticado->setTelefone($resultadoAutenticacao['telefone']);
                // $funcionarioAutenticado->setTipoConta($resultadoAutenticaca['tipoConta']);
                $clienteAutenticado->setCnpj($resultadoAutenticacao['cnpj']);
                $clienteAutenticado->setRazaoSocial($resultadoAutenticacao['razaoSocial']);
                $clienteAutenticado->setInscricaoEstadual($resultadoAutenticacao['inscricaoEstadual']);
                $clienteAutenticado->setEstado($resultadoAutenticacao['estado']);
                $clienteAutenticado->setMunicipio($resultadoAutenticacao['municipio']);
                $clienteAutenticado->setBairro($resultadoAutenticacao['bairro']);
                $clienteAutenticado->setLogradouro($resultadoAutenticacao['logradouro']);
                $clienteAutenticado->setCep($resultadoAutenticacao['cep']);
                $clienteAutenticado->setNumeroEndereco($resultadoAutenticacao['numeroEndereco']);
    
    
                // Passando os dados do funcionário autenticado para criar sua sessão no site.
                $_SESSION['idCliente'] = $clienteAutenticado->getId();
                $_SESSION['nomeEmpresa'] = $clienteAutenticado->getNome();
                $_SESSION['razaoSocial'] = $clienteAutenticado->getRazaoSocial();
                $_SESSION['cnpj'] = $clienteAutenticado->getCnpj();
                $_SESSION['inscricaoEstadual'] = $clienteAutenticado->getInscricaoEstadual();
    
                header("Location: ../homeEmpresa.php");

                exit();
            
        }

    }
    

?>