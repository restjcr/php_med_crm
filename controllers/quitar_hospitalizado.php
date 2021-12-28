<?php

    require('../database/conexion.php');

    if(isset($_POST['alta'])){

        $tabla = 'altas';

    }else if(isset($_POST['deceso'])){

        $tabla = 'decesos';

    }else{
        die("No se reconoce la peticion");
    }

    $id_cama = $_POST['id_cama'];

    $preparada_cama = $conexion->prepare("SELECT * from camas where id_cama=:id_cama");
    
    $preparada_cama->bindParam(':id_cama',$id_cama);
    
    $preparada_cama->setFetchMode(PDO::FETCH_ASSOC);
    
    $preparada_cama->execute();
    
    $resultado_cama = $preparada_cama->fetch();
    
    //Insertamos
    
    $preparada_registro = $conexion->prepare("INSERT INTO $tabla (id_cama,id_paciente,id_doctor,
    descripcion_ingreso,fecha_ingreso) VALUES (:id_cama,:id_paciente,:id_doctor,
    :descripcion_ingreso,:fecha_ingreso)");
    
    $preparada_registro->bindParam(':id_cama',$resultado_cama['id_cama']);
    $preparada_registro->bindParam(':id_paciente',$resultado_cama['id_paciente']);
    $preparada_registro->bindParam(':id_doctor',$resultado_cama['id_doctor']);
    $preparada_registro->bindParam(':descripcion_ingreso',$resultado_cama['descripcion_ingreso']);
    $preparada_registro->bindParam(':fecha_ingreso',$resultado_cama['fecha_ingreso']);
    
    if(!$preparada_registro->execute()){
        die("Error al insertar registro a altas o decesos");
    }

    //agregar diagnostico
    $preparada_resetear = $conexion->prepare("UPDATE camas SET id_paciente=NULL,id_doctor=NULL,
    descripcion_ingreso=NULL,fecha_ingreso=NULL,estado='libre' WHERE id_cama=:id_cama");

    $preparada_resetear->bindParam(':id_cama',$id_cama);

    if($preparada_resetear->execute()){
        echo "Todo salió bien";
    }else{
        echo "Todo salió mal";
    }

?>