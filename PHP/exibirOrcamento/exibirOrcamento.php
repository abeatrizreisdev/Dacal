<?php

    // Configurações de exibição de erros.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "../sessao/sessao.php";
    require_once "../entidades/orcamento.php";
    require "../entidades/produto.php";

    $sessaoCliente = new Sessao();

    // Recupera o orçamento serializado armazenado na sessão do cliente.
    $orcamento_serializado = $sessaoCliente->getValorSessao('orcamento');

    // Define o tipo de conteúdo da resposta como JSON.
    header('Content-Type: application/json');

    // Inicializa um array para a resposta do orçamento
    $respostaOrcamento = [];

    try {

        // Verifica se existe um orçamento serializado e se é uma string.
        if ($orcamento_serializado && is_string($orcamento_serializado)) {

            // Verifica se a classe Orcamento está definida.
            if (class_exists('Orcamento')) {

                // Desserializa o objeto Orcamento.
                $orcamento = unserialize($orcamento_serializado);

                // Verifica se a desserialização falhou.
                if ($orcamento === false) {
                    throw new Exception('Falha na deserialização.');
                }

            } else {

                throw new Exception('Classe Orcamento não encontrada.');

            }

        } else {

            // Cria um novo objeto Orcamento se não houver um orçamento serializado.
            $orcamento = new Orcamento();

        }

        // Verifica se o orçamento contém produtos
        if (empty($orcamento->getProdutos())) {

            $respostaOrcamento['mensagem'] = 'Nenhum produto adicionado ao orçamento.';

        } else {

            // Inicializa arrays para armazenar produtos e calcular o total.
            $produtos = [];
            $total = 0;
            $quantidadeTotal = 0;

            // Itera sobre os produtos no orçamento.
            foreach ($orcamento->getProdutos() as $produto) {

                // Obtém a quantidade do produto no orçamento.
                $quantidade = $orcamento->getQuantidadeProdutos()[$produto->getId()];
                // Calcula o total do orçamento.
                $total += $produto->getValor() * $quantidade;
                // Calcula a quantidade total de produtos.
                $quantidadeTotal += $quantidade;

                // Adiciona as informações do produto ao array de produtos.
                $produtos[] = [
                    'id' => $produto->getId(),
                    'nome' => $produto->getNome(),
                    'categoria' => $produto->getCategoria(),
                    'imagem' => $produto->getImagem(),
                    'quantidade' => $quantidade,
                    'valor' => $produto->getValor(),
                ];

            }

            // Adiciona os produtos, o total e a quantidade total à resposta.
            $respostaOrcamento['produtos'] = $produtos;
            $respostaOrcamento['total'] = $total;
            $respostaOrcamento['quantidadeTotal'] = $quantidadeTotal;

        }

        // Retorna a resposta do orçamento como JSON.
        echo json_encode($respostaOrcamento);

    } catch (Exception $excecao) {

        // Captura e retorna exceções como mensagens de erro na resposta JSON.
        $respostaOrcamento['mensagem'] = 'Erro: ' . $excecao->getMessage();
        echo json_encode($respostaOrcamento);
        exit;

    }

