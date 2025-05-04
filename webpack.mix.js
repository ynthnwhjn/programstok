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

// mix.autoload({
//    jquery: ['$', 'window.jQuery'],
// });

mix.webpackConfig(webpack => {
   return {
      plugins: [
         new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
         })
      ]
   };
});

mix.js('resources/js/app.js', 'public/js')
   .js('resources/views/customers/*.js', 'public/js/customers')
   .js('resources/views/purchase_invoices/*.js', 'public/js/purchase_invoices')
   .js('resources/views/sales_invoices/*.js', 'public/js/sales_invoices')
   .js('resources/views/laporan_stok_barang/*.js', 'public/js/laporan_stok_barang')
   .postCss('resources/css/pracetak.css', 'public/css')
   .postCss('resources/css/app.css', 'public/css', [
      //
   ]);
