function exibirProdutos() {

    // Crie um elemento div para o pop-up
    var produto = document.createElement('div');
    produto.classList.add('produto'); // Adicione uma classe para estilizar

    // Defina o conteúdo do pop-up
    produto.innerHTML = `
    <div class="exibirProdutos">
    <img src="${imagemProduto.produto}">
    </div>
    `
}