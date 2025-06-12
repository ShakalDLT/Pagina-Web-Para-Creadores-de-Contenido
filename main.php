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


   <section class="inicio-slider">
     <div class="swiper mySwiper">
       <div class="swiper-wrapper">
         <div class="swiper-slide">
           <img src="img/Imagen1.webp" alt="Imagen 1">
           <div class="slide-texto">
             <h2>Creación de Contenido</h2>
             <p>Explorá el poder de tu creatividad</p>
           </div>
         </div>
         <div class="swiper-slide">
           <img src="img/imagen2.jpg" alt="Imagen 2">
           <div class="slide-texto">
             <h2>Expresión sin límites</h2>
             <p>Comparte tu voz con el mundo</p>
           </div>
         </div>
         <div class="swiper-slide">
           <img src="img/imagen3.jpg" alt="Imagen 3">
           <div class="slide-texto">
             <h2>Inspirá y conectá</h2>
             <p>Una comunidad hecha para creadores</p>
           </div>
         </div>
       </div>
       <div class="swiper-pagination"></div>
     </div>
   </section>


   <section class="beneficios-section">
     <div class="beneficios-grid">
       <div class="beneficio-card">
         <img src="img/beneficio1.jpg" alt="Beneficio 1">
         <h3>Monetización</h3>
         <p>Convertí tu contenido en ingresos reales.</p>
       </div>
       <div class="beneficio-card">
         <img src="img/beneficio2.jpg" alt="Beneficio 2">
         <h3>Alcance global</h3>
         <p>Llegá a miles de personas en todo el mundo.</p>
       </div>
       <div class="beneficio-card">
         <img src="img/beneficio3.jpg" alt="Beneficio 3">
         <h3>Herramientas exclusivas</h3>
         <p>Accedé a funciones diseñadas para vos.</p>
       </div>
     </div>
   </section>

   <script src="https://unpkg.com/swiper@11.2.8/swiper-bundle.min.js"></script>
   <script src="js/main.js"></script>
</body>

<footer class="custom-footer">
  <div class="custom-footer-container">
    <p class="custom-footer-text">&copy; <?= date('Y') ?> TuSitioWeb. Todos los derechos reservados.</p>
  </div>
</footer>
</html>