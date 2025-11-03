document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
}

// Funccion para buscar por fehca las citas en el panel del administrador
function buscarPorFecha() {
    const fechaInput = document.querySelector("#fecha");

    fechaInput.addEventListener('input', function (e) {
        const fechaSeleccionada = e.target.value;

        // Redirigimos por metodo get la URL con la fecha seleccionada
        window.location= `?fecha=${fechaSeleccionada}`;
        
    });
}