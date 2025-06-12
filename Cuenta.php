<?php
session_start();
include 'php/conexion.php';

$user_id = $_SESSION['id_usuario'] ?? null;

if (!$user_id) {
    die("No estás logueado");
}

$uploadSuccess = false;
$newProfilePath = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    $file = $_FILES['imagen'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (in_array($file['type'], $allowedTypes)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = 'perfil_' . $user_id . '_' . time() . '.' . $ext;
            $destino = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $destino)) {
                $rutaDB = $destino;
                $sqlUpdate = "UPDATE usuarios SET foto_perfil = ? WHERE idusuarios = ?";
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("si", $rutaDB, $user_id);
                    if ($stmtUpdate->execute()) {
                        $uploadSuccess = true;
                        $newProfilePath = $rutaDB;
                    }
                }
            }
        }
    }
}


$sql = "SELECT nombre, usuario, correo, foto_perfil, busquedas FROM usuarios WHERE idusuarios = ?";
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

$profilePhoto = $usuario['foto_perfil'] && file_exists($usuario['foto_perfil'])
    ? $usuario['foto_perfil']
    : 'img/avatar.png';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Cuenta de <?php echo htmlspecialchars($usuario['nombre']); ?></title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header>
  <ul class="navbar">
    <li><a href="main.php">Inicio</a></li>
    <li><a href="Creadores.php">Creadores</a></li>
    <li><a href="Tendencias.php">Tendencias</a></li>
    <li><a href="Soporte.php">Soporte</a></li>
  </ul>

  <a href="cuenta.php" class="btnlogin">Cuenta</a>
  <a href="php/logout.php" class="btnlogout">Cerrar sesión</a>
</header>

<main class="cuenta-main">

  <section class="perfil-lateral">
    <div class="foto-perfil">
      <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Foto de perfil" id="avatar">
    </div>
    <div class="datos-usuario">
      <p><strong>Usuario:</strong></p>
      <p><?php echo htmlspecialchars($usuario['usuario']); ?></p>
      <p><strong>Correo:</strong></p>
      <p><?php echo htmlspecialchars($usuario['correo']); ?></p>
    </div>
  </section>

  <section class="contenido-principal">
    <h2>Estadísticas</h2>
    <p><strong>Cantidad de búsquedas realizadas sobre este Usuario:</strong> <?php echo (int)$usuario['busquedas']; ?></p>
  </section>

</main>

<div id="modal-upload" class="cuenta-modal" style="display:none;">
  <div class="cuenta-modal-content">
    <span id="close-modal" class="cuenta-close">&times;</span>
    <h2>Subir nueva imagen</h2>
    <form action="cuenta.php" method="POST" enctype="multipart/form-data" class="cuenta-upload-form">
      <input type="file" name="imagen" accept="image/*" required>
      <button type="submit">Subir</button>
    </form>
  </div>
</div>

<script>
  const avatar = document.getElementById('avatar');
  const modal = document.getElementById('modal-upload');
  const closeBtn = document.getElementById('close-modal');

  avatar.addEventListener('click', () => {
    modal.style.display = 'flex';
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', e => {
    if (e.target === modal) modal.style.display = 'none';
  });

  <?php if ($uploadSuccess && $newProfilePath): ?>
    alert('Imagen subida con éxito');
    avatar.src = '<?php echo htmlspecialchars($newProfilePath); ?>?t=' + new Date().getTime();
  <?php endif; ?>
</script>

</body>
<footer class="custom-footer">
  <div class="custom-footer-container">
    <p class="custom-footer-text">&copy; <?= date('Y') ?> TuSitioWeb. Todos los derechos reservados.</p>
  </div>
</footer>
</html>