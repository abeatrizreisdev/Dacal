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

        private $id;
        private $cliente;
        private $produtos;
        private $valor;
        private $data;
        private $status;
        private $quantidadeProdutos;

        public function __construct($id = null, $cliente = null, $produtos = [], $valor = 0.0, $quantidadeProdutos = []) {
            
            $this->id = $id;
            $this->cliente = $cliente;
            $this->produtos = $produtos;
            $this->valor = $valor;
            $this->quantidadeProdutos = $quantidadeProdutos;

        }

        public function setId($id) {

             // Se for um valor númerico (int, por exemplo) e maior que 0.
             if (is_numeric($id) && $id <= 0) {

                throw new Exception("Erro. O id deve ser um número maior que 0.");

            } else if(is_null($id)) {

                throw new Exception("Erro. O id não pode ser nulo.");

            }

            $this->id = $id;

            
        }
    
        public function setCliente($cliente) {

            if (is_null($cliente)) {

                throw new Exception("Erro. O cliente que realizou o orçamento não pode ser nulo.");

            }

            $this->cliente = $cliente;

        }
    
        public function setProdutos($produtos) {

            if (is_null($produtos)) {

                throw new Exception("Erro. Os produtos do orçamento não podem ser nulos.");

            }

            $this->produtos = $produtos;

        }
    
        public function setValor($valorOrcamento) {

            if (is_numeric($valorOrcamento) && $valorOrcamento -= 0) {

                throw new Exception("Erro. O valor do orçamento não pode ser igual ou inferior a 0.");

            } elseif(!is_numeric($valorOrcamento)) {

                throw new Exception("Erro. Valor do orçamento inválido.");

            }

            $this->valor = $valorOrcamento;

        }

        public function setQuantidadeProdutos($quantidadeProdutos) {

            if (is_numeric($quantidadeProdutos) && $quantidadeProdutos -= 0) {

                throw new Exception("Erro. A quantidade de produtos do orçamento não pode ser igual ou inferior a 0.");

            } elseif(!is_numeric($quantidadeProdutos)) {

                throw new Exception("Erro. Quantidade de produtos inválida.");

            }


            $this->quantidadeProdutos = $quantidadeProdutos;

        }

        public function setData($data) {

            if (!is_string($data)) {

                throw new Exception("Erro. Data de criação do orçamento inválida.");

            }

            $this->data = $data;

        }

        public function setStatus($status) {

            if (!is_string($status)) {

                throw new Exception("Erro. Status do orçamento inválido.");

            }

            $this->status = $status;

        }

        public function getId() {
            return $this->id;
        }
    
        public function getCliente() {
            return $this->cliente;
        }
    
        public function getProdutos() {
            return $this->produtos;
        }
    
        public function getValor() {
            return $this->valor;
        }

        public function getQuantidadeProdutos() {
            return $this->quantidadeProdutos;
        }

        public function getData() {
            return $this->data;
        }

        public function getStatus() {
            return $this->status;
        }

        // Método para adicionar um produto com quantidade
        public function adicionarProduto($produto, $quantidade) {

            // Usar o ID do produto como chave no array associativo
            $produtoId = $produto->getId();
            
            if (isset($this->quantidadeProdutos[$produtoId])) {
                
                // Incrementar a quantidade do produto existente
                $this->quantidadeProdutos[$produtoId] += $quantidade;

            } else {

                // Adicionar o produto com a quantidade inicial
                $this->quantidadeProdutos[$produtoId] = $quantidade;
                $this->produtos[] = $produto;

            }

            $this->calcularValorOrcamento();

        }
        

        // Método para remover um produto
        public function removerProduto($produtoId) {

            if (isset($this->quantidadeProdutos[$produtoId])) {

                unset($this->quantidadeProdutos[$produtoId]); // Remove a quantidade do produto
    
                foreach ($this->produtos as $index => $produto) {

                    if ($produto->getId() == $produtoId) {
                        unset($this->produtos[$index]); // Remove o produto da lista de produtos
                        break;
                    }

                }
    
                // Recalcular o valor total do orçamento
                $this->calcularValorOrcamento();
            }
        }

        // novo método para adcionar no diagrama de classes.
        public function atualizarQuantidadeProduto($produtoId, $novaQuantidade) {
            if (isset($this->quantidadeProdutos[$produtoId])) {
                $this->quantidadeProdutos[$produtoId] = $novaQuantidade;
                $this->calcularValorOrcamento();
            }
        }

        // Método para calcular o valor total do orçamento
        public function calcularValorOrcamento() {
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
        
        */

    }

?>