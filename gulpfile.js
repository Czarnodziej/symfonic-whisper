var gulp      = require('gulp');
var concat    = require('gulp-concat');
var uglify    = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var imagemin  = require('gulp-imagemin');
var del       = require('del');
var argv      = require('yargs').argv;
var gulpif    = require('gulp-if');
var rename    = require('gulp-rename');

var resourceDirectory = 'app/Resources/public/';

var destinationDirectory = 'web/';

var paths = {
    scripts: [
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        //
        'node_modules/datatables.net/js/jquery.dataTables.js',
        'node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        'node_modules/symfony-collection/jquery.collection.js',
        'node_modules/admin-lte/dist/js/app.js',
        resourceDirectory + 'js/**/*.js'
    ],
    styles: [
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/font-awesome/css/font-awesome.css',
        'node_modules/admin-lte/dist/css/AdminLTE.css',
        'node_modules/admin-lte/dist/css/skins/skin-blue.css',
        resourceDirectory + 'css/**/*.css'
    ],
    images: 'client/img/**/*',
    fonts: [
        'node_modules/font-awesome/fonts/**.*',
        'node_modules/bootstrap/fonts/**.*'
    ]
};

gulp.task('scripts', function () {
    return gulp.src(paths.scripts)
        .pipe(concat('script.js'))
        .pipe(gulpif(argv.prod, uglify()))
        .pipe(gulpif(argv.prod, rename({suffix: '.min'})))
        .pipe(gulp.dest(destinationDirectory + '/js'));
});

gulp.task('styles', function () {
    return gulp.src(paths.styles)
        .pipe(concat('style.css'))
        .pipe(gulpif(argv.prod, uglifycss()))
        .pipe(gulpif(argv.prod, rename({suffix: '.min'})))
        .pipe(gulp.dest(destinationDirectory + '/css'));
});

// Copy all static images
gulp.task('images', function () {
    return gulp.src(paths.images)
        // Pass in options to the task
        .pipe(imagemin({optimizationLevel: 5}))
        .pipe(gulp.dest(destinationDirectory + '/img'));
});

// Fonts
gulp.task('fonts', function () {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest(destinationDirectory + 'fonts'));
});

// Rerun the task when a file changes
gulp.task('watch', function () {
    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.images, ['images']);
    gulp.watch(paths.styles, ['styles']);
    gulp.watch(paths.fonts, ['fonts']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['scripts', 'styles', 'images', 'fonts']);
