<?php

    require ("../database/conexion.php");

    if(isset($_POST['id_cama']) && isset($_POST['diagnosticar'])){

        $id_cama = $_POST['id_cama'];
        $diagnostico = $_POST['diagnosticar'];

        $preparada = $conexion->prepare("UPDATE camas SET diagnostico=:diagnostico WHERE id_cama=:id_cama");

        $preparada->bindParam(":diagnostico",$diagnostico);
        $preparada->bindParam(":id_cama",$id_cama);

        if($preparada->execute()){
            header('location:../personal/camas/cama_ocupada.php?id='.$id_cama);
        }else{
            echo "No se pudo agregar el diagnostico";
        }
    }else{
        die('No se ingresó todos los datos sugeridos');
    }

?>