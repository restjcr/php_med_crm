<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/login.css">
    <!-- GOOGLE FONTS -->

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 

        if(isset($_GET["usuario"]) && ($_GET["usuario"]=="doctor" || $_GET["usuario"]=="personal" || $_GET["usuario"]=="admin")){
            $usuario = $_GET["usuario"];
        }else{
            header("location:../errors/404page.php");
        }

    ?>

    <main>
        <div class="izquierda">
            <img src="../images/hospital-portada.jpg" alt="">
        </div>
        <div class="derecha">
            <h1 class="hospital-titulo">FISI HOSPITAL</h1>
            <h2 class="hospital-slogan">Slogan</h2>
            <p class="login">Log in</p>
            <div class="login-wrapper">
                <form action="../controllers/login_<?php echo $usuario ?>_test.php" method="POST">
                    <div class="form-control">
                        <label for="">Usuario</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i><input type="text" name="usuario">
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="">Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-unlock"></i><input type="password" name="password">
                        </div>
                    </div>
                    <div class="form-submit">
                        <input type="submit" value="Ingresar">
                    </div>
                </form>
                <p class="forgot-password"><a href="#">¿Olvidó su contraseña?</a></p>
            </div>
            <footer class="footer">
                <ul>
                    <li><a href="#">Term. y condiciones</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="#">Atencion al cliente</a></li>
                </ul>
            </footer>
        </div>
    </main>
</body>
</html>