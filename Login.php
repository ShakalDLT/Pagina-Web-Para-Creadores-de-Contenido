<?php 
session_start();
include("php/conexion.php");

if (!empty($_POST)){
    $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
    $contraseña = mysqli_real_escape_string($conexion,$_POST['contraseña']);
    $contraseña_encriptada = sha1($contraseña);

    $sql = "SELECT idusuarios FROM usuarios WHERE correo = '$correo' AND contraseña ='$contraseña_encriptada'";
    $resultado = $conexion->query($sql);
    $rows = $resultado->num_rows;

    if ($rows > 0){
        $rows = $resultado->fetch_assoc();
        $_SESSION['id_usuario'] = $rows['idusuarios'];
        echo "<script>
                alert('Cuenta iniciada con éxito');
                window.location.href = 'main.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Correo o Contraseña Incorrecta');
                window.location = 'Login.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="login-body">
    <header>
        <a href="#" class="logo"><i class="bx bxs-main"></i></a>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="main.php" class="inicio-activo">Inicio</a></li>
            <li><a href="#Categorias.html">Categorias</a></li>
            <li><a href="#En Directo">En Directo</a></li>
            <li><a href="Soporte.php">Soporte</a></li>
        </ul>
        <a href="Login.php" class="btnlogin">Acceder</a>
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Ingresar</h2>
            <?php if (!empty($error)) : ?>
                <div style="color: red; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="input-box">
                    <input type="email" name="correo" placeholder=" " required value="<?= isset($correo) ? htmlspecialchars($correo) : '' ?>" />
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <input type="password" name="contraseña" placeholder=" " required />
                    <label>Contraseña</label>
                </div>
                <div class="recover">
                    <a href="#">¿Olvidaste la Contraseña?</a>
                </div>
                <button type="submit" class="btnIngresar">Ingresar</button>
                <div class="ingreso-registro">
                    <p>¿No tienes una Cuenta? <a href="Registro.php" class="registrar-link">Regístrate</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>