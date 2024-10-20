<?php
    require '../sessao/sessao.php';

    $sessao = new Sessao();
    $sessao->excluirChaveSessao('orcamento'); // Excluir o orçamento da sessão

    echo json_encode(['success' => true]);
    
?>
