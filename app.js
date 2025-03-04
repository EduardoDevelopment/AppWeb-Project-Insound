/* app.js */
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("content").innerHTML = "<h2>Bienvenido a IN SOUND</h2>";

    // Solicitar permisos para notificacioness
    if ('Notification' in window) {
        Notification.requestPermission().then((permission) => {
            if (permission === 'granted') {
                console.log('Permiso para notificaciones concedido');
            } else if (permission === 'denied') {
                console.warn('Permiso para notificaciones denegado');
            } else if (permission === 'default') {
                console.log('Permiso para notificaciones: predeterminado');
            }
        });
    }
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/APPWEB-PROJECT-INSOUND/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registrado con éxito:', registration);
        })
        .catch((error) => {
            console.log('Error al registrar el Service Worker:', error);
        });
}