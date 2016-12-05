var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

var paths = {
    'dev': {
        'js': './resources/assets/js/'
    },
    'production': {
        'js': './assets/'
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

gulp.task('watch', function () {
    gulp.watch(paths.dev.js + '*.js', ['js', 'jsMin']);
});

gulp.task('default', ['js', 'jsMin', 'watch']);