<?php 

    require("../database/conexion.php");

?>

<?php

    //Para la especialidad escogida
    $id_especialidad = $_GET["id"];

    $sentencia_especialidad = $conexion->prepare("SELECT * FROM especialidades WHERE id_especialidad=:id");
    
    $sentencia_especialidad->bindParam(":id",$id_especialidad);
    
    $sentencia_especialidad->setFetchMode(PDO::FETCH_ASSOC);
    
    $sentencia_especialidad->execute();
    
    $fila_especialidad = $sentencia_especialidad->fetch();

?>

<?php
    
    //Para los doctores de esa especialidad

    $sentencia_doctores = $conexion->prepare("SELECT * FROM doctores where especialidad=:especialidad");

    $sentencia_doctores->bindParam(":especialidad",$fila_especialidad["nombre"]);

    $sentencia_doctores->setFetchMode(PDO::FETCH_ASSOC);

    $sentencia_doctores->execute();

    $resultados_doctores = $sentencia_doctores->fetchAll();

    date_default_timezone_set("America/Lima");
    
    $fecha = date("Y-m-d");

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

    <?php

        session_start();

        if(!isset($_SESSION["personal"])){

            header("location:../index.php");

        }
    ?>
    
    <header>
        <h1><?php echo $fila_especialidad["nombre"]?></h1>
        <a href="../controllers/logout.php">Log out</a>
    </header>
    <main>
        <div class="left">
            <form action="insertar.php?id=<?php echo $id_especialidad?>" method="POST">
                <input type="hidden" value="<?php echo $fila_especialidad["nombre"]?>" name="especialidad">
                <div>
                    <label for="paciente">Paciente</label>
                    <input type="number" name="id_paciente">
                </div>
                <div>
                    <label for="doctor">Doctor</label>
                    <select name="id_doctor" id="doctor">
                        <?php foreach($resultados_doctores as $doctor){ ?>
                        <option value="<?php echo $doctor["id_doctor"]?>"><?php echo $doctor["nombres"] . " " . $doctor["apellidos"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div>
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha">
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    <div class="right">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Paciente</th>
                    <th>Especialidad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                    $sentencia_citas = $conexion->prepare(
                    "SELECT citas.id_cita, concat(doctores.nombres,' ',doctores.apellidos) as doctor,
                    concat(pacientes.nombres,' ',pacientes.apellidos) as paciente,
                    citas.especialidad,citas.fecha  
                    FROM citas 
                    INNER JOIN pacientes USING (id_paciente)  
                    INNER JOIN doctores USING (id_doctor) 
                    WHERE citas.especialidad = :especialidad and citas.fecha=:fecha"
                    );

                    $sentencia_citas->bindParam(":especialidad",$fila_especialidad["nombre"]);
                    $sentencia_citas->bindParam(":fecha",$fecha);

                    $sentencia_citas->setFetchMode(PDO::FETCH_ASSOC);
                    
                    $sentencia_citas->execute();

                    $resultados_citas = $sentencia_citas->fetchAll();
                    
                ?>
                <?php  foreach($resultados_citas as $cita){ ?>
                    
                    <tr>
                        <td><?php echo $cita["id_cita"]; ?></td>
                        <td><?php echo $cita["doctor"]; ?></td>
                        <td><?php echo $cita["paciente"]; ?></td>
                        <td><?php echo $cita["especialidad"]; ?></td>
                        <td><?php echo $cita["fecha"]; ?></td>
                        <td><a href="editar.php?id=<?php echo $fila["id_cita"]?>">Edit</a></td>
                        <td><a href="eliminar.php?id=<?php echo $fila["id_cita"]?>">Elim</a></td>
                    </tr>
                        
                <?php }?>
            </tbody>
        </table>
    </div>
    </main>

</body>
</html>