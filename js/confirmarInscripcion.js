function confirmarInscripcion(idEvento) {
    if (confirm("¿Estás seguro que deseas inscribirte en este evento?")) {
        // Si confirma, redirige al PHP que procesa la inscripción
        window.location.href = "../../php/inscribirse.php?id_evento=" + idEvento;
    }
}