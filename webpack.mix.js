const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/actions/delete-prompt.js', 'public/js/actions')
    .js('resources/js/actions/form-modal.js', 'public/js/actions')
    .js('resources/js/actions/interval-format-toggle.js', 'public/js/actions')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
