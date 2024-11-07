# TESTE DE EXCLUSÃO DE PRODUTO COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de exclusão de produto implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que a funcionalidade de exclusão de produto esteja funcionando corretamente.

# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes
O arquivo TesteExclusaoProduto.php contém dois métodos de testes para verificar a funcionalidade de exclusão de produtos. Cada teste foca em diferentes cenários, como exclusão de um produto existente e tentativa de exclusão de um produto inexistente.


# Descrição dos Métodos de Testes
1. Teste de Exclusão de Produto Existente
O método testExclusaoProdutoExistente() verifica se um produto existente pode ser excluído corretamente. O teste espera que a exclusão retorne true.

2. Teste de Exclusão de Produto Inexistente
O método testExclusaoProdutoInexistente() verifica se o sistema rejeita a exclusão de um produto inexistente. O teste espera que a função de exclusão retorne false.

# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Exclusoes/TesteExcluirProduto.php


# Resultado dos Testes
1. testExclusaoProdutoExistente()
Descrição: Verifica se um produto existente é excluído corretamente.
Resultado Esperado: true
Resultado Obtido: true

2. testExclusaoProdutoInexistente()
Descrição: Verifica se o sistema rejeita a exclusão de um produto inexistente.
Resultado Esperado: false
Resultado Obtido: false


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que a funcionalidade de exclusão de produto está funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.