<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brokers Inmobiliarios México</title>
    <link rel="stylesheet" href="../build/css/app.css">
    <link rel="shortcut icon" href="/build/img/perfil.png" type="image/x-icon">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header logo" src="/build/img/logotipo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/preguntas">Preguntas</a>
                        <a href="/contacto">Contacto</a>
                        <?php if(!$auth):  ?>
                        <a href="/login" class="login">Login</a>
                        <?php endif;  ?>
                        <?php if($auth): ?>
                            <a href="/administrar-cuenta">Usuario </a>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- .barra -->
            <?php echo $inicio ? '<h1>Remates Bancarios: Oportunidades Inmobiliarias</h>' : ''; ?>
        </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros">Nosotros</a>
                <a href="propiedades">Anuncios</a>
                <a href="blog">Blog</a>
                <a href="/preguntas">Preguntas</a>
                <a href="contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>