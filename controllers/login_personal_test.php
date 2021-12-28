<?php 

    require("../database/conexion.php");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sentencia = $conexion->prepare("SELECT * FROM personal where nombres=:usuario AND dni=:password");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);

    $sentencia->setFetchMode(PDO::FETCH_ASSOC);

    $sentencia->execute();

    $personal = $sentencia->fetch();

    $conexion = null;
    
    if ($sentencia->rowCount() == 1) {
        
        session_start();

        $_SESSION["id_personal"] = $personal["id_personal"];
        $_SESSION["nombres_personal"] = $personal["nombres"];
        $_SESSION["apellidos_personal"] = $personal["apellidos"];

        header("location:../personal/home.php");

    } else {
        header("location:../index.php");
    }
    
    $conexion = null;

?>