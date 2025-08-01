const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass')(require('sass'));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const sourcemaps = require("gulp-sourcemaps");
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const order = require('gulp-order');

//compile scss into css
function style() {
    return gulp.src('src/sass/**/*.scss', { sourcemaps: true })
    .pipe(sourcemaps.init())
    .pipe(sass().on('error',sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/css', { sourcemaps: '.' }));
}

function scripts() {
    const jsFiles = 'src/js/**/*.js',
    jsDest = 'assets/js';

    
    return gulp.src(jsFiles)
        .pipe(order([
            'libs/jquery-3.6.0.min.js',
        ]))
        .pipe(concat('main.js'))
        .pipe(rename('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
}


function watch() {
    gulp.watch('src/sass/**/*.scss', style);
    gulp.watch('src/js/**/*.js', scripts);
}

exports.style = style;
exports.scripts = scripts;
exports.watch = watch;