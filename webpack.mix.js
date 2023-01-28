// webpack.mix.js

let mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'css')
    .styles([
        'resources/css/app.css'
    ], 'public/css/custom.css');

mix.js([
        'resources/js/app.js',
        'resources/js/bootstrap.js'
    ], 'js/all.js').setPublicPath('public');