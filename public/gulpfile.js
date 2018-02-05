var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin'),
    cache = require('gulp-cache');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var handlebars = require('gulp-compile-handlebars');
var spritesmith = require('gulp.spritesmith');
var merge = require('merge-stream');
var clean = require('gulp-clean');
var runSequence = require('run-sequence');
var sourcemaps = require('gulp-sourcemaps');


gulp.task('clean', function () {
    return gulp.src('build/', {read: false})
        .pipe(clean());
});

gulp.task('browser-sync', function() {
  browserSync({
    server: {
       baseDir: "build/"
    }
  });
});

gulp.task('bs-reload', function () {
  browserSync.reload();
});

gulp.task('copyfonts', function() {
   gulp.src('src/fonts/**/*.{eot,svg,ttf,woff}')
   .pipe(gulp.dest('build/fonts/'));
});

gulp.task('images', function(){
  gulp.src(['src/images/**/*.{png,jpg,gif,svg}'])
    .pipe(gulp.dest('build/images/'));

  // gulp.src(['src/img/**/*.{png,jpg,gif,svg}'])
  //   .pipe(gulp.dest('build/img/'));
});

gulp.task('styles', function(){
  gulp.src(['src/scss/**/*.scss'])
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(sourcemaps.init({loadMaps: true, identityMap: true}))
    .pipe(sass({
      outputStyle: 'expanded'//'expanded', 'compressed'
     }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('build/css/'))
    .pipe(browserSync.stream())
});


gulp.task('scripts', function(){
  return gulp.src(['src/js/**/*.js','!src/js/**/custom.js'])
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(concat('assets.js'))
    .pipe(gulp.dest('build/js/'))
    // .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('build/js/'))
    .pipe(browserSync.reload({stream:true}))
});

gulp.task('copycustomscript', function() {
   gulp.src('src/js/custom.js')
   .pipe(gulp.dest('build/js/'));
});

gulp.task('scripts-build', function(){
  return gulp.src(['src/js/**/*.js','!src/js/**/custom.js'])
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(concat('assets.js'))
    .pipe(gulp.dest('build/js/'))
    // .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('build/js/'))
    .pipe(browserSync.reload({stream:true}))
});

gulp.task('copycustomscript-build', function() {
   gulp.src('src/js/custom.js')
   .pipe(uglify())
   .pipe(gulp.dest('build/js/'));
});

gulp.task('handlebarsToHTML', function () {
  var templateData = require('./src/data.json'),
      options = {
          batch: ['src/partials']
      }

    return gulp.src(['src/pages/**/*.html', '!src/pages/**/_*.html',
                     'src/pages/**/*.hbs', '!src/pages/**/_*.hbs'])
        .pipe(handlebars(templateData, options))
        .pipe(gulp.dest('build/'))
        .pipe(browserSync.reload({stream:true}))
});

gulp.task('sprite', function () {
  var spriteData = gulp.src('src/images/sprite/*.png').pipe(spritesmith({
    imgName: 'sprite.png',
    cssName: '_sprite.scss',
    imgPath: '../images/sprite.png'
  }));
 
  var imgStream = spriteData.img
    .pipe(gulp.dest('src/images/'));
 
  var cssStream = spriteData.css
    .pipe(gulp.dest('src/scss/'));
 
  return merge(imgStream, cssStream);
});

gulp.task('refresh', function() {
  runSequence('clean',
              [
              'images',
              'copyfonts',
              'styles',
              'scripts',
              'handlebarsToHTML'
              ]
  );

});

gulp.task('default', function() {
  runSequence('clean',
              // 'sprite',
              [
              'images',
              'copyfonts',
              'styles',
              'scripts',
              'copycustomscript',
              'handlebarsToHTML'
              ],
              'browser-sync'
  );

  gulp.watch("src/scss/**/*.scss", ['styles']);
  gulp.watch("src/js/**/*.js", ['scripts','copycustomscript']);
  // gulp.watch("src/data.json", ['refresh']);
  gulp.watch("src/**/*.html", ['handlebarsToHTML']);
  gulp.watch("src/images/**/*", ['images']);
  // gulp.watch("src/img/**/*", ['images']);
  gulp.watch("src/fonts/**/*", ['copyfonts']);
});

gulp.task('build', function() {
  runSequence('clean',
              // 'sprite',
              [
              'images',
              'copyfonts',
              'styles',
              'scripts-build',
              'copycustomscript-build',
              'handlebarsToHTML'
              ],
              'browser-sync'
  );
});