var elixir   = require('laravel-elixir');

require('./elixir-extensions');

elixir(function(mix) {
    mix
        .sass('main.scss', 'public/css/main.css')
        .babel([
            //'facebookUtils.js',
            'main.js',
            'action.js',
        ], 'public/js/main.js')
        .scripts([
            // bower:js
            'jquery/dist/jquery.js',
            'bootstrap-sass/assets/javascripts/bootstrap.js',
            'sweetalert/dist/sweetalert.min.js',
            'jquery-ui/ui/jquery-ui.js',
            'datatables/media/js/jquery.dataTables.js',
            'bootstrap/dist/js/bootstrap.js',
            'datatables-bootstrap3-plugin/media/js/datatables-bootstrap3.js',
            'datatables-bootstrap3-plugin/media/js/datatables-bootstrap3.min.js',
            'jquery-colorbox/jquery.colorbox.js',
            'metisMenu/dist/metisMenu.js',
            'datatables-responsive/js/dataTables.responsive.js',
            'select2/dist/js/select2.js',
            'summernote/dist/summernote.js',
            'Justified-Gallery/dist/js/jquery.justifiedGallery.js',
            'moment/moment.js',
            'moment-timezone/builds/moment-timezone-with-data-2010-2020.js',
            'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            'startmin/index.js',
            'raphael.min/index.js',
            'morris.min/index.js',
            'jquery.dataTables.min/index.js',
            'morris-data/index.js',
            'jquery.maskedinput/index.js',
            // endbower
        ], 'public/js/vendor.js', 'vendor/bower_components')
        .styles([
            // bower:css
            'sweetalert/dist/sweetalert.css',
            'datatables/media/css/jquery.dataTables.css',
            'font-awesome/css/font-awesome.css',
            'datatables-bootstrap3-plugin/media/css/datatables-bootstrap3.css',
            'datatables-bootstrap3-plugin/media/css/datatables-bootstrap3.min.css',
            'metisMenu/dist/metisMenu.css',
            'summernote/dist/summernote.css',
            'Justified-Gallery/dist/css/justifiedGallery.css',
            'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
            'bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
            'timeline/index.css',
            'morris/index.css',
            'metisMenu.min/index.css',
            'dataTables.bootstrap/index.css',
            'dataTables.responsive/index.css',
            'select2-css/select2.css',
            // endbower
        ], 'public/css/vendor.css', 'vendor/bower_components')
        .version(['css/main.css', 'js/main.js'])
        .copy('public/fonts', 'public/build/fonts')
        .images()
        //.copy('vendor/bower_components/font-awesome/fonts', 'public/fonts')
        .wiredep({
            //exclude: ['jquery']
        })
        .browserSync({
            proxy: process.env.APP_URL
        });
});
