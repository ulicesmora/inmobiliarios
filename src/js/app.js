document.addEventListener('DOMContentLoaded', function() {

   eventListeners();
   elegirModo();
   darkMode();
   obtenerDatosJSON();
//    mostrarEstados();
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


//función para mostrar los estados en los filtros de búsqueda
async function obtenerDatosJSON() {
    const url = 'https://raw.githubusercontent.com/martinciscap/json-estados-municipios-mexico/master/estados-municipios.json';
  
    try {
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        
        const datos = await response.json();
        const nombresDeEstados = Object.keys(datos); // Obtiene los nombres de los estados
        // console.log(nombresDeEstados);

        //Rellenando el select de estados
        const select = document.querySelector(".estado");
        nombresDeEstados.forEach(attribute => {
            const option = document.createElement("option");
            option.value = attribute;
            option.textContent = attribute;
            select.appendChild(option);
        });

        //Rellenando el select de municipios
        select.addEventListener('change', function() {
            const estadoSeleccionado = this.value;
            const municipios = datos[estadoSeleccionado] || [];
            const selectMunicipio = document.querySelector(".municipio");
            // console.log(municipios);

            // Limpia las opciones de municipios
            selectMunicipio.innerHTML = '<option value="">Selecciona un Municipio</option>';

            municipios.forEach(municipio => {
                const option = document.createElement("option");
                option.value = municipio;
                option.textContent = municipio;
                selectMunicipio.appendChild(option);
            });
        });
    } catch (error) {
        console.error('Hubo un problema con la petición Fetch:', error);
    }
}

document.getElementById('excelFile').addEventListener('change', handleFile, false);

//Con esta funcion se lee el archivo de excel
function handleFile(e) {
    const file = e.target.files[0];
    const reader = new FileReader();
    reader.onload = function(event) {
        const data = new Uint8Array(event.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
        const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });
        appendDataToTable(jsonData);
    };
    reader.readAsArrayBuffer(file);
}

function displayData(data) {
    const output = document.querySelector(".tabla-importar");
    // console.log(output);
    let html = '';
    data.forEach((row) => {
        html += '<tr>';
        row.forEach((cell) => {
            html += `<td>${cell}</td>`;
        });
        html += '</tr>';
    });
    output.innerHTML = html;
}

//Con esta funcion se inserta la información del archivo a la tabla en el html
function appendDataToTable(data) {
    const tableBody = document.querySelector('.tabla-importar').getElementsByTagName('tbody')[0];
    data.forEach((row, rowIndex) => {
        // Ignora la primera fila si es el encabezado
        if (rowIndex === 0) return;

        const newRow = tableBody.insertRow();
        row.forEach((cell) => {
            const newCell = newRow.insertCell();
            newCell.innerHTML = `<input type="text" value="${cell}"></input>`;
            // newCell.textContent = cell;
        });
    });
}
  