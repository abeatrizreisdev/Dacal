<?php
require '../../conexaoBD/conexaoBD.php';
require '../../sessao/sessao.php';
require '../../crud/crudOrcamento.php';
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

    $produtos = $_POST['produtos'] ?? [];
    $quantidades = $_POST['quantidades'] ?? [];
    $valores = $_POST['valores'] ?? [];
    $produtoIds = $_POST['produtoIds'] ?? [];
    $valorTotal = $_POST['valorTotal'] ?? 0;
    $nome = $sessao->getValorSessao('nome');
    $idCliente = $sessao->getValorSessao('id'); // Obtendo ID do cliente da sessão
    $razaoSocial = $sessao->getValorSessao('razaoSocial'); // Obtendo ID do cliente da sessão
    $cpf = $sessao->getValorSessao('cpf');
    $cnpj = $sessao->getValorSessao('cnpj'); // Obtendo ID do cliente da sessão
    $inscricaoEstadual = $sessao->getValorSessao('inscricaoEstadual'); // Obtendo ID do cliente da sessão
    $telefone = $sessao->getValorSessao('telefone'); // Obtendo ID do cliente da sessão
    $email = $sessao->getValorSessao('email'); // Obtendo ID do cliente da sessão
    $logradouro = $sessao->getValorSessao('logradouro'); // Obtendo ID do cliente da sessão
    $bairro = $sessao->getValorSessao('bairro'); // Obtendo ID do cliente da sessão
    $cep = $sessao->getValorSessao('cep'); // Obtendo ID do cliente da sessão
    $estado = $sessao->getValorSessao('estado'); // Obtendo ID do cliente da sessão
    $municipio = $sessao->getValorSessao('cidade'); // Obtendo ID do cliente da sessão
    $numeroEndereco = $sessao->getValorSessao('numeroEndereco'); // Obtendo ID do cliente da sessão

    // Calcula a quantidade total de produtos
    $quantidadeTotal = array_sum($quantidades);

    // Criar o objeto Orcamento
    $orcamento = [
        'idCliente' => $idCliente,
        'valorOrcamento' => $valorTotal,
        'dataCriacao' => date('Y-m-d'), // Data atual
        'status' => 'pendente'
    ];


    // Você coloca dentro das aspas o seu número para teste, no formato internacional (557199999999), ou da loja futuramente, que é para onde será encaminhado a mensagem com os dados do pedido.
    $numero = '5571996016625';

    // Pegando os valores dos inputs do formulário.
    $nomeProduto = $_POST['nomeProduto'];
    $cnpj = $_POST['cnpj'];
    $razaoSocial = $_POST['razaoSocial'];


    // Criando a mensagem que será encaminhada para o número do whatsapp, em que estará incluso todos os dados do formulário.
    $mensagem = "Olá, equipe da Dacal!\n\n";
    $mensagem .= "Um novo orçamento foi solicitado pelo cliente. Seguem os detalhes:\n\n";
    $mensagem .= "Nome do Cliente: $nome\n";
    $mensagem .= "CPF: $cpf\n";
    $mensagem .= "Telefone: $telefone\n";
    $mensagem .= "Email: $email\n";
    $mensagem .= "Endereço: $logradouro, $numeroEndereco, $bairro - $municipio/$estado, $cep\n\n";
    $mensagem .= "Produtos Solicitados:\n";

    foreach ($produtos as $key => $produto) {
        $mensagem .= "- $produto: *Quantidade: {$quantidades[$key]} Valor: R$ {$valores[$key]}\n";
    }

    $mensagem .= "\nValor Total do Orçamento: R$ $valorTotal\n";
    $mensagem .= "Data da Solicitação: " . date('d/m/Y') . "\n\n";
    $mensagem .= "Por favor, entrem em contato com o cliente para confirmar o pedido.\n\n";
    $mensagem .= "Atenciosamente,\nSistema de Orçamento";

    // Esse é o endereço que fará o encaminhamento da mensagem, passando o número do whatsapp de destino e a mensagem com os dados do pedido.
    $url = 'https://wa.me/' . $numero . '?text=' . urlencode("Requerimento de pedido:\n\n $mensagem");

    // Método que redireciona para o endereço de encaminhamento do pedido para o whatsapp web ou o próprio programa do whatsapp para pc...
    // Dependendo da escolha do cliente.
    header("Location: $url");





    // Inserir o orçamento na tabela Orcamentos
    //$orcamentoId = $crudOrcamento->cadastrarOrcamento($orcamento);

    /* 
    if ($orcamentoId) {
        // Inserir itens do orçamento na tabela itens_orcamento
        $stmtItem = $conexao->getConexao()->prepare("INSERT INTO itens_orcamento (numeroOrcamento, idProduto, quantidade) VALUES (?, ?, ?)");
        foreach ($produtoIds as $index => $produtoId) {
            $quantidade = $quantidades[$index];
            $stmtItem->bind_param("iii", $orcamentoId, $produtoId, $quantidade);
            $stmtItem->execute();
        }

        echo '<h2>Orçamento enviado com sucesso!</h2>';
        echo '<p>Produtos:</p><ul>';
        foreach ($produtos as $index => $produto) {
            echo '<li>' . htmlspecialchars($produto) . ' - Quantidade: ' . htmlspecialchars($quantidades[$index]) . ' - Valor: R$ ' . htmlspecialchars($valores[$index]) . '</li>';
        }
        echo '</ul>';
        echo '<p>Valor Total: R$ ' . htmlspecialchars($valorTotal) . '</p>';
    } else {
        echo '<p>Erro ao enviar o orçamento.</p>';
    } */
} else {
    echo '<p>Método de requisição inválido.</p>';
}
?>
