<?php
include 'php/conexion.php';
session_start();

$user_id = $_SESSION['id_usuario'] ?? null;

if (!$user_id) {
    die("No estás logueado");
}

$sql = "SELECT nombre, usuario, correo, foto_perfil FROM usuarios WHERE idusuarios = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuario no encontrado");
}

$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Cuenta de <?php echo htmlspecialchars($usuario['nombre']); ?></title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Aquí podrías incluir cualquier otro CSS o scripts -->
</head>
<body>

<header>
  <ul class="navbar">
    <li><a href="main.php">Inicio</a></li>
    <li><a href="Categorias.php">Categorías</a></li>
    <li><a href="Tendencias.php">Tendencias</a></li>
    <li><a href="Soporte.php">Soporte</a></li>
  </ul>

  <a href="cuenta.php" class="btnlogin">Cuenta</a>
  <a href="php/logout.php" class="btnlogout">Cerrar sesión</a>
</header>

<main style="display:flex; padding: 2rem; gap: 2rem;">

  <section style="width: 300px;">

    <!-- Área para imagen perfil -->
    <div id="foto-perfil" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin-bottom: 1rem; background:#eee; cursor:pointer;">
        <?php if ($usuario['foto_perfil']): ?>
            <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover;">
        <?php else: ?>
            <div style="display:flex; justify-content:center; align-items:center; height: 100%; color:#999;">
                No tienes una foto de perfil.
            </div>
        <?php endif; ?>
    </div>

    <!-- Datos del usuario -->
    <div>
      <p><strong>Cuenta de:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
      <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario['usuario']); ?></p>
      <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></p>
    </div>
  </section>

  <section style="flex-grow: 1;">
    <!-- Aquí irá la parte derecha para las funciones que definirás después -->
    <h2>Funciones próximamente...</h2>
  </section>

</main>

</body>
</html>