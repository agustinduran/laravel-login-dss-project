<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SecurePasswordRule implements Rule
{
    protected $weakPasswords;

    public function __construct()
    {
        $this->weakPasswords = file(base_path('passwords/10k-most-common.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    /**
     * Verifica si la contraseña es válida.
     */
    public function passes($attribute, $value)
    {
        // Condiciones de validación
        $minLength = 8;
        $length = strlen($value) >= $minLength; // Mínimo 8 caracteres
        $uppercase = preg_match('/[A-Z]/', $value); // Al menos una letra mayúscula
        $lowercase = preg_match('/[a-z]/', $value); // Al menos una letra minúscula
        $number = preg_match('/[0-9]/', $value); // Al menos un número

        // Retorna falso si alguna de las condiciones no se cumple
        return $length && $uppercase && $lowercase && $number && !in_array($value, $this->weakPasswords);
    }

    /**
     * Devuelve el mensaje de error.
     */
    public function message()
    {
        return 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número, y no debe estar listada en el TOP 10k de contraseñas más comunes.';
    }
}
