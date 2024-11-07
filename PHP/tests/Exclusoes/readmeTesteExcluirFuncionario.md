# TESTE DE EXCLUSÃO DE FUNCIONÁRIOS COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de exclusão de funcionários implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de exclusão de funcionários estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes
O arquivo "testeExcluirFuncionario.php" contém dois métodos de testes para verificar a funcionalidade de exclusão de funcionário. Cada teste foca em diferentes cenários, como exclusão de um funcionário existente e tentativa de exclusão de um funcionário inexistente.

# Descrição dos Métodos de Testes
1. Teste de Exclusão de Funcionário Existente
O método "testExclusaoFuncionarioExistente()" verifica se um funcionário existente pode ser excluído corretamente. O teste espera que a exclusão retorne um número de registro no banco afetado maior que 0.

2. Teste de Exclusão de Funcionário Inexistente
O método "testExclusaoFuncionarioInexistente()" verifica se o sistema rejeita a exclusão de um funcionário inexistente. O teste espera que a função de exclusão retorne null.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Exclusoes/testeExcluirFuncionario.php


# Resultado dos Testes
1. testExclusaoFuncionarioExistente()
Descrição: Verifica se um funcionário existente é excluído corretamente.
Resultado Esperado: > 0
Resultado Obtido: > 0

2. testExclusaoFuncionarioInexistente()
Descrição: Verifica se o sistema rejeita a exclusão de um funcionário inexistente.
Resultado Esperado: null
Resultado Obtido: null

# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que a funcionalidade de exclusão de funcionário está funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.