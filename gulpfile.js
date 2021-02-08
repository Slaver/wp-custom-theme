'use strict';

var paths = {
    'scss': './assets/scss/style.scss',
    'css': './assets/css/',
};
var gulp = require('gulp');
var sass = require('gulp-sass');
var options = {};

gulp.task('sass', function() {
    return gulp.src(paths.scss)
        .pipe(sass())
        .pipe(gulp.dest(paths.css));
});