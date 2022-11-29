const mix = require('laravel-mix');




 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .postCss('resources/css/app.css', 'public/css', [
     require('postcss-import'),
     require('tailwindcss'),
     require('autoprefixer'),
 ])
 mix.js('resources/js/user.js', 'public/user/js')

 .webpackConfig(require('./webpack.config'))

if (mix.inProduction()) {
 mix.version();
}



