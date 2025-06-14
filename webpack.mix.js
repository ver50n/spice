const mix = require('laravel-mix');


mix.js('resources/js/common.js', 'public/js')
.sass('resources/sass/common.scss', 'public/css')
.options({
  processCssUrls: false
})
.sourceMaps()
.version();
