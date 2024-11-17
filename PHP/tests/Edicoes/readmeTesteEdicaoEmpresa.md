# TESTES UNITÁRIOS DE EDIÇÃO DE CLIENTE/EMPRESA COM PHP UNIT


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de edição de clientes implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de edição de clientes estejam funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS: 
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo "testeEdicaoEmpresa.php" contém 7 métodos de testes para verificar a funcionalidade de edição de clientes/empresas. Cada teste foca em diferentes cenários, como edição válida, CNPJ inválido e dados obrigatórios faltando.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Edição de Cliente Válido:
O método "testEdicaoClienteValido()" verifica se um cliente com todos os dados válidos pode ser editado corretamente. O teste espera que a edição retorne true.

## 2 -> Teste de Edição de Cliente com CNPJ Inválido:
O método "testEdicaoClienteCnpjInvalido()" verifica se o sistema rejeita a edição de um cliente com um CNPJ inválido. O teste espera que a função de edição retorne false.

## 3 -> Teste de Edição de Cliente com Dados Obrigatórios Faltando:
O método "testEdicaoClienteDadosIncompletos()" verifica se o sistema rejeita a edição de um cliente quando dados obrigatórios estão faltando. O teste espera que a função de edição retorne false.

## 4. Teste de Edição de Email Válido do Cliente
O método "testEdicaoEmailClienteValido()" verifica se um cliente pode ter seu email editado corretamente. O teste espera que a função de edição retorne true.

## 5. Teste de Edição de Email Inválido do Cliente
O método "testEdicaoEmailClienteInvalido()" verifica se o sistema rejeita a edição de um cliente com um email inválido. O teste espera que a função de edição retorne false.

## 6. Teste de Edição de Senha Válida do Cliente
O método "testEdicaoSenhaClienteValida()" verifica se um cliente pode ter sua senha editada corretamente. O teste espera que a função de edição retorne true.

## 7. Teste de Edição de Senha Inválida do Cliente
O método "testEdicaoSenhaClienteInvalida()" verifica se o sistema rejeita a edição de um cliente com uma senha inválida. O teste espera que a função de edição retorne false.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Edicoes/TesteEdicaoEmpresa.php


# RESULTADO DOS TESTES:

## 1 -> testEdicaoClienteValido()
Descrição: verifica se um cliente com dados válidos inseridos é editado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2 -> testEdicaoClienteCnpjInvalido()
Descrição: verifica se o sistema rejeita uma edição de um cliente com CNPJ inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 3 -> testEdicaoClienteDadosIncompletos()
Descrição: verifica se o sistema rejeita uma edição de um cliente com dados obrigatórios faltando.

Resultado Esperado: false.

Resultado Obtido: false.

## 4. testEdicaoEmailClienteValido()
Descrição: verifica se um cliente pode ter seu email editado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 5. testEdicaoEmailClienteInvalido()
Descrição: verifica se o sistema rejeita uma edição do email de um cliente ao inserir um email inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 6. testEdicaoSenhaClienteValida()
Descrição: verifica se um cliente pode ter sua senha editada corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 7. testEdicaoSenhaClienteInvalida()
Descrição: verifica se o sistema rejeita uma edição de senha de cliente, com uma senha inválida inserida.

Resultado Esperado: false.

Resultado Obtido: false.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de edição de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.