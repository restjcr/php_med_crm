<?php 

    require("../../database/conexion.php");

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
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <?php

        session_start();

        if(!isset($_SESSION["personal"])){

            header("location:../index.php");

        }
    ?>
    
    <header class="header">
        <h1>Reservar cita</h1>
    </header>
    
    <main class="main">
        <div class="main-left">
            <div class="main-left-top">
                <div class="main-left-top-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="main-left-top-username">
                    <h3><?php echo $_SESSION["nombres_personal"] . " ". $_SESSION["apellidos_personal"]?></h3>
                </div>
            </div>
            <div class="main-left-center">
                <ul>
                    <li><a href="#">Informacion personal</a></li>
                    <li><a href="#">Reservar cita</a></li>
                    <li><a href="#">Historial de citas</a></li>
                    <li><a href="#">Cerrar Sesion</a></li>
                </ul>
            </div>
            <div class="main-left-bottom">
                 <div class="main-left-bottom-cell">
                    <a href="#">Sobre nosotros</a>
                 </div>
                 <div class="main-left-bottom-cell">
                    <a href="#">Contacto</a>
                 </div>
                 <div class="main-left-bottom-cell">
                    <a href="#">Terminos y condiciones</a>
                 </div>
            </div>
        </div>
        <div class="main-right">
            <div class="main-right-top">
                hduhudhouhfoihjf
            </div>
            <div class="main-right-center">
                <h2><?php echo $fila_especialidad["nombre"]?></h2>
            </div>
            <div class="main-right-bottom">
                <div class="main-right-bottom-left">
                    <form action="insertar.php?id=<?php echo $id_especialidad?>" method="POST">
                        <input type="hidden" value="<?php echo $fila_especialidad["nombre"]?>" name="especialidad">
                            <table>
                                <tbody>
                                    <tr>
                                    <td><label for="paciente">Paciente</label></td>
                                    <td><input type="number" name="id_paciente"></td>
                                </tr>
                                <tr>
                                    <td><label for="doctor">Doctor</label></td>
                                    <td>
                                        <select name="id_doctor" id="doctor">
                                        <?php foreach($resultados_doctores as $doctor){ ?>
                                            <option value="<?php echo $doctor["id_doctor"]?>"><?php echo $doctor["nombres"] . " " . $doctor["apellidos"]?></option>
                                        <?php }?>
                                         </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="fecha">Fecha</label></td>
                                    <td><input type="date" name="fecha"></td>
                                </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" value="Enviar"></td>
                                </tr>
                            </table>
                        <!-- <div>
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
                        </div> -->
                    </form>
                </div>
                <div class="main-right-bottom-right">
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
            </div>
        </div>
    </main>

    <footer class="footer">
        SGH - Todos los derechos reservados
    </footer>
    <!-- <main>
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
    </main> -->

</body>
</html>