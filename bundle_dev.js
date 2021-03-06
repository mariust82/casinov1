var fs = require("fs"),
    xml2js = require("xml2js"),
    parser = new xml2js.Parser(),
    gulp = require('gulp'),
    // babel = require('gulp-babel'),
    uglify = require("gulp-uglify"),
    minifyCss = require("gulp-clean-css")
;

if(!fs.existsSync("resources.xml")) {
    console.error("ERROR: XML file not set");
    return;
}

fs.readFile("resources.xml", function(error, data) {
    parser.parseString(data, function(err, result) {
        var types = ["js","css"];
        for(var z in types) {
            var type = types[z];
            // gets source and destination folders
            var sourceFolder = result.xml[type][0].$.source;
            if (!fs.existsSync(sourceFolder)) {
                console.error("ERROR: folder " + sourceFolder + " not found!");
                return;
            }
            var destinationFolder = result.xml[type][0].$.destination;

            // minify
            if (!fs.existsSync(destinationFolder)) {
                fs.mkdirSync(destinationFolder);
            }
            if(type==="js") {
                gulp.src(sourceFolder+'/**/*.js')
                    // .pipe(babel({presets: ['es2015']}))
                    // .pipe(uglify())
                    .pipe(gulp.dest(destinationFolder+'/'))
            } else if(type==="css") {
                gulp.src(sourceFolder+'/**/*.css')
                    // .pipe(minifyCss())
                    .pipe(gulp.dest(destinationFolder+'/'))
            }
        }
        console.log("COMPLETE!");
    });
});