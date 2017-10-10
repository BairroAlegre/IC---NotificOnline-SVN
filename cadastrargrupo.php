<?php
include 'bancoDados.php';

$objeto = new Conexao();
$objeto->cadastroGrupo();
header("location:inicialposlogin.php");
