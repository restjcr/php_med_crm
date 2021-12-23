<?php

    require('../database/conexion.php');

    if(isset($_POST['id_cama']) && isset($_POST['paciente']) && isset($_POST['doctor']) &&
    isset($_POST['descripcion_ingreso']) && isset($_POST['ingreso'])){

        $id_cama = $_POST['id_cama'];
        $id_paciente = $_POST['paciente'];
        $id_doctor = $_POST['doctor'];
        $descripcion_ingreso = $_POST['descripcion_ingreso'];
        $ingreso = $_POST['ingreso'];
        $estado = "ocupada";

        $preparada = $conexion->prepare("UPDATE camas SET id_paciente=:id_paciente,id_doctor=:id_doctor,
        descripcion_ingreso=:descripcion_ingreso,estado=:estado,fecha_ingreso=:fecha_ingreso WHERE id_cama=:id_cama");

        $preparada->bindParam(':id_paciente',$id_paciente);
        $preparada->bindParam(':id_doctor',$id_doctor);
        $preparada->bindParam(':descripcion_ingreso',$descripcion_ingreso);
        $preparada->bindParam(':estado',$estado);
        $preparada->bindParam(':fecha_ingreso',$ingreso);
        $preparada->bindParam(':id_cama',$id_cama);

        $preparada->setFetchMode(PDO::FETCH_ASSOC);

        if($preparada->execute()){
            header('location:../personal/camas/cama_ocupada.php?id='.$id_cama);
        }else{
            echo "No se pudo realizar el registro";
        }


    }else{
        die('No se ingresó todos los datos sugeridos');
    }

?>