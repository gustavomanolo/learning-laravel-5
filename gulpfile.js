var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//-> *** USE COMMAND LINE "gulp --production" to get minified files

elixir(function(mix) {
    //-> Search in "resources/assets/sass"
    mix.sass('app.scss');


    //By default gulp search in "resources/css", so it can be changed with the "3rd argument"
    mix.styles([
       'vendor/normalize.css',
        'app.css'
    ], 'public/output/final.css', 'public/css');

    //-> JS files are searched in "resources/js" by default and it can be cahnged to
    /*mix.scripts([
       'vendor/jquery.js',
        'main.js',
        'coupon.js'
    ], 'public/output/scripts.js', 'public/js');*/

    //-> To version specific file "to avoid caching when making simple updates" to a CSS file
    mix.version('public/output/final.css');

    //-> To version multiple files
    //mix.version(['css/all.css', 'js/app.js']);

});
