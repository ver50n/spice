const mix = require('laravel-mix');

mix.js('resources/js/common.js', 'public/js')
.sass('resources/sass/common.scss', 'public/css')
.sass('resources/sass/front.scss', 'public/css')
.copy('resources/images/', 'public/images')
.options({
  processCssUrls: false
})
.sourceMaps()
.version();
