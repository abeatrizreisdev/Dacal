# TESTES UNITÁRIOS DE BUSCA DE CONTAS CLIENTES COM PHP UNIT:


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de busca de informações de contas do tipo cliente implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de busca de contas do tipo cliente estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, O PHPUnit SERÁ INSTALADO TAMBÉM:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# ESTRUTURA DOS TESTES:
O arquivo "TesteBuscarCliente.php" contém 5 métodos de testes para verificar a funcionalidade de busca de informações dos clientes. Cada teste foca em diferentes cenários, como busca por ID, busca por nome e busca de todos os clientes.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1. Teste de Busca de Cliente por ID Existente
O método "testBuscarInfoClienteExistente()" verifica se um cliente existente (cadastrado no sistema) pode ser buscado corretamente por seu ID. O teste espera que a busca retorne um resultado não nulo (array associativo com as informações da conta encontrada).

## 2. Teste de Busca de Cliente por ID Inexistente
O método "testBuscarInfoClienteInexistente()" verifica se a busca por uma conta do tipo cliente, pesquisada por um ID inexistente,corretamente retorna null.

## 3. Teste de Busca de Cliente por Nome Fantasia Existente
O método "testBuscarClientePeloNomeExistente()" verifica se um cliente cadastrado no sistema pode ser buscado corretamente por seu Nome Fantasia. O teste espera que a busca retorne um resultado não nulo.

## 4. Teste de Busca de Cliente por Nome Fantasia Inexistente
O método "testBuscarClientePeloNomeInexistente()" verifica se a busca por um cliente cadastrado no sistema, pesquisado por um nome inexistente, corretamente retorna null.

## 5. Teste de Busca de Todos os Clientes
O método "testBuscarInfoTodosClientes()" verifica se a busca de todos os clientes retorna uma lista de clientes cadastrados no sistema.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Buscas/TesteBuscarCliente.php


# RESULTADO DOS TESTES:

## 1. testBuscarInfoClienteExistente()
Descrição: verifica se um cliente, cadastrado no sistema, pode ser buscado corretamente por seu ID.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 2. testBuscarInfoClienteInexistente()
Descrição: verifica se a busca por um cliente, não cadastrado no sistema, buscado por um ID inexistente, corretamente retorna null.

Resultado Esperado: null.

Resultado Obtido: null.

## 3. testBuscarClientePeloNomeExistente()
Descrição: verifica se um cliente, cadastrado no sistema, pode ser buscado corretamente por seu Nome Fantasia.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 4. testBuscarClientePeloNomeInexistente()
Descrição: verifica se a busca por um cliente, cadastrado no sistema, buscado por um Nome Fantasia inexistente corretamente retorna null.

Resultado Esperado: null.

Resultado Obtido: null.

## 5. testBuscarInfoTodosClientes()

Descrição: verifica se a busca por todos os clientes cadastrados no sistema retorna uma lista de clientes.

Resultado Esperado: Not null.

Resultado Obtido: Not null.


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de busca de informações de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.