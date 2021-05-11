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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

// =========front part
mix.styles(
    [
        "resources/assets/front/css/bootstrap.css",
        "resources/assets/front/css/bootstrap.css.map",
        "resources/assets/front/css/flexslider.css",
        "resources/assets/front/css/font-awesome.css",
        "resources/assets/front/plugins/megamenu/css/ionicons.min.css",
        "resources/assets/front/plugins/megamenu/css/style.css",
        "resources/assets/front/plugins/autocomplete/jquery-ui.css",
        "resources/assets/front/css/style.css"

    ],
    "public/assets/front/css/front.css"
);

mix.scripts(
    [
        "resources/assets/front/js/jquery-1.11.0.min.js",
        "resources/assets/front/plugins/megamenu/js/megamenu.js",
        "resources/assets/front/js/bootstrap.min.js",
        "resources/assets/front/js/responsiveslides.min.js",
        "resources/assets/front/js/simpleCart.min.js",
        "resources/assets/front/js/jquery.easydropdown.js",
        "resources/assets/front/js/imagezoom.js",
        "resources/assets/front/js/jquery.flexslider.js",
        "resources/assets/front/plugins/autocomplete/jquery-ui.js",
        "resources/assets/front/js/validator.min.js",
        "resources/assets/front/js/main.js"
    ],
    "public/assets/front/js/front.js"
);

mix.copyDirectory("resources/assets/front/fonts", "public/assets/front/fonts");
mix.copyDirectory("resources/assets/front/images", "public/assets/front/images");
mix.copyDirectory("resources/assets/front/plugins/autocomplete/images", "public/assets/front/autocomplete/images");