// webpack.mix.js

let mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/app.css'
    ], 'public/css');

mix.js('src/app.js', 'dist').setPublicPath('dist');