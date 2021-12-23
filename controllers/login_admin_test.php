<?php 

    require("../database/conexion.php");

    $usuario = $_POST["usuario"];
    $password = sha1($_POST["password"]);

    $sentencia = $conexion->prepare("SELECT * FROM admins where usuario=:usuario AND password=:password");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);

    $sentencia->execute();

    $conexion = null;

    if ($sentencia->rowCount() == 1) {       
        
        session_start();

        $_SESSION["admin"] = $usuario;

        header("location:../admin/dashboard.php");

    } else {
        header("location:../index.php");
    }

?>