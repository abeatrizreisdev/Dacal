<?php
    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudFuncionario.php";
    require "../entidades/funcionario.php";
    require "../sessao/sessao.php";
    require "../conexaoBD/configBanco.php";

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

        try {

            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $logradouro = $_POST['logradouro'];
            $bairro = $_POST['bairro'];
            $tipoConta = "funcionario";
            $email = $_POST['email'];
            
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
            $funcionario->setTipoConta($tipoConta);
            $funcionario->setTelefone($telefone);
            $funcionario->setCep($cep);
            $funcionario->setCpf($cpf);
            $funcionario->setEmail($email);
            
            $resultadoEdicao = $crudFuncionario->editarFuncionario($funcionario->getId(), [
                'nome' => $funcionario->getNome(),
                'email' => $funcionario->getEmail(),
                'telefone' => $funcionario->getTelefone(),
                'tipoConta' => $funcionario->getTipoConta(),
                'cpf' => $funcionario->getCpf(),
                'estado' => $funcionario->getEstado(),
                'cidade' => $funcionario->getCidade(),
                'bairro' => $funcionario->getBairro(),
                'logradouro' => $funcionario->getLogradouro(),
                'cep' => $funcionario->getCep()
            ]);
            
            if ($resultadoEdicao) {

                if ($tipoContaSessao == 'admin') {

                    header("Location: ../gerenciarContas.php?statusEdicaoContaFuncionario=sucesso");
                    exit();

                } elseif ($tipoContaSessao == 'funcionario') {

                    header("Location: ../homeFuncionario.php?statusEdicaoContaFuncionario=sucesso");
                    exit();

                }

            } else {

                echo "Ocorreu um erro ao editar o funcionário. Verifique os dados fornecidos e tente novamente.";

                if ($tipoContaSessao == 'admin') {

                    header("Location: ../gerenciarContas.php?statusEdicaoContaFuncionario=erro");
                    exit();

                } elseif ($tipoContaSessao == 'funcionario') {

                    header("Location: ../homeFuncionario.php?statusEdicaoContaFuncionario=erro");
                    exit();

                }

            }

        } catch (Exception $excecao) {

            echo "<br>Erro ao processar a edição do funcionário: " . $excecao->getMessage();

            if ($tipoContaSessao == 'admin') {

                header("Location: ../gerenciarContas.php?statusEdicaoContaFuncionario=erro");
                exit();

            } elseif ($tipoContaSessao == 'funcionario') {

                header("Location: ../homeFuncionario.php?statusEdicaoContaFuncionario=erro");
                exit();

            }

        }

    }

