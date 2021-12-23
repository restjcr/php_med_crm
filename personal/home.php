<?php 

    require("../database/conexion.php");

    $sentencia = $conexion->query("SELECT * FROM especialidades",PDO::FETCH_ASSOC);

    $resultados = $sentencia->fetchAll();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <?php

        session_start();
    
        if(!isset($_SESSION["personal"])){
            header("location:../index.php");
        }

    ?>

    <h1>SGH</h1>
    <main>
        <div class="left">
            <a href="#">Citas</a>
            <a href="camas/dashboard.php">Camas</a>
            <a href="../controllers/logout.php">Cerrar sesion</a>
        </div>
        <div class="right">
            <h2>Citas</h2>
            <div class="especialidades-container">
                <?php foreach($resultados as $fila){ ?>
                    <a href="citas/dashboard.php?id=<?php echo $fila["id_especialidad"]?>" class="child"><?php echo $fila["nombre"] ?></a>
                <?php }?>    
            </div>
        </div>
    </main>
</body>
</html>