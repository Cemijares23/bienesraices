<?php

    // Pasos para importar la base de datos:

    // 1) Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    // 2) Escribir el Query
    $query = "SELECT * FROM propiedades";

    // 3) Consultar la BD
    $resultado = mysqli_query($db, $query);

    // Muestra mensaje condicional
    $registro = $_GET['registro'] ?? null; // variante de usar isset(), busca el valor y si no lo encuentra la variable queda vacia.

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

        if($id) {
            // Eliminar el archivo de imagen
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../../imagenes/' . $propiedad['imagen']);

            // Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id = $id"; // NO OLVIDAR EL WHERE
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('location: /bienesraices/admin/index.php?registro=3');
            }
        }
    }

    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Administrador de Bienes Raíces</h2>

        <?php if(intval($registro) === 1): //convierte a entero y luego verifica?> 
            <p class="alerta exito">Anuncio Creado Correctamente!</p>
        <?php elseif (intval($registro) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente!</p>
        <?php elseif (intval($registro) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente!</p>    
        <?php endif; ?>
        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- 4) Mostrar los resultados -->
                <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="../imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php

    // 5) Cerrar la conexión (es opcional, porque PHP al detectar que no se usa más la base de datos la cierra automaticamente)
    mysqli_close($db);

    incluirTemplate('footer');
?>