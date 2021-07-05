var gulp = require('gulp');
var run = require('gulp-run');
var observedFolders = [
  'public/build/css/parts/**/*.css', 
  'public/build/js/parts/**/*.js'
];

gulp.task('compile-dev', function(){
  return run('node bundle_dev.js').exec();
});

gulp.task('minify', function(){
  return run('node minify.js').exec();
});

gulp.task('bundle', function(){
  return run('node bundle.js').exec();
});

gulp.task('default', function() {
  gulp.watch(observedFolders, gulp.series('minify', 'bundle'));
});

gulp.task('dev', function() {
  gulp.watch(observedFolders, gulp.series('compile-dev', 'bundle'));
});