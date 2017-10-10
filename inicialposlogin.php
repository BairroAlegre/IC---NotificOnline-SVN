<!DOCTYPE html>
<?php
    include 'bancoDados.php';
    $objeto = new Conexao();
    $stmt = $objeto->grupoLogado();
    if(!isset($_SESSION["USUA_PRONT"]))
    {
        header("location:index.php");
        return;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>NotificOnline</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid" style="background-color:white">
                <div class="navbar-header">
                    <a class="navbar-brand" href="inicialposlogin.php">NotificOnline</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="inicialposlogin.php">Home</a></li>
                    <li ><a href="msgrascunhos.php">Rascunhos</a></li>
                    <li ><a href=" msgrecebidas.php">Recebidas</a></li>
                    <li ><a href="msgenviadas.php">Enviadas</a></li>
                    <li ><a href="escrevermsg.php">Escrever uma mensagem</a></li>
                    <?php if($_SESSION["USUA_TIPO"]=="ADM")
                        {
                        ?>
                    <li ><a href="cadastroUsuario.php">Administração de Usuários</a></li>
                        <?php                        
                        }
                        ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="logout.php">Sair</a></li>
                </ul>
            </div>
        </nav>
        <div class="well" style="height:100%;">
            <div class="container" style="height:50%; width:100%;">
                <table class="table-responsive table-hover table-bordered" style="height:50%; width:100%;">
                    <tr>
                      <th class="text-center">Grupos</th>
                      <th class="text-center">Nofiticações</th> <!-- ÚLTIMO USUÁRIO ONLINE E ÚLTIMAS MENSAGENS RECEBIDAS -->
                    </tr>
                      <?php if($stmt->rowCount() > 0){ 
                                while($grupo = $stmt->fetch(PDO::FETCH_OBJ)){
                          ?>
                    <tr>
                        <td class="text-center" style="width: 50%;"><?php echo $grupo->GRUP_NOME; ?></td>
                        <td class="text-center" style="width: 50%;"> VAI TER MENSAGEM SIM </td>
                    </tr>
                      <?php     }
                            } ?>
                </table>
            </div>
        </div>
    </body>
</html>
