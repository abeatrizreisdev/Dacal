<?php

require './sessao/sessao.php';

$sessao = new Sessao();
$erro = $sessao->getValorSessao('erro');
$sessao->excluirChaveSessao('erro'); // Remove a mensagem de erro após exibi-la

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
    <link rel="stylesheet" href="../CSS/cadastroEmpresa.css">
</head>
<header>
</header>

<body>
    <div id="homeGeral">
        <img src="../IMAGENS/Homepage/imagemDacalF.png" id="imagemInicial">
        <form action="crud/receberFormulariosDeCadastros/enviarDadosCadastroCliente.php" method="post" id="formLogin"
            class="formularioLogin">
            <div class="infoConta">
                <div class="dadosGerais">
                    <br>
                    <img src="../IMAGENS/Homepage/logoDacal.png" id="logoDacal" alt="logoDacal">
                    <p id="titulo">CADASTRO</p>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>CNPJ da Empresa</p>
                            <input type="text" id="cnpjEmpresa" name="cnpjEmpresa" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>Razão Social</p>
                            <input type="text" id="razaoSocial" name="razaoSocial" class="input" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Inscrição Estadual</p>
                            <input type="text" id="inscricaoEstadual" name="inscricaoEstadual" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>Telefone</p>
                            <input type="text" id="telefone" name="telefone" class="input" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Email</p>
                            <input type="email" id="email" name="email" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>Senha</p>
                            <input type="text" id="senha" name="senha" class="input" required>
                        </div>
                    </div>
                    <br>
                    <div class="endereço">
                        <p id="">Endereço</p>
                        <input type="text" id="estado" name="estado" class="inputAPI" required>
                        <input type="text" id="municipio" name="municipio" class="inputAPI" required>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Logradouro</p>
                            <input type="text" id="logradouro" name="logradouro" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>Nº</p>
                            <input type="text" id="numeroEndereco" name="numeroEndereco" class="input" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Bairro</p>
                            <input type="text" id="bairro" name="bairro" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>CEP</p>
                            <input type="text" id="cep" name="cep" class="input" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" id="btnCadastro">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../JS/cadastrarCliente/validacoesCadastro.js"></script>
</body>


<footer id="footer">
</footer>

</html>