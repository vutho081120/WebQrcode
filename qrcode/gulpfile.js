const { src, dest, watch, series} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const prefix = require('gulp-autoprefixer');
const minify = require('gulp-clean-css');
const merge =   require('merge-stream');

//compile, prefix, and min scss
function compilescss() {
    var firstPath =src('./public/sass/Qrcode/main.scss') // change to your source directory
                    .pipe(sass())
                    .pipe(prefix('last 2 versions'))
                    .pipe(minify())
                    .pipe(dest('./public/css/Qrcode/')); // change to your final/public directory
    var secondPath = src('./public/sass/Site/main.scss') // change to your source directory
                    .pipe(sass())
                    .pipe(prefix('last 2 versions'))
                    .pipe(minify())
                    .pipe(dest('./public/css/Site/')); // change to your final/public directory
    return merge(firstPath, secondPath);
}


//watchtask
function watchTask(){
    watch("./public/sass/**/*.scss", compilescss); // change to your source directory
    //watch("**/*.php").on('change', browserSync.reload);
}

// Default Gulp task 
exports.default = series(
    compilescss,
    //browsersyncServe,
    watchTask
);