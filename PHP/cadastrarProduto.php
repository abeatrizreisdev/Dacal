<?php 

    require "./sessao/sessao.php";

    $sessaoFuncionario = new Sessao();

    $tipoContaAutenticada = $sessaoFuncionario->getValorSessao('tipoConta');

     // Definindo o link com base no tipo de conta $linkCancelar = ''; 
    if ($tipoContaAutenticada === 'admin') { 
        $linkCancelar = './homeAdm.php'; 
    } elseif ($tipoContaAutenticada === 'Funcionario') {
        $linkCancelar = './homeFuncionario.php'; 
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
    <link rel="stylesheet" href="../CSS/cadastrarProduto.css">
</head>


<body class="fundo" >

    <div id="tipoConta" data-tipo="<?php echo $tipoContaAutenticada; ?>"></div> 
    <header> 
        <div id="barraSuperior"></div> 
    </header>


    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas" href="<?php echo $linkCancelar; ?>">
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
        
                <form action="./crud/receberFormulariosDeCadastros/enviarDadosCadastroProduto.php" method="post" enctype="multipart/form-data" class="containerFormulario">

                    <div class="containerImagemNomeEValor">
                            <label for="imagem" class="upload-container">
                                <img src="../IMAGENS/CadastrarProduto/iconeAdcionarImagemProduto.png" id="imagemPreview">
                                <input type="file" id="imagem" name="imagem" accept="image/*" required>
                                
                            </label>
                            <div class="input-group">
                                <label for="nomeProduto">Nome:</label>
                                <input type="text" name="nome" id="nomeProduto" placeholder="Nome do produto." required>

                                <label for="valorProduto">Valor:</label>
                                <input type="number" name="valor" id="valorProduto" placeholder="Valor do produto." required min="1">

                                <label for="categoriaProduto" id="labelCategoria"> Categoria: </label>
                                <select name="categoriaProduto" id="CategoriaProduto">
                                    <option value="1">Móveis</option>
                                    <option value="2">Escritório</option>
                                    <option value="3">Diversos</option>
                                </select>
                            </div>
                            
                    </div>

                    <div class="descricao-field">
                        <label for="descricaoProduto">Descrição:</label>
                        <textarea name="descricao" id="descricaoProduto" required></textarea>
                    </div>

                    <div class="form-buttons">
                        <a href="<?php echo $linkCancelar; ?>" id="link-botao-cancelar"><button type="button">Cancelar</button></a>
                        <button type="submit" id="botaoCadastrarProduto">Cadastrar produto</button>
                    </div>

                </form>
            
        </section>
    </div>

    <script src="../JS/cadastrarProduto/cadastroProduto.js"></script>
    <script src="../JS/barras/barraSuperior.js"></script>

</body>

</html>