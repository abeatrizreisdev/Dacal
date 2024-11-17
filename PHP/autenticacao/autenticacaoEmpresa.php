<?php 

     // Configurações de sessão com maior segurança, salvando os dados da sessão do usuário pelo menos por um dia, caso ele não deslogue do sistema.
    // Configurações de sessão com persistência.
    session_set_cookie_params([
        'lifetime' => 86400, // Sessão ativa por 1 dia (em segundos)
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudCliente.php";
    require "../entidades/cliente.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    $sessao = new Sessao();
    
    // Verifica se o cookie de sessão existe e restaura a sessão
    if (isset($_COOKIE['usuario_sessao'])) {

        session_id($_COOKIE['usuario_sessao']);
        $sessao = new Sessao();

    };

    $conexao = new ConexaoBD();
    $conexao->setHostBD( BD_HOST);
    $conexao->setPortaBD( BD_PORTA);
    $conexao->setEschemaBD( BD_ESCHEMA);
    $conexao->setSenhaBD( BD_PASSWORD);
    $conexao->setUsuarioBD( BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudCliente = new CrudCliente($conexao);
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        $cnpj = $_POST['cnpj'];
        $senha = $_POST['senha'];
        $resultadoAutenticacao = $crudCliente->autenticarCliente($cnpj, $senha);
    
        if ($resultadoAutenticacao === null) {

            $sessao->setChaveEValorSessao('erro', 'Login ou senha inválida.');
            header("Location: ../../login.php");
            exit();
            
        } else {

            // Instanciando o cliente que fez a autenticação.
            $clienteAutenticado = new Cliente(); 
    
            // Inserindo as informações do cliente retiradas do banco de dados.
            $clienteAutenticado->setIdCliente($resultadoAutenticacao['idCliente']);
            $clienteAutenticado->setNome($resultadoAutenticacao['nomeFantasia']);
            
    
            // Passando os dados do cliente autenticado para criar sua sessão no site.
            $sessao->setChaveEValorSessao('idCliente', $clienteAutenticado->getId());
            $sessao->setChaveEValorSessao('nomeFantasia', $clienteAutenticado->getNome());
            $sessao->setChaveEValorSessao('tipoConta', 'cliente');
            
    
            header("Location: ../homeEmpresa.php");
            exit();

        }
        
    }
    
    

?>