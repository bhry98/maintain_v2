const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/demo-theme.js', 'public/assets/js')
    .js('resources/js/demo-theme.min.js', 'public/assets/js')
    .js('resources/js/demo.min.js', 'public/assets/js')
    .js('resources/js/demo.js', 'public/assets/js')
    .js('resources/js/tabler.esm.js', 'public/assets/js')
    .js('resources/js/tabler.esm.min.js', 'public/assets/js')
    .js('resources/js/tabler.js', 'public/assets/js')
    .js('resources/js/tabler.min.js', 'public/assets/js')
    // .js('resources/js/app.js', 'public/assets/js')
    // .js('resources/js/select.js', 'public/assets/js')
    // .vue()
    // .postCss('resources/css/app.css', 'public/assets/css')
    .postCss('resources/css/demo.css', 'public/assets/css')
    .postCss('resources/css/demo.min.css', 'public/assets/css')
    .postCss('resources/css/demo.rtl.css', 'public/assets/css')
    .postCss('resources/css/demo.rtl.min.css', 'public/assets/css')
    // .postCss('resources/css/tabler-flags.css', 'public/assets/css')
    // .postCss('resources/css/tabler-flags.rtl.css', 'public/assets/css')
    // .postCss('resources/css/tabler-payments.css', 'public/assets/css')
    // .postCss('resources/css/tabler-payments.min.css', 'public/assets/css')
    // .postCss('resources/css/tabler-payments.rtl.css', 'public/assets/css')
    // .postCss('resources/css/tabler-payments.rtl.min.css', 'public/assets/css')
    .postCss('resources/css/tabler-vendors.css', 'public/assets/css')
    .postCss('resources/css/tabler-vendors.min.css', 'public/assets/css')
    .postCss('resources/css/tabler-vendors.rtl.css', 'public/assets/css')
    .postCss('resources/css/tabler-vendors.rtl.min.css', 'public/assets/css')
    .postCss('resources/css/tabler.css', 'public/assets/css')
    .postCss('resources/css/tabler.min.css', 'public/assets/css')
    .postCss('resources/css/tabler.rtl.css', 'public/assets/css')
    .postCss('resources/css/tabler.rtl.min.css', 'public/assets/css');