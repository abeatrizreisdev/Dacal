<?php 

    require "../conexaoBD/conexaoBD.php";
    require "../crud/crudProduto.php";
    require "../conexaoBD/configBanco.php";

    $conexao = new ConexaoBD();
    $conexao->setHostBD(BD_HOST);
    $conexao->setPortaBD(BD_PORTA);
    $conexao->setEschemaBD(BD_ESCHEMA);
    $conexao->setSenhaBD(BD_PASSWORD);
    $conexao->setUsuarioBD(BD_USERNAME);
    $conexao->getConexao(); // Iniciando a conexão com o banco.

    $crudProduto = new CrudProduto($conexao);

    $resposta = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        try {

            $idProduto = $_POST['idProduto'];

            // Recuperar os detalhes do produto para obter o caminho da imagem.
            $produtoInfo = $crudProduto->buscarInfoProduto($idProduto);
            
            if ($produtoInfo && isset($produtoInfo['imagemProduto'])) {

                $caminhoRelativo = $produtoInfo['imagemProduto'];
                $caminhoDestino = '../../' . $caminhoRelativo;

                if (is_file($caminhoDestino)) {

                    // Registrar log de depuração no servidor.
                    error_log("Arquivo encontrado no caminho: $caminhoDestino");

                    $resultadoExclusao = $crudProduto->excluirProduto($idProduto);

                    if ($resultadoExclusao > 0) {

                        // Excluir o arquivo de imagem do sistema de arquivos.
                        if (unlink($caminhoDestino)) {

                            $resposta = ['status' => 'sucesso', 'mensagem' => 'Produto excluído com sucesso.'];

                        } else {

                            $resposta = ['status' => 'erro', 'mensagem' => 'Produto excluído, mas falha ao excluir a imagem.'];

                        }

                    } else {

                        $resposta = ['status' => 'erro', 'mensagem' => 'Erro ao excluir o produto.'];

                    }

                } else {

                    error_log("Arquivo não encontrado no caminho: $caminhoDestino");
                    $resposta = ['status' => 'erro', 'mensagem' => 'Produto excluído, mas a imagem não foi encontrada.'];

                }

            } else {

                $resposta = ['status' => 'erro', 'mensagem' => 'Produto não encontrado ou imagem não definida.'];

            }

        } catch (Exception $excecao) {

            error_log('Erro ao excluir o produto: ' . $excecao->getMessage()); // Log para depuração
            $resposta = ['status' => 'erro', 'mensagem' => 'Erro ao excluir o produto: ' . $excecao->getMessage()];

        }

    } else {

        $resposta = ['status' => 'erro', 'mensagem' => 'Método de requisição inválido.'];

    }

    echo json_encode($resposta);

?>
