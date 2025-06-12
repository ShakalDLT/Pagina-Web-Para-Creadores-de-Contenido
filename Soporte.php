<?php
session_start();
include("php/conexion.php");

if (isset($_POST["Enviar"])) {
    $Usuario = mysqli_real_escape_string($conexion, $_POST['Usuario']);
    $Correo = mysqli_real_escape_string($conexion, $_POST['Correo']);
    $Mensaje = mysqli_real_escape_string($conexion, $_POST['Mensaje']);

    $sqluser = "SELECT idticketsoporte FROM ticketsoporte WHERE Usuario = '$Usuario'";
    $resultadoticket = mysqli_query($conexion, $sqluser);
    $filas = mysqli_num_rows($resultadoticket);

    if ($filas > 0) {
        echo "<script>
        alert('Ya has enviado un Ticket');
        window.location = 'Soporte.php';
        </script>";
    } else {
        $sqltickesoporte = "INSERT INTO ticketsoporte (Usuario, Correo, Mensaje) 
                            VALUES ('$Usuario', '$Correo', '$Mensaje')";

        if (mysqli_query($conexion, $sqltickesoporte)) {
            echo "<script>
            alert('Ticket enviado exitosamente');
            window.location = 'Soporte.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Content Creation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body> 
   <header>
     <a href="#" class="logo">
      <i class="bx bxs-main"></i>
    </a>
      <div class="bx bx-menu" id="menu-icon"></div>
     
      <ul class="navbar">
        <li><a href="main.php" class="inicio-activo">Inicio</a></li>
        <li><a href="Creadores.php">Creadores</a></li>
        <li><a href="Tendencias.php">Tendencias</a></li>
        <li><a href="Soporte.php">Soporte</a></li>
      </ul>

      <?php if (isset($_SESSION['id_usuario'])): ?>
        <a href="Cuenta.php" class="btnlogin">Cuenta</a>
        <a href="/PaginaWeb/php/logout.php" class="btnlogout">Cerrar sesión</a>
      <?php else: ?>
        <a href="Login.php" class="btnlogin">Acceder</a>
      <?php endif; ?>
   </header>

   <section class="Soporte" id="Soporte">

    <h1 class = "soporte-titulo">Formulario de Soporte</h1>

    <div class="soporte-form">
        <form action="Soporte.php" method="POST">
            <input type="text" name="Usuario" placeholder="Nombre de Usuario" required>
            <input type="email" name="Correo" placeholder="Coloca tu Email" required>
            <textarea name="Mensaje" cols="30" rows="10" placeholder="Escribe tu Mensaje" required></textarea>
            <input type="submit" name="Enviar" value="Enviar" class="soporte-botton">
        </form>
    </div>
   </section>
</body>
<footer class="custom-footer">
  <div class="custom-footer-container">
    <p class="custom-footer-text">&copy; <?= date('Y') ?> TuSitioWeb. Todos los derechos reservados.</p>
  </div>
</footer>
</html>