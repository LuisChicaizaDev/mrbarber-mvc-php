let step = 1; // Variable para llevar el control del paso actual
const stepInicial = 1; // Pagina inicial
const stepFinal = 3; // Pagina final

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra/oculta las secciones
    tabsNavegacion();
    paginacion();
    paginaAnterior();
    paginaSiguiente();
    consultarAPI();
    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();
    mostrarResumen();
}

function mostrarSeccion() {

    // Ocultamos la seccion que este visible
    const seccionAnterior = document.querySelector('.seccion.show');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('show');
    }

    // Seleccionamos la seccion que se debe mostrar por el id según el paso
    const stepSelector = `#paso-${step}`;
    const seccion = document.querySelector(stepSelector);

    // Mostramos la seccion
    seccion.classList.add('show');


    // Quitamos la clase de active del tab anterior
    const tabAnterior = document.querySelector(".tabs .active");
    if(tabAnterior){
        tabAnterior.classList.remove('active');
    }

    // Resaltamos el tab actual
    const tab = document.querySelector(`[data-paso="${step}"]`);
    tab.classList.add('active');
   

}

function tabsNavegacion() {
    const tabs = document.querySelectorAll('.tabs button');
    
    tabs.forEach( tab => {
        tab.addEventListener('click', function(e) {
            step = parseInt(e.target.dataset.paso);

            // Llamanos a estas funciones cuando se da click en un tab
            mostrarSeccion();
            paginacion();

        });
    }

    );
}

function paginacion() {
    const paginaAnterior = document.querySelector(".paginacion #prev");
    const paginaSiguiente = document.querySelector(".paginacion #next");

    if (step === 1) {
        paginaAnterior.classList.add('hidden');
        paginaSiguiente.classList.remove('hidden');
    }else if (step === 3) {
        paginaAnterior.classList.remove('hidden');
        paginaSiguiente.classList.add('hidden');

        mostrarResumen(); // Mostramos la info en la seccion resumen
    }else {
        paginaAnterior.classList.remove('hidden');
        paginaSiguiente.classList.remove('hidden');
    }

    // Llamamos a la funcion mostrarSeccion para que muestre la seccion correspondiente
    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector(".paginacion #prev");
    paginaAnterior.addEventListener('click', function() {

        // Si el step es menor o igual al inicial no hace nada sino resta 1 al step
        if (step <= stepInicial) return;
        step--;

        // Llamamos a la funcion de la paginacion
        paginacion();
    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector(".paginacion #next");
    paginaSiguiente.addEventListener('click', function() {
        
        if (step >= stepFinal) return;
        step++;

        // Llamamos a la funcion de la paginacion
        paginacion();
    });
}

// Funcion asincrona para consultar la API
async function consultarAPI() {
    try {
        // Pasamos desde la vista la constante BASE_URL definida en .env
        const url = `${BASE_URL}/api/servicios`;
        const response = await fetch(url);
        const servicios = await response.json(); // Convertimos la respuesta a JSON

        mostrarServicios(servicios);
        
    }catch (error){
        console.log(error);
    }
}


function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        // Destructuring extrae las propiedades del objeto servicio
        // Extrae el valor y crea una variable con el mismo nombre
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `${precio} €`;
        
        const servicioContainer = document.createElement('DIV');
        servicioContainer.classList.add('servicio');
        servicioContainer.dataset.idServicio = id; // Agrega un atributo data-id-servicio al div
        servicioContainer.onclick =  function() {
            seleccionarServicio(servicio);
        } // Agrega el evento onclick para seleccionar el servicio

        servicioContainer.appendChild(nombreServicio);
        servicioContainer.appendChild(precioServicio);

        // Mostramos los servicios en el HTML
        document.querySelector('#servicios').appendChild(servicioContainer);

    }); 
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita; // Extraemos el arreglo de servicios del objeto cita

    const servicioContainer = document.querySelector(`[data-id-servicio="${id}"]`);


    // Revisamos si un servicio ya fue agregado
    // some() regresa true o false y revisa si un elemento ya existe en el arreglo
    if (servicios.some(agregado => agregado.id === id)) {
        // Lo eliminamos
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        servicioContainer.classList.remove('selected');        
    } else {
        // Lo agregamos
        cita.servicios = [...servicios, servicio]; // Agregamos el servicio al arreglo de servicios
        servicioContainer.classList.add('selected');        
    }

}

function idCliente() {
    // Asignamos el id del cliente al objeto cita
    cita.id = document.querySelector('#id').value;
}

