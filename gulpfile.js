// including plugins
var gulp = require('gulp')
, uglify = require("gulp-uglify")
, concat = require("gulp-concat")
, minifyCss = require("gulp-minify-css");


// task
gulp.task('minify-js', function () {
	var arguments = process.argv;
	if(arguments[4] == undefined || arguments[6] == undefined) {
		console.log("Insufficient arguments");
		return false;
	}
    var sourcesFolder = arguments[4];
    var destinationFolder = arguments[6];
	return gulp.src(sourcesFolder+'/*.js')
	.pipe(uglify())
	.pipe(gulp.dest(destinationFolder+'/'));
});

gulp.task('minify-css', function () {
    var arguments = process.argv;
    if(arguments[4] == undefined || arguments[6] == undefined) {
        console.log("Insufficient arguments");
        return false;
    }
    var sourcesFolder = arguments[4];
    var destinationFolder = arguments[6];
    return gulp.src(sourcesFolder+'/*.css')
        .pipe(minifyCss())
        .pipe(gulp.dest(destinationFolder+'/'));
});

// npm install --save-dev gulp-minify-css
// npm install --save-dev gulp-uglify
