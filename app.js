/* app.js */
document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el elemento con id="content" existe
    let content = document.getElementById("content");

    if (!content) {
        console.error("El elemento con id='content' no se encontró en el DOM.");
        return; // Detener la ejecución si el elemento no existe
    }

    // Función para cargar productos dinámicamente con CSR
    function cargarProductosCSR() {
        fetch("api_compras.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos cargados con CSR:", data);
            // Procesar los datos y mostrarlos en el DOM
        })
        .catch(error => console.error("Error cargando productos con CSR:", error));
    }

    // Cargar productos CSR después de 3 segundos para mostrar diferencia con SSR
    setTimeout(cargarProductosCSR, 3000);

    // Solicitar permisos de notificaciones
    if ("Notification" in window) {
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                console.log("Permiso para notificaciones concedido.");
            } else if (permission === "denied") {
                console.warn("Permiso para notificaciones denegado.");
            } else {
                console.log("Permiso para notificaciones: predeterminado.");
            }
        });
    }

    // Registrar el Service Worker para PWA
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("./service-worker.js")
            .then((registration) => {
                console.log("Service Worker registrado con éxito:", registration);
            })
            .catch((error) => {
                console.log("Error al registrar el Service Worker:", error);
            });
    }
});