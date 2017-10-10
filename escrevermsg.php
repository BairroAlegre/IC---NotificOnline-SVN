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
        <title>Escrever Mensagem - NotificOnline</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pfaxjet1fvh437t4353zg8s3wsh0u6qsb1phv8nfm6t623cl"></script>
        <script src="https://cdn.ckeditor.com/4.7.2/standard/ckeditor.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid" style="background-color:white">
                <div class="navbar-header">
                    <a class="navbar-brand" href="inicialposlogin.php">NotificOnline</a>
                </div>
                <ul class="nav navbar-nav">
                    <li ><a href="inicialposlogin.php">Home</a></li>
                    <li ><a href="msgrascunhos.php">Rascunhos</a></li>
                    <li ><a href="msgrecebidas.php">Recebidas</a></li>
                    <li ><a href="msgenviadas.php">Enviadas</a></li>
                    <li class="active" ><a href="escrevermsg.php">Escrever uma mensagem</a></li>
                    <li ><a href="cadastroUsuario.php">Administração de usuários</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="index.php">Sair</a></li>
                </ul>
            </div>
        </nav>


        <div class="well pull-left" style="height:100%; width:100%;">
            <div class="container pull-left" style="height:10%;width:100%;">
                <label class=" control-label col-sm-4" for="email">Enviar:</label>
                <input type="email" class=" form-control" id="email" placeholder="Enviar para">
            </div>
            <div class="container pull-left" style="height:85%;width:100%;">
               <textarea name="editor1"></textarea>
                <script>
                    CKEDITOR.replace( 'editor1' );
                </script>
            </div>
            
        </div>
    </body>
</html>
