<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGH</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    
    <form action="../controllers/login_admin_test.php" method="POST">
        <div>
            <label for="">Usuario</label>
            <input type="text" name="usuario">
        </div>
        <div>
            <label for="">Contraseña</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>

</body>
</html>