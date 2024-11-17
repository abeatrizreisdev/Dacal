# TESTE DE EXCLUSÃO DE PRODUTO COM PHP UNIT


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de exclusão de produto implementado no sistema, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que a funcionalidade de exclusão de produto esteja funcionando corretamente.

# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo TesteExclusaoProduto.php contém 2 métodos de testes para verificar a funcionalidade de exclusão de produtos. Cada teste foca em diferentes cenários, como exclusão de um produto existente e tentativa de exclusão de um produto inexistente.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1. Teste de Exclusão de Produto Existente
O método "testExclusaoProdutoExistente()" verifica se um produto cadastrado no sistema pode ser excluído corretamente. O teste espera que a tentativa de exclusão retorne true.

## 2. Teste de Exclusão de Produto Inexistente
O método "testExclusaoProdutoInexistente()" verifica se o sistema rejeita a exclusão de um produto inválido. O teste espera que a função de exclusão retorne false.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Exclusoes/TesteExcluirProduto.php


# RESULTADO DOS TESTES:

## 1. testExclusaoProdutoExistente()
Descrição: verifica se um produto cadastrado no sistema é excluído corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2. testExclusaoProdutoInexistente()
Descrição: verifica se o sistema rejeita a exclusão de um produto inválido.

Resultado Esperado: false.

Resultado Obtido: false.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que a funcionalidade de exclusão de produto está funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.