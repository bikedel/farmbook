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

elixir(function(mix) {
    mix.styles([
        "app.css",
        "bootstrap.min.css",
        "buttons.dataTables.min.css",
        "dataTables.bootstrap.min.css",
        "select.dataTables.min.css", 
        "dark_theme.css",
        "mystyles.css"
    ], 'public/css/all.css', 'public/css');
});



elixir(function(mix) {
    mix.scripts([
        "jquery-1.11.3.min.js",
        "bootstrap.min.js",
        "jquery.dataTables.min.js",
        "dataTables.bootstrap.min.js",
        "dataTables.buttons.min.js",
        "dataTables.select.min.js"
        
    ], 'public/js/all.js', 'public/js');
});
