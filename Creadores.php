<?php
include("php/conexion.php");
session_start();

$searchTerm = trim($_POST['searchTerm'] ?? '');
$searchField = $_POST['searchField'] ?? 'usuario';

$allowedFields = ['usuario', 'nombre', 'correo'];
if (!in_array($searchField, $allowedFields)) {
    $searchField = 'usuario';
}

if (!empty($searchTerm)) {
    $searchTermSql = mysqli_real_escape_string($conexion, $searchTerm);
    $sql = "SELECT usuario, nombre, correo, foto_perfil 
            FROM usuarios 
            WHERE $searchField LIKE '%$searchTermSql%'";
} else {
    $sql = "SELECT usuario, nombre, correo, foto_perfil FROM usuarios";
}

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
  <title>Creadores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <header>
    <a href="#" class="logo"><i class="bx bxs-main"></i></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
      <li><a href="main.php">Inicio</a></li>
      <li><a href="Creadores.php" class="inicio-activo">Creadores</a></li>
      <li><a href="Tendencias.php">Tendencias</a></li>
      <li><a href="Soporte.php">Soporte</a></li>
    </ul>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <a href="Cuenta.php" class="btnlogin">Cuenta</a>
    <?php else: ?>
      <a href="Login.php" class="btnlogin">Acceder</a>
    <?php endif; ?>
  </header>

<main class="search-content">
  <aside class="search-panel">
    <form method="POST" action="Creadores.php" class="search-form">
      <input 
        type="text" 
        name="searchTerm" 
        placeholder="Buscar usuario..." 
        value="<?= htmlspecialchars($searchTerm) ?>" 
        autocomplete="off"
      />
      <div class="search-options">
        <label><input type="radio" name="searchField" value="usuario" <?= $searchField === 'usuario' ? 'checked' : '' ?>> Usuario</label>
        <label><input type="radio" name="searchField" value="nombre" <?= $searchField === 'nombre' ? 'checked' : '' ?>> Nombre</label>
        <label><input type="radio" name="searchField" value="correo" <?= $searchField === 'correo' ? 'checked' : '' ?>> Correo</label>
      </div>
      <button type="submit" class="btnsearch">Buscar</button>
    </form>
  </aside>

  <section class="usuarios-grid">
    <!-- resto del código -->
  </section>
</main>

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
        </div>
      <?php
          } else {
      ?>
        <div class="usuario-card">
          <div class="usuario-imagen">
            <img src="img/avatar.png" alt="Ejemplo de perfil">
          </div>
          <h3 class="usuario-nombre">Ejemplo</h3>
        </div>
      <?php
          }
        }
      ?>
    </section>
  </main>

</body>
</html>