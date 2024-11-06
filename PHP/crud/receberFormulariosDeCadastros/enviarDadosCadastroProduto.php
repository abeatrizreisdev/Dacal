<?php 

    require "../../conexaoBD/conexaoBD.php";
    require "../crudProduto.php";
    require "../../sessao/sessao.php";
    require "../../entidades/produto.php";
    require "../../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudProduto = new CrudProduto($conexao);

    // Verifica se o método de requisição é POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Verifica se o arquivo de imagem foi enviado
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            
            $imagemProduto = $_FILES['imagem'];
            $nomeArquivo = basename($imagemProduto['name']);
            $caminhoRelativo = 'IMAGENS/Produtos/' . $nomeArquivo;
            $caminhoDestino = '../../../' . $caminhoRelativo;

            // Verifica se o diretório existe e cria se necessário
            if (!is_dir(dirname($caminhoDestino))) {
                mkdir(dirname($caminhoDestino), 0777, true);
            }

            // Verifica se o caminho temporário do arquivo não está vazio
            if (!empty($imagemProduto['tmp_name'])) {

                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($imagemProduto['tmp_name'], $caminhoDestino)) {
                    
                    // Processa os outros campos do formulário
                    $nomeProduto = $_POST['nome'];
                    $valorProduto = floatval(str_replace(',', '.', $_POST['valor']));
                    $descricaoProduto = $_POST['descricao'];
                    $categoriaProduto = $_POST['categoriaProduto'];

                    try {

                        // Cria uma nova instância do Produto
                        $produto = new Produto();
                        
                        // Define os atributos do produto
                        $produto->setImagem($caminhoRelativo); // Armazena o caminho relativo da imagem
                        $produto->setNome($nomeProduto);
                        $produto->setValor($valorProduto);
                        $produto->setDescricao($descricaoProduto);
                        $produto->setCategoria($categoriaProduto);

                        // Chamando o método de cadastro do produto
                        $crudProduto->cadastrarProduto([
                            'nomeProduto' => $produto->getNome(),
                            'imagemProduto' => $produto->getImagem(),
                            'valorProduto' => $produto->getValor(),
                            'descricaoProduto' => $produto->getDescricao(),
                            'categoria' => $produto->getCategoria()
                        ]);
                        
                        $sessao = new Sessao();

                        header("Location: ../../catalogoProdutos.php?statusCadastroProduto=sucesso");
                        exit();
                        
                    } catch (Exception $excecao) {

                        echo "Erro ao cadastrar o produto: " . $excecao->getMessage();
                        header("Location: ../../catalogoProdutos.php?statusCadastroProduto=erro");
                        exit();

                    }

                } else {

                    echo 'Falha ao mover o arquivo para o destino final.';

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
