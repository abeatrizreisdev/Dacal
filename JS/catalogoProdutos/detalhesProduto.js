document.addEventListener("DOMContentLoaded", function() {

    var urlParams = new URLSearchParams(window.location.search);
    var produtoId = urlParams.get('id');
    var fromPage = urlParams.get('from') || 'catalogo'; // Padrão para 'catalogo' se não especificado.

    if (!produtoId) {

        document.querySelector('.quadrado').innerHTML = "ID do produto não especificado.";
        return;

    }

    fetch('./buscarProdutos/pegarProduto.php?id=' + produtoId)
        .then(resposta => resposta.json())
        .then(dados => {


            if (dados.error) {

                document.querySelector('.quadrado').innerHTML = dados.error;
                return;

            }

            const imagemProduto = criarImagemProduto(dados.imagemProduto);
            const infoProduto = criarInfoProduto(dados);
            const botoesNavegacao = criarBotoesNavegacao(fromPage);

            let html = `
                <div class='containerDetalhesProduto'>
                    ${imagemProduto}
                    ${infoProduto}
                </div>
                ${botoesNavegacao}
            `;

            document.querySelector('.quadrado').innerHTML = html;

            // Adiciona os listeners para os botões de quantidade e formulário somente se for necessário
            if (dados.contaAutenticada !== 'admin' && dados.contaAutenticada !== 'funcionario') {
                adicionarListeners();
            }

        })
        .catch(erro => console.log('Erro:', erro));
});

function criarImagemProduto(imagemProduto) {

    // Atualizado para usar o caminho relativo da imagem
    return `
    <div class="produto">
        <div class='containerImagemProduto'>
            <img src='../${imagemProduto}' alt='Produto' class='imagemProduto'>
        </div>
    `;

}

function criarInfoProduto(dados) {

    return `
        <div class='containerInfoProduto'>
            <h2 class='tituloProduto'>${dados.nomeProduto}</h2>
            <div class='containerDescricaoValor'>
                <p class='valorProduto'>R$ ${dados.valorProduto}</p>
            </div>
                <p class='codigoProduto'>Código: ${dados.codigoProduto}</p>
            ${dados.contaAutenticada !== 'admin' && dados.contaAutenticada !== 'funcionario' ? criarFormularioOrcamento(dados) : ''}
         </div>
        </div>
    </div>
    <p id='tituloDescricao'>Descrição:</p>
    <div class='containerDescricao'>
        <div class='alinharContainer'>
            <p class='descricaoProduto'>${dados.descricaoProduto}</p>
        </div>
    </div>
    `;

}

function criarFormularioOrcamento(dados) {

    return `
        <form class='formOrcamento' id='formOrcamento'>
            <div class='inputQuantidadeContainer'>
                <label for='quantidade' class='labelQuantidade'>Adicionar no orçamento:</label>
                <button type='button' class='quantidadeBtn' id='quantidadeMenos'>-</button>
                <input type='number' id='quantidade' name='quantidade' value='1' min='1' required>
                <button type='button' class='quantidadeBtn' id='quantidadeMais'>+</button>
            </div>
            <input type='hidden' id='quantidadeFinal' name='quantidadeFinal' value='1'>
            <input type='hidden' name='produto_id' value='${dados.codigoProduto}'>
            <input type='hidden' name='nomeProduto' value='${dados.nomeProduto}'>
            <input type='hidden' name='valorProduto' value='${dados.valorProduto}'>
            <input type='hidden' name='imagemProduto' value='${dados.imagemProduto}'>
            <input type='hidden' name='categoriaProduto' value='${dados.categoria}'>
            <input type='hidden' name='adicionar' value='true'> 
            <button type='submit' name='adicionar' class='botaoAdicionar'>Adicionar</button>
        </form>
    </div>
    
    `;

}

function criarBotoesNavegacao(voltarParaPagina) {

    var voltarCatalogoURL = voltarParaPagina === 'orcamento' ? '../PHP/realizarOrcamento.php' : '../PHP/catalogoProdutos.php';

    return `
        <div class='containerBotoes'>
            <a href='${voltarCatalogoURL}'>
                <button class='botaoVoltar'>Voltar para o Catálogo</button>
            </a>
        </div>
    `;

}

function adicionarListeners() {

    const quantidadeMenos = document.getElementById('quantidadeMenos');
    const quantidadeMais = document.getElementById('quantidadeMais');
    const formOrcamento = document.getElementById('formOrcamento');

    if (quantidadeMenos) {

        quantidadeMenos.addEventListener('click', function() {

            var quantidade = document.getElementById('quantidade');

            if (quantidade.value > 1) {
                quantidade.value--;
                document.getElementById('quantidadeFinal').value = quantidade.value;
            }

        });

    }

    if (quantidadeMais) {

        quantidadeMais.addEventListener('click', function() {
            var quantidade = document.getElementById('quantidade');
            quantidade.value++;
            document.getElementById('quantidadeFinal').value = quantidade.value;
        });

    }

    if (formOrcamento) {

        formOrcamento.addEventListener('submit', function(event) {

            event.preventDefault(); 
            
            var formData = new FormData(this);
            var botaoAdicionar = document.querySelector('.botaoAdicionar');
            botaoAdicionar.disabled = true;

            fetch('./buscarProdutos/addNoOrcamento.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(resposta => resposta.text())
            .then(dados => {

                try {

                    dados = JSON.parse(dados);

                    if (dados.sucesso) {

                        toastr.success(dados.mensagem);
                        setTimeout(function() {
                            window.location.href = './realizarOrcamento.php';
                        }, 1500);

                    } else {

                        toastr.error('Erro inesperado. Por favor, tente novamente.');

                    }

                } catch (erro) {

                    console.error('Erro ao processar JSON:', erro);
                    toastr.error('Erro inesperado. Por favor, tente novamente.');

                }
            })
            .catch(erro => console.log('Erro:', erro))
            .finally(() => {

                botaoAdicionar.disabled = false;

            });

        });
        
    }

}
