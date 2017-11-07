<?php

session_start();

class Conexao {

    function abreConexao() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=ic", "joaomazi", "");
            //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            echo "Problemas na conexão!";
            echo $exc->getMessage();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $pdo;
    }

    function fazerLogin() {
        $sergio = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        $login = $sergio['prontuario'];
        $senha_1 = $sergio['senha'];
        $senha = md5($senha_1);
        $pdo = $this->abreConexao();
        $sql = "select * from usuario where USUA_PRONT=:login and USUA_SENHA=:senha and usua_ativo='1'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
        $stmt->execute();
        $log = $stmt->rowCount();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($log == 1) {
            $_SESSION["USUA_PRONT"] = $login;
            $_SESSION["USUA_SENHA"] = $senha;
            $_SESSION["USUA_NOME"] = $result->USUA_NOME;
            $_SESSION["USUA_TIPO"] = $result->USUA_TIPO;
            $_SESSION["USUA_TURMA"] = $result->USUA_TURMA;
            $_SESSION["USUA_ATIVO"] = $result->USUA_ATIVO;
            header('Location: inicialposlogin.php');
        } else {
            header('Location: index.php?erro=1');

            // header('Location: index.php');
        }
    }

    function cadastroGrupo() {
        $sergio = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $grup_nome = $sergio['nomegrupo'];
        $sql = "INSERT INTO grupo (GRUP_NOME) VALUES";
        $sql .= "('$grup_nome')";
        $pdo = $this->abreConexao();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    function cadastroUsuario() {
        $sergio = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $usua_pront = $sergio['prontuario'];
        $usua_tipo = $sergio['tipo'];
        $usua_grupos = $sergio['grupo'];
        $usua_nome = $sergio['nomecompleto'];
        $usua_senha = $sergio['senha'];
        $usua_turma = $sergio['turma'];
        $usuasenha = md5($usua_senha);
        $pdo = $this->abreConexao();
        $db = $pdo;
        $db->beginTransaction();
        $sql = $db->exec("INSERT INTO usuario (USUA_PRONT, USUA_TIPO,USUA_TURMA, USUA_NOME, USUA_SENHA, USUA_ATIVO) VALUES('" . $usua_pront . "','" . $usua_tipo . "','" . $usua_turma . "','" . $usua_nome . "','" . $usuasenha . "',1)");

        for ($i = 0; $i < count($usua_grupos); $i++) {
            echo "grupo:" . $usua_grupos[$i] . "<br>";
            $sql2 = $db->exec("INSERT INTO participa (USUA_PRONT, GRUP_CODIGO) VALUES ('" . $usua_pront . "','" . $usua_grupos[$i] . "')");
            echo "grupo:" . $usua_grupos[$i] . "<br>";
        }
        if ($sql and $sql2) {
            $db->commit();
        } else {
            $db->rollBack();
        }
        //var_dump($usua_grupos);
        header("location: cadastroUsuario.php");
    }

    function usuarioConsulta2() {

        $pdo = $this->abreConexao();
        $sql = "select * from usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $log = $stmt->rowCount();
        return $stmt;
    }

    function grupoConsulta() {
        $pdo = $this->abreConexao();
        $sql = "select GRUP_NOME, GRUP_CODIGO from grupo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $log = $stmt->rowCount();
        return $stmt;
    }

    function fazerLogout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    function desativarUsuario($log) {
        $pdo = $this->abreConexao();
        $sql = "update usuario set USUA_ATIVO=0 where USUA_PRONT=:prontuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $log, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cadastroUsuario.php");
    }

    function ativarUsuario($prontuario) {
        $pdo = $this->abreConexao();
        $sql = "update usuario set USUA_ATIVO=1 where USUA_PRONT=:prontuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $prontuario, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cadastroUsuario.php");
    }

    function usuarioConsulta($prontuario) {
        $pdo = $this->abreConexao();
        $sql = "select * from usuario where USUA_PRONT=('" . $prontuario . "')";
        $stmt = $pdo->prepare($sql);
        //  $stmt->bindValue(":prontuario", $prontuario, PDO::PARAM_STR);
        $stmt->execute();
        return($stmt);
    }

    function contagemGrupos($SERGIO) {
        $pdo = $this->abreConexao();
        $sql = "select GRUP_NOME from usuario, grupo, participa where :prontuario=participa.USUA_PRONT and participa.GRUP_CODIGO=grupo.GRUP_CODIGO";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $SERGIO, PDO::PARAM_STR);
        $stmt->execute();
        return($stmt);
    }

    function grupoAltera($prontuario) {
        $pdo = $this->abreConexao();
        $sql = "select USUA_NOME,GRUP_NOME from usuario,grupo,participa where usuario.USUA_PRONT=:prontuario and usuario.USUA_PRONT=participa.USUA_PRONT and grupo.GRUP_CODIGO=participa.GRUP_CODIGO;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $prontuario, PDO::PARAM_STR);
        $stmt->execute();
        return($stmt);
    }

    function grupoConsultaporUsuario($prontuario) {
        $pdo = $this->abreConexao();
        $sql = "select * from participa where usua_pront=:prontuario";
        $stmt3 = $pdo->prepare($sql);
        $stmt3->bindValue(":prontuario", $prontuario);
        $stmt3->execute();
        return($stmt3);
    }

    function alteraUsuario($grupos) {
        $pdo = $this->abreConexao();
        $nome = $_POST['nomecompleto2'];
        $prontuario = $_POST['prontuario2'];
        $turma = $_POST['turma2'];
        $tipo = $_POST['tipo3'];
        if(isset($_POST['senha2'])){
            $senha = $_POST['senha2'];
            $senhamd5 = md5($senha);
        }else{
            $senhamd5 = $_POST['senha2'];
        }
        //var_dump($nome,$prontuario,$turma,$tipo, $grupos);
        $db = $pdo;
        $db->beginTransaction();
        $sql = $db->exec("update usuario set USUA_NOME='" . $nome . "', USUA_TURMA='" . $turma . "', USUA_TIPO='" . $tipo . "', USUA_SENHA='" . $senhamd5 . "' where USUA_PRONT='" . $prontuario . "'");
        $sql2 = $db->exec("delete from participa where USUA_PRONT='" . $prontuario . "'");
        for ($i = 0; $i < count($grupos); $i++) {
            $sql4 = ("INSERT INTO participa (GRUP_CODIGO, USUA_PRONT) VALUES (" . $grupos[$i] . ",'" . $prontuario . "')");
            //  echo $sql4 . "<br>";
            $sql3 = $db->exec($sql4);
            //var_dump($sql3);
            // die();
        }
        if ($sql && $sql2 and $sql3) {
            $db->commit();
            header("Location:cadastrousuario.php");
        } else {
            $db->rollBack();
            //var_dump($sql);
            //header("Location:cadastrousuario.php");
        }
    }

    function grupoLogado() {
        $pdo = $this->abreConexao();
        $sql = ("select grupo.GRUP_NOME from grupo,participa where ((participa.USUA_PRONT=:prontuario) and (participa.GRUP_CODIGO=grupo.GRUP_CODIGO)) limit 4");
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $_SESSION["USUA_PRONT"]);
        $stmt->execute();
        return ($stmt);
    }

    function enviandoMensagem($usuario, $mensagem){
        $pdo = $this->abreConexao();
        $sql = ("insert into mensagem (MENS_TIPO, MENS_FORM, MENS_TEXTO, MENS_ESTADO, USUA_PRONT, MENS_DATA values()");
    }
    
    function codigoGrupo($prontuario){
        $pdo = $this->abreConexao();
        $sql = "select participa.GRUP_CODIGO, grupo.GRUP_NOME from participa inner join grupo on participa.GRUP_CODIGO = grupo.GRUP_CODIGO where :prontuario = participa.USUA_PRONT";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $prontuario);
        $stmt->execute();
        return $stmt;
    }
    
    function prontuarioPe($prontuario){
        $pdo = $this->abreConexao();
        $sql = '';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":prontuario", $prontuario);
        $stmt->execute();
        return $stmt;
    }
}

function participa($resposta, $gruposqueparticipa) {
    for ($i = 0; $i < count($gruposqueparticipa); $i++) {
        if ($resposta == $gruposqueparticipa[$i]["GRUP_CODIGO"]) {
            return(true);
        }
    }
    return(false);
}
/*
function deadLine() {
    if (!dead) {
        die();
    }
}
*/