document.addEventListener('DOMContentLoaded', function() {

   eventListeners();
   elegirModo();
   darkMode();
   obtenerDatosJSON();
   searchFilter(".entrada-buscador", ".anuncio");
//    asignarValor();
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
            //cambiar el valor del atributo seleccionado
            // let opcionEstado = document.querySelector('select.estado option[selected]');
            // let opcionEstado = select.options[select.selectedIndex];
            // opcionEstado.value = "<?php echo s($propiedad->estado); ?>";
            // console.log(opcionEstado);

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

            // selectMunicipio.addEventListener('change', function() {
            //     //cambiar el valor del atributo seleccionado
            //     let opcionMunicipio = document.querySelector('select.municipio option[selected]');
            //     opcionMunicipio.value = "<?php echo s($propiedad->municipio); ?>";
            //     // console.log(opcionMunicipio);
            // });
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

        //Validando el numero de columnas
        if(jsonData[0].length !== 11) {
            document.querySelector(".estructura").classList.remove("filter");
            setTimeout(() => {
                document.querySelector(".estructura").classList.add("filter");
            }, 3000);
            return;
        }
        appendDataToTable(jsonData);
    };
    reader.readAsArrayBuffer(file);
}

// function displayData(data) {
//     const output = document.querySelector(".tabla-importar");
//     console.log(output);
//     let html = '';
//     data.forEach((row) => {
//         html += '<tr>';
//         row.forEach((cell) => {
//             html += `<td>${cell}</td>`;
//         });
//         html += '</tr>';
//     });
//     output.innerHTML = html;
// }

//Con esta funcion se inserta la información del archivo a la tabla en el html
function appendDataToTable(data) {
    let contador = 0;
    const variableTotal = document.querySelector('.variable-total');
    const tableBody = document.querySelector('.tabla-importar').getElementsByTagName('tbody')[0];
    data.forEach((row, rowIndex) => {
        // Ignora la primera fila si es el encabezado
        if (rowIndex === 0) return;

        const newRow = tableBody.insertRow();
        row.forEach((cell, colIndex) => {
            if(colIndex===10) contador++;
            // console.log(contador);
            const newCell = newRow.insertCell();
            switch (colIndex) {
                case 0:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[titulo]" value="${cell}"></input>`;
                    break;
                case 1:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[precio]" value="${cell}"></input>`;
                    break;
                case 2:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[estado]" value="${cell}"></input>`;
                    break;
                case 3:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[municipio]" value="${cell}"></input>`;
                    break;
                case 4:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[colonia]" value="${cell}"></input>`;
                    break;
                case 5:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[descripcion]" value="${cell}"></input>`;
                    break;
                case 6:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[habitaciones]" value="${cell}"></input>`;
                    break;
                case 7:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[wc]" value="${cell}"></input>`;
                    break;
                case 8:
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[estacionamiento]" value="${cell}"></input>`;
                    break;
                case 9:
                    if(cell.toLowerCase().includes("casa")) {
                        cell=1;
                    } else if(cell.toLowerCase().includes("departamento")) {
                        cell=2;
                    } else if(cell.toLowerCase().includes("oficina")) {
                        cell=3;
                    } else if(cell.toLowerCase().includes("terreno")) {
                        cell=4;
                    } else if(cell.toLowerCase().includes("bodega")) {
                        cell=5;
                    } else {
                        document.querySelector(".estructura").innerHTML=`Tipo de inmobiliario inválido, revísalos`;
                        document.querySelector(".estructura").classList.remove("filter");
                        setTimeout(() => {
                            document.querySelector(".estructura").classList.add("filter");
                        }, 4000);
                        cell="";
                    }
                    newCell.innerHTML = `<input type="text" name="propiedad${contador+1}[tipoid]" value="${cell}"></input>
                    <input type="hidden" name="propiedad${contador+1}[vendedorid]" value="1"></input>`;
                break;
                case 10:
                    if(cell.toLowerCase().includes("litigio")) {
                        cell=1;
                    } else if(cell.toLowerCase().includes("adjudicado")) {
                        cell=2;
                    } else if(cell.toLowerCase().includes("venta")) {
                        cell=3;
                    } else if(cell.toLowerCase().includes("vendido")) {
                        cell=4;
                    } else if(cell.toLowerCase().includes("cancelado")) {
                        cell=5;
                    } else if(cell.toLowerCase().includes("suspendido")) {
                        cell=6;
                    } else {
                        document.querySelector(".estructura").innerHTML=`Estatus de inmobiliario inválido, revísalos`;
                        document.querySelector(".estructura").classList.remove("filter");
                        setTimeout(() => {
                            document.querySelector(".estructura").classList.add("filter");
                        }, 4000);
                        cell="";
                    }
                    newCell.innerHTML = `<input type="text" name="propiedad${contador}[statusid]" value="${cell}"></input>
                    <input type="hidden" name="propiedad${contador}[imagen]" value="0.jpg"></input>`;
                break;

                default:
                    break;
            }
            // newCell.innerHTML = `<input type="hidden" name="total" value="0.jpg"></input>`;
        });
    });
    // tableBody.innerHTML += `<input type="hidden" name="total" value="${contador}"></input>`;
    variableTotal.value = contador;
}


// function asignarValor() {
//     const selectEstado = document.querySelector(".estado");

//     selectEstado.addEventListener('change', function() {
//         //cambiar el valor del atributo seleccionado
//         let opcionEstado = document.querySelector('option[selected]');
//         // opcionEstado.value = "<?php echo s($propiedad->wc); ?>";
//         console.log(opcionEstado);
//     });
// }


//filtro de anuncios
function searchFilter(input, selector) {
    const d = document;
    const sinResultados = d.querySelector(".sin-resultados");
    // console.log(sinResultados);

    d.addEventListener("keyup", (e)=> {
        if(e.target.matches(input)) {
            // console.log(e.key);
            // console.log(e.target.value);

            if(e.key === "Escape") e.target.value = "";

            d.querySelectorAll(selector).forEach((el) =>
                el.textContent.toLowerCase().includes(e.target.value.toLowerCase()) && el.textContent.toLowerCase().includes(select.value.toLowerCase()) && el.textContent.toLowerCase().includes(selectMunicipios.value.toLowerCase())
                ? el.classList.remove("filter")
                : el.classList.add("filter")
            );

            // console.log(d.querySelectorAll(".filter").length, d.querySelectorAll(selector).length);

            if((d.querySelectorAll(selector).length-d.querySelectorAll(".filter").length) < 0) {
                sinResultados.classList.remove("filter");
            } else {
                sinResultados.classList.add("filter");
            }
        }
    });

    const select = document.querySelector(".estado");
    select.addEventListener("change", (e) => {

        // if(e.target.matches(select)) {
            // console.log(e.target.value.toLowerCase());

            // if(e.target.value.toLowerCase() == 'default') return;

            d.querySelectorAll(selector).forEach((el) =>
                el.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ? el.classList.remove("filter")
                : el.classList.add("filter")
            );
        // }

        // console.log(d.querySelectorAll(".filter").length, d.querySelectorAll(selector).length);

        if((d.querySelectorAll(selector).length-d.querySelectorAll(".filter").length) < 0) {
            sinResultados.classList.remove("filter");
        } else {
            sinResultados.classList.add("filter");
        }

    });

    const selectMunicipios = document.querySelector(".municipio");
    selectMunicipios.addEventListener("change", (e) => {

        // if(e.target.matches(select)) {
            // console.log(e.target.value.toLowerCase());

            // if(e.target.value.toLowerCase() == 'default') return;

            d.querySelectorAll(selector).forEach((el) =>
                el.textContent.toLowerCase().includes(e.target.value.toLowerCase()) && el.textContent.toLowerCase().includes(select.value.toLowerCase())
                ? el.classList.remove("filter")
                : el.classList.add("filter")
            );
        // }

        if((d.querySelectorAll(selector).length-d.querySelectorAll(".filter").length) < 0) {
            sinResultados.classList.remove("filter");
        } else {
            sinResultados.classList.add("filter");
        }
    });
}