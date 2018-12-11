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

var APP_VERSION = '1.4.0';
var BUILD_PATH = 'public/build/' + APP_VERSION;
var VENDOR_ASSETS_PATH = 'public/assets/vendor/';
var JS_ASSETS_PATH = 'public/assets/js/';
var CSS_ASSETS_PATH = 'public/assets/css/';
var LESS_ASSETS_PATH = 'public/assets/less/';
var SEMANTIC_VERSION = '2.3.1';
var SEMANTIC_PATH = VENDOR_ASSETS_PATH + 'semantic/' + SEMANTIC_VERSION + '/components/';
var PRISM_VERSION = '1.15.0';

var loaderCss = function () {
    return gulp.src([
        CSS_ASSETS_PATH + 'loader.css'
    ])
        .pipe(concat('lo.css'))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
};

var fontsCss = function () {
    return gulp.src([
        CSS_ASSETS_PATH + 'fonts.css'
    ])
        .pipe(concat('fo.css'))
        .pipe(postcss([
            discard_comments({removeAll: true}),
            combine_duplicated_selectors(),
            autoprefixer(),
            sorting()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
};

var old__frontendCss = function () {
    return gulp.src([
        SEMANTIC_PATH + 'reset.css',
        SEMANTIC_PATH + 'site.css',
        SEMANTIC_PATH + 'container.css',
        SEMANTIC_PATH + 'divider.css',
        SEMANTIC_PATH + 'header.css',
        SEMANTIC_PATH + 'image.css',
        SEMANTIC_PATH + 'list.css',
        SEMANTIC_PATH + 'segment.css',
        SEMANTIC_PATH + 'breadcrumb.css',
        SEMANTIC_PATH + 'grid.css',
        SEMANTIC_PATH + 'menu.css',
        CSS_ASSETS_PATH + 'frontend.css'
    ])
        .pipe(concat('f.css'))
        .pipe(postcss([
            discard_comments({removeAll: true}),
            combine_duplicated_selectors(),
            autoprefixer(),
            sorting()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
};

var frontendCss = function () {
    return gulp.src([
        LESS_ASSETS_PATH + 'overrides/semantic/semantic.less',
        CSS_ASSETS_PATH + 'frontend.css'
    ])
        .pipe(concat('f.css'))
        .pipe(less())
        .pipe(postcss([
            discard_comments({removeAll: true}),
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
            discard_comments({removeAll: true}),
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

var countersJs = function () {
    return gulp.src([
        JS_ASSETS_PATH + 'counters.js'
    ])
        .pipe(concat('c.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

var svgIconsLoaderJs = function () {
    return gulp.src([
        JS_ASSETS_PATH + 'icons-loader.js'
    ])
        .pipe(concat('ilo.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
};

var svgSprite = function () {
    var svgstore = require('gulp-svgstore');
    var svgmin = require('gulp-svgmin');
    var rename = require('gulp-rename');

    return gulp.src('public/assets/img/icons/*.svg')
        .pipe(rename({prefix: 'fi-'}))
        .pipe(svgmin())
        .pipe(svgstore({
            inlineSvg: true
        }))
        .pipe(gulp.dest(BUILD_PATH));
};

gulp.task('loader css', gulp.parallel(loaderCss));
gulp.task('fonts css', gulp.parallel(fontsCss));
gulp.task('frontend css', gulp.parallel(frontendCss));
gulp.task('highlight css', gulp.parallel(highlightCss));
gulp.task('highlight js', gulp.parallel(highlightJs));
gulp.task('counters js', gulp.parallel(countersJs));
gulp.task('svg icons loader js', gulp.parallel(svgIconsLoaderJs));
gulp.task('svg sprite', gulp.parallel(svgSprite));

gulp.task('PRODUCTION', gulp.parallel(
    loaderCss,
    fontsCss,
    frontendCss,
    highlightCss,
    highlightJs,
    countersJs,
    svgIconsLoaderJs,
    svgSprite
));