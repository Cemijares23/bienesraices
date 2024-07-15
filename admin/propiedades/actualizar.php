<?php

    // Validar la URL por ID válido (numero entero)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // En caso que no sea un numero retorna false y redirecciona
    if (!$id) {
        header ('Location: /bienesraices/admin/index.php');
    }

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consulta para obtener las propiedades
    $consulta = "SELECT * FROM propiedades WHERE id = $id";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // Arreglo con mensajes de errores
    $errores = [];

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Declaracion variables vacias
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['WC'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedor = $propiedad['vendedor_id'];
    $imagen = $propiedad['imagen'];

    // Ejecutar el codigo despues que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";


        // Asignacion de valores a variables
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = 'Por favor, añade un título para tu anuncio.';
        }
        

        if(!$precio) {
            $errores[] = 'Por favor, especifica el precio de tu propiedad.';
        }

        // validar por tamaño (1mb máximo)
        $medida = 1000 * 1000; // 1.000.000 bytes
        if($imagen['size'] > $medida){
            $errores[] = 'La imagen es muy pesada';
        }

        // if(!$imagen['type'] == 'image/jpeg' || !$imagen['type'] == 'image/png') {
        //     $errores[] = 'Selecciona una imagen en formato JPG o PNG';
        // }

        if(!$descripcion) {
            $errores[] = 'Añade una descripción detallada de la propiedad.';
        } 

        if(strlen($descripcion) < 50 ) {
            $errores[] = 'La descripción debe contener un mínimo de 50 caracteres';
        }

        if(!$habitaciones) {
            $errores[] = 'Indica cuántas habitaciones tiene la propiedad.';
        }

        if(!$wc) {
            $errores[] = 'Especifica la cantidad de baños disponibles.';
        }

        if(!$estacionamiento) {
            $errores[] = 'Indica la cantidad de puestos de estacionamiento disponibles.';
        }

        if(!$vendedor) {
            $errores[] = 'Selecciona un vendedor';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el array de errores este vacio
        if(empty($errores)) {

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            
            $nombreImagen = '';
            /* SUBIDA DE ARCHIVOS */ 

            if($imagen['name']) {
                // Eliminar la imagen previa

                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true))  . $imagen['name'];
    
                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }


            // Insertar en la base de datos
            // PHP tambien soporta codigo mysql
            $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedor_id = $vendedor WHERE id = $id"; // NO OLVIDAR EL WHERE

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario
                header('Location: /bienesraices/admin/index.php?registro=2');
            }
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Actualizar Propiedad</h2>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de Propiedad" min="1" max="9999999999" step="0.01" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/bienesraices/imagenes/<?php echo $imagen;?>" alt="Imagen de propiedad" class="image-form">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="" selected>-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedor === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>