# TESTE DE EXCLUSÃO DE CLIENTES COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de exclusão de clientes implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de exclusão de clientes estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes
O arquivo TesteExclusaoCliente.php contém dois métodos de testes para verificar a funcionalidade de exclusão de clientes. Cada teste foca em diferentes cenários, como exclusão de um cliente existente e tentativa de exclusão de um cliente inexistente.

# Descrição dos Métodos de Testes
1. Teste de Exclusão de Cliente Existente
O método testExclusaoClienteExistente() verifica se um cliente existente pode ser excluído corretamente. O teste espera que a exclusão retorne um número maior que 0.

2. Teste de Exclusão de Cliente Inexistente
O método testExclusaoClienteInexistente() verifica se o sistema rejeita a exclusão de um cliente inexistente. O teste espera que a função de exclusão retorne null.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Exclusoes/TesteExclusaoCliente.php


# Resultado dos Testes
1. testExclusaoClienteExistente
Descrição: Verifica se um cliente existente é excluído corretamente.
Resultado Esperado: > 0
Resultado Obtido: > 0

2. testExclusaoClienteInexistente
Descrição: Verifica se o sistema rejeita a exclusão de um cliente inexistente.
Resultado Esperado: null
Resultado Obtido: null


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de exclusão de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.