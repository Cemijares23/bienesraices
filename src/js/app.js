document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
    eliminarAlerta();
});

function darkMode() {

    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(preferDarkMode.matches);

    if (preferDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    preferDarkMode.addEventListener('change', function(){
        if (preferDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const darkModeBtn = document.querySelector(".dark-mode-btn");
    darkModeBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', displayNav)
}

// Eliminar texto de confirmación de CRUD en admin/index.php
function eliminarAlerta() {
    setTimeout( function() {
        const alerta = document.querySelector('.alerta.exito');
        const alertaPadre = alerta.parentElement;
        alertaPadre.removeChild(alerta);
    }, 3500);
}

function displayNav() {
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    } else{
        navegacion.classList.add('mostrar');
    }

    // Misma funcion:
    // navegacion.classList.toggle('mostrar'); 
}

