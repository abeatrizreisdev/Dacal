<?php
require './conexaoBD/conexaoBD.php';
require "./sessao/sessao.php";

$sessaoFuncionario = new Sessao();
$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');

if ($tipoContaAutenticada !== "admin" && $tipoContaAutenticada !== "funcionario") {
    if ($tipoContaAutenticada === "cliente") {
        header("Location: ./acessoNegado.php");
        exit();
    } else {
        header("Location: ../login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../CSS/geral.css">
    <link rel="stylesheet" href="../CSS/cadastrarProduto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="fundo">

    <div id="tipoConta" data-tipo="<?php echo $tipoContaAutenticada; ?>"></div> 
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
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoFuncionario->getValorSessao('nome'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas" href="./perfilFuncionario.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <?php 

                if ($tipoContaAutenticada == "admin") {
                    echo '<br>';
                    echo '<a class="abas" href="./gerenciarContas.php">
                    <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                    <div id="info">';
                        echo '<p class="tituloAbas"> Gerenciar Contas</p>
                        <p class="descricaoAbas">Gerenciar funcionários</p>
                        <p class="descricaoAbas">e empresas</p>
                    </div>';
                        echo '</a>';
                }

            ?>
        </div>
        <section class="quadrado">
            <h1>Editar Produto</h1>
            <form method="POST" action="crud/receberFormulariodeEdicaoProduto/processarEdicaoProduto.php" enctype="multipart/form-data" class="containerFormulario">
                <div class="containerImagemNomeEValor">
                    <label for="imagem" class="upload-container">
                        <img src="" alt="Imagem do Produto" id="imagemPreview">
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                    </label>
                    <input type="hidden" name="imagemAtual" id="imagemAtual">
                    <input type="hidden" name="idProduto" id="idProduto">
                    <div class="input-group">
                        <label for="nomeProduto">Nome:</label>
                        <input type="text" id="nomeProduto" name="nomeProduto" required>
                        <label for="precoProduto">Preço:</label>
                        <input type="number" id="precoProduto" name="precoProduto" required min="1">
                        <label for="categoriaProduto" id="labelCategoria">Categoria:</label>
                        <select name="categoriaProduto" id="categoriaProduto">
                            <option value="1">Móveis</option>
                            <option value="2">Escritório</option>
                            <option value="3">Diversos</option>
                        </select>
                    </div>
                </div>
                <div class="descricao-field">
                    <label for="descricaoProduto">Descrição:</label>
                    <textarea id="descricaoProduto" name="descricaoProduto" required></textarea>
                </div>
                <div class="form-buttons">
                    <a href="./catalogoProdutos.php" id="link-botao-cancelar"><button type="button">Cancelar</button></a>
                    <button type="submit" id="botaoCadastrarProduto">Salvar Alterações</button>
                </div>
            </form>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarProduto/editarProduto.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</html>
