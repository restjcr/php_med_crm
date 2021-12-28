<?php 

    require("../database/conexion.php");

    $sentencia_especialidades = $conexion->query("SELECT * FROM especialidades",PDO::FETCH_ASSOC);

    $resultados = $sentencia_especialidades->fetchAll();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/home.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <?php

        session_start();
    
        if(!isset($_SESSION["personal"])){
            header("location:../index.php");
        }

    ?>

    <header class="header">
        <div class="header-top">
            <p>¡Bienvenido(a) al sistema informático del FISI-Hospital!</p>
        </div>
        <div class="header-bottom">
            <a href="home.php" class="header-bottom-left">
                <div class="header-bottom-left-left">
                    <img src="../images/hospital-logo.png" alt="">
                </div>
                <div class="header-bottom-left-right">
                    <h1>FISI Hospital</h1>
                </div>
            </a>
            <div class="header-bottom-center">
                <div class="header-bottom-center-left"><i class="fas fa-clock"></i></div>
                <div class="header-bottom-center-right">
                    <p>Atencion:</p>
                    <p>Lun-Sab/9am-9pm</p>
                </div>
            </div>
            <div class="header-bottom-right">
                <div class="header-bottom-right-left"><i class="fas fa-phone"></i></div>
                <div class="header-bottom-right-right">987 654 321</div>
            </div>
        </div>
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
                    <li><a href="../controllers/logout.php">Cerrar Sesion</a></li>
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
                <h2>Especialidades</h2>
            </div>
            <div class="main-right-bottom">
                <?php foreach($resultados as $fila){ ?>
                    <a href="citas/dashboard.php?id=<?php echo $fila["id_especialidad"]?>" class="main-right-bottom-cell">
                        <div class="main-right-bottom-cell-left"></div>
                        <div class="main-right-bottom-cell-right"><?php echo $fila["nombre"] ?></div>
                    </a>
                <?php }?> 
            </div>
        </div>
    </main>

    <footer class="footer">
        SGH - Todos los derechos reservados
    </footer>

</body>
</html>