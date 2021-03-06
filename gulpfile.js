var dir, elixir = require('laravel-elixir');

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

dir = {
    asset: {
        css: 'public/css',
        img: 'public/img',
        js: 'public/js'
    },
    vendor: 'vendor/bower_components',
};

elixir(function(mix) {
    mix.scripts([
        'libs/jquery.min.js',
        'libs/bootstrap.min.js',
        'libs/dropzone.min.js',
        'libs/sweetalert.min.js',
        'app.js'
    ]).styles([
        'libs/bootstrap.min.css',
        'libs/dropzone.css',
        'libs/font-awesome.min.css',
        'libs/sweetalert.css',
        'app.css'
    ]);
});