function nombreCliente() {
    // Asignamos el nombre del cliente al objeto cita
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay(); // 0 es domingo y 6 es sabado
        
        // Si es sabado o domingo no se puede seleccionar
        if ([0, 6].includes(dia)) {
            e.target.value = ''; // Reiniciamos el valor del input
            mostrarAlerta('Fines de semana no permitidos', 'error', '.contenido-datos .alerta-container');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');

    inputHora.addEventListener('input', function(e) {

        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];  // Split() para separar un string, en un array
        
        if(hora < 10 || hora > 19) {
            e.target.value = '';
            mostrarAlerta('Hora no válida. Horario de 10:00 a 19:00', 'error', '.contenido-datos .alerta-container');
        } else {
            cita.hora = e.target.value; // Asignamos la hora al objeto cita
            //console.log(cita);
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    
    const alertaPrevia = document.querySelector('.alerta');

    // Si existe una alerta previa elimina para volver a crear
    if(alertaPrevia) {
        alertaPrevia.remove();
    } 

    // Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const errores = document.querySelector(elemento);
    errores.appendChild(alerta);

    if (desaparece) {        
        // Eliminamos la alerta
        setTimeout( () => {
            alerta.remove();
        }, 3000);
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');
    const alertaContainer = resumen.querySelector('.alerta-container');

    // Con operador spread lo convertimos en array y eliminamos todo menos el contenedor de la alerta
    [...resumen.children].forEach(hijo => {
        if (!hijo.classList.contains('alerta-container')) {
            hijo.remove();
        }
    });

    // Para obtener los valores del objeto, iterando sobre la cita con includes() comprobamos si tiene valores vacios
    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta(
            'Asegúrate de elegir por lo menos un Servicio, la Fecha y Hora de tu cita.', 
            'error', 
            '.contenido-resumen .alerta-container', 
            false
        );

        return;
        
    }  

    // Si hay datos limpiar alerta
    alertaContainer.innerHTML = '';
    
    // Scripting para mostrar el resumen
    const titulo = document.createElement('h2');
    titulo.textContent = 'Resumen';
    resumen.appendChild(titulo);

    const texto = document.createElement('p');
    texto.classList.add('text-center');
    texto.textContent = 'Verifica que la información sea correcta para reservar tu cita';
    resumen.appendChild(texto);
    

    // Mostramos datos del cliente de la cita
    const { nombre, fecha, hora, servicios } = cita;

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre: </span>${nombre}`;

    // Formatear la fecha
    const fechaObj = new Date(fecha);
    const dia = fechaObj.getDate();
    const mes = fechaObj.getMonth();
    const anio = fechaObj.getFullYear();
 
    const fechaUTC = new Date(Date.UTC(anio, mes, dia));
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString('es-ES', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha: </span>${fechaFormateada}`;

    // console.log(cita);
    
    
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora: </span>${hora} horas`;


    // Mostramos datos de los servicios de la cita
    const subtituloServicios = document.createElement('h3');
    subtituloServicios.classList.add('text-start');
    subtituloServicios.textContent = 'Datos Servicios:';
    resumen.appendChild(subtituloServicios);

    // Iterando los servicios
    servicios.forEach(servicio => {
        // Destructuring extrae las propiedades del objeto servicio
        const { id, precio, nombre } = servicio;
        const containerServicio = document.createElement('DIV');
        containerServicio.classList.add('container-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> ${precio} €` 

        containerServicio.appendChild(textoServicio);
        containerServicio.appendChild(precioServicio);

        // Agregamos el container del servicio
        resumen.appendChild(containerServicio);

    });

    // Heading datos cliente
    const subtitulo = document.createElement('h3');
    subtitulo.classList.add('text-start');
    subtitulo.textContent = 'Datos Cliente:';
    resumen.appendChild(subtitulo);

    // Botón Reservar
    const btnReservar = document.createElement('BUTTON');
    btnReservar.classList.add('button');
    btnReservar.textContent = 'Reservar Cita';
    btnReservar.onclick = reservarCita; // invocamos a la funcion
    
    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(btnReservar);
    
}

async function reservarCita () {
    // Extraemos los datos del objeto cita
    const {nombre, fecha, hora, servicios, id} = cita;

    const idServicios = servicios.map(servicio => servicio.id);

    const datos = new FormData();
     // apend() para agregar datos para enviar a la API
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);

    // console.log([...datos]);

    try {
        // Peticion hacia la API tipo POST y enviamos los datos 
        // Pasamos desde la vista la constante BASE_URL definida en .env
        const url = `${BASE_URL}/api/citas`;
        const response = await fetch(url, {
            method: 'POST',
            body: datos
        }); 


        const result = await response.json();

        // Si el API responde true, se guardaron los datos en la bbdd
        if (result.resultado) {
            Swal.fire({
                icon: "success",
                title: "Cita creada",
                text: "¡Tu cita fue creada correctamente!"
            }).then (() => {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });
        }

        // console.log(result.resultado);
        // console.log([...datos]);
    }catch (error){
        Swal.fire({
            icon: "error",
            title: "Uups...",
            text: "¡Hubo un error al guardar la cita!. Inténtalo de nuevo."
        }).then ( () => {
            setTimeout( () => {
                window.location.reload();
            }, 1000);
        });
    }
    
}