<?php

    require "../sessao/sessao.php";

    $sessao = new Sessao();

    $sessao->encerrarSessao();

    header("Location: ../loginEmpresa.php");

    exit();

?>