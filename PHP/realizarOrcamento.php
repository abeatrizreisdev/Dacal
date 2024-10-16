<?php 

    require "./exibirOrcamento/exibirOrcamento.php"

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Beatriz Reis e Valter Filho">
    <meta name="description" content="Site de automoção da Dacal">
    <title>Dacal</title>
    <link rel="stylesheet" href="../CSS/realizarOrcamento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="./homeEmpresa.php">Homepage</li></a>
            <li><a href="">Catálogo</li></a>
            <li><a href="">Sobre Nós</li></a>
        </ul>
        <ul class="icons">
            <a href="./autenticacao/logout.php">
                <button class="sair" href="/IMAGENS/Homepage/logoDacal.png">
                <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
            </button>
            </a>
        </ul>
    </nav>
</header>

<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem vinda,</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoCliente->getValorSessao('nome'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgOrcamento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Orçamentos</p>
                    <p class="descricaoAbas">Confira todos os seus</p>
                    <p class="descricaoAbas">orçamentos.</p>

                </div>
            </a>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgAtendimento.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Atendimento</p>
                    <p class="descricaoAbas">Precisando de ajuda?</p>
                    <p class="descricaoAbas">Clique aqui..</p>
                </div>
            </a>
        </div>
        <section class="quadrado">
            
                <div class="container">
                    <div class="tabelas"> 
                        <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo1')" id="passoPadrao">1 - Catálogo de itens</button> 
                        <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo2')"> 2 - Revisar orçamento</button>
                        <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo3')"> 3 - Confirmar orçamento</button>
                    </div>
                
                    <div id="passo1" class="conteudoPassoAPasso">

                        <div class="containerPesquisar">
                            <input type="text" id="buscarProdutoId" placeholder="Digite o código do produto">
                            <button onclick="buscarProdutoPorId()">Buscar</button>
                        </div>
                        <nav>
                            <ul class="containerCategorias">
                                <li><a href="#" onclick="carregarProdutos(1)">Móveis</a></li>
                                <li><a href="#" onclick="carregarProdutos(2)">Cadeiras</a></li>
                                <li><a href="#" onclick="carregarProdutos(3)">Cozinha</a></li>
                                <li><a href="#" onclick="carregarProdutos(4)">Utensílios</a></li>
                                <li><a href="#" onclick="carregarProdutos(5)">Aparelhos</a></li>
                            </ul>
                        </nav>
            
                        <div id="containerProdutos">
                            <!-- Os produtos cadastrados, dependendo da sua categoria, serão exibidos aqui, por meio do arquivo "realizarOrcamento.js" e "buscarProdutosPorCategoria" na pasta "buscarProdutos". -->
                        </div>
                        
                    </div>
                
                    <div id="passo2" class="conteudoPassoAPasso">
                        <h2>Passo 2: Revisão dos Produtos Selecionados</h2>
                        <!-- Produtos selecionados para revisão, terão que aparecer aqui. -->
                        <?php exibirOrcamento(); ?>

                        <button onclick="cancelarOrcamento()">Cancelar Orçamento</button>
                        <button type="button" onclick="abrirPassoAPasso(event, 'passo1')">Voltar Página</button>
                        <button type="button" onclick="abrirPassoAPasso(event, 'passo3')">Finalizar Orçamento</button>
                   
                    </div>
                
                    <div id="passo3" class="conteudoPassoAPasso">
                        <h2>Passo 3: Encaminhamento do Orçamento</h2>
                        <!-- Precisa criar o formulário para enviar o orçamento para o whatsapp aqui. -->
                        <form id="formOrcamento" action="./crud/receberFormulariosDeCadastros/enviarDadosCadastroOrcamento.php" method="post">
                            <?php
                                // Recuperar o orçamento da sessão e gerar inputs ocultos
                                $orcamento_serializado = $sessaoCliente->getValorSessao('orcamento');
                                if ($orcamento_serializado && is_string($orcamento_serializado)) {
                                    $orcamento = unserialize($orcamento_serializado);
                                    $quantidadeTotal = 0; // Definir a variável $quantidadeTotal

                                    foreach ($orcamento->getProdutos() as $produto) {
                                        $quantidade = $orcamento->getQuantidadeProdutos()[$produto->getId()];
                                        $quantidadeTotal += $quantidade; // Calcular a quantidade total
                                        echo "<div class='produto'>
                                                <p class='produto-nome'>Produto: " . htmlspecialchars($produto->getNome()) . "</p>
                                                <p class='produto-categoria'>Categoria: " . htmlspecialchars($produto->getCategoria()) . "</p>
                                                <img class='produto-imagem' src='data:image/jpeg;base64," . base64_encode($produto->getImagem()) . "' alt='Produto'>
                                                <p class='produto-quantidade'>Quantidade: 
                                                    <input type='number' name='quantidades[]' value='" . htmlspecialchars($quantidade) . "' min='1' required readonly>
                                                </p>
                                                <p class='produto-valor'>Valor: R$ " . htmlspecialchars($produto->getValor()) . "</p>
                                                <input type='hidden' name='produtos[]' value='" . htmlspecialchars($produto->getNome()) . "'>
                                                <input type='hidden' name='valores[]' value='" . htmlspecialchars($produto->getValor()) . "'>
                                            </div>";
                                    }
                                    
                                    echo '<p class="produto-valor"> Valor Total: R$ ' . htmlspecialchars($orcamento->getValor()) . ' </p>';
                                    echo '<h3>Quantidade Total de Itens: ' . htmlspecialchars($quantidadeTotal) . '</h3>';
                                    echo '<input type="hidden" name="valorTotal" value="' . htmlspecialchars($orcamento->getValor()) . '">';

                                } else {
                                    echo '<p>Nenhum produto no orçamento.</p>';
                                }   

                            ?>
                            
                            <button onclick="cancelarOrcamento()">Cancelar Orçamento</button>
                            <button type="button" onclick="abrirPassoAPasso(event, 'passo2')">Voltar Página</button>
                            <button type="submit">Finalizar Orçamento</button>

                        </form>
                        

                    </div>

                </div>

        </section>

        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="../JS/scriptParaPasso2DeOrcamento/metodosUtilizadosNosPassosDeOrcamento.js"></script>
        <script src="../JS/realizarOrcamento.js"></script>
        

</body>

</html>