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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                    <img src="../IMAGENS/Homepage/logoDacal.png" id="logoDacal" alt="logoDacal">
                    <p id="titulo">CADASTRO</p>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Razão Social</p>
                            <input type="text" id="razaoSocial" name="razaoSocial" class="input" placeholder="Digite a Razão Social" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>CNPJ da Empresa</p>
                            <input type="text" id="cnpjEmpresa" name="cnpjEmpresa" class="input" placeholder="Digite o CNPJ da Empresa" required>
                        </div>
                        <div class="parteGeral">
                            <p>Nome Fantasia</p>
                            <input type="text" id="nomeFantasia" name="nomeFantasia" class="input" placeholder="Máximo de 21 caracteres" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Inscrição Estadual</p>
                            <input type="text" id="inscricaoEstadual" name="inscricaoEstadual" placeholder="Digite a inscricao Estadual" class="input" required>
                        </div>
                        <div class="parteGeral">
                            <p>Telefone</p>
                            <input type="text" id="telefone" name="telefone" class="input" placeholder="Digite o número de Telefone" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Email</p>
                            <input type="email" id="email" name="email" class="input" placeholder="Digite o endereço E-mail" required>
                        </div>
                        <div class="parteGeral">
                            <p>Senha</p>
                            <input type="text" id="senha" name="senha" class="input" placeholder="Digite a senha" required>
                        </div>
                    </div>
                    <div class="endereço">
                        <p id="">Endereço</p>
                        <select id="estado" name="estado" class="inputAPI" required>
                            <option value="">Selecione um estado</option>
                        </select>
                        <select id="municipio" name="municipio" class="inputAPI" required>
                            <option value="">Selecione um município</option>
                        </select>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Logradouro</p>
                            <input type="text" id="logradouro" name="logradouro" class="input" placeholder="Digite a Rua/Avenida" required>
                        </div>
                        <div class="parteGeral">
                            <p>Nº</p>
                            <input type="text" id="numeroEndereco" name="numeroEndereco" class="input" placeholder="Número" required>
                        </div>
                    </div>
                    <div class="infoGerais">
                        <div class="parteGeral">
                            <p>Bairro</p>
                            <input type="text" id="bairro" name="bairro" class="input" placeholder="Digite o Bairro" required>
                        </div>
                        <div class="parteGeral">
                            <p>CEP</p>
                            <input type="text" id="cep" name="cep" class="input" placeholder="Digite o CEP da cidade" required>
                        </div>
                    </div>
                    <label>
                        <input type="checkbox" id="checkbox" required>
                        Declaro que as informações acima são verdadeiras
                    </label>
                    <br>
                    <button type="submit" id="btnCadastro">Cadastrar</button>
                    <div>
                    <a href="../login.php" id="btnCancelar">Cancelar</a>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../JS/cadastrarCliente/validacoesCadastro.js"></script>
    <script src="../JS/scriptsApi/ibge.js"></script>
</body>


<footer id="footer">
</footer>

</html>