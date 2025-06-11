<?php
include("php/conexion.php");

if (isset($_POST["Registrar"])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
    $contraseña_encriptada = sha1($contraseña);

    $sqlusuario = "SELECT idusuarios FROM usuarios WHERE usuario = '$usuario'";
    $resultadousuario = mysqli_query($conexion, $sqlusuario);
    $filas = $resultadousuario->num_rows;

    if ($filas > 0) {
        echo "<script>
        alert('El Usuario Ya Existe');
        window.location = 'Registro.php';
        </script>";
    } else {
        $sqlusuario = "INSERT INTO usuarios (Nombre, Usuario, Correo, Contraseña) 
                            VALUES ('$nombre','$usuario', '$correo', '$contraseña_encriptada')";
        $resultadousuario = $conexion->query($sqlusuario); 

        if ($resultadousuario > 0) {
            echo "<script>
            alert('Registro Exitoso');
            window.location = 'Login.php';
            </script>"; 
        } else {
            echo "<script>
            alert('Error Al Registrarse');
            window.location = 'Registro.php';
            </script>"; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Cuenta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="login-body">
  <header>
    <a href="#" class="logo"><i class="bx bxs-main"></i></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
      <li><a href="main.php" class="inicio-activo">Inicio</a></li>
      <li><a href="#Categorias.html">Categorías</a></li>
      <li><a href="#En Directo">En Directo</a></li>
      <li><a href="Soporte.php">Soporte</a></li>
    </ul>
    <a href="Login.php" class="btnlogin">Acceder</a>
  </header>

  <div class="wrapper">
    <div class="form-box login">
      <h2>Crear Cuenta</h2>

      <?php if (!empty($mensajeError)): ?>
        <p style="color: red; text-align:center;"><?= htmlspecialchars($mensajeError) ?></p>
      <?php endif; ?>

      <form method="POST" action="registro.php">
        <div class="input-box">
          <input type="text" name="nombre" placeholder=" " value="<?= htmlspecialchars($nombre ?? '') ?>" required />
          <label>Nombre completo</label>
        </div>

        <div class="input-box">
          <input type="text" name="usuario" placeholder=" " value="<?= htmlspecialchars($usuario ?? '') ?>" required />
          <label>Nombre de usuario</label>
        </div>

        <div class="input-box">
          <input type="email" name="correo" placeholder=" " value="<?= htmlspecialchars($correo ?? '') ?>" required />
          <label>Correo electrónico</label>
        </div>

        <div class="input-box">
          <input type="password" name="contraseña" placeholder=" " required />
          <label>Contraseña</label>
        </div>

        <button type="submit" name="Registrar" class="btnIngresar">Registrarse</button>

        <div class="ingreso-registro">
          <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>