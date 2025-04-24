function validarYFormatearRut(input) {
    let rut = input.value.replace(/\D/g, ''); // Elimina todo lo que no sea dígito
    if (rut.length < 9) {
        mostrarError("RUT demasiado corto.");
        return;
    }

    const cuerpo = rut.slice(0, -1);
    const dvIngresado = rut.slice(-1);
    const dvCalculado = calcularDV(cuerpo);

    if (dvIngresado.toUpperCase() !== dvCalculado) {
        mostrarError("RUT no válido.");
    } else {
        ocultarError();
        input.value = cuerpo + '-' + dvCalculado;
    }
}
    