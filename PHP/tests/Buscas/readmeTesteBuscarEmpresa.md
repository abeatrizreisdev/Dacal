# TESTE DE BUSCA DE CLIENTES COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de busca de informações de clientes implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de busca de clientes estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, o PHPUnit será instalado também:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# Estrutura dos Testes
O arquivo TesteBuscarCliente.php contém cinco métodos de testes para verificar a funcionalidade de busca de informações dos clientes. Cada teste foca em diferentes cenários, como busca por ID, busca por nome e busca de todos os clientes.


# Descrição dos Métodos de Testes
1. Teste de Busca de Cliente por ID Existente
O método testBuscarInfoClienteExistente() verifica se um cliente existente pode ser buscado corretamente por seu ID. O teste espera que a busca retorne um resultado não nulo.

2. Teste de Busca de Cliente por ID Inexistente
O método testBuscarInfoClienteInexistente() verifica se a busca por um ID inexistente corretamente retorna null.

3. Teste de Busca de Cliente por Nome Existente
O método testBuscarClientePeloNomeExistente() verifica se um cliente existente pode ser buscado corretamente por seu nome. O teste espera que a busca retorne um resultado não nulo.

4. Teste de Busca de Cliente por Nome Inexistente
O método testBuscarClientePeloNomeInexistente() verifica se a busca por um nome inexistente corretamente retorna null.

5. Teste de Busca de Todos os Clientes
O método testBuscarInfoTodosClientes() verifica se a busca de todos os clientes retorna uma lista não vazia de clientes.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Buscas/TesteBuscarCliente.php


# Resultado dos Testes
1. testBuscarInfoClienteExistente
Descrição: Verifica se um cliente existente pode ser buscado corretamente por seu ID.
Resultado Esperado: Not null
Resultado Obtido: Not null

2. testBuscarInfoClienteInexistente
Descrição: Verifica se a busca por um ID inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

3. testBuscarClientePeloNomeExistente
Descrição: Verifica se um cliente existente pode ser buscado corretamente por seu nome.
Resultado Esperado: Not null
Resultado Obtido: Not null

4. testBuscarClientePeloNomeInexistente
Descrição: Verifica se a busca por um nome inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

5. testBuscarInfoTodosClientes
Descrição: Verifica se a busca de todos os clientes retorna uma lista não vazia de clientes.
Resultado Esperado: Not null
Resultado Obtido: Not null


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de busca de informações de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.