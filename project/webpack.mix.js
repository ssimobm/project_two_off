let mix = require('laravel-mix');
mix
.js('resources/js/app.js', 'js')
//.js('resources/js/vendor.js', 'js')
// .js('resources/js/jquery.js', 'js')4
.sass('resources/scss/app-dark-rtl.scss', 'css')
.sass('resources/scss/bootstrap-dark.scss', 'css')

;
//
// mix.scripts([
//     'resources/assets/js/pack/bootstrap.js',
//     ], 'public/js/vendor.min.js');
mix.js([
    'resources/js/vendor.js',
    'resources/js/allpack.js'
], 'public/js/vendor.js').version();
