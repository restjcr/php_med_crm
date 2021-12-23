<?php 

    require("../../database/conexion.php");

    $id_cama = $_GET['id'];

    $preparada = $conexion->prepare('SELECT * from camas WHERE id_cama=:id_cama');

    $preparada->bindParam(':id_cama',$id_cama);

    $preparada->setFetchMode(PDO::FETCH_ASSOC);

    $preparada->execute();

    $resultado = $preparada->fetch();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/cama.css">
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
            <a href="../controllers/logout.php">Cerrar sesion</a>
            <a href="dashboard.php">Camas</a>
        </div>
        <div class="right">
            <h2 class="right-title">Cama <?php echo $resultado['id_cama']?></h2>
            <div class="right-content">
                <div class="right-content-left">
                    <img src="../../images/cama_hospital1_mejorada.png" alt="img">
                </div>
                <div class="right-content-right">
                    <form action="../../controllers/ingresar_hospitalizado.php" method="POST">
                        <input type="hidden" name="id_cama" value="<?php echo $resultado['id_cama']?>">
                        <div>
                            <label for="paciente">Cod. paciente</label>
                            <input type="text" name="paciente">
                        </div>
                        <div>
                            <label for="doctor">Cod. doctor</label>
                            <input type="text" name="doctor">
                        </div>
                        <div>
                            <label for="descripcion_ingreso">Descripcion</label>
                            <textarea name="descripcion_ingreso" id="descripcion_ingreso" cols="30" rows="10"></textarea>
                        </div>
                        <!-- <div>
                            <label for="diagnostico">Diagnostico</label>
                            <input type="text" name="diagnostico">
                        </div> -->
                        <div>
                            <label for="ingreso">Ingreso</label>
                            <input type="datetime-local" name="ingreso">
                        </div>
                        <div>
                            <input type="submit" name="registrar" value="Registrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>