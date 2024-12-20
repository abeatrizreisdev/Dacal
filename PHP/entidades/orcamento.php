<?php 

    class Orcamento {

        /* 
        
        Atributos: 

        - id: Int
        - cliente: Cliente
        - produtos: ArrayList<Produto>
        - valor: Double
        - quantidadeProdutos: Map<Produto, Int> 

        */

        private int $id;
        private int $cliente;
        private $produtos = [];
        private float $valor;
        private string $data;
        private string $status;
        private $quantidadeProdutos = [];

        public function __construct() {

        }

        public function setId(int $id): void {

            if (!is_numeric($id) || $id <= 0) {
                throw new Exception("Erro. O id deve ser um número maior que 0.");
            }
            $this->id = $id;

        }
        
    
        public function setCliente(int $cliente): void {

            if (is_null($cliente)) {

                throw new Exception("Erro. O cliente que realizou o orçamento não pode ser nulo.");

            }

            $this->cliente = $cliente;

        }
    
        public function setProdutos($produtos): void {

            if (is_null($produtos)) {

                throw new Exception("Erro. Os produtos do orçamento não podem ser nulos.");

            }

            $this->produtos = $produtos;

        }
    
        public function setValor(float $valorOrcamento): void {

            if (!is_numeric($valorOrcamento) || $valorOrcamento <= 0) {

                throw new Exception("Erro. O valor do orçamento não pode ser igual ou inferior a 0.");
            }

            $this->valor = $valorOrcamento;

        }
        

        public function setQuantidadeProdutos(int $quantidadeProdutos): void {

            if (!is_numeric($quantidadeProdutos) || $quantidadeProdutos <= 0) {

                throw new Exception("Erro. A quantidade de produtos do orçamento não pode ser igual ou inferior a 0.");

            }

            $this->quantidadeProdutos = $quantidadeProdutos;

        }


        public function setData(string $data): void {
            if (!is_string($data) || empty($data)) {
                throw new Exception("Erro. Data de criação do orçamento inválida.");
            }
            $this->data = $data;
        }

        public function setStatus(string $status): void {
            if (!is_string($status) || empty($status)) {
                throw new Exception("Erro. Status do orçamento inválido.");
            }
            $this->status = $status;
        }


        public function getId(): int {
            return $this->id;
        }
    
        public function getCliente(): int {
            return $this->cliente;
        }
    
        public function getProdutos() {
            return $this->produtos;
        }
    
        public function getValor(): float {
            return $this->valor;
        }

        public function getQuantidadeProdutos(): array|int {
            return $this->quantidadeProdutos;
        }

        public function getData(): string {
            return $this->data;
        }

        public function getStatus(): string {
            return $this->status;
        }

        // Método para adicionar um produto com quantidade.
        public function adicionarProduto(Produto $produto, int $quantidade): void {

            // Usar o ID do produto como chave no array associativo.
            $produtoId = $produto->getId();
        
            if (isset($this->quantidadeProdutos[$produtoId])) {

                // Incrementar a quantidade do produto existente.
                $this->quantidadeProdutos[$produtoId] += $quantidade;

            } else {

                // Adicionar o produto com a quantidade inicial
                $this->quantidadeProdutos[$produtoId] = $quantidade;

                // Verifica se o produto já está no array de produtos, caso não esteja, adiciona-o
                $produtoJaAdicionado = false;

                foreach ($this->produtos as $p) {

                    if ($p->getId() == $produtoId) {
                        $produtoJaAdicionado = true;
                        break;
                    }

                }

                if (!$produtoJaAdicionado) {
                    $this->produtos[] = $produto;
                }

            }

            $this->calcularValorOrcamento();

        }
        
        

        // Método para remover um produto.
        public function removerProduto(int $produtoId): void {

            if (isset($this->quantidadeProdutos[$produtoId])) {

                unset($this->quantidadeProdutos[$produtoId]); // Remove a quantidade do produto.
    
                foreach ($this->produtos as $index => $produto) {

                    if ($produto->getId() == $produtoId) {
                        unset($this->produtos[$index]); // Remove o produto da lista de produtos.
                        break;
                    }

                }
    
                // Recalcular o valor total do orçamento
                $this->calcularValorOrcamento();
            }
        }

        // novo método para adcionar no diagrama de classes.
        public function atualizarQuantidadeProduto(int $id, int $novaQuantidade): void {

            if (isset($this->quantidadeProdutos[$id])) {
                $this->quantidadeProdutos[$id] = $novaQuantidade;
                $this->calcularValorOrcamento();
            }

        }

        // Método para calcular o valor total do orçamento.
        public function calcularValorOrcamento(): void {

            $this->valor = 0.0;
            foreach ($this->produtos as $produto) {
                $produtoId = $produto->getId();
                $this->valor += $produto->getValor() * $this->quantidadeProdutos[$produtoId];
            }

        }

        /*
        Métodos: 

        + setId(Int id): Void
        + setCliente(Cliente cliente): Void
        + setProdutos(ArrayList<Produto> produtos): Void
        + setValor(Double valorOrcamento): Void
        + setQuantidadeProdutos(Map<Produto, Int>): Void
        + getId(): Int
        + getCliente(): Cliente
        + getProdutos(): ArrayList<Produto>
        + getValor(): Double
        + getQuantidadeProdutos(): Map<Produto, Int>
        + adcionarProduto(Produto produto): Void
        + removerProduto(Produto produto): Void
        + calcularValorOrcamento(): Void
        + atualizarQuantidadeProduto(Int id, Int novaQuantidade): Void
        
        */

    }

