const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const babelify = require('babelify');
const source = require('vinyl-source-stream');
const browserify = require('browserify');
const watch = require('gulp-watch');
const reload = browserSync.reload;
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cssnano = require('gulp-cssnano');

gulp.task('sass', () => {
    gulp.src('./src/sass/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./dist/css'))
        .pipe(browserSync.stream());
});

gulp.task('js', () => {
    return browserify({ entries: ['./src/js/app.js'], debug: true })
        .transform(babelify, { presets: ['env'] })
        .bundle()
        .on('error', (e) => console.log({ message: 'Error', filename: e.filename, at: e.loc }))
        .pipe(source('app.js'))
        .pipe(gulp.dest('./dist/js'))
        .pipe(browserSync.stream());
});

gulp.task('watch', ['sass', 'js'], () => {
    // https://browsersync.io/docs/options
    browserSync.init({
        server: {
            baseDir: "./"
        },
        port: 3000,
        open: false
    });

    watch('./src/sass/**/*.scss', () => {
        gulp.start('sass');
    });

    watch('./src/js/**/*.js', () => {
        gulp.start('js');
    });

    watch(['./**/*.html', './**/*.php'], () => {
        reload();
    });
});

gulp.task('production', ['sass', 'js'], () => {
    gulp.src('./dist/js/app.js')
        .pipe(uglify())
        .pipe(rename('app.min.js'))
        .pipe(gulp.dest('./dist/js'));

    gulp.src('./dist/css/style.css')
        .pipe(cssnano())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('./dist/css'));
});
