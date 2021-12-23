<?php 

    require("../database/conexion.php");

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
    
        if(!isset($_SESSION["doctor"])){
            header("location:../index.php");
        }

    ?>

    <h1>SGH</h1>
    <main>
        <div class="left">
            <a href="../controllers/logout.php">Cerrar sesion</a>
        </div>
        <div class="right">
            <h2>Mis citas</h2>
            <div>
                  
            </div>
        </div>
    </main>
</body>
</html>