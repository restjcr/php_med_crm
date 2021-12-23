<?php

    require("../../database/conexion.php");

    $id = $_GET["id"];

    $sentencia = $conexion->prepare("DELETE FROM personal WHERE id_personal=:id");

    $sentencia->bindParam(":id",$id);

    if($sentencia->execute()){
        
        header("location:dashboard.php");

    }else{

        echo "No se pudo eliminar al personal";
    }

    $conexion = null;


?>