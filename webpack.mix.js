const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const dataBuildJS = [
    {
        from: 'resources/js/app.js',
        to: 'public/js',
    },
    {
        from: 'resources/js/layouts/main.js',
        to: 'public/js/layouts/main.js',
    },
    {
        from: 'resources/js/pages/transactions/index.js',
        to: 'public/js/pages/transactions/index.js',
    },
    {
        from: 'resources/js/pages/dashboard/index.js',
        to: 'public/js/pages/dashboard/index.js',
    }
];

dataBuildJS.forEach(item => {
    mix.js(item.from, item.to)
})

const dataBuildCSS = [
    {
        from: 'resources/sass/app.scss',
        to: 'public/css',
    }
];

dataBuildCSS.forEach(item => {
    mix.js(item.from, item.to)
})

mix.vue()
