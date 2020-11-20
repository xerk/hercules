const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    future: {
        purgeLayersByDefault: true,
        removeDeprecatedGapUtilities: true,
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['"SF Pro AR"', '"SF Pro Gulf"', '"SF Pro Display"', '"SF Pro Icons"', 'Nunito'],
                // sans: ['"SF Pro AR"', '"SF Pro Gulf"', '"SF Pro Display"', '"SF Pro Icons"', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
