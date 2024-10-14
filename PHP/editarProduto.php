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
$sessaoFuncionario = new Sessao();
$tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');
$crudProduto = new CrudProduto($conexao);

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];
    $produto = $crudProduto->buscarInfoProduto($idProduto);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../CSS/cadastrarProduto.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>
    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">
        <ul class="nav-list">
            <li><a href="<?php echo $tipoContaAutenticada == 'admin'? 'homeAdm.php' : 'homeFuncionario.php'; ?>">Homepage</a></li>
            <li><a href="">Catálogo</a></li>
            <li><a href="">Sobre Nós</a></li>
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
            <?php if ($tipoContaAutenticada == "admin") { ?>
            <br>
            <a class="abas" href="./visualizarContasCadastradas.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar contas</p>
                    <p class="descricaoAbas">funcionários e empresas</p>
                </div>
            </a>
            <?php } ?>
        </div>
        <section class="quadrado">
            <h1>Editar Produto</h1>
            <?php if (isset($produto)): ?>
            <form method="POST" action="crud/receberFormulariodeEdicaoProduto/processarEdicaoProduto.php" enctype="multipart/form-data" class="containerFormulario">
                <div class="containerImagemNomeEValor">
                    <label for="imagem" class="upload-container">
                        <img src="<?php echo 'data:image/png;base64,' . base64_encode($produto['imagemProduto']); ?>" alt="Imagem do Produto" id="imagemPreview">
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                    </label>
                    <input type="hidden" name="imagemAtual" value="<?php echo base64_encode($produto['imagemProduto']); ?>">
                    <input type="hidden" name="idProduto" value="<?php echo $produto['codigoProduto']; ?>">
                    <div class="input-group">
                        <label for="nomeProduto">Nome:</label>
                        <input type="text" id="nomeProduto" name="nomeProduto" value="<?php echo $produto['nomeProduto']; ?>" required>
                        <label for="precoProduto">Preço:</label>
                        <input type="number" id="precoProduto" name="precoProduto" value="<?php echo $produto['valorProduto']; ?>" required min="1">
                        <label for="categoriaProduto">Categoria:</label>
                        <select name="categoriaProduto" id="categoriaProduto">
                            <option value="1" <?php echo $produto['categoria'] == 1 ? 'selected' : ''; ?>>Móveis</option>
                            <option value="2" <?php echo $produto['categoria'] == 2 ? 'selected' : ''; ?>>Cadeiras</option>
                            <option value="3" <?php echo $produto['categoria'] == 3 ? 'selected' : ''; ?>>Cozinha</option>
                            <option value="4" <?php echo $produto['categoria'] == 4 ? 'selected' : ''; ?>>Utensílios</option>
                            <option value="5" <?php echo $produto['categoria'] == 5 ? 'selected' : ''; ?>>Aparelhos</option>
                        </select>
                    </div>
                </div>
                <div class="descricao-field">
                    <label for="descricaoProduto">Descrição:</label>
                    <textarea id="descricaoProduto" name="descricaoProduto" required><?php echo $produto['descricaoProduto']; ?></textarea>
                </div>
                <div class="form-buttons">
                    <a href="./homeFuncionario.php" id="link-botao-cancelar"><button type="button">Cancelar</button></a>
                    <button type="submit" id="botaoCadastrarProduto">Salvar Alterações</button>
                </div>
            </form>
            <?php else: ?>
            <p>Produto não encontrado.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
