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

// ========admin part
mix.styles(
    [
        "resources/assets/admin/plugins/fontawesome-free/css/all.min.css",
        // "resources/assets/admin/plugins/select2/css/select2.css",
        // "resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css",
        "resources/assets/admin/css/adminlte.min.css",
        "resources/assets/admin/css/adminlte.min.css.map",
        // "resources/assets/admin/plugins/daterangepicker/daterangepicker.css"
    ],
    "public/assets/admin/css/admin.css"
);

mix.scripts(
    [
        "resources/assets/admin/plugins/jquery/jquery.min.js",
        "resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js",
        // "resources/assets/admin/plugins/select2/js/select2.full.js",
        // "resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.js",
        "resources/assets/admin/js/adminlte.min.js",
        // "resources/assets/front/js/validator.min.js",
        "resources/assets/admin/js/demo.js",
        // "resources/assets/admin/plugins/moment/moment.min.js",
        // "resources/assets/admin/plugins/daterangepicker/daterangepicker.js",
        "resources/assets/admin/js/main.js"
    ],
    "public/assets/admin/js/admin.js"
);

mix.copyDirectory("resources/assets/admin/img", "public/assets/admin/img");
mix.copyDirectory(
    "resources/assets/admin/plugins/fontawesome-free/webfonts",
    "public/assets/admin/webfonts"
);
// mix.copyDirectory("resources/assets/front/fonts", "public/assets/admin/fonts");
//так можно добавлять пропущенные файлы
// mix.copy(
//     "resources/assets/admin/css/adminlte.min.css.map",
//     "public/assets/admin/css/adminlte.min.css.map"
// );