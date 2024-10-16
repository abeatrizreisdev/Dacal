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
    $sessao = new Sessao();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        $cpf = $_POST['cnpj'];
        $senha = $_POST['senha'];
        $resultadoAutenticacao = $crudCliente->autenticarCliente($cpf, $senha);
    
        if ($resultadoAutenticacao === null) {

            $sessao->setChaveEValorSessao('erro', 'Login ou senha inválida.');
            header("Location: ../login.php");
            exit();
            
        } else {

            // Instanciando o cliente que fez a autenticação.
            $clienteAutenticado = new Cliente(); 
    
            // Inserindo as informações do cliente retiradas do banco de dados.
            $clienteAutenticado->setIdCliente($resultadoAutenticacao['idCliente']);
            $clienteAutenticado->setNome($resultadoAutenticacao['nomeEmpresa']);
            $clienteAutenticado->setEmail($resultadoAutenticacao['email']);
            $clienteAutenticado->setSenha($resultadoAutenticacao['senha']);
            $clienteAutenticado->setTelefone($resultadoAutenticacao['telefone']);
            $clienteAutenticado->setCnpj($resultadoAutenticacao['cnpj']);
            $clienteAutenticado->setRazaoSocial($resultadoAutenticacao['razaoSocial']);
            $clienteAutenticado->setInscricaoEstadual($resultadoAutenticacao['inscricaoEstadual']);
            $clienteAutenticado->setEstado($resultadoAutenticacao['estado']);
            $clienteAutenticado->setMunicipio($resultadoAutenticacao['municipio']);
            $clienteAutenticado->setBairro($resultadoAutenticacao['bairro']);
            $clienteAutenticado->setLogradouro($resultadoAutenticacao['logradouro']);
            $clienteAutenticado->setCep($resultadoAutenticacao['cep']);
            $clienteAutenticado->setNumeroEndereco($resultadoAutenticacao['numeroEndereco']);
    
            // Passando os dados do cliente autenticado para criar sua sessão no site.
            $sessao->setChaveEValorSessao('idCliente', $clienteAutenticado->getId());
            $sessao->setChaveEValorSessao('nome', $clienteAutenticado->getNome());
            $sessao->setChaveEValorSessao('email', $clienteAutenticado->getEmail());
            $sessao->setChaveEValorSessao('senha', $clienteAutenticado->getSenha());
            $sessao->setChaveEValorSessao('razaoSocial', $clienteAutenticado->getRazaoSocial());
            $sessao->setChaveEValorSessao('cnpj', $clienteAutenticado->getCnpj());
            $sessao->setChaveEValorSessao('inscricaoEstadual', $clienteAutenticado->getInscricaoEstadual());
            $sessao->setChaveEValorSessao('telefone', $clienteAutenticado->getTelefone());
            $sessao->setChaveEValorSessao('estado', $clienteAutenticado->getEstado());
            $sessao->setChaveEValorSessao('municipio', $clienteAutenticado->getMunicipio());
            $sessao->setChaveEValorSessao('bairro', $clienteAutenticado->getBairro());
            $sessao->setChaveEValorSessao('cep', $clienteAutenticado->getCep());
            $sessao->setChaveEValorSessao('logradouro', $clienteAutenticado->getLogradouro());
            $sessao->setChaveEValorSessao('numeroEndereco', $clienteAutenticado->getNumeroEndereco());
    
            header("Location: ../homeEmpresa.php");
            exit();
        }
    }
    
    

?>