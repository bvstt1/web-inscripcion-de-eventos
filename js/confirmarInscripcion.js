function confirmarInscripcion(idEvento) {
    if (confirm("¿Estás seguro que deseas inscribirte en este evento?")) {
        // Si confirma, redirige al PHP que procesa la inscripción
        window.location.href = "../../php/inscribir.php?id_evento=" + idEvento;
    }
}

function confirmarDesinscripcion(idEvento) {
    if (confirm("¿Estás seguro que deseas desinscribirte de este evento?")) {
        window.location.href = "../../php/desincribir.php?id_evento=" + idEvento;
    }
}