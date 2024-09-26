<?php 

    class CrudOrcamento extends Crud {

        public function __construct($conexao) {
            parent::__construct($conexao, "orcamentos");
        }

    }

?>