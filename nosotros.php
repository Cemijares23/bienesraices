<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Conoce Sobre Nosotros</h2>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo obcaecati et assumenda, consequuntur excepturi sed quidem optio eveniet, officia ullam, dolorum alias fugit cum? Illum magnam aperiam necessitatibus voluptatibus obcaecati? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, perferendis voluptatem delectus neque, eaque est id tenetur natus, temporibus ad officia doloribus suscipit quisquam aliquid nisi ut ab! Mollitia, consectetur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore est autem velit esse veritatis. Alias at dolores placeat esse ipsa veniam sapiente, inventore, maiores quidem mollitia consectetur voluptas necessitatibus accusantium?
                </p>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum assumenda illum perferendis saepe ullam facilis sapiente veritatis exercitationem nam reprehenderit. Ratione minima facilis fuga nemo cum quam officiis beatae dolorum! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta saepe impedit sint a, accusamus quod esse. Error velit officia hic, odio dolor nulla porro, possimus repellat, est repudiandae totam nam!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Más Sobre Nosotros</h2>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Quidem, voluptas iusto autem dicta amet earum aliquid excepturi, delectus, esse laborum ad?</p>
            </div><!--.icono-->

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Quidem, voluptas iusto autem dicta amet earum aliquid excepturi, delectus, esse laborum ad?</p>
            </div><!--.icono-->

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Quidem, voluptas iusto autem dicta amet earum aliquid excepturi, delectus, esse laborum ad?</p>
            </div><!--.icono-->
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>