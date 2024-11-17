# TESTES UNITÁRIOS DE BUSCA DE PRODUTOS COM PHP UNIT:

# OBJETIVOS:
Este documento fornece uma visão detalhada dos testes das funcionalidades de busca de informações dos produtos, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de busca de produtos estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, o PHPUnit será instalado também:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# ESTRUTURA DOS TESTES:
O arquivo TesteBuscarProduto.php contém sete métodos de testes para verificar a funcionalidade de busca de informações dos produtos. Cada teste foca em diferentes cenários, como busca por ID, busca por nome, busca por categoria e busca de todos os produtos.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1. Teste de Busca de Produto por ID válido
O método "testBuscarInfoProdutoExistente()" verifica se um produto, cadastrado no sistema, pode ser buscado corretamente por seu ID. O teste espera que a busca retorne um resultado não nulo.

## 2. Teste de Busca de Produto por ID inválido
O método "testBuscarInfoProdutoInexistente()" verifica se a busca por um produto, utilizando um ID inválido, corretamente retorna null.

## 3. Teste de Busca de Produto por Nome válido
O método "testBuscarProdutosPorNomeExistente()" verifica se um produto, cadastrado no sistema, pode ser buscado corretamente por seu nome. O teste espera que a busca retorne um resultado não nulo.

## 4. Teste de Busca de Produto por Nome inválido.
O método "testBuscarProdutosPorNomeInexistente()" verifica se a busca por um produto cadastrado no sistema, buscado por um nome inválido, corretamente retorna null.

## 5. Teste de Busca de Todos os Produtos
O método "testBuscarTodosProdutos()" verifica se a busca por todos os produtos, cadastrados no sistema, retorna uma lista de produtos.

## 6. Teste de Busca de Produtos por Categoria válida.
O método "testBuscarProdutosPorCategoriaExistente()" verifica se produtos, cadastrados no sistema, podem ser buscados corretamente por sua categoria. O teste espera que a busca retorne um resultado não nulo.

## 7. Teste de Busca de Produtos por Categoria inválida
O método "testBuscarProdutosPorCategoriaInexistente()" verifica se a busca por produtos cadastrados no sistema, utilizando uma categoria inválida, corretamente retorna null.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Buscas/TesteBuscarProduto.php


# RESULTADO DOS TESTES:

## 1. testBuscarInfoProdutoExistente()
Descrição: verifica se um produto, cadastrado no sistema, pode ser buscado corretamente por seu ID.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 2. testBuscarInfoProdutoInexistente()
Descrição: verifica se a busca por um um produto cadastrado no sistema, utilizando um ID inexistente, corretamente retorna null.

Resultado Esperado: null.

Resultado Obtido: null.

## 3. testBuscarProdutosPorNomeExistente()
Descrição: verifica se um produto, cadastrado no sistema, pode ser buscado corretamente por seu nome.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 4. testBuscarProdutosPorNomeInexistente()
Descrição: verifica se a busca um produto cadastrado no sistema, utilizando um nome inválido corretamente retorna null.

Resultado Esperado: null.

Resultado Obtido: null.

## 5. testBuscarTodosProdutos()
Descrição: verifica se a busca por todos os produtos cadastrados no sistema, retorna uma lista de produtos.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 6. testBuscarProdutosPorCategoriaExistente()
Descrição: verifica se os produtos cadastrado no sistema, podem ser buscados corretamente utilizando o id da sua categoria.

Resultado Esperado: Not null.

Resultado Obtido: Not null.

## 7. testBuscarProdutosPorCategoriaInexistente()
Descrição: verifica se a busca pelos produtos, utilizando um id inválido da sua categoria, retorna null.

Resultado Esperado: null.

Resultado Obtido: null.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de busca de informações de produtos estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.