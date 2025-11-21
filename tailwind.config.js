import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Personaliza los colores clave de Breeze o agrega los tuyos
                // Por ejemplo, para un color primario:
                'mi-primario': {
                    50: '#f0f9ff', // Tonalidad más clara
                    100: '#e0f2fe',
                    // ... hasta 900
                    500: '#0ea5e9', // El tono base
                    // ...
                },
                // O un color de marca único:
                'marca-azul': '#1d4ed8',
                // Puedes sobrescribir un color existente de Tailwind:
                // 'gray': {
                //     // ... tus tonos de gris
                // }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
