<?php 

    require("../../database/conexion.php");

    $id_cama = $_GET['id'];

    $preparada = $conexion->prepare("SELECT concat_ws(' ',p.nombres,p.apellidos) as paciente,concat_ws(' ',d.nombres,d.apellidos) as doctor,
        c.estado,c.descripcion_ingreso,c.fecha_ingreso,c.id_cama,c.diagnostico 
	    from camas as c
	        inner join pacientes as p on c.id_paciente = p.id_paciente
	        inner join doctores as d on c.id_doctor = d.id_doctor
        where c.id_cama = :id_cama");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                    <form action="../../controllers/quitar_hospitalizado.php" method="POST">
                        <input type="hidden" name="id_cama" value="<?php echo $resultado['id_cama']?>">
                        <div>
                            <label for="paciente">Paciente</label>
                            <input type="text" name="paciente" value="<?php echo $resultado['paciente']?>" disabled>
                        </div>
                        <div>
                            <label for="doctor">Doctor</label>
                            <input type="text" name="doctor" value="<?php echo $resultado['doctor']?>" disabled>
                        </div>
                        <div>
                            <label for="descripcion_ingreso">Descripcion</label>
                            <textarea name="descripcion_ingreso" id=descripcion_ingreso" cols="30" rows="10" disabled>
                                <?php echo $resultado['descripcion_ingreso']?>  
                            </textarea>
                        </div>
                        <div>
                            <label for="ingreso">Ingreso</label>
                            <input type="text" name="ingreso" value="<?php echo $resultado['fecha_ingreso']?>" disabled>
                        </div>
                        <div>
                            <label for="diagnostico">Diagnostico</label>
                            <input type="text" name="diagnostico" value="<?php echo $resultado['diagnostico']?>" disabled>
                        </div>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Diagnosticar
                            </button>
                            <input type="submit" name="alta" value="Alta">
                            <input type="submit" name="deceso" value="Deceso">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Diagnostico</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../../controllers/agregar_diagnostico.php" method="post">
                <input type="hidden" name="id_cama" value="<?php echo $resultado['id_cama']?>">
                <label for="diagnosticar">Diagnostico</label>
                <input type="text" name="diagnosticar">
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>