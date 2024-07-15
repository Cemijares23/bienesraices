<?php
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Arreglo con mensajes de errores
    $errores = [];

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Declaracion variables vacias
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedor = '';
    $imagen = '';

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
        if (strlen($titulo) > 25){
            $errores[] = 'El título es muy extenso.';
        }
        

        if(!$precio) {
            $errores[] = 'Por favor, especifica el precio de tu propiedad.';
        }

        if(!$imagen['name']) {
            $errores[] = 'Por favor, selecciona una imagen';
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

        if(strlen($descripcion) < 45 ) {
            $errores[] = 'La descripción debe contener un mínimo de 45 caracteres';
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

            /* SUBIDA DE ARCHIVOS */ 

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true))  . $imagen['name'];

            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            // Insertar en la base de datos
            // PHP tambien soporta codigo mysql
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedor_id) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor')";

            $resultado = mysqli_query($db, $query);
            // echo $query;

            if($resultado) {
                // Redireccionar al usuario
                header('Location: /bienesraices/admin/index.php?registro=1');
            }
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Crear</h2>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" max="20" name="titulo" placeholder="Título de Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de Propiedad" min="1" max="9999999999" step="0.01" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" max="75" name="descripcion"><?php echo $descripcion; ?></textarea>
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

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>