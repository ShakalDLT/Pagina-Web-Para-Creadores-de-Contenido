<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Content Creation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@11.2.8/swiper-bundle.min.css"/> 
</head>
<body> 
   <header>
     <a href="#" class="logo">
      <i class="bx bxs-main"></i>
    </a>
      <div class="bx bx-menu" id="menu-icon"></div>
     
      <ul class="navbar">
        <li><a href="main.php" class="inicio-activo">Inicio</a></li>
        <li><a href="#Categorias.html">Categorias</a></li>
        <li><a href="#En Directo">En Directo</a></li>
        <li><a href="Soporte.php">Soporte</a></li>
      </ul>

      <?php if (isset($_SESSION['id_usuario'])): ?>
        <!-- Usuario logueado -->
        <a href="cuenta.php" class="btnlogin">Cuenta</a>
      <?php else: ?>
        <!-- Usuario no logueado -->
        <a href="Login.php" class="btnlogin">Acceder</a>
      <?php endif; ?>
   </header>

<section class="inicio-swiper" id="inicio">
  <div class="swiper-wrapper">
    <div class="swiper-slide container">
      <img src="img/Imagen1.webp" alt="">
      <div class="inicio-texto">
        <span>Imagen de Ejemplo</span>
      </div>
    </div>

    <div class="swiper-slide container">
      <img src="img/imagen2.jpg" alt="">
      <div class="inicio-texto">
        <span>Imagen de Ejemplo 2</span>
      </div>
    </div>

    <div class="swiper-slide container">
      <img src="img/imagen3.jpg" alt="">
      <div class="inicio-texto">
        <span>Imagen de Ejemplo 3</span>
      </div>
    </div>

  </div>

  <div class="swiper-pagination"></div>
</section>
 <script src="https://unpkg.com/swiper@11.2.8/swiper-bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>