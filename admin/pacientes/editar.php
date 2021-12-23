<?php

    require("../../database/conexion.php");

    if(isset($_GET["id"])){

        $id = $_GET["id"];

        $sentencia = $conexion->prepare("SELECT * FROM pacientes WHERE id_paciente = :id");

        $sentencia->bindParam(":id",$id);

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);

        $sentencia->execute();

        $fila = $sentencia->fetch(); 
    }

    if(isset($_POST["editar"])){
        
        $id_paciente = $_POST["id_paciente"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $dni = $_POST["dni"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];

        $sentencia = $conexion->prepare("UPDATE pacientes SET nombres=:nombres,apellidos=:apellidos,telefono=:telefono,
        email=:email WHERE id_paciente=:id_paciente AND dni=:dni");

        $sentencia->bindParam(":nombres",$nombres);
        $sentencia->bindParam(":apellidos",$apellidos);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":email",$email);
        $sentencia->bindParam(":id_paciente",$id_paciente);
        $sentencia->bindParam(":dni",$dni);

        if($sentencia->execute()){

            header("location:dashboard.php");

        }else{

            echo "No se pudo editar la informacion del paciente";

        }

    }

    $conexion = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="id_paciente" value="<?php echo $fila["id_paciente"]?>">
        <div>
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" value="<?php echo $fila["nombres"]?>">
        </div>
        <div>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $fila["apellidos"]?>">
        </div>
        <input type="hidden" name="dni" value="<?php echo $fila["dni"]?>">
        <div>
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" value="<?php echo $fila["telefono"]?>">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" value="<?php echo $fila["email"]?>">
        </div>
        <div>
            <input type="submit" value="Editar" name="editar">
        </div>
    </form>

</body>
</html>