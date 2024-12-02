<?php


require "./sessao/sessao.php";

$sessaoCliente = new Sessao();

$usuarioAutenticado = $sessaoCliente->getValorSessao('tipoConta');

if ($usuarioAutenticado !== "cliente") {
    // O usuário autenticado que não for admin, será direcionado para a página de acesso não permitido.
    if ($usuarioAutenticado === "admin" or $usuarioAutenticado === "funcionario") {
        header("Location: ./acessoNegado.php");
        exit();
    } else { // o usuário que não tiver autenticado, será direcionado para a página de login.
        header("Location: ../login.php");
        exit();
    }
}



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
    <link rel="stylesheet" href="../CSS/geral.css">
    <link rel="stylesheet" href="../CSS/realizarOrcamento.css">
    <link rel="stylesheet" href="../CSS/catalogoProdutos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="fundo">


    <div id="tipoConta" data-tipo="<?php echo $usuarioAutenticado; ?>"></div> 
    <header> 
        <div id="barraSuperior"></div> 
    </header>

    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem vinda,</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoCliente->getValorSessao('nomeFantasia'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas" href="perfilEmpresa.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas" href="orcamentosEmpresa.php">
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
        <section class="quadradoAjustar">
            <div class="container">
                <div class="tabelas">
                    <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo1')" id="passoPadrao">1
                        - Catálogo de itens</button>
                    <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo2')"> 2 - Revisar
                        orçamento</button>
                    <button class="linksTabela" onclick="abrirPassoAPassoOrcamento(event, 'passo3')"> 3 - Confirmar
                        orçamento</button>
                </div>
                <div class="quadradoOrca">
                    <div id="passo1" class="conteudoPassoAPasso">

                        <div class="containerPesquisar">
                            <input type="text" id="buscarProdutoNome" placeholder="Digite o nome do produto">
                            <button onclick="buscarProdutoPorNome()">Buscar</button>
                        </div>
                        <nav>
                            <ul class="containerCategorias">
                                <li><a href="#" onclick="carregarProdutos(0)">Geral</a></li>
                                <li><a href="#" onclick="carregarProdutos(1)">Móveis</a></li>
                                <li><a href="#" onclick="carregarProdutos(2)">Escritório</a></li>
                                <li><a href="#" onclick="carregarProdutos(3)">Diversos</a></li>
                            </ul>
                        </nav>

                        <div id="containerProdutos">
                            <!-- Os produtos cadastrados, dependendo da sua categoria, serão exibidos aqui, por meio do arquivo "realizarOrcamento.js" e "buscarProdutosPorCategoria" na pasta "buscarProdutos". -->
                        </div>
                        <div class="btnPasso">
                            <button class="btn" type="button"  id="btnCancelar1" onclick="cancelarOrcamento()">Cancelar Orçamento</button>
                            <button class="btn" id="btnProximo" type="button"
                                onclick="avancarParaPasso('passo2')">Proximo Passo</button>
                        </div>

                    </div>

                    <div id="passo2" class="conteudoPassoAPasso">
                        <p class="titulo">PRODUTOS SELECIONADOS</p>
                        <!-- Produtos selecionados para revisão, terão que aparecer aqui. -->
                        <div id="orcamentoContainer"></div>

                        <div class="btnCentrais">
                            <button class="btn" type="button" id="btnCancelar" onclick="cancelarOrcamento()">Cancelar
                                Orçamento</button>
                            <button class="btn" id="btnVoltar" type="button"
                                onclick="voltarParaPasso('passo1')">Voltar Página</button>
                            <button class="btn" id="btnFinalizar" type="button"
                                onclick="avancarParaPasso('passo3')">Finalizar Orçamento</button>
                        </div>
                    </div>

                    <div id="passo3" class="conteudoPassoAPasso">
                        <p class="titulo">ORÇAMENTO</p>
                        <form id="formOrcamento"
                            action="./crud/receberFormulariosDeCadastros/enviarDadosCadastroOrcamento.php"
                            method="post">
                            <div id="formOrcamentoContainer"></div>
                            <div class="btnCentrais">
                                <button type="button" id="btn3Cancelar"><a onclick="cancelarOrcamento()">Cancelar Orçamento</a></button>
                                <button type="button" id="btn3Voltar"><a onclick="voltarParaPasso('passo2')">Voltar
                                    Página</a></button>
                                <button id="btnFinalizarr" type="submit">Finalizar Orçamento</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/realizarOrcamento/metodosDosPassos.js"></script>
    <script src="../JS/realizarOrcamento/definirLogicaDosPassos.js"></script>
    <script src="../JS/realizarOrcamento/metodosBuscarProduto.js"></script>
    <script src="../JS/realizarOrcamento/carregarProdutos.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>
    

</body>

</html>