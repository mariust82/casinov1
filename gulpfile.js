var gulp = require('gulp');
var run = require('gulp-run');

gulp.task('minify', function () {
    return run('node minify.js').exec();
});

gulp.task('bundle', function () {
    return run('node bundle.js').exec();
});

gulp.task('default', function () {
    gulp.watch(['public/build/css/parts/**/*.css', 'public/build/js/parts/**/*.js'], gulp.series('minify', 'bundle'));
});