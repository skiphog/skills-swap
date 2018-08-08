let mix = require('laravel-mix');

mix.
  js('assets/js/app.js', 'c:\\OSPanel\\domains\\skills-swap\\public\\js\\').
  sass('assets/sass/app.scss', 'public/css');

mix.babel(['assets/js/modal.js'], 'c:\\OSPanel\\domains\\skills-swap\\public\\js\\modal.js');
