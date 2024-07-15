<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset> <!--se usa para agrupar datos relacionados-->
                <legend>Información Personal</legend> <!--etiqueta para describir el fieldset-->

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre"> <!--el placeholder deja un texto pred.-->

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Sobre la Propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option> 
                    <option value="Vende">Vende</option>
                    <!--el value es lo que se envia al servidor-->
                </select>

                <label for="presupuesto">Presupuesto</label>
                <input type="num" placeholder="Tu presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="opciones-contacto">
                    <div class="opciones-radio">
                        <label for="contacto-telefono">Teléfono</label>
                        <input name="contacto" type="radio" value="telefono" id="contacto-telefono">
                    </div>

                    <div class="opciones-radio">
                        <label for="contacto-email">E-mail</label>
                        <input name="contacto" type="radio" value="email" id="contacto-email">
                    </div>
                    <!--el name agrupa a los radio buttons haciendo que solo se pueda seleccionar uno-->
                </div>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">

                </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>