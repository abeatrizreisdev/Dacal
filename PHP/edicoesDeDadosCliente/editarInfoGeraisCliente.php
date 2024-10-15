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
        
        $id = $_POST['idCliente'];
        $razaoSocial = $_POST['razaoSocial'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $logradouro = $_POST['logradouro'];
        $numeroEndereco = $_POST['numeroEndereco'];
        $bairro = $_POST['bairro'];

        // Desformatando os valores dos atributos do formulário de edição, para cadastrar no banco de dados sem formatação.
        $cnpj = preg_replace('/\D/', '', $_POST['cnpjEmpresa']); // Remove tudo que não for dígito
        $inscricaoEstadual = preg_replace('/\D/', '', $_POST['inscricaoEstadual']); // Remove tudo que não for dígito
        $telefone = preg_replace('/\D/', '', $_POST['telefone']); // Remove tudo que não for dígito
        $cep = preg_replace('/\D/', '', $_POST['cep']); 

     
        $cliente = new Cliente();
    
        $cliente->setIdCliente($id);
        $cliente->setCnpj($cnpj);
        $cliente->setRazaoSocial($razaoSocial);
        $cliente->setInscricaoEstadual($inscricaoEstadual);
        $cliente->setTelefone($telefone);
        $cliente->setEstado($estado);
        $cliente->setMunicipio($municipio);
        $cliente->setLogradouro($logradouro);
        $cliente->setNumeroEndereco($numeroEndereco);
        $cliente->setBairro($bairro);
        $cliente->setCep($cep);
        
        $resultadoEdicao = $crudCliente->editarCliente(
            $cliente->getId(),[
            'razaoSocial' => $cliente->getRazaoSocial(), 
            'cnpj' => $cliente->getCnpj(), 
            'inscricaoEstadual' => $cliente->getInscricaoEstadual(),
            'telefone' => $cliente->getTelefone(),
            'logradouro' => $cliente->getLogradouro(),
            'bairro' => $cliente->getBairro(),
            'cep' => $cliente->getCep(),
            'estado' => $cliente->getEstado(),
            'municipio' => $cliente->getMunicipio(),
            'numeroEndereco' => $cliente->getNumeroEndereco()
            ] );

        switch ($resultadoEdicao) {

            case true :
                
                if ($tipoConta == 'admin' ) {

                    header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaCliente=sucesso");
                    exit();

                } else {

                    // Passando os dados do funcionário autenticado para editar os dados da sua sessão no site, após a realização da edição dos dados gerais.
                    $sessaoAtiva->setChaveEValorSessao('idCliente', $cliente->getId());
                    $sessaoAtiva->setChaveEValorSessao('razaoSocial', $cliente->getRazaoSocial());
                    $sessaoAtiva->setChaveEValorSessao('cnpj', $cliente->getCnpj());
                    $sessaoAtiva->setChaveEValorSessao('inscricaoEstadual', $cliente->getInscricaoEstadual());
                    $sessaoAtiva->setChaveEValorSessao('telefone', $cliente->getTelefone());
                    $sessaoAtiva->setChaveEValorSessao('estado', $cliente->getEstado());
                    $sessaoAtiva->setChaveEValorSessao('municipio', $cliente->getMunicipio());
                    $sessaoAtiva->setChaveEValorSessao('bairro', $cliente->getBairro());
                    $sessaoAtiva->setChaveEValorSessao('cep', $cliente->getCep());
                    $sessaoAtiva->setChaveEValorSessao('logradouro', $cliente->getLogradouro());
                    $sessaoAtiva->setChaveEValorSessao('numeroEndereco', $cliente->getNumeroEndereco());

                    header("Location: ../homeEmpresa.php?statusEdicaoContaCliente=sucesso");
                    exit();
                    
                }
                    

            case false :

                if ($tipoConta == 'admin' ) {

                    header("Location: ../visualizarContasCadastradas.php?statusEdicaoContaCliente=erro");
                    exit();

                } else {

                    header("Location: ../homeEmpresa.php?statusEdicaoContaCliente=erro");
                    exit();

                    echo $resultadoEdicao;

                }

        }

    } 
  
?>