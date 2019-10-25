const mix = require('laravel-mix');
const del = require('del')
const {InjectManifest} = require('workbox-webpack-plugin');

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

del(['precache-manifest.*.js'])
    .then(() => {
        mix.js('resources/js/app.js', 'public/js')
            .sass('resources/sass/app.scss', 'public/css')

            .js('resources/js/landing.js', 'public/js')
            .sass('resources/sass/landing.scss', 'public/css')

            .copy('resources/pwa/browserconfig.xml', 'public/browserconfig.xml')
            .copy('resources/pwa/ms-icon-*.png', 'public/ms-icons')

            .copy('resources/pwa/android-icon-*.png', 'public/android-icons')

            .copy('resources/pwa/apple-icon-*.png', 'public/apple-icons')
            .copy('resources/pwa/apple-icon.png', 'public/apple-icons')

            .copy('resources/pwa/favicon-*.png', 'public')
            .copy('resources/pwa/favicon.ico', 'public/favicon.ico')

            .copy('resources/pwa/icon-512-512.png', 'public/icon-512-512.png')
            .copy('resources/pwa/manifest.json', 'public/manifest.json')

            .webpackConfig(webpack => {
                return {
                    plugins: [
                        new InjectManifest({
                            swSrc: 'resources/pwa/sw.js',
                            swDest: 'service-worker.js',
                            importWorkboxFrom: 'local'
                        })
                    ]
                };
            })
            .minify([
                'public/js/app.js',
                'public/css/app.css',
                'public/js/landing.js',
                'public/css/landing.css',
            ]);
    });
