<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Nuestro Blog</h2>

        <article class="entrada-blog">
            <div class="imagen-blog">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.avif" type="image/avif">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="info-meta">Escrito el: <span>03/06/2024</span> por: <span>Admin</span></p> <!--info meta de cuando se escribio-->
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        <article class="entrada-blog">
            <div class="imagen-blog">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.avif" type="image/avif">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Construye una alberca en tu hogar</h4>
                    <p class="info-meta">Escrito el: <span>03/06/2024</span> por: <span>Admin</span></p> <!--info meta de cuando se escribio-->
                    <p>Descubre cómo construir una alberca en casa, desde la planificación hasta los acabados.</p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        <article class="entrada-blog">
            <div class="imagen-blog">
                <picture>
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.avif" type="image/avif">
                    <source srcset="build/img/blog3.jpg" type="image/jpeg">
                    <img src="build/img/blog3.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="info-meta">Escrito el: <span>03/06/2024</span> por: <span>Admin</span></p> <!--info meta de cuando se escribio-->
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.</p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        <article class="entrada-blog">
            <div class="imagen-blog">
                <picture>
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.avif" type="image/avif">
                    <source srcset="build/img/blog4.jpg" type="image/jpeg">
                    <img src="build/img/blog4.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu habitación</h4>
                    <p class="info-meta">Escrito el: <span>03/06/2024</span> por: <span>Admin</span></p> <!--info meta de cuando se escribio-->
                    <p>Aprenderás a equilibrar colores, estilos y tamaños para lograr la armonía perfecta en tu espacio personal.</p>
                </a>
            </div>
        </article> <!--.entrada-blog-->
    </main>

<?php
    incluirTemplate('footer');
?>