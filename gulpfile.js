var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    less = require('gulp-less'),
    minify = require('gulp-clean-css');

var paths = {
    'dev': {
        'js': './resources/assets/js/',
        'less': './resources/assets/less/'
    },
    'production': {
        'js': './assets/',
        'css': './assets/'
    }
};

gulp.task('js', function () {
    return gulp.src(paths.dev.js + '*.js')
        .pipe(concat('form.js'))
        .pipe(gulp.dest(paths.production.js));
});

gulp.task('jsMin', function () {
    return gulp.src(paths.dev.js + '*.js')
        .pipe(concat('form.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.production.js));
});

gulp.task('css', function () {
    return gulp.src(paths.dev.less + '*.less')
        .pipe(less())
        .pipe(concat('form.css'))
        .pipe(gulp.dest(paths.production.css));
});

gulp.task('cssMin', function () {
    return gulp.src(paths.dev.less + '*.less')
        .pipe(less())
        .pipe(concat('form.min.css'))
        .pipe(minify({keepSpecialComments: 0}))
        .pipe(gulp.dest(paths.production.css));
});

gulp.task('watch', function () {
    gulp.watch(paths.dev.js + '*.js', ['js', 'jsMin']);
    gulp.watch(paths.dev.less + '*.less', ['css', 'cssMin']);
});

gulp.task('default', ['js', 'jsMin', 'css', 'cssMin', 'watch']);