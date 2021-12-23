<?php 

    require("../database/conexion.php");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sentencia = $conexion->prepare("SELECT * FROM doctores where id_doctor=:usuario AND dni=:password");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);

    $sentencia->execute();

    $conexion = null;

    if ($sentencia->rowCount() == 1) {
        
        session_start();

        $_SESSION["doctor"]=$usuario;

        header("location:../doctores/dashboard.php");

    } else {
        header("location:../index.php");
    }
    
   

?>