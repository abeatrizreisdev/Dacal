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

    $sessao = new Sessao();


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $id = $_POST['idCliente'];
        $cnpj = $_POST['cnpjEmpresa'];
        $cnpj = formatarCNPJ($cnpj);
        $razaoSocial = $_POST['razaoSocial'];
        $inscricaoEstadual = formatarInscricaoEstadual($_POST['inscricaoEstadual']);
        $telefone = formatarTelefone($_POST['telefone']);
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $logradouro = $_POST['logradouro'];
        $numeroEndereco = $_POST['numeroEndereco'];
        $bairro = $_POST['bairro'];
        $cep = formatarCEP($_POST['cep']);

        // Debug: Verificar se os dados estão sendo formatados corretamente
    echo "Dados formatados:<br>";
    echo "CNPJ: $cnpj<br>";
    echo "Inscrição Estadual: $inscricaoEstadual<br>";
    echo "Telefone: $telefone<br>";
    echo "CEP: $cep<br>";

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
            $cliente->getId(),['nomeEmpresa' => $cliente->getNome(), 
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
                
                $tipoConta = $sessao->getValorSessao('tipoConta');

                if ($tipoConta == 'admin' ) {
                    //header("Location: ../visualizarContasCadastradas.php");
                    //exit();
                } else {
                    //header("Location: ../homeEmpresa.php");
                    //exit();
                }
                    

            case false :

                $tipoConta = $sessao->getValorSessao('tipoConta');

                if ($tipoConta == 'admin' ) {
                    //header("Location: ../homeADM.php");
                    //exit();
                } else {
                    //header("Location: ../homeEmpresa.php");
                    //exit();
                }

        }

    }

    

function formatarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj); // Remove tudo que não for número
    return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "$1.$2.$3/$4-$5", $cnpj);
}

function formatarInscricaoEstadual($inscricaoEstadual) {
    $inscricaoEstadual = preg_replace('/[^0-9]/', '', $inscricaoEstadual); // Remove tudo que não for número
    return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{1})/', '$1.$2.$3-$4', $inscricaoEstadual);
}

function formatarTelefone($telefone) {
    $telefone = preg_replace('/[^0-9]/', '', $telefone); // Remove tudo que não for número
    return preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $telefone);
}

function formatarCEP($cep) {
    $cep = preg_replace('/[^0-9]/', '', $cep); // Remove tudo que não for número
    return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
}
    
    

?>