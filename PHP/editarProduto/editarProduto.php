<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudProduto.php";
    require "../../sessao/sessao.php";
    require "../../entidades/produto.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(host: BD_HOST);
    $conexao->setPortaBD(porta: BD_PORTA);
    $conexao->setEschemaBD(eschema: BD_ESCHEMA);
    $conexao->setSenhaBD(senha: BD_PASSWORD);
    $conexao->setUsuarioBD(user: BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.
    
    $crudProduto = new CrudProduto($conexao);

    // Verifica se o ID do produto foi passado na URL.
    if (isset($_GET['id'])) {
        $idProduto = $_GET['id'];
    }

    // Verifica se o método de requisição é POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Verifica se o arquivo de imagem foi enviado
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            
            echo 'Erro no upload: ' . $_FILES['imagem']['error'];
            $imagemProduto = $_FILES['imagem'];

            // Verifica se o caminho temporário do arquivo não está vazio
            if (!empty($imagemProduto['tmp_name'])) {

                // Lê o conteúdo do arquivo
                $conteudoImagem = file_get_contents($imagemProduto['tmp_name']);
                
                // Processa os outros campos do formulário
                $nomeProduto = $_POST['nome'];
                $valorProduto = floatval(str_replace(',', '.', $_POST['valor']));
                $descricaoProduto = $_POST['descricao'];

                try {

                    // Cria uma nova instância do Produto
                    $produto = new Produto();
                    
                    // Define os atributos do produto
                    $produto->setImagem($conteudoImagem); // Armazena a imagem como BLOB
                    $produto->setNome($nomeProduto);
                    $produto->setValor($valorProduto);
                    $produto->setDescricao($descricaoProduto);
                    $produto->setId($idProduto);
                    // está caracterizado como a categoria 5, pois estava testando o banco como deve ser, se o catalogo de produtos forem separados por categorias.
                    $produto->setCategoria(5);

                    // Chamando o método de cadastro do produto
                    $crudProduto->editarProduto($produto->getId(), [
                        'nomeProduto' => $produto->getNome(),
                        'imagemProduto' => $produto->getImagem(),
                        'valorProduto' => $produto->getValor(),
                        'descricaoProduto' => $produto->getDescricao(),
                        'categoria' => $produto->getCategoria()
                    ]);

                    header("Location: .../homeFuncionario.php");
                    exit();

                } catch (Exception $excecao) {

                    echo "Erro ao editar o produto: " . $excecao->getMessage();
                    exit();

                }

            } else {

                echo 'O caminho do arquivo está vazio.';

            }
        } else {

            echo 'O campo imagem não foi enviado ou ocorreu um erro no upload.';

        }
    } else {

        echo 'Requisição inválida.';

    }

    

?>