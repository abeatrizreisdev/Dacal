# TESTE DE BUSCA DE PRODUTOS COM PHP UNIT

# Objetivo
Este documento fornece uma visão detalhada dos testes de busca de informações de produtos implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de busca de produtos estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, o PHPUnit será instalado também:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# Estrutura dos Testes
O arquivo TesteBuscarProduto.php contém sete métodos de testes para verificar a funcionalidade de busca de informações dos produtos. Cada teste foca em diferentes cenários, como busca por ID, busca por nome, busca por categoria e busca de todos os produtos.



# Descrição dos Métodos de Testes
1. Teste de Busca de Produto por ID Existente
O método testBuscarInfoProdutoExistente() verifica se um produto existente pode ser buscado corretamente por seu ID. O teste espera que a busca retorne um resultado não nulo.

2. Teste de Busca de Produto por ID Inexistente
O método testBuscarInfoProdutoInexistente() verifica se a busca por um ID inexistente corretamente retorna null.

3. Teste de Busca de Produto por Nome Existente
O método testBuscarProdutosPorNomeExistente() verifica se um produto existente pode ser buscado corretamente por seu nome. O teste espera que a busca retorne um resultado não nulo.

4. Teste de Busca de Produto por Nome Inexistente
O método testBuscarProdutosPorNomeInexistente() verifica se a busca por um nome inexistente corretamente retorna null.

5. Teste de Busca de Todos os Produtos
O método testBuscarTodosProdutos() verifica se a busca de todos os produtos retorna uma lista não vazia de produtos.

6. Teste de Busca de Produtos por Categoria Existente
O método testBuscarProdutosPorCategoriaExistente() verifica se produtos existentes podem ser buscados corretamente por sua categoria. O teste espera que a busca retorne um resultado não nulo.

7. Teste de Busca de Produtos por Categoria Inexistente
O método testBuscarProdutosPorCategoriaInexistente() verifica se a busca por uma categoria inexistente corretamente retorna null.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Buscas/TesteBuscarProduto.php


# Resultado dos Testes
1. testBuscarInfoProdutoExistente
Descrição: Verifica se um produto existente pode ser buscado corretamente por seu ID.
Resultado Esperado: Not null
Resultado Obtido: Not null

2. testBuscarInfoProdutoInexistente
Descrição: Verifica se a busca por um ID inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

3. testBuscarProdutosPorNomeExistente
Descrição: Verifica se um produto existente pode ser buscado corretamente por seu nome.
Resultado Esperado: Not null
Resultado Obtido: Not null

4. testBuscarProdutosPorNomeInexistente
Descrição: Verifica se a busca por um nome inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null

5. testBuscarTodosProdutos
Descrição: Verifica se a busca de todos os produtos retorna uma lista não vazia de produtos.
Resultado Esperado: Not null
Resultado Obtido: Not null

6. testBuscarProdutosPorCategoriaExistente
Descrição: Verifica se produtos existentes podem ser buscados corretamente por sua categoria.
Resultado Esperado: Not null
Resultado Obtido: Not null

7. testBuscarProdutosPorCategoriaInexistente
Descrição: Verifica se a busca por uma categoria inexistente corretamente retorna null.
Resultado Esperado: null
Resultado Obtido: null


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de busca de informações de produtos estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.