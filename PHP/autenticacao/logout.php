<?php

    require "../sessao/sessao.php";

    $sessao = new Sessao();

    $sessao->encerrarSessao();

    header("Location: ../../login.php");

    exit();

?>