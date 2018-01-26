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



   mix.webpackConfig({
      node: {
        fs: "empty"
      },
  }).autoload({
       jquery: ['$', 'window.jQuery', 'jQuery'] //,'popper.js/dist/umd/popper.js': ['Popper']
   })

      .js([
       //'node_modules/jquery/dist/jquery.slim.min.js',
       //'node_modules/popper.js/dist/umd/popper.min.js',
       //'node_modules/bootstrap/dist/js/bootstrap.min.js',
       //'node_modules/admin-lte/dist/js/adminlte.js',
       'resources/assets/js/app.js'], 'public/js/app.js')

      //.js(['resources/assets/js/palette.js'], 'public/js/palette.js')

      //.sass('node_modules/select2/src/scss/core.scss', 'public/css')
      //.styles('node_modules/admin-lte/dist/css/AdminLTE.css', 'public/css/adminLTE.css')
      //.styles('node_modules/admin-lte/dist/css/skins/skin-blue.css', 'public/css/skin.css')
      .sass('resources/assets/sass/app.scss', 'public/css')

      .version();