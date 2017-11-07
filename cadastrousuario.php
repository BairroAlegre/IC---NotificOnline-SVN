<!DOCTYPE html>
<?php
include 'bancoDados.php';
$objeto = new Conexao;
$stmt = $objeto->usuarioConsulta2();
$stmt2 = $objeto->grupoConsulta();
$resposta = $stmt2->fetchAll();
if (!isset($_SESSION["USUA_PRONT"]) or $_SESSION["USUA_TIPO"] != "ADM") {
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
        <title>Cadastro de usuário - NotificOnline</title>
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
                    <li ><a href="escrevermsg.php">Escrever uma mensagem</a></li>
                    <li class="active"><a href="cadastroUsuario.php">Administração de usuários</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="Logout.php">Sair</a></li>
                </ul>
            </div>
        </nav>
        <div class="well">
            <div class="container-fluid">
                <form action="cadastrargrupo.php" method="post">
                    <div class="form-group">
                        <label>Nome do grupo:</label>
                        <input type="text" class="form-control" name="nomegrupo">
                    </div>
                    <button type="submit" class="btn btn-default">Cadastrar grupo</button></form>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Cadastrar novo usuário</button>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cadastro de usuário</h4>
                            </div>
                            <div class="modal-body">
                                <form action="cadastrarusuario.php" method="post">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control" name="nomecompleto">
                                        <label>Prontuário:</label>
                                        <input type="text" class="form-control" name="prontuario">
                                        <label>Senha:</label>
                                        <input type="password" class="form-control" name="senha">
                                        <label>Turma:</label>
                                        <input type="text" class="form-control" name="turma">
                                        <label>Grupo:</label>
                                        <select multiple name="grupo[]"><?php
                                                if (count($resposta)>0) {
                                                            for ($i = 0;$i<count($resposta);$i++){ 
                                                    ?>
                                            <option name="grupo2" value="<?php echo $resposta[$i]["GRUP_CODIGO"];?>"><?=$resposta[$i]["GRUP_NOME"]?></option>
                                                            <?php }
                                                }else{?>
                                            <option>Nenhum grupo cadastrado...</option>
                                                <?php }?>
                                        </select>
                                        <label>Tipo:</label>
                                        <select name="tipo">
                                            <option name="tipo2" value="ADM">ADM</option>
                                            <option name="tipo2" value="Aluno">Aluno</option>
                                            <option name="tipo2" value="Professor">Professor</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default">Cadastrar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>Prontuário</th>
                        <th>Tipo de usuário</th>
                        <th>Turma do usuário</th>
                        <th>Nome do usuário</th>
                        <th>Estado do usuário</th>
                        <th>Editar ou excluir usuário</th>
                    </tr>
                    <?php
                    if ($stmt->rowCount() > 0) {
                        while ($resulta = $stmt->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <td><?= $login = $resulta->USUA_PRONT; ?></td>
                                <td><?= $tip = $resulta->USUA_TIPO; ?></td>
                                <td><?= $turm = $resulta->USUA_TURMA; ?></td>
                                <td><?= $nom = $resulta->USUA_NOME; ?></td>
                                <td><?php $ativo = $resulta->USUA_ATIVO;
                                    $senha = $resulta->USUA_SENHA;
                                    if ($resulta->USUA_ATIVO == 1) {
                                        echo 'Ativo';
                                    } else {
                                        echo 'Desativado';
                                    }?>
                                </td>
                                
                                <td><form action="estado.php" method="post">
                                        <input type="hidden" name="prontuario" value='<?php echo $login; ?>'/> <button  type="submit" class="btn btn-default"><?php
                                    if ($ativo == 0) {
                                        echo'Ativar usuário';
                                    } else {
                                        echo'Desativar usuário';
                                    }?></button></form>  
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?= $login ?>">Alterar dados desse usuário</button>
                                    <div class="modal fade" id="<?= $login ?>" role="dialog">
                                        <div class="modal-dialog">


                                            <!-- Modal content-->
                                            <div class="modal-content center-block">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title text-center" style="color:green">Atualizar informações dos usuários</h4>
                                                </div>
                                                <div class="modal-body center-block">
                                                    <form class="form-horizontal" action="alterar.php" method="post">
                                                        <label>Nome:</label>
                                                        <input type="text" class="form-control" name="nomecompleto2" value="<?= $nom;?>">
                                                        <label>Prontuário:</label>
                                                        <input type="text" class="form-control" name="prontuario2" value="<?= $login; ?>" readonly>
                                                        <label>Senha:</label>
                                                        <input type="password" class="form-control" name="senha2" value="<?= $senha; ?>" >
                                                        <label>Turma:</label>
                                                        <input type="text" class="form-control" name="turma2" value="<?= $turm; ?>">
                                                        <label>Grupo:</label>
                                                        <select multiple name="grupo4[]">
                                                    <?php
                                                        $stmt3 = $objeto->grupoConsultaporUsuario($login);
                                                        $gruposqueparticipa = $stmt3->fetchAll();
                                                        if (count($resposta)>0) {
                                                            for ($i = 0;$i<count($resposta);$i++){ 
                                                    ?>
                                                                <option name="grupo2" value="<?php echo $resposta[$i]["GRUP_CODIGO"];?>"
                                                               <?php     if (participa($resposta[$i]["GRUP_CODIGO"],$gruposqueparticipa)){ echo "selected";}?> ><?=$resposta[$i]["GRUP_NOME"];?></option>
                                                    <?php }
                                                        } else { ?>
                                                                <option>Nenhum grupo cadastrado</option>
                                                    <?php }
                                                    ?>
                                                        </select>
                                                        <label>Tipo:</label>
                                                        <select name="tipo3">                            
                                                            <option name="tipo4" value="ADM" <?php 
                                                            if ($tip == "ADM") {
                                                                echo "selected='selected'";
                                                            } ?>">ADM</option>
                                                            <option name="tipo4" value="Aluno" <?php
                                                            if ($tip == "Aluno") {
                                                                echo "selected='selected'";
                                                            } ?>">Aluno</option>
                                                            <option name="tipo4" value="Professor" <?php 
                                                            if ($tip == "Professor") {
                                                                echo "selected='selected'";
                                                            } ?>">Professor</option>
                                                        </select>
                                                        <div class="form-group">        
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" value="alterar" class="btn btn-default">Alterar dados</button>
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
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">Nenhum usuário cadastrado...</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>  
    </body>
</html>
