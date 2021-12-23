<?php require("../../database/conexion.php")?>

<?php
    
        session_start();

        if(!isset($_SESSION["admin"])){
            
            header("location:../../index.php");

        }
    
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
    
    <header>
        <h1><a href="../dashboard.php">Home</a></h1>
        <a href="../../controllers/logout.php">Log out</a>
    </header>
    <main>
    <div class="left">
        <form action="insertar.php" method="POST">
            <div>
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres">
            </div>
            <div>
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos">
            </div>
            <div>
                <label for="dni">DNI</label>
                <input type="text" name="dni">
            </div>
            <div>
                <label for="telefono">Telefono</label>
                <input type="tel" name="telefono">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email">
            </div>
            <div>
                <input type="submit" value="enviar" name="enviar">
            </div>
            
        </form>
    </div>
    <div class="right">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                    $sentencia = $conexion->prepare("SELECT * FROM pacientes");

                    $sentencia->execute();

                    $sentencia->setFetchMode(PDO::FETCH_ASSOC);

                    $resultados = $sentencia->fetchAll();
                    
                ?>
                <?php  foreach($resultados as $fila){ ?>
                    
                    <tr>
                        <td><?php echo $fila["id_paciente"]; ?></td>
                        <td><?php echo $fila["nombres"]; ?></td>
                        <td><?php echo $fila["apellidos"]; ?></td>
                        <td><?php echo $fila["dni"]; ?></td>
                        <td><?php echo $fila["telefono"]; ?></td>
                        <td><?php echo $fila["email"]; ?></td>
                        <td><?php echo $fila["fecha_registro"]; ?></td>
                        <td><a href="editar.php?id=<?php echo $fila["id_paciente"]?>">Edit</a></td>
                        <td><a href="eliminar.php?id=<?php echo $fila["id_paciente"]?>">Elim</a></td>
                    </tr>
                        
                <?php }?>
            </tbody>
        </table>
    </div>
    </main>

</body>
</html>