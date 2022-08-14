const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
mix.scripts([
    'node_modules/sweetalert/dist/sweetalert.min.js',
    'node_modules/izitoast/dist/js/iziToast.js'
], 'public/js/app.js').styles([
    'node_modules/izitoast/dist/css/iziToast.css',
], 'public/css/app.css');
