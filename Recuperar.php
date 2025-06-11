<?php 
include("php/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);


    $query = "SELECT idusuarios FROM usuarios WHERE correo = '$correo'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {

        $nueva_contraseña = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 10);
        $nueva_contraseña_encriptada = sha1($nueva_contraseña);


        $update = "UPDATE usuarios SET contraseña = '$nueva_contraseña_encriptada' WHERE correo = '$correo'";
        $conexion->query($update);

        $asunto = "Recuperación de contraseña";
        $mensaje = "Tu nueva contraseña es: $nueva_contraseña\n\nPor favor cámbiala al iniciar sesión.";
        $cabeceras = "From: no-reply@tupagina.com";

        if (mail($correo, $asunto, $mensaje, $cabeceras)) {
            echo "<script>alert('Se ha enviado la contraseña al correo'); window.location.href = 'Login.php';</script>";
        } else {
            echo "<script>alert('Error al enviar el correo. Intenta más tarde.');</script>";
        }
    } else {
        echo "<script>alert('Correo no registrado');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Recuperar Contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="login-body">
    <header>
        <a href="#" class="logo"><i class="bx bxs-main"></i></a>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="main.php" class="inicio-activo">Inicio</a></li>
            <li><a href="Categorias.php">Categorias</a></li>
            <li><a href="Tendencias.php">Tendencias</a></li>
            <li><a href="Soporte.php">Soporte</a></li>
        </ul>
        <a href="Login.php" class="btnlogin">Acceder</a>
        
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Recuperar Contraseña</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <input type="email" name="correo" placeholder=" " required />
                   <label>Correo</label>
                </div>
                <button type="submit" class="btnIngresar">Enviar Contraseña</button>
                <div class="ingreso-registro">
                    <p><a href="Login.php">Volver al login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>