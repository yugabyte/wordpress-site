// Gulp Imports
var gulp        = require ('gulp');
var sass        = require ('gulp-sass')(require('sass'));
var prefix      = require ('gulp-autoprefixer');
var concat      = require ('gulp-concat');
var rename      = require ('gulp-rename');
var uglify      = require ('gulp-uglify');
var cleanCSS    = require ('gulp-clean-css');
var babel       = require ('gulp-babel');
var sourcemaps  = require ('gulp-sourcemaps');
var browserSync = require ('browser-sync');
var packageData = require ('./package.json');

// Set Theme Paths
var paths = {
    styles:     ['assets/css/sass/**/*.scss'],
    scripts:    ['assets/js/src/**/*.js'],
    scripts_dest:   'assets/js/dist/',
    templates:  ['**/*.php'],
    gulp:       ['gulpfile.js']
}

// Tasks
gulp.task( 'styles', function(){

    return gulp.src( paths.styles )
        .pipe( sourcemaps.init() )                                  // initialize sourcemaps
        .pipe( sass().on('error', sass.logError) )                  // compile sass
        .pipe( prefix({
            browsers: ['last 2 versions']
        }))                                                         // browser-prefix CSS
        .pipe( cleanCSS() )                                         // compress 
        .pipe( sourcemaps.write() )                                 // write sourcemaps to disk
        .pipe(rename('screen.min.css'))
        .pipe( gulp.dest( './assets/css/dist/' ) );                        // save to disk

});

gulp.task( 'scripts', function(){

    return gulp.src( paths.scripts )
        .pipe( sourcemaps.init() )                                  // init sourcemaps
        .pipe( babel({                                         // compile typescript
            presets: ['env'],
        }))
        .pipe( sourcemaps.write() )                                 // write sourcemaps to disk
        .pipe(concat('scripts.js'))
        .pipe(rename('scripts.min.js'))
        .pipe( uglify() )                                           // compress
        .pipe( gulp.dest( paths.scripts_dest ) )                  // save to disk
});

gulp.task( 'reload', function(){        

    browserSync.reload();                                           // reload browserSync

});

gulp.task( 'watch', function(){

    gulp.watch( paths.templates, ['reload'] );                      // watch templates to recompile
    gulp.watch( paths.gulp, ['reload'] );       
    gulp.watch( paths.styles, ['styles', 'reload'] );               // watch styles to recompile
    gulp.watch( paths.scripts, ['scripts', 'reload'] );             // watch scripts to recompile

});

gulp.task ( 'serve', function(){

    browserSync.init({                                              // spin up web server
        proxy: "yugabyte:8888"
    });

});

gulp.task( 'default', gulp.series('serve', 'styles', 'scripts', 'watch'));    // initial task