<?php

    require '../../conexaoBD/conexaoBD.php';
    require '../../sessao/sessao.php';
    require '../../crud/crudOrcamento.php';
    require "../../entidades/orcamento.php";
    require "../../entidades/cliente.php";
    require "../../entidades/produto.php";
    require '../../conexaoBD/configBanco.php';

    $sessao = new Sessao();
    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco

    $crudOrcamento = new CrudOrcamento($conexao);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        try {

            $produtos = $_POST['produtos'] ?? [];
            $quantidades = $_POST['quantidades'] ?? [];
            $valores = $_POST['valores'] ?? [];
            $produtoIds = $_POST['produtoIds'] ?? [];
            $valorTotal = $_POST['valorTotal'] ?? 0;

            // Calcula a quantidade total de produtos.
            $quantidadeTotal = array_sum($quantidades);

            // Criar o objeto Orcamento.
            $orcamentoRealizado = new Orcamento();

            $orcamentoRealizado->setCliente($sessao->getValorSessao('idCliente'));
            $orcamentoRealizado->setValor($valorTotal);
            $orcamentoRealizado->setData(date('Y-m-d H:i:s')); // Passando a data e as horas atuais do momento do cadastro do orcamento.
            $orcamentoRealizado->setStatus('pendente');

            // Criando os itens do orçamento.
            $itens = [];

            foreach ($produtos as $index => $produtoNome) {

                $produto = new Produto();
                $produto->setId($produtoIds[$index]);
                $produto->setNome($produtoNome);
                $produto->setValor($valores[$index]);
                $quantidade = $quantidades[$index];

                $itens[] = [
                    'produto' => $produto,
                    'quantidade' => $quantidade
                ];
                
            }

            // Cadastrar o orçamento e os itens no banco de dados
            if ($crudOrcamento->cadastrarOrcamento($orcamentoRealizado, $itens)) {

                $sessao->excluirChaveSessao('orcamento');

                $cliente = new Cliente();

                // Setando os valores do objeto Cliente que está autenticado e fez o orçamento.
                $cliente->setNome($sessao->getValorSessao('nomeFantasia'));
                $cliente->setIdCliente($idCliente = $sessao->getValorSessao('idCliente'));
                $cliente->setRazaoSocial($razaoSocial = $sessao->getValorSessao('razaoSocial'));
                $cliente->setCnpj($cnpj = $sessao->getValorSessao('cnpj'));
                $cliente->setInscricaoEstadual($inscricaoEstadual = $sessao->getValorSessao('inscricaoEstadual'));
                $cliente->setTelefone($telefone = $sessao->getValorSessao('telefone'));
                $cliente->setEmail($email = $sessao->getValorSessao('email'));
                $cliente->setLogradouro($logradouro = $sessao->getValorSessao('logradouro'));
                $cliente->setBairro($bairro = $sessao->getValorSessao('bairro'));
                $cliente->setCep($cep = $sessao->getValorSessao('cep'));
                $cliente->setEstado($estado = $sessao->getValorSessao('estado'));
                $cliente->setMunicipio($municipio = $sessao->getValorSessao('municipio'));
                $cliente->setNumeroEndereco($numeroEndereco = $sessao->getValorSessao('numeroEndereco'));

                // Retornar JSON de sucesso.
                echo json_encode(['status' => 'sucesso']);

                // Passando o número oficial do whatsapp da empresa a qual o cliente será direcionado com as informações do orçamento.
                $numero = '5571996023166';

                // Criando a mensagem que será encaminhada para o número do whatsapp, em que estará incluso todos os dados do formulário e do cliente.
                $mensagem = "Olá, equipe da Dacal!\n\n";
                $mensagem .= "Um novo orçamento foi solicitado pelo cliente. Seguem os detalhes:\n\n";
                $mensagem .= "Nome do Cliente: " . $cliente->getNome() . "\n";
                $mensagem .= "CNPJ: " . $cliente->getCnpj() . "\n";
                $mensagem .= "Telefone: " . $cliente->getTelefone() . "\n";
                $mensagem .= "Email: " . $cliente->getEmail() . "\n";
                $mensagem .= "Endereço: " . $cliente->getlogradouro() . ", " . $cliente->getNumeroEndereco() . ", " . $cliente->getBairro() . "-" . $cliente->getMunicipio() . "/" . $cliente->getEstado() . ", " . $cliente->getCep() . "\n\n";
                $mensagem .= "Produtos Solicitados:\n";

                foreach ($itens as $item) {
                    $mensagem .= "- Código do Produto: " . $item['produto']->getId() . " - Nome do produto: " . $item['produto']->getNome() . ": *Quantidade: " . $item['quantidade'] . " Valor unitário: R$ " . $item['produto']->getValor() . "\n";
                }

                $mensagem .= "\nValor Total do Orçamento: R$ $valorTotal\n";
                $mensagem .= "Data da Solicitação: " . date('d/m/Y') . "\n\n";
                $mensagem .= "Por favor, entrem em contato com o cliente para confirmar o pedido.\n\n";
                $mensagem .= "Atenciosamente,\nSistema de Orçamento";

                // Esse é o endereço que fará o encaminhamento da mensagem, passando o número do whatsapp de destino e a mensagem com os dados do pedido.
                $url = 'https://wa.me/' . $numero . '?text=' . urlencode("Realização de Orçamento:\n\n $mensagem");

                // Método que redireciona para o endereço de encaminhamento do pedido para o whatsapp web ou o próprio programa do whatsapp para pc...
                // Dependendo da escolha do cliente.
                header("Location: $url");

                exit();

            } else {

                // Retornar JSON de erro
                echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao cadastrar o orçamento.']);
                exit();

            };

        } catch (Exception $excecao) {

            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao cadastrar o orçamento: ' . $excecao->getMessage()]);

            exit();

        }

    } else {

        echo '<p>Método de requisição inválido.</p>';

    }

?>
