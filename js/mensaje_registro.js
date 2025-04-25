document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const mensajeDiv = document.getElementById('mensaje-error');

    if (params.get('error') === 'duplicado') {
        mensajeDiv.textContent = "❌ El RUT o el correo ya están registrados.";
    }

    if (params.get('exito') === '1') {
        mensajeDiv.style.color = "green";
        mensajeDiv.textContent = "✅ Registro exitoso.";
    }

    // Opcional: hacer que el mensaje desaparezca después de 5 segundos
    if (mensajeDiv.textContent !== "") {
        setTimeout(() => {
            mensajeDiv.textContent = "";
        }, 5000); // 5000 ms = 5 segundos
    }
});
