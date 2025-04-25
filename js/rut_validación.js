// Limpiar RUT: elimina puntos, guiones y pasa a mayúscula
function limpiarRut(rut) {
    return rut.replace(/[^0-9kK]/g, '').toUpperCase();
}

// Validar estructura de RUT
function validarRut(rut) {
    rut = limpiarRut(rut);

    if (rut.length < 8) {
        mostrarError("❌ RUT demasiado corto.");
        return false;
    }

    // Detectar RUT de dígitos repetidos (ej: 11111111)
    if (/^(\d)\1+$/.test(rut.slice(0, -1))) {
        mostrarError("❌ RUT inválido o repetido.");
        return false;
    }

    const cuerpo = rut.slice(0, -1);
    const dvIngresado = rut.slice(-1);

    let suma = 0;
    let multiplo = 2;

    for (let i = cuerpo.length - 1; i >= 0; i--) {
        suma += parseInt(cuerpo.charAt(i)) * multiplo;
        multiplo = multiplo < 7 ? multiplo + 1 : 2;
    }

    const dvEsperado = 11 - (suma % 11);
    let dvFinal = '';

    if (dvEsperado === 11) dvFinal = '0';
    else if (dvEsperado === 10) dvFinal = 'K';
    else dvFinal = dvEsperado.toString();

    if (dvFinal !== dvIngresado) {
        mostrarError("❌ Dígito verificador incorrecto.");
        return false;
    }

    // Todo bien
    mostrarError("");
    return true;
}

// Solo permitir números y K/k al escribir
function soloNumeros(input) {
    input.value = input.value.replace(/[^0-9kK]/g, '');
}

// Validar todo antes de enviar
function validarFormulario() {
    const rutInput = document.getElementById("rut");
    const rut = rutInput.value.trim();

    if (!validarRut(rut)) {
        rutInput.focus();
        return false;
    }

    return true;
}

// Mostrar errores debajo del input
function mostrarError(mensaje) {
    const errorSpan = document.getElementById("error-rut");
    if (errorSpan) {
        errorSpan.textContent = mensaje;
    }
}

// Hacemos accesibles las funciones desde el HTML
window.soloNumeros = soloNumeros;
window.validarFormulario = validarFormulario;
