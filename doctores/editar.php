<?php

    require("../database/conexion.php");

    if(isset($_GET["id"]) && isset($_GET["estado"])){

        $id = $_GET["id"];
        $estado_inicial = $_GET["estado"];

        $sentencia = $conexion->prepare("SELECT * FROM citas WHERE id_cita = :id");

        $sentencia->bindParam(":id",$id);

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);

        $sentencia->execute();

        $conexion = null;

        $fila = $sentencia->fetch(); 
    }

    if(isset($_POST["editar"])){
        
        $id_cita = $_POST["id_cita"];
        $estado_final = $_POST["estado"];

        $sentencia = $conexion->prepare("UPDATE citas SET estado=:estado WHERE id_cita=:id_cita");

        $sentencia->bindParam(":id_cita",$id_cita);
        $sentencia->bindParam(":estado",$estado_final);

        if($sentencia->execute()){

            header("location:dashboard.php");

        }else{

            echo "No se pudo editar la informacion del doctor";

        }
        
        $conexion = null;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="id_cita" value="<?php echo $fila["id_cita"]?>">
        <div>
            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <?php if($estado_inicial == "pendiente"){ ?>
                        
                    <option value="<?php echo $estado_inicial?>"><?php echo $estado_inicial?></option>
                    <option value="atendido">atendido</option>

                <?php }else{ ?>

                    <option value="<?php echo $estado_inicial?>"><?php echo $estado_inicial?></option>
                    <option value="pendiente">pendiente</option>

                <?php }?>    
            </select>
        </div>
        <div>
            <input type="submit" value="Editar" name="editar">
        </div>
    </form>

</body>
</html>