<?php
require './conexaoBD/conexaoBD.php';
require "./crud/crudProduto.php";
require "./conexaoBD/configBanco.php";
require "./sessao/sessao.php";

$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco.

$crudProduto = new CrudProduto($conexao);

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];
    $produtoEncontrado = $crudProduto->buscarInfoProduto($idProduto);
}
$sessaoFuncionario = new Sessao();
$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');
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
    <link rel="stylesheet" href="../CSS/cadastrarProduto.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>
    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">
        <ul class="nav-list">
            <li><a href="<?php echo $tipoContaAutenticada == 'admin' ? 'homeAdm.php' : 'homeFuncionario.php'; ?>">Homepage</a></li>
            <li><a href="#">Catálogo</a></li>
            <li><a href="#">Sobre Nós</a></li>
        </ul>
        <ul class="icons">
            <a href="./autenticacao/logout.php">
                <button class="sair">
                <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
                </button>
            </a>
        </ul>
    </nav>
</header>
<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br><br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoFuncionario->getValorSessao('nome'); ?> </p>
                    <button class="sairInfo">
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
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus dados.</p>
                </div>
            </a>
            <?php 
                if ($tipoContaAutenticada == "admin") {
                    echo '<br>';
                    echo '<a class="abas" href="./visualizarContasCadastradas.php">
                    <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                    <div id="info">';
                    echo '<p class="tituloAbas">Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar contas funcionários e empresas</p>
                </div>';
                    echo '</a>';
                }
            ?>
        </div>
        <section class="quadrado">
            <form action="./crud/receberFormulariosDeCadastros/enviarDadosEdicaoProduto.php" method="post" enctype="multipart/form-data" class="containerFormulario">
                <div class="containerImagemNomeEValor">
                    <label for="imagem" class="upload-container">
                        <img src="<?php echo isset($produtoEncontrado['imagemProduto']) ? 'data:image/png;base64,' . base64_encode($produtoEncontrado['imagemProduto']) : '../IMAGENS/CadastrarProduto/iconeAdcionarImagemProduto.png'; ?>" id="imagemPreview">
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                    </label>
                    <div class="input-group">
                        <label for="nomeProduto">Nome:</label>
                        <input type="text" name="nome" id="nomeProduto" placeholder="Nome do produto." value="<?php echo isset($produtoEncontrado['nomeProduto']) ? $produtoEncontrado['nomeProduto'] : ''; ?>" required>
                        <label for="valorProduto">Valor:</label>
                        <input type="number" name="valor" id="valorProduto" placeholder="Valor do produto." value="<?php echo isset($produtoEncontrado['valorProduto']) ? $produtoEncontrado['valor'] : ''; ?>" required min="1">
                        <label for="categoriaProduto">Categoria:</label>
                        <select name="categoriaProduto" id="CategoriaProduto">
                            <option value="1" <?php echo isset($produtoEncontrado['categoria']) && $produtoEncontrado['categoria'] == 1 ? 'selected' : ''; ?>>Móveis</option>
                            <option value="2" <?php echo isset($produtoEncontrado['categoria']) && $produtoEncontrado['categoria'] == 2 ? 'selected' : ''; ?>>Cadeiras</option>
                            <option value="3" <?php echo isset($produtoEncontrado['categoria']) && $produtoEncontrado['categoria'] == 3 ? 'selected' : ''; ?>>Cozinha</option>
                            <option value="4" <?php echo isset($produtoEncontrado['categoria']) && $produtoEncontrado['categoria'] == 4 ? 'selected' : ''; ?>>Utensílios</option>
                            <option value="5" <?php echo isset($produtoEncontrado['categoria']) && $produtoEncontrado['categoria'] == 5 ? 'selected' : ''; ?>>Aparelhos</option>
                        </select>
                    </div>
                </div>
                <div class="descricao-field">
                    <label for="descricaoProduto">Descrição:</label>
                    <textarea name="descricao" id="descricaoProduto" required><?php echo isset($produtoEncontrado['descricao']) ? $produtoEncontrado['descricaoProduto'] : ''; ?></textarea>
                </div>
                <div class="form-buttons">
                    <a href="./homeFuncionario.php" id="link-botao-cancelar"><button type="button">Cancelar</button></a>
                    <button type="submit" id="botaoCadastrarProduto">Salvar Alterações</button>
                </div>
            </form>
        </section>
    </div>
    <script src="../JS/scriptCadastroDeProduto.js"></script>
</body>
</html>
