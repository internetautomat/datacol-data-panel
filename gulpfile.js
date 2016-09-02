var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
    mix.less('admin-lte/AdminLTE.less');
    mix.less('admin-lte/skins/skin-darkblue.less','public/css/skins/skin-darkblue.css');
    mix.less('bootstrap/bootstrap.less');

    mix.copy('node_modules/codemirror','public/codemirror');
});
