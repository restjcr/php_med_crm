<?php

    require("../../database/conexion.php");

    $id = $_GET["id"];

    $sentencia = $conexion->prepare("DELETE FROM pacientes WHERE id_paciente=:id");

    $sentencia->bindParam(":id",$id);

    if($sentencia->execute()){
        
        header("location:dashboard.php");

    }else{

        echo "No se pudo eliminar al paciente";
    }

    $conexion = null;


?>