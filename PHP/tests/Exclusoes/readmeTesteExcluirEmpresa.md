# TESTE UNITÁRIOS DE EXCLUSÃO DE CLIENTES COM PHP UNIT


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de exclusão de clientes implementados no sistema, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de exclusão de clientes estejam funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo "testeExclusaoCliente.php" contém 2 métodos de testes para verificar a funcionalidade de exclusão de clientes. Cada teste foca em diferentes cenários, como exclusão de um cliente existente e tentativa de exclusão de um cliente inexistente.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1. Teste de Exclusão de Cliente Existente
O método "testExclusaoClienteExistente()" verifica se um cliente existente pode ser excluído corretamente. O teste espera que a exclusão retorne um número maior que 0 de contas afetadas no banco de dados.

## 2. Teste de Exclusão de Cliente Inexistente
O método "testExclusaoClienteInexistente()" verifica se o sistema rejeita a exclusão de um cliente inválido. O teste espera que a função de exclusão retorne null.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Exclusoes/TesteExclusaoCliente.php


# RESULTADO DOS TESTES:

## 1. testExclusaoClienteExistente
Descrição: verifica se um cliente cadastrado no sistema é excluído corretamente.

Resultado Esperado: valor maior que 0.

Resultado Obtido:  valor maior que 0.

## 2. testExclusaoClienteInexistente
Descrição: verifica se o sistema rejeita a exclusão de um cliente inválido.

Resultado Esperado: null.

Resultado Obtido: null.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que a funcionalidade de exclusão de cliente está funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.