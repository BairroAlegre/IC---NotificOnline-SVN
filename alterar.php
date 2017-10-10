<?php
    include 'bancoDados.php';
    $objeto = new Conexao();
    $pdo = $objeto->abreConexao();
    $grupo = $_POST["grupo4"];
    $objeto->alteraUsuario($grupo);
    header("Location:cadastrousuario.php");