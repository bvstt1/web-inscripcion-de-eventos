import { validateRUT, getCheckDigit, clearRUT } from 'validar-rut';

const rutValido = validateRUT('12345678-9'); // Reemplaza '12345678-9' con el RUT a validar
if (rutValido) {
    console.log('El RUT es válido');
} else {
    console.log('El RUT no es válido');
}

