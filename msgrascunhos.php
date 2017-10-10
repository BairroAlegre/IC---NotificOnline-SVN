<!DOCTYPE html>
<?php 
 if(isset($_SESSION["USUA_PRONT"]))
    {
        header("location:index.php");
        return;
    }
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rascunhos - NotificOnline</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid" style="background-color:white">
                <div class="navbar-header">
                    <a class="navbar-brand" href="inicialposlogin.php">NotificOnline</a>
                </div>
                <ul class="nav navbar-nav">
                    <li ><a href="inicialposlogin.php">Home</a></li>
                    <li  class="active"><a href="msgrascunhos.php">Rascunhos</a></li>
                    <li ><a href="msgrecebidas.php">Recebidas</a></li>
                    <li ><a href="msgenviadas.php">Enviadas</a></li>
                    <li ><a href="escrevermsg.php">Escrever uma mensagem</a></li>
                    <li ><a href="cadastroUsuario.php">Administração de usuários</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="index.php">Sair</a></li>
                </ul>
            </div>
        </nav>
        <div class="well">
            <div class="container-fluid">
                <ul class="list-group pull-left" style="width:70%; height:90%;">
                    <li class="list-group-item"><h1 class="text-center">Rascunhos</h1></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                </ul>
                <ul class="list-group pull-right" style="width:30%; height:45%;">
                    <li class="list-group-item"><h1 class="text-center">Últimos usuários online</h1></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                </ul>
                <ul class="list-group pull-right" style="width:30%; height:45%;">
                    <li class="list-group-item"><h1 class="text-center">Grupos</h1></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                    <li class="list-group-item"><a href="">Exemplo</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
