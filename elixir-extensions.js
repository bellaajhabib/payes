var gulp     = require('gulp');
var elixir   = require('laravel-elixir');
var dotenv   = require('dotenv').load();
var _        = require('underscore');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var wiredep  = require('wiredep').stream;
var Task     = elixir.Task;
var config   = elixir.config;

require('./elixir-extensions');

elixir.extend('wiredep', function(options) {
    options = _.extend({
        ignorePath:  /(\..\/)*vendor\/bower_components\//,
        fileTypes: {
          js: {
            block: /(([ \t]*)\/\/\s*bower:*(\S*))(\n|\r|.)*?(\/\/\s*endbower)/gi,
            detect: {
              js: /\s['"](.+js)['"]/gi,
              css: /\s['"](.+css)['"]/gi
            },
            replace: {
              js: '"{{filePath}}",',
              css: '"{{filePath}}",'
            }
          }
        }
    }, options);

    new Task('wiredep', function() {
      return gulp.src('gulpfile.js')
            .pipe(wiredep(options))
            .on('error', function(e) {
                new elixir.Notification().error(e, 'Wiring Bower Dependencies Failed!');
                this.emit('end');
            })
            .pipe(gulp.dest('./'));
    })
    .watch('bower.json');
});

elixir.extend('images', function(options) {
    config.img = {
        folder: 'img',
        outputFolder: config.versioning.buildFolder + '/img'
    };

    options = _.extend({
        progressive: true,
        interlaced : true,
        svgoPlugins: [{removeViewBox: false, cleanupIDs: false}],
        use: [pngquant()]
    }, options);

    new Task('imagemin', function () {
        var paths = new elixir.GulpPaths()
            .src(config.get('public.img.folder'))
            .output(config.get('public.img.outputFolder'));

        return gulp.src(paths.src.path)
            .pipe(imagemin(options))
            .on('error', function(e) {
                new elixir.Notification().error(e, 'Minifying Images Failed!');
                this.emit('end');
            })
            .pipe(gulp.dest(paths.output.path));
    });
});
