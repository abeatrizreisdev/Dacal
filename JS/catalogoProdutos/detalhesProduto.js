 document.addEventListener("DOMContentLoaded", function() {
    
    var urlParams = new URLSearchParams(window.location.search);
    var produtoId = urlParams.get('id'); // Obtém o ID do produto da URL
    if (!produtoId) {
        document.querySelector('.quadrado').innerHTML = "ID do produto não especificado.";
        return;
    }

    fetch('./buscarProdutos/pegarProduto.php?id=' + produtoId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.querySelector('.quadrado').innerHTML = data.error;
                return;
            }
            
            //console.log(data);

            var html = "<div class='containerDetalhesProduto'>";
            html += "<div class='containerImagemProduto'>";
            html += "<img src='data:image/png;base64," + data.imagemProduto + "' alt='Produto' class='imagemProduto'>";
            html += "</div>";
            html += "<div class='containerInfoProduto'>";
            html += "<h2 class='tituloProduto'>" + data.nomeProduto + "</h2>";
            html += "<div class='containerDescricaoValor'>";
            html += "<p class='valorProduto'>R$ " + data.valorProduto + "</p>";
            html += "<div class='containerDescricao'>";
            html += "<p id='tituloDescricao'>Descrição:</p>";
            html += "<p class='descricaoProduto'>" + data.descricaoProduto + "</p>";
            html += "</div>";
            html += "</div>";

            if (data.contaAutenticada !== 'admin' && data.contaAutenticada !== 'funcionario') {
                html += "<form class='formOrcamento' id='formOrcamento'>";
                html += "<div class='inputQuantidadeContainer'>";
                html += "<label for='quantidade' class='labelQuantidade'>Adicionar no orçamento:</label>";
                html += "<button type='button' class='quantidadeBtn' id='quantidadeMenos'>-</button>";
                html += "<input type='number' id='quantidade' name='quantidade' value='1' min='1' required>";
                html += "<button type='button' class='quantidadeBtn' id='quantidadeMais'>+</button>";
                html += "</div>";
                html += "<input type='hidden' id='quantidadeFinal' name='quantidadeFinal' value='1'>";
                html += "<input type='hidden' name='produto_id' value='" + data.codigoProduto + "'>";
                html += "<input type='hidden' name='nomeProduto' value='" + data.nomeProduto + "'>";
                html += "<input type='hidden' name='valorProduto' value='" + data.valorProduto + "'>";
                html += "<input type='hidden' name='imagemProduto' value='" + data.imagemProduto + "'>";
                html += "<input type='hidden' name='categoriaProduto' value='" + data.categoria + "'>";
                html += "<input type='hidden' name='adicionar' value='true'>"; // Adiciona a chave 'adicionar';
                html += "<button type='submit' name='adicionar' class='botaoAdicionar'>Adicionar</button>";
                html += "</form>";
            }
            
            html += "</div>";
            html += "</div>";

            var voltarCatalogoURL = (data.contaAutenticada !== 'admin' && data.contaAutenticada !== 'funcionario') ? '../realizarOrcamento.php' : '../catalogoProdutos.php';
            html += "<div class='containerBotoes'>";
            html += "<a href='" + voltarCatalogoURL + "'><button class='botaoVoltar'>Voltar para o Catálogo</button></a>";
            
            document.querySelector('.quadrado').innerHTML = html;
            
            // Adiciona os listeners para os botões de quantidade
            document.getElementById('quantidadeMenos').addEventListener('click', function() {
                var quantidade = document.getElementById('quantidade');
                if (quantidade.value > 1) {
                    quantidade.value--;
                    document.getElementById('quantidadeFinal').value = quantidade.value;
                }
            });
            
            document.getElementById('quantidadeMais').addEventListener('click', function() {
                var quantidade = document.getElementById('quantidade');
                quantidade.value++;
                document.getElementById('quantidadeFinal').value = quantidade.value;
            });

            // Adiciona o listener para o envio do formulário.
            document.getElementById('formOrcamento').addEventListener('submit', function(event) {
                
                event.preventDefault(); // Previne o envio padrão do formulário.
                var formData = new FormData(this);
                
                //console.log(Array.from(formData.entries()));
                
                fetch('./buscarProdutos/addNoOrcamento.php', { 
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.text()) 
                .then(data => {

                    try {
                        data = JSON.parse(data); // Converte para JSON se possível

                        if (data.success) {

                            toastr.success(data.message);
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
                .catch(error => console.log('Erro:', error));

            });
            
        })
        .catch(error => console.log('Erro:', error));

});