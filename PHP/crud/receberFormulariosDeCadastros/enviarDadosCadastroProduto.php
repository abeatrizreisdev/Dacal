<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudProduto.php";
    require "../../sessao/sessao.php";
    require "../../entidades/produto.php";

    $conexao = new ConexaoBD();
    $conexao->setEschemaBD("dacal");
    $conexao->setHostBD("localhost");
    $conexao->setPortaBD(3306);
    $conexao->setEschemaBD("dacal");
    $conexao->setSenhaBD("96029958va");
    $conexao->setUsuarioBD("root");
    $conexao->getConexao(); // Iniciando a conexão com o banco.
    
    $crudProduto = new CrudProduto($conexao);

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

                    // Chamando o método de cadastro do produto
                    $crudProduto->cadastrarProduto([
                        'nomeProduto' => $produto->getNome(),
                        'imagemProduto' => $produto->getImagem(),
                        'valorProduto' => $produto->getValor(),
                        'descricaoProduto' => $produto->getDescricao()
                    ]);

                    echo 'Produto cadastrado com sucesso!';

                } catch (Exception $excecao) {

                    echo "Erro ao cadastrar o produto: " . $excecao->getMessage();

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