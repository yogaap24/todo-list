const mix = require('laravel-mix');

let source = 'public/app/src/';
let build = 'public/app/build/';

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

mix.js('public/app/app.js',build)
    .js('public/app/api.js',build)
    .js(source + 'todoList.js', build)
    .version();

mix.disableNotifications();
