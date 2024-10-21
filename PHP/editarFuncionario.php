<?php 

    require "./sessao/sessao.php";

    $sessaoFuncionario = new Sessao();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Beatriz Reis e Valter Filho">
    <meta name="description" content="Site de automoção da Dacal">
    <title>Dacal</title>
    <link rel="stylesheet" href="../CSS/editarPerfilFuncionarioAdm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<header>
    <div class="informativo_superior">
        <p>A EMPRESA QUE AUTOMATIZA O PEDIDO DOS SEUS ORÇAMENTOS</p>
    </div>

    <nav class="nav-superior">
        <img class="logoDacal" src="../IMAGENS/Homepage/logoDacal.png">

        <ul class="nav-list">
            <li><a href="./homeAdm.php">Homepage</li></a>
            <li><a href="">Catálogo</li></a>
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
</header>

<body class="fundo">
    <div class="homepage">
        <div class="menu">
            <br>
            <br>
            <a class="abas">
                <img src="../IMAGENS/HomeEmpresa/imgUser.png" class="imgPerfil">
                <div id="info">
                    <p>Bem-vindo(a),</p>
                    <p id="nomeEmpresa"> <?php echo $sessaoFuncionario->getValorSessao('nome'); ?> </p>
                    <button class="sairInfo" href="">
                        <img src="../IMAGENS/HomeEmpresa/sair.png" id="imgInfo" alt="">
                    </button>
                </div>
            </a>
            <br>
            <hr id="linhaMenu">
            <br>
            <a class="abas" href="./perfilFuncionario.php">
                <img src="../IMAGENS/HomeEmpresa/imgPerfil.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas">Meu Perfil</p>
                    <p class="descricaoAbas">Visualize e altere seus</p>
                    <p class="descricaoAbas">dados.</p>
                </div>
            </a>
            <br>
            <a class="abas" href="gerenciarContas.php">
                <img src="../IMAGENS/HomeEmpresa/imgGerenciar.png" class="imgPerfil">
                <div id="info">
                    <p class="tituloAbas"> Gerenciar Contas</p>
                    <p class="descricaoAbas">Gerenciar contas</p>
                    <p class="descricaoAbas">funcionários e empresas</p>
                </div>
            </a>
            
        </div>
        <section class="quadrado">
            
            <div class="geral">
            <h1> Informações da conta </h1>
                <div class="infoConta">
                    <div class="dadosGerais">
                        <h2 id="subtitulo"> Dados gerais </h2>

                        <form action="editarContaFuncionario/editarContaFuncionario.php" method="post" class="formDados">
                            <div class="infoGerais">

                                <div class="parteGeral">
                                    <input type="hidden" id="inputId" name="id" class="input" required >
                                </div>
                                
                                <div class="parteGeral">
                                    <p>Nome</p>
                                    <input type="text" id="inputNome" name="nome" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>CPF</p>
                                    <input type="text" id="inputCpf" name="cpf" class="input"  required>
                                </div>

                            </div>
                            <div class="infoGerais">

                                <div class="parteGeral">
                                    <p>Email</p>
                                    <input type="text" id="inputEmail" name="email" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Telefone</p>
                                    <input type="text" id="inputTelefone" name="telefone" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Cidade</p>
                                    <input type="text" id="inputCidade" name="cidade" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Estado</p>
                                    <input type="text" id="inputEstado" name="estado" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Bairro</p>
                                    <input type="text" id="inputBairro" name="bairro" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Logradouro</p>
                                    <input type="text" id="inputLogradouro" name="logradouro" class="input" required>
                                </div>

                                <div class="parteGeral">
                                    <p>Cep</p>
                                    <input type="text" id="inputCep" name="cep" class="input" required>
                                </div>

                            </div>

                            <button type="submit">Salvar Alterações</button>
                            
                        </form>

                        <div class="parteGeral">
                            
                            <form action="editarContaFuncionario/editarSenhaFuncionario.php" method="post">
                                <p>Senha</p>
                                <input type="password" id="inputSenha" name="senha" class="input" required >
                                <input type="hidden" id="idOcultoFunc" name="idOcultoFunc">
                                <button type="submit">AlterarSenha</button>
                            </form>
                                    
                        </div>

                        <a href="visualizarContasCadastradas.php"> <button>Página Anterior</button> </a>

                        
                        <button id="botaoExcluirConta">Excluir Conta</button>
                    

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/editarFuncionario_adm/carregarDadosFuncionario.js"></script>
    
</body>

</html>