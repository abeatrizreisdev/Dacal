<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../entidades/funcionario.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

    try {

        $conexao = new ConexaoBD();
        $conexao->setHostBD(BD_HOST);
        $conexao->setPortaBD(BD_PORTA);
        $conexao->setEschemaBD(BD_ESCHEMA);
        $conexao->setSenhaBD(BD_PASSWORD);
        $conexao->setUsuarioBD(BD_USERNAME);
        $conexao->getConexao(); // Iniciando a conexão com o banco.

        $crudFuncionario = new CrudFuncionario($conexao);
        $sessao = new Sessao();
        $tipoContaSessao = $sessao->getValorSessao('tipoConta');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            header('Content-Type: application/json');

            $id = $_POST['idGeral'];
            $nome = $_POST['nome'];
            $estado = $_POST['estado'];
            $cidade = $_POST['municipio'];
            $logradouro = $_POST['logradouro'];
            $bairro = $_POST['bairro'];
            $numeroEndereco = $_POST['numeroEndereco'];
            
            // Desformatando os valores dos atributos do formulário de edição, para cadastrar no banco de dados sem formatação.
            $telefone = preg_replace('/\D/', '', $_POST['telefone']); // Remove tudo que não for dígito
            $cep = preg_replace('/\D/', '', $_POST['cep']); 
            $cpf = preg_replace('/\D/', '', $_POST['cpf']); 
            
            $funcionario = new Funcionario();
            $funcionario->setId($id);
            $funcionario->setNome($nome);
            $funcionario->setEstado($estado);
            $funcionario->setCidade($cidade);
            $funcionario->setLogradouro($logradouro);
            $funcionario->setBairro($bairro);
            $funcionario->setTelefone($telefone);
            $funcionario->setCep($cep);
            $funcionario->setCpf($cpf);
            $funcionario->setNumeroEndereco($numeroEndereco);
            
            $resultadoEdicao = $crudFuncionario->editarFuncionario($funcionario->getId(), [
                'nome' => $funcionario->getNome(),
                'telefone' => $funcionario->getTelefone(),
                'cpf' => $funcionario->getCpf(),
                'estado' => $funcionario->getEstado(),
                'cidade' => $funcionario->getCidade(),
                'bairro' => $funcionario->getBairro(),
                'logradouro' => $funcionario->getLogradouro(),
                'cep' => $funcionario->getCep(),
                'numeroEndereco' => $funcionario->getNumeroEndereco()

            ]);
            
            if ($resultadoEdicao) {

                echo json_encode(['status' => 'sucesso']);

            } else {
                
                echo json_encode(['status' => 'erro', 'mensagem' => 'Ocorreu um erro ao editar o funcionário. Verifique os dados fornecidos e tente novamente.']);

            }

        } else {
            
            echo json_encode(['status' => 'erro', 'mensagem' => 'Requisição inválida.']);

        }

    } catch (Exception $excecao) {

        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao processar a edição do funcionário: ' . $excecao->getMessage()]);

    }
