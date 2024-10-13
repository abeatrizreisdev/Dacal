<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .selecionado {
            background-color: #f44f4f; 
        }
    </style>
</head>
<body>
    <button id="empresa" class="selecionado">Empresa</button>
    <button id="funcionario">Funcionário</button>
    <div id="busca-container">
        <!-- Input de busca para empresa será inserido aqui -->
    </div>
    <div id="container-funcionarios"></div>
    <p id="mensagem-erro"></p>

    <script src="../JS/formatacoes.js"></script>
    <script src="../JS/buscarContaCliente.js"></script>
    <script src="../JS/buscarContaFuncionario.js"></script>
    <script>

        // Exibindo por padrão na página todas as contas dos clientes cadastrados.
        configurarBuscaEmpresa()
        buscarTodasEmpresas()
    </script>
</body>
</html>
