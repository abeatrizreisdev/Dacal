<?php
require '../conexaoBD/conexaoBD.php';
require "../crud/crudProduto.php";
require "../conexaoBD/configBanco.php";
require "../sessao/sessao.php";

$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco.

$sessao = new Sessao();
$crudProduto = new CrudProduto($conexao);

if (isset($_GET['produtoNome'])) {

    $nomeProduto = $_GET['produtoNome'];

    $produtos = $crudProduto->buscarProdutosPorNome($nomeProduto); 

    if ($produtos) {
        
        foreach ($produtos as $produto) {

            $idProduto = $produto['codigoProduto'];
            $imagem_base64 = base64_encode($produto['imagemProduto']); // Converte a imagem do produto que está salva no banco de dados no formato BLOB para base64
            $tipoConta = $sessao->getValorSessao('tipoConta');

            // Verifica se o usuário é funcionário ou admin
            if ($tipoConta == "funcionario" || $tipoConta == "admin") {

                echo "<div class='produtoEspecifico'>";
                echo "<a class='linkDoProduto' href='./buscarProdutos/detalhesProduto.php?id=$idProduto'>" . "<img src='data:image/png;base64," . $imagem_base64 . "' alt='" . "'> </a>";
                echo "<div class='botoesProduto'>";
                echo "<a class='botao' id='botaoVisualizar' href='./buscarProdutos/detalhesProduto.php?id=$idProduto''>" . "<button>Visualizar" . "</button>" . "</a>";
                echo "<a class='botao' id='botaoRemover'>" . "<button onclick='excluirProduto($idProduto)'>Remover" . "</button></a>";
                echo "<a class='botao' id='botaoEditar' href='./editarProduto2.php?id=$idProduto'>" . "<button>Editar" . "</button></a>";
                echo "</div>";
                echo "</div>"; // Fechamento da div 'produtoEspecifico'

            } else {

                echo "<div class='produtoEspecifico'>";
                echo "<a class='linkDoProduto' href='./buscarProdutos/detalhesProduto.php?id=$idProduto'>" . "<img src='data:image/png;base64," . $imagem_base64 . "' alt='" . "'> </a>";
                echo "<a class='visualizarDetalhes' href='./buscarProdutos/detalhesProduto.php?id=$idProduto''>" . "<button>Visualizar Detalhes" . "</button>" . "</a>";
                echo "</div>"; // Fechamento da div 'produtoEspecifico'

            }
        }

    } else {

        echo "<div>Nenhum produto encontrado com este nome. </div>";

    }
} else {

    echo "<div>Valor do nome do produto inválido. </div>";
    
}
?>
