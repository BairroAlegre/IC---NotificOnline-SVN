<?php

include 'bancoDados.php';
$objeto = new Conexao();
$pdo = $objeto->abreConexao();
$stmt = $objeto->usuarioConsulta($_POST["prontuario"]);
$result = $stmt->fetch(PDO::FETCH_OBJ);

if($result->USUA_ATIVO == 1){
    $stmt = $objeto->desativarUsuario($_POST["prontuario"]);
}else{
    $stmt = $objeto->ativarUsuario($_POST["prontuario"]);
}