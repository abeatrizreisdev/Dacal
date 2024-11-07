# TESTE DE EDIÇÃO DE CLIENTE/EMPRESA COM PHP UNIT


# Objetivo:
Este documento fornece uma visão detalhada dos testes de edição de clientes implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de edição de clientes estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes:
O arquivo TesteEdicaoEmpresa.php contém vários métodos de testes para verificar a funcionalidade de edição de clientes/empresas. Cada teste foca em diferentes cenários, como edição válida, CNPJ inválido e dados obrigatórios faltando.


# Descrição dos Métodos de Testes:
1 -> Teste de Edição de Cliente Válido:
O método testEdicaoClienteValido() verifica se um cliente com todos os dados válidos pode ser editado corretamente. O teste espera que a edição retorne true.

2 -> Teste de Edição de Cliente com CNPJ Inválido:
O método testEdicaoClienteCnpjInvalido() verifica se o sistema rejeita a edição de um cliente com um CNPJ inválido. O teste espera que a função de edição retorne false.

3 -> Teste de Edição de Cliente com Dados Obrigatórios Faltando:
O método testEdicaoClienteDadosIncompletos() verifica se o sistema rejeita a edição de um cliente quando dados obrigatórios estão faltando. O teste espera que a função de edição retorne false.

4. Teste de Edição de Email Válido do Cliente
O método testEdicaoEmailClienteValido() verifica se um cliente pode ter seu email editado corretamente. O teste espera que a função de edição retorne true.

5. Teste de Edição de Email Inválido do Cliente
O método testEdicaoEmailClienteInvalido() verifica se o sistema rejeita a edição de um cliente com um email inválido. O teste espera que a função de edição retorne false.

6. Teste de Edição de Senha Válida do Cliente
O método testEdicaoSenhaClienteValida() verifica se um cliente pode ter sua senha editada corretamente. O teste espera que a função de edição retorne true.

7. Teste de Edição de Senha Inválida do Cliente
O método testEdicaoSenhaClienteInvalida() verifica se o sistema rejeita a edição de um cliente com uma senha inválida. O teste espera que a função de edição retorne false.


# Comando para Rodar os Testes:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Edicoes/TesteEdicaoEmpresa.php


# Resultado dos Testes:
1 -> testEdicaoClienteValido()
Descrição: Verifica se um cliente é editado corretamente.
Resultado Esperado: true
Resultado Obtido: true

2 -> testEdicaoClienteCnpjInvalido()
Descrição: Verifica se o sistema rejeita uma edição com CNPJ inválido.
Resultado Esperado: false
Resultado Obtido: false

3 -> testEdicaoClienteDadosIncompletos()
Descrição: Verifica se o sistema rejeita uma edição com dados obrigatórios faltando.
Resultado Esperado: false
Resultado Obtido: false

4. testEdicaoEmailClienteValido
Descrição: Verifica se um cliente pode ter seu email editado corretamente.
Resultado Esperado: true
Resultado Obtido: true

5. testEdicaoEmailClienteInvalido
Descrição: Verifica se o sistema rejeita uma edição com email inválido.
Resultado Esperado: false
Resultado Obtido: false

6. testEdicaoSenhaClienteValida
Descrição: Verifica se um cliente pode ter sua senha editada corretamente.
Resultado Esperado: true
Resultado Obtido: true

7. testEdicaoSenhaClienteInvalida
Descrição: Verifica se o sistema rejeita uma edição com senha inválida.
Resultado Esperado: false
Resultado Obtido: false


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de edição de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.