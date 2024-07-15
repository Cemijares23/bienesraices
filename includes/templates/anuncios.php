<?php
    // Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();

    // Consulta
    $query = "SELECT * FROM propiedades LIMIT $limite";

    // Obtener resultados consulta
    $resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">

        <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio">
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>

            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-anuncio">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad['WC']; ?></p>
                </li> <!--.icono-->

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li> <!--.icono-->

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li> <!--.icono-->
            </ul>
        </div> <!--.contenido-anuncio-->
        <div class="boton-anuncio">
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div>
    </div> <!--.anuncio-->
    <?php endwhile; ?>
</div> <!--.contendor-anuncios-->

<?php
    mysqli_close($db);
?>