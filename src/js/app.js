document.addEventListener('DOMContentLoaded', function() {

   eventListeners();
   elegirModo();
   darkMode();
//    darkChange();
});

// function darkMode() {
//     // Comprueba si estaba habilidado dark mode
//     let darkLocal = window.localStorage.getItem('dark');
//     if(darkLocal === 'true') {
//         document.body.classList.add('dark-mode');
//     }
//     // Añadimos el evento de click al botón de dark mode
//     document.querySelector('.dark-mode-boton').addEventListener('click', darkChange);
// }
 
// function darkChange() {
//     let darkLocal = window.localStorage.getItem('dark');
 
//     if(darkLocal === null || darkLocal === 'false') {
//         // No está inicializado darkLocal o es falso
//         window.localStorage.setItem('dark', true);
//         document.body.classList.add('dark-mode');
//     } else {
//         // Está activado darkMode, por lo que se desactiva
//         window.localStorage.setItem('dark', false);
//         document.body.classList.remove('dark-mode');
//     }
// }

// function darkMode() {

//     const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark');

//     console.log(prefiereDarkMode.matches);

//     if(prefiereDarkMode.matches) {
//         document.body.classList.add('dark-mode');
//     } else {
//         document.body.classList.remove('dark-mode');
//     }

//     prefiereDarkMode.addEventListener('change', function () {
//         if(prefiereDarkMode.matches) {
//             document.body.classList.add('dark-mode');
//         } else {
//             document.body.classList.remove('dark-mode');
//         }
//     });

//     const botonDarkMode = document.querySelector('.dark-mode-boton');

//     botonDarkMode.addEventListener('click',function () {
//         document.body.classList.toggle('dark-mode');
//     });
// }

function elegirModo() {
    if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && localStorage.getItem('modo') === 'claro') {
        document.body.classList.remove('dark-mode');
    } else if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches || localStorage.getItem('modo') === 'oscuro') {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
}
 
function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        let modo = 'claro';
 
        if(document.body.classList.contains('dark-mode')) {
            modo = 'oscuro';
        } else {
            modo = 'claro';
        }
        localStorage.setItem('modo', modo);        
    });
}


function darkModeLocal() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    if(isDarkMode) {
        document.body.classList.add('dark-mode');
    }

    const botonDarkMode = document.querySelector('.dark-mode-button');

    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        const darkModeState = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', darkModeState);
        });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click',  navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
            <label for="telefono">Número Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]"></input>

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]"  >
        `;
    }
}