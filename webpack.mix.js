let mix = require('laravel-mix');

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

mix.js('resources/assets/js/login.js', 'public/js/login.js');
//   .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles('resources/assets/css/login.css', 'public/css/login.css').version();
mix.copy('node_modules/material-components-web/dist/material-components-web.min.*', 'public/lib/');