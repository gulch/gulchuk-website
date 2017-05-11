var gulp = require('gulp');
var elixir = require('laravel-elixir');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var nano = require('gulp-cssnano');
var comments = require('postcss-discard-comments');
var uncss = require('gulp-uncss');

var BUILD_PATH = 'public/assets/processed/';
var VENDOR_ASSETS_PATH = 'public/assets/vendor/';
var JS_ASSETS_PATH = 'public/assets/js/';
var CSS_ASSETS_PATH = 'public/assets/css/';
var SEMANTIC_VERSION = '2.2.6';
var SEMANTIC_PATH = VENDOR_ASSETS_PATH + 'semantic/' + SEMANTIC_VERSION + '/components/';

gulp.task('production', [
    'loader-css',
    'fonts-css',
    'frontend-css',
    /*'frontend-js',*/
    'highlight-css',
    'highlight-js',
    'svg-icons-loader-js'
]);

gulp.task('loader-css', function () {
    return gulp.src([
        CSS_ASSETS_PATH + 'loader.css'
    ])
        .pipe(concat('lo.css'))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('fonts-css', function () {
    return gulp.src([
        CSS_ASSETS_PATH + 'fonts.css'
    ])
        .pipe(concat('fo.css'))
        .pipe(postcss([
            comments({removeAll: true}),
            autoprefixer()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('frontend-css', function () {
    return gulp.src([
        SEMANTIC_PATH + 'reset.css',
        SEMANTIC_PATH + 'site.css',
        SEMANTIC_PATH + 'container.css',
        SEMANTIC_PATH + 'grid.css',
        SEMANTIC_PATH + 'segment.css',
        SEMANTIC_PATH + 'image.css',
        SEMANTIC_PATH + 'site.css',
        SEMANTIC_PATH + 'menu.css',
        SEMANTIC_PATH + 'header.css',
        SEMANTIC_PATH + 'divider.css',
        SEMANTIC_PATH + 'list.css',
        SEMANTIC_PATH + 'breadcrumb.css',
        CSS_ASSETS_PATH + 'frontend.css'
    ])
        .pipe(concat('f.css'))
        /*.pipe(uncss({
            html: [
                'https://dev.gulchuk.com',
                'https://dev.gulchuk.com/cv',
                'https://dev.gulchuk.com/blog',
                'https://dev.gulchuk.com/blog/tag/redis',
                'https://dev.gulchuk.com/blog/change-engine-for-all-mysql-database-tables'
            ]
        }))*/
        .pipe(postcss([
            comments({removeAll: true}),
            autoprefixer()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('frontend-js', function () {
    return gulp.src([
        JS_ASSETS_PATH + 'frontend.js'
    ])
        .pipe(concat('f.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('highlight-css', function () {
    return gulp.src([
        VENDOR_ASSETS_PATH + 'prism/1.6.0/prism.css'
    ])
        .pipe(concat('h.css'))
        .pipe(postcss([
            comments({removeAll: true}),
            autoprefixer()
        ]))
        .pipe(nano())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('highlight-js', function () {
    return gulp.src([
        VENDOR_ASSETS_PATH + 'prism/1.6.0/prism.js',
        JS_ASSETS_PATH + 'highlight.js'
    ])
        .pipe(concat('h.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('svg-icons-loader-js', function () {
    return gulp.src([
        JS_ASSETS_PATH + 'icons-loader.js'
    ])
        .pipe(concat('ilo.js'))
        .pipe(uglify())
        .pipe(gulp.dest(BUILD_PATH));
});

gulp.task('svg-sprite', function () {

    var svgstore = require('gulp-svgstore');
    var svgmin = require('gulp-svgmin');
    var rename = require('gulp-rename');

    return gulp.src('public/assets/img/icons/*.svg')
        .pipe(rename({prefix: 'fi-'}))
        .pipe(svgmin())
        .pipe(svgstore())
        .pipe(gulp.dest('public/assets/img/'));
});

elixir(function (mix) {
    mix.version([
        BUILD_PATH + 'lo.css',
        BUILD_PATH + 'fo.css',
        /*BUILD_PATH + 'f.js',*/
        BUILD_PATH + 'f.css',
        BUILD_PATH + 'h.css',
        BUILD_PATH + 'h.js',
        BUILD_PATH + 'ilo.js',
    ]);
});
