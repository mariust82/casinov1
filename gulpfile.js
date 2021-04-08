var gulp = require('gulp');

gulp.task('compile-dev', function () {
    return run('node bundle_dev.js').exec();
});

gulp.task('minify', function () {
    return run('node minify.js').exec();
});

gulp.task('bundle', function () {
    return run('node bundle.js').exec();
});

gulp.task('default', function () {
    gulp.watch(['public/build/css/parts/**/*.css', 'public/build/js/parts/**/*.js'], gulp.series('compile-dev', 'bundle', 'minify', 'bundle'));
});

var penthouse = require("penthouse");
var fs = require('fs');
var urlList = require('./criticalcss-pagelist.json');

gulp.task('criticalcss', function () {
    urlList.urls.forEach(function (item, i) {
        penthouse({
            url: item.link,  // can also use file:/// protocol for local files
            css: './public/build/css/parts/all.css',  // path to original css file on disk
            width: 1300,  // viewport width
            height: 900,  // viewport height
            keepLargerMediaQueries: false,  // when true, will not filter out larger media queries
            forceInclude: [ // selectors to keep, useful for above-the-fold styles added by js scripts
                '.keepMeEvenIfNotSeenInDom',
                /^\.regexWorksToo/
            ],
            propertiesToRemove: [
                '(.*)transition(.*)',
                'cursor',
                'pointer-events',
                '(-webkit-)?tap-highlight-color',
                '(.*)user-select'
            ],
            userAgent: 'Penthouse Critical Path CSS Generator', // specify which user agent string when loading the page
            puppeteer: {
                getBrowser: undefined, // A function that resolves with a puppeteer browser to use instead of launching a new browser session
            }
        })
        .then(criticalCss => {
            // use the critical css
            fs.writeFileSync('./public/build/css/compilations/' + item.name + '.css', criticalCss);
        })
        .catch(err => {
            console.log(err);
        });
    });
});