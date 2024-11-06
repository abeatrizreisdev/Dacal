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

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $idProduto = $_POST['idProduto'];
        $nomeProduto = $_POST['nomeProduto'];
        $valorProduto = floatval(str_replace(',', '.', $_POST['precoProduto']));
        $descricaoProduto = $_POST['descricaoProduto'];
        $categoriaProduto = $_POST['categoriaProduto'];

        // Verifica se o arquivo de imagem foi enviado e está sem erros.
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            
            $imagemProduto = $_FILES['imagem'];
            $nomeArquivo = basename($imagemProduto['name']);
            $caminhoRelativo = 'IMAGENS/Produtos/' . $nomeArquivo;
            $caminhoDestino = '../../../' . $caminhoRelativo;

            // Move o arquivo para o diretório de destino.
            if (!move_uploaded_file($imagemProduto['tmp_name'], $caminhoDestino)) {
                echo json_encode(['error' => 'Falha ao mover o arquivo para o destino final.']);
                exit();
            }

        } else {

            // Se nenhuma nova imagem foi enviada, mantem a imagem atual.
            $caminhoRelativo = $_POST['imagemAtual'];

        }

        try {

            $produto = new Produto();
            
            // Define os atributos do produto.
            $produto->setImagem($caminhoRelativo); // Armazena o caminho relativo da imagem.
            $produto->setNome($nomeProduto);
            $produto->setValor($valorProduto);
            $produto->setDescricao($descricaoProduto);
            $produto->setCategoria($categoriaProduto);

            // Chamando o método de atualização do produto.
            $resultadoEdicaoProduto = $crudProduto->editarProduto($idProduto, [
                'nomeProduto' => $produto->getNome(),
                'imagemProduto' => $produto->getImagem(),
                'valorProduto' => $produto->getValor(),
                'descricaoProduto' => $produto->getDescricao(),
                'categoria' => $produto->getCategoria()
            ]);

            if ($resultadoEdicaoProduto) {

                echo json_encode(['sucesso' => true, 'mensagem' => 'Edição do produto feita com sucesso!']);
                exit();

            } else {

                echo json_encode(['erro' => true, 'mensagem' => 'Erro na edição do produto.']);            
                exit();

            }

        } catch (Exception $excecao) {

            echo json_encode(['erro' => 'Erro ao atualizar o produto: ' . $excecao->getMessage()]);
            exit();

        }

    } else {

        echo json_encode(['erro' => 'Requisição inválida.']);
        exit();

    }
?>
