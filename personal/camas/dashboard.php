<?php 

    require("../../database/conexion.php");

    $sentencia = $conexion->query("SELECT id_cama,estado FROM camas",PDO::FETCH_ASSOC);

    $resultados = $sentencia->fetchAll();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <?php

        session_start();
    
        if(!isset($_SESSION["personal"])){
            header("location:../index.php");
        }

    ?>

    <h1><a href="../home.php">Home</a></h1>
    <main>
        <div class="left">
            <a href="">Camas</a>
            <a href="#">Altas</a>
            <a href="#">Decesos</a>
            <a href="../../controllers/logout.php">Cerrar sesion</a>
        </div>
        <div class="right">
            <h2>Camas</h2>
            <div class="camas-container">
                <?php foreach($resultados as $fila){ ?>
                    <?php if($fila['estado']=='libre'){ ?>
                        <a href="cama_libre.php?id=<?php echo $fila["id_cama"]?>" class="child">
                            <p><?php echo $fila['id_cama'] ?></p>
                            <i class="fas fa-procedures" style="color: green;"></i>
                            <span><?php echo $fila['estado']?></span>
                        </a>
                    <?php }else{ ?>
                        <a href="cama_ocupada.php?id=<?php echo $fila["id_cama"]?>" class="child">
                            <p><?php echo $fila['id_cama'] ?></p>
                            <i class="fas fa-procedures" style="color: #d90429;"></i>
                            <span><?php echo $fila['estado']?></span>
                        </a>
                    <?php }?>
                <?php }?>    
            </div>
        </div>
    </main>
</body>
</html>