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
mix.js('resources/assets/js/modal.js', 'public/js/modal.js');
mix.js('resources/assets/js/insert.js', 'public/js/insert.js');
//   .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles('resources/assets/css/insert.css', 'public/css/insert.css');
mix.styles('resources/assets/css/all.css', 'public/css/all.css');
mix.styles('resources/assets/css/login.css', 'public/css/login.css').version();
mix.copy(['node_modules/jquery/dist/jquery.min.js', 'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js'], 'public/lib/');

/*mix.browserSync({
	proxy: '192.168.99.100:8080'
});
*/
