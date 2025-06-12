<?php
include("php/conexion.php");
session_start();


$sql = "SELECT usuario, nombre, correo, foto_perfil, busquedas 
        FROM usuarios 
        ORDER BY busquedas DESC 
        LIMIT 9";

$resultado = mysqli_query($conexion, $sql);
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
$usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Tendencias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <header>
    <a href="#" class="logo"><i class="bx bxs-main"></i></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
      <li><a href="main.php">Inicio</a></li>
      <li><a href="Creadores.php">Creadores</a></li>
      <li><a href="Tendencias.php" class="inicio-activo">Tendencias</a></li>
      <li><a href="Soporte.php">Soporte</a></li>
    </ul>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <a href="Cuenta.php" class="btnlogin">Cuenta</a>
    <?php else: ?>
      <a href="Login.php" class="btnlogin">Acceder</a>
    <?php endif; ?>
  </header>

  <main class="search-content">
    <section class="usuarios-grid">
      <?php
        $min_cards = 9;
        $usuarios_count = count($usuarios);
        for ($i = 0; $i < $min_cards; $i++) {
          if ($i < $usuarios_count) {
            $usuario = $usuarios[$i];
      ?>
        <div class="usuario-card">
          <div class="usuario-imagen">
            <img src="<?= !empty($usuario['foto_perfil']) ? 'uploads/' . htmlspecialchars($usuario['foto_perfil']) : 'img/avatar.png' ?>" alt="Perfil de <?= htmlspecialchars($usuario['usuario']) ?>">
          </div>
          <h3 class="usuario-nombre"><?= htmlspecialchars($usuario['usuario']) ?></h3>
          <p class="usuario-busquedas">Búsquedas: <?= (int)$usuario['busquedas'] ?></p>
        </div>
      <?php
          } else {
      ?>
        <div class="usuario-card">
          <div class="usuario-imagen">
            <img src="img/avatar.png" alt="Ejemplo de perfil">
          </div>
          <h3 class="usuario-nombre">Ejemplo</h3>
          <p class="usuario-busquedas">Búsquedas: 0</p>
        </div>
      <?php
          }
        }
      ?>
    </section>
  </main>

</body>
<footer class="custom-footer">
  <div class="custom-footer-container">
    <p class="custom-footer-text">&copy; <?= date('Y') ?> TuSitioWeb. Todos los derechos reservados.</p>
  </div>
</footer>
</html>