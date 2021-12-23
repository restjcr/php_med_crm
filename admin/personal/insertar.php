<?php

    require("../../database/conexion.php");

    if(isset($_POST["enviar"])){

        $nombre = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $dni = $_POST["dni"];
        $telefono = $_POST["telefono"];
        $cargo = $_POST["cargo"];
        $email = $_POST["email"];

        $sentencia = $conexion->prepare("INSERT INTO personal (nombres,apellidos,dni,telefono,cargo,email) 
        VALUES (:nombres,:apellidos,:dni,:telefono,:cargo,:email)");

        $sentencia->bindParam(":nombres",$nombre);
        $sentencia->bindParam(":apellidos",$apellidos);
        $sentencia->bindParam(":dni",$dni);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":cargo",$cargo);
        $sentencia->bindParam(":email",$email);

        if($sentencia->execute()){
            header("location:dashboard.php");
        }else{
            echo "No se pudo registrar al personal";
        }

        $conexion = null;

    }

?>