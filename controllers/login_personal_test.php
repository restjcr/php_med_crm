<?php 

    require("../database/conexion.php");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sentencia = $conexion->prepare("SELECT * FROM personal where nombres=:usuario AND dni=:password");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);

    $sentencia->execute();

    $conexion = null;

    if ($sentencia->rowCount() == 1) {
        
        session_start();

        $_SESSION["personal"] = $usuario;

        header("location:../personal/home.php");

    } else {
        header("location:../index.php");
    }
    
    $conexion = null;

?>