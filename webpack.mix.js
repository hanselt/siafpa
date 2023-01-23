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

mix.js('resources/assets/js/app.js', 'public/js')
   .extract(['vue', 'moment', 'uiv', 'vee-validate', 'vue-flatpickr-component', 'vue-multiselect', 'vue-sweetalert', 'vue2-dropzone'])
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/reportes.scss', 'public/css')
   .styles(['public/fonts/vendor/google-fonts/Raleway.css'], 'public/css/fonts.css');

if (mix.inProduction()) {
  mix.version();
}