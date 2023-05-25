var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var nano = require('gulp-cssnano');
var discard_comments = require('postcss-discard-comments');
var combine_duplicated_selectors = require('postcss-combine-duplicated-selectors');
var sorting = require('postcss-sorting');
var less = require('gulp-less');

require('dotenv').config();

const APP_VERSION = process.env.APP_VERSION;
var BUILD_PATH = 'public/b/' + APP_VERSION;
var VENDOR_ASSETS_PATH = 'public/assets/vendor/';
var JS_ASSETS_PATH = 'public/assets/js/';
var JS_RESOURCES_PATH = 'resources/js/';
var CSS_RESOURCES_PATH = 'resources/css/';
var LESS_RESOURCES_PATH = 'resources/less/';
var PRISM_VERSION = '1.15.0';

var frontendCss = function () {
    return gulp.src([
        LESS_RESOURCES_PATH + 'fomantic/2.9.2/semantic.less',
        CSS_RESOURCES_PATH + 'frontend.css'
    ])
        .pipe(concat('f.css'))
        .pipe(less())
        .pipe(postcss([
            discard_comments({ removeAll: true }),
            combine_duplicated_selectors(),
            autoprefixer(),
            sorting()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
};

var frontendJs = function () {
    return gulp.src([
        JS_ASSETS_PATH + 'frontend.js'
    ])
        .pipe(concat('f.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

var highlightCss = function () {
    return gulp.src([
        VENDOR_ASSETS_PATH + 'prism/' + PRISM_VERSION + '/prism.css'
    ])
        .pipe(concat('h.css'))
        .pipe(postcss([
            discard_comments({ removeAll: true }),
            combine_duplicated_selectors(),
            autoprefixer(),
            sorting()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
};

var highlightJs = function () {
    return gulp.src([
        VENDOR_ASSETS_PATH + 'prism/' + PRISM_VERSION + '/prism.js',
        JS_ASSETS_PATH + 'highlight.js'
    ])
        .pipe(concat('h.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

var svgSpriteLoaderJs = function () {
    return gulp.src([
        JS_RESOURCES_PATH + 'svg-sprite-loader.js'
    ])
        .pipe(concat('s.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

var svgSprite = function () {
    var svgstore = require('gulp-svgstore');
    var svgmin = require('gulp-svgmin');
    var rename = require('gulp-rename');

    return gulp.src('resources/images/icons/*.svg')
        .pipe(rename({ prefix: 'fi-' }))
        .pipe(svgmin())
        .pipe(svgstore({
            inlineSvg: true
        }))
        .pipe(rename({ basename: 's' }))
        .pipe(gulp.dest(BUILD_PATH));
};

var analyticsJs = function () {
    return gulp.src([
        JS_RESOURCES_PATH + 'google-analytics.js'
    ])
        .pipe(concat('a.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

const webmanifest_file = function () {
    return gulp.src([
        'public/favicon/app.webmanifest'
    ])
        .pipe(gulp.dest(BUILD_PATH));
};

gulp.task('frontend css', gulp.parallel(frontendCss));
gulp.task('highlight', gulp.parallel(highlightCss, highlightJs));
gulp.task('svg sprite loader js', gulp.parallel(svgSpriteLoaderJs));
gulp.task('svg sprite', gulp.parallel(svgSprite));
gulp.task('google analytics js', gulp.parallel(analyticsJs));

gulp.task('PRODUCTION', gulp.parallel(
    frontendCss,
    highlightCss,
    highlightJs,
    svgSpriteLoaderJs,
    svgSprite,
    analyticsJs,
    webmanifest_file
));
