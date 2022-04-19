const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .vue()

    .sass('resources/sass/app.scss', 'public/css').sourceMaps()
    .sass('resources/sass/style.sass', 'public/css').sourceMaps()

mix.browserSync('http://127.0.0.1:8000/');
