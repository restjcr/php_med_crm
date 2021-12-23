<?php

    $db_servidor = "localhost";
    $db_usuario = "root";
    $db_contraseña = "_qw652@jajs$";
    $db_nombre = "proyecto_ihc";

    try{

        $conexion = new PDO("mysql:dbname=$db_nombre;host=$db_servidor",$db_usuario,$db_contraseña);

        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){

        die("No se pudo conectar a la base de datos" . $e->getMessage());
    }

?>