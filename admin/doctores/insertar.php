<?php

    require("../../database/conexion.php");

    if(isset($_POST["enviar"])){

        $nombre = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $dni = $_POST["dni"];
        $telefono = $_POST["telefono"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];

        $sentencia = $conexion->prepare("INSERT INTO doctores (nombres,apellidos,dni,telefono,especialidad,email) 
        VALUES (:nombres,:apellidos,:dni,:telefono,:especialidad,:email)");

        $sentencia->bindParam(":nombres",$nombre);
        $sentencia->bindParam(":apellidos",$apellidos);
        $sentencia->bindParam(":dni",$dni);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":especialidad",$especialidad);
        $sentencia->bindParam(":email",$email);

        if($sentencia->execute()){
            header("location:dashboard.php");
        }else{
            echo "No se pudo registrar al doctor";
        }

        $conexion = null;

    }

?>