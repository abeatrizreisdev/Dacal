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

        // Método para adicionar um produto
        public function adicionarProduto($produto) {

            $this->produtos[] = $produto;

            // Verificando se o produto já foi inserido no array associativo "quantidadeProdutos" do orçamento.
            if (isset($this->quantidadeProdutos[$produto])) {

                // Incrementa a quantidade desse produto em 1.
                $this->quantidadeProdutos[$produto]++;

            } else { // Se o produto não existe...
                
                // Adiciona o produto ao array associativo quantidadeProdutos com a quantidade inicial de 1.
                $this->quantidadeProdutos[$produto] = 1;

            }

            $this->calcularValorOrcamento();

        }

        // Método para remover um produto
        public function removerProduto($produto) {

            // Usa "array_search" para encontrar a chave do produto no array associativo "produtos" do orçamento.
            if (($key = array_search($produto, $this->produtos)) !== false) {

                // Remove o produto do array associativo produtos usando "unset".
                unset($this->produtos[$key]);

                // Verifica se o produto existe no array associativo "quantidadeProdutos".
                if (isset($this->quantidadeProdutos[$produto])) {

                    // Decrementa a quantidade do produto que foi removido do orçamento em 1.
                    $this->quantidadeProdutos[$produto]--;

                    // E se a quantidade do produto for menor ou igual a 0, remove o produto do array quantidadeProdutos usando unset.
                    if ($this->quantidadeProdutos[$produto] <= 0) {

                        unset($this->quantidadeProdutos[$produto]);

                    }

                }

                // Chama "calcularValorOrcamento" para recalcular o valor total do orçamento depois da remoção feita.
                $this->calcularValorOrcamento();

            }

        }

        // Método para calcular o valor total do orçamento
        public function calcularValorOrcamento() {
            
            $this->valor = 0.0;

            // Itera sobre cada produto no array produtos.
            foreach ($this->produtos as $produto) {

                // Para cada produto, multiplica o preço do produto ($produto->getPreco()) pela quantidade do produto ($this->quantidadeProdutos[$produto]) e adciona no atributo "valor" do orçamento.
                $this->valor += $produto->getPreco() * $this->quantidadeProdutos[$produto];

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