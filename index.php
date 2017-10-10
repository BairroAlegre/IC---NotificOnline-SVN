<?php
    include 'bancoDados.php';
    
    if(isset($_SESSION["USUA_PRONT"])){
        header("location:inicialposlogin.php");
        return;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NotificOnline</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <a class="navbar-brand" href="index.php">NotificOnline</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button type="button" class="navbar-brand" data-toggle="modal" data-target="#myModal">Login</button>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">


                <!-- Modal content-->
                <div class="modal-content center-block">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h1 class="modal-title text-center" style="color:green">NotificOnline Login</h1>
                    </div>
                    <div class="modal-body center-block">
                        <form class="form-horizontal" action="login.php">
                            <div class="form-group center-block">
                                <label class="control-label col-sm-2" for="text">Prontuário:</label>
                                <div class="col-sm-7 center-block">
                                    <input type="text" class="form-control" name="prontuario" placeholder="Digite seu prontuário">
                                </div>
                            </div>
                            <div class="form-group center-block">
                                <label class="control-label col-sm-2" for="pwd">Senha:</label>
                                <div class="col-sm-7 center-block">          
                                    <input type="password" class="form-control" id="pwd" name="senha" placeholder="Digite sua senha">
                                </div>
                            </div>
                            <div class="form-group center-block">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox ">
                                        <label><input type="checkbox" name="continuaron">Continuar online</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="lembrasenha">Lembrar minha senha</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="entrar" class="btn btn-default">Login</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">

            <div class="well">
                <h1 class="text-center"> Sobre nós</h1>
                <p class="text-center"> NÃO SEI O SOBRE NÓS </p>
                <?php if ((isset($_GET["erro"])) and ($_GET["erro"]=="1"))  echo "<p>Login inválido</p>"; ?>
            </div>
        </div>
    </body>
</html>


