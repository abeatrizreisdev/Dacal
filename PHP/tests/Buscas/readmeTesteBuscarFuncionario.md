# TESTE DE BUSCA DE FUNCIONÁRIOS COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de busca de informações de funcionários implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de busca de funcionários estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, o PHPUnit será instalado também:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# Estrutura dos Testes
O arquivo testeBuscarFuncionario.php contém cinco métodos de testes para verificar a funcionalidade de busca de informações dos funcionários. Cada teste foca em diferentes cenários, como busca por ID, busca por CPF e busca de todos os funcionários.


# Descrição dos Métodos de Testes
1. Teste de Busca de Funcionário por ID Existente
O método testBuscarInfoFuncionarioExistente() verifica se um funcionário existente pode ser buscado corretamente por seu ID. O teste espera que a busca retorne um resultado não nulo.

2. Teste de Busca de Funcionário por ID Inexistente
O método testBuscarInfoFuncionarioInexistente() verifica se a busca por um ID inexistente corretamente retorna null.

3. Teste de Busca de Funcionário por CPF Existente
O método testBuscarFuncionarioPeloCpfExistente() verifica se um funcionário existente pode ser buscado corretamente por seu CPF. O teste espera que a busca retorne um resultado não nulo.

4. Teste de Busca de Funcionário por CPF Inexistente
O método testBuscarFuncionarioPeloCpfInexistente() verifica se a busca por um CPF inexistente corretamente retorna null.

5. Teste de Busca de Todos os Funcionários
O método testBuscarInfoTodosFuncionarios() verifica se a busca de todos os funcionários retorna uma lista não vazia de funcionários.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Buscas/TesteBuscarFuncionario.php


# Resultado dos Testes
1. testBuscarInfoFuncionarioExistente()
Descrição: Verifica se um funcionário existente pode ser buscado corretamente por seu ID.
Resultado Esperado: Not null
Resultado Obtido: Not null

2. testBuscarInfoFuncionarioInexistente()
Descrição: Verifica se a busca por um ID inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

3. testBuscarFuncionarioPeloCpfExistente()
Descrição: Verifica se um funcionário existente pode ser buscado corretamente por seu CPF.
Resultado Esperado: Not null
Resultado Obtido: Not null

4. testBuscarFuncionarioPeloCpfInexistente()
Descrição: Verifica se a busca por um CPF inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

5. testBuscarInfoTodosFuncionarios()
Descrição: Verifica se a busca de todos os funcionários retorna uma lista não vazia de funcionários.
Resultado Esperado: Not null
Resultado Obtido: Not null


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de busca de informações de funcionários estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.