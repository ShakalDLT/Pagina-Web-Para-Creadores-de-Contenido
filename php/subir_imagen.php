<?php
session_start();
$id_usuario = $_SESSION['id'];
include("php/conexion.php");

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $carpeta_destino = 'imagenes/';
    $nombre_archivo = uniqid() . "_" . basename($_FILES['foto']['name']);
    $ruta_completa = $carpeta_destino . $nombre_archivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_completa)) {
        $conn = new mysqli("localhost", "usuario", "contraseña", "basedatos");
        $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE id = ?");
        $stmt->bind_param("si", $ruta_completa, $id_usuario);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: cuenta.php");
        exit;
    } else {
        echo "Error al subir la imagen.";
    }
}
?>