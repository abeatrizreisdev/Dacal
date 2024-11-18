function criarBarraSuperior() {

    // Obtém o tipo de conta autenticada do elemento HTML.
    const tipoConta = document.getElementById('tipoConta').getAttribute('data-tipo');
    
    // Define o link da homepage com base no tipo de conta.
    let homepageLink;
    if (tipoConta === 'admin') {
        homepageLink = './homeAdm.php';
    } else if (tipoConta === 'funcionario') {
        homepageLink = './homeFuncionario.php';
    } else {
        homepageLink = './homeEmpresa.php';
    }
    
    // Cria o HTML da barra superior
    const barraSuperiorHTML = `
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">
        <ul class="nav-list">
            <li><a href="${homepageLink}">Homepage</a></li>
            <li><a href="catalogoProdutos.php">Catálogo</a></li>
            <li><a href="">Sobre Nós</a></li>
        </ul>
        <ul class="icons">
            <a href="./autenticacao/logout.php">
                <button class="sair">
                    <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
                </button>
            </a>
        </ul>
    </nav>
    `;
  
    // Insere o HTML no elemento com o ID "barraSuperior",
    const barraSuperiorElement = document.getElementById('barraSuperior');
    barraSuperiorElement.innerHTML = barraSuperiorHTML;
}

// Chama a função para criar a barra superior.
criarBarraSuperior();
