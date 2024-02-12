let mix = require('laravel-mix');

mix.styles([
    'resources/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/admin/plugins/select2/css/select2.min.css',
    'resources/admin/css/adminlte.min.css',
], 'public/assets/admin/css/admin.css');

mix.styles([
    'resources/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/admin/css/adminlte.min.css',
], 'public/assets/admin/css/user.css');

mix.styles('resources/admin/css/post.css', 'public/assets/admin/css/post.css');

mix.styles([
    'resources/site/css/bootstrap.css',
    'resources/site/css/font-awesome.min.css',
    'resources/site/css/style.css',
    'resources/site/css/animate.css',
    'resources/site/css/responsive.css',
    'resources/site/css/colors.css',
    'resources/site/css/marketing.css',
], 'public/assets/site/css/site.css');

mix.scripts([
    'resources/admin/plugins/jquery/jquery.min.js',
    'resources/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/admin/plugins/select2/js/select2.full.min.js',
    'resources/admin/js/adminlte.min.js',
    'resources/admin/js/demo.js',
    'resources/admin/js/main.js',
], 'public/assets/admin/js/admin.js');

mix.scripts([
    'resources/admin/plugins/jquery/jquery.min.js',
    'resources/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/admin/js/adminlte.min.js',
    'resources/admin/js/user.js',
], 'public/assets/admin/js/user.js');

mix.scripts('resources/admin/js/post.js', 'public/assets/admin/js/post.js');

mix.scripts([
    'resources/site/js/jquery.min.js',
    'resources/site/js/tether.min.js',
    'resources/site/js/bootstrap.min.js',
    'resources/site/js/animate.js',
    'resources/site/js/custom.js',
    'resources/site/js/main.js',
], 'public/assets/site/js/site.js');

mix.copyDirectory('resources/admin/img', 'public/assets/admin/img');
mix.copyDirectory('resources/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');
mix.copyDirectory('resources/admin/ckeditor', 'public/assets/admin/ckeditor');
mix.copyDirectory('resources/admin/ckfinder', 'public/assets/admin/ckfinder');
mix.copyDirectory('resources/site/fonts', 'public/assets/site/fonts');
mix.copyDirectory('resources/site/images', 'public/assets/site/images');
