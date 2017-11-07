<?php
$usuarioRecebe = $_POST["user"];
$mensagem = $_POST["mensagem"];
$tipo = $_POST["pessoa"];
enviandoMensagem($mensagem, $usuarioRecebe);