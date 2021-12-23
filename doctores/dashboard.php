<?php

        require("../database/conexion.php");

        session_start();
    
        if(!isset($_SESSION["doctor"])){
            header("location:../index.php");
        }

        $id_doctor = $_SESSION["doctor"];

        date_default_timezone_set("America/Lima");
    
        $fecha = date("Y-m-d");

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h1>SGH</h1>
    <main>
        <div class="left">
            <a href="../controllers/logout.php">Cerrar sesion</a>
        </div>
        <div class="right">
            <h2>Mis citas</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            $sentencia_citas_doctor = $conexion->prepare(
                            "SELECT id_cita,concat(pacientes.nombres,' ',pacientes.apellidos) as paciente,citas.fecha,estado FROM citas
                            INNER JOIN pacientes using(id_paciente)
                            WHERE id_doctor=:id_doctor AND fecha=:fecha");

                            $sentencia_citas_doctor->bindParam(":id_doctor",$id_doctor);
                            $sentencia_citas_doctor->bindParam(":fecha",$fecha);

                            $sentencia_citas_doctor->setFetchMode(PDO::FETCH_ASSOC);

                            $sentencia_citas_doctor->execute();

                            $resultados_citas_doctor = $sentencia_citas_doctor->fetchAll();

                        ?>
                        <?php  foreach($resultados_citas_doctor as $cita_doctor){ ?>

                            <tr>
                                <td><?php echo $cita_doctor["paciente"]; ?></td>
                                <td><?php echo $cita_doctor["fecha"]; ?></td>
                                <?php if($cita_doctor["estado"]=="pendiente"){ ?>
                                <td style="background-color: yellow;"><?php echo $cita_doctor["estado"]; ?></td>
                                <?php }else{ ?>
                                    <td style="background-color: green;"><?php echo $cita_doctor["estado"]; ?></td>
                                <?php } ?>
                                <td><a href="editar.php?id=<?php echo $cita_doctor["id_cita"]?>&estado=<?php echo $cita_doctor["estado"]?>">Edit</a></td>
                                <td><a href="eliminar.php?id=<?php echo $cita_doctor["id_cita"]?>">Elim</a></td>
                            </tr>

                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>