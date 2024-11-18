function criarBarraSuperior() {
    
    // Cria o HTML da barra superior
    const barraSuperiorHTML = `
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="<?php
            if ($sessao->getValorSessao('tipoConta') === 'admin') {
                echo './homeAdm.php';
            } elseif ($sessao->getValorSessao('tipoConta') === 'funcionario') {
                echo './homeFuncionario.php';
            } else {
                echo './homeEmpresa.php';
            }
            ?>">Homepage
            </li></a>
            <li><a href="catalogoProdutos.php">Catálogo</li></a>
            <li><a href="">Sobre Nós</li></a>
        </ul>
        <ul class="icons">
            <a href="./autenticacao/logout.php">
                <button class="sair" href="/IMAGENS/Homepage/logoDacal.png">
                    <img src="../IMAGENS/HomeEmpresa/sair.png" class="sair">
                </button>
            </a>
        </ul>
    </nav>
    `;
  
    // Busca o elemento com o ID "barraSuperior" e insere o HTML
    const barraSuperiorElement = document.getElementById('barraSuperior');
    barraSuperiorElement.innerHTML = barraSuperiorHTML;
  }
  
  // Chama a função para criar a barra superior
  criarBarraSuperior();