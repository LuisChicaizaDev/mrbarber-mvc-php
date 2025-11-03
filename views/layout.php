<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. BARBER | Peluquería Barber Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/app.css">
</head>
<body>

    <div class="container-app">
        <div class="image">
            <div class="logo">
                <span>Mr. </span>Barber    
            </div>
            <h1 class="image__title">
                Agenda tu próxima cita con facilidad
            </h1>
        </div>

        <div class="app">
            <?php echo $contenido; ?>

            <div class="footer">
                <p>
                    &COPY; 2025.
                </p>
                <p>
                    Desarrollado por <a href="https://github.com/LuisChicaizaDev" target="_blank">
                        Luis Chicaiza.
                    </a>
                </p> 
            </div>
        </div>
    </div>

    <?php 
        // Seccion para agregar scripts personalizados en las vistas
        // Si no hay la variable $script, se imprime un string vacio
        echo $script ?? '';
    ?>
            
</body>
</html>