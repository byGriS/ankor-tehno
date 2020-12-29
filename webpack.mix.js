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
    .styles(['resources/css/admin.css'], 'public/css/admin.css')    
    //.styles(['resources/css/index.css', 'public/fonts/MyriadPro/stylesheet.css'], 'public/css/index.css')
    .styles(['resources/css/index.css'], 'public/css/index.css')
    .styles(['resources/css/auth.css'], 'public/css/auth.css');