<?php

    require("../database/conexion.php");

    $id_especialidad = $_GET["id"];

    $id_doctor = $_POST["id_doctor"];
    $id_paciente = $_POST["id_paciente"];
    $fecha = $_POST["fecha"];
    $especialidad = $_POST["especialidad"];

    $sentencia = $conexion->prepare("INSERT INTO citas (id_paciente,id_doctor,especialidad,fecha) VALUES (:id_paciente,:id_doctor,:especialidad,:fecha)");

    $sentencia->bindParam(":id_paciente",$id_paciente);
    $sentencia->bindParam(":id_doctor",$id_doctor);
    $sentencia->bindParam(":especialidad",$especialidad);
    $sentencia->bindParam(":fecha",$fecha);

    if($sentencia->execute()){

        header("location:dashboard.php?id=$id_especialidad");

    }else{
        echo("No se pudo registrar al usuario");
    }

    $conexion = null;

?>