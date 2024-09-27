// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, parallel } = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const replace = require('gulp-replace');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const jshint = require('gulp-jshint');
const stylish = require('jshint-stylish');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const sitename = 'localhost:8085';
// File paths
const files = {
  scssPath: 'styles/**/*.scss',
  jsCustom: 'scripts/*.js',
  jsSingle: 'scripts/single/*.js',
  jsVendor: 'scripts/vendor/*.js',
  phpPath: '../*.php',
};

// Sass task: compiles the style.scss file into style.css
function scssTask() {
  return src(files.scssPath)
    .pipe(sourcemaps.init()) // initialize sourcemaps first
    .pipe(sass()) // compile SCSS to CSS
    .pipe(postcss([autoprefixer(), cssnano()])) // PostCSS plugins
    .pipe(
      rename({
        suffix: '.min',
      })
    )
    .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
    .pipe(dest('../assets/css/')) // put final CSS in dist folder
    .pipe(browserSync.stream());
}

function jsVendor() {
  return src(files.jsVendor)
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min',
      })
    )
    .pipe(dest('../assets/js/vendor'));
}

function jsCustom() {
  return src([files.jsCustom])
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter(stylish))
    .pipe(customPlumber('Javascript Errors'))
    .pipe(sourcemaps.write('.'))
    .pipe(concat('cancan.js'))
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min',
      })
    )
    .pipe(dest('../assets/js'));
}

function jsSingle() {
  return (
    src([files.jsCustom])
      .pipe(jshint('.jshintrc'))
      .pipe(jshint.reporter(stylish))
      .pipe(customPlumber('Javascript Errors'))
      .pipe(sourcemaps.write('.'))
      // .pipe(concat('cancan.js'))
      .pipe(uglify())
      .pipe(
        rename({
          suffix: '.min',
        })
      )
      .pipe(dest('../assets/js'))
  );
}
// function minifyJS(src) {
//   return src.pipe(uglify()).pipe(
//     rename({
//       suffix: '.min',
//     })
//   );
// }
// Cachebust
// function cacheBustTask() {
//   var cbString = new Date().getTime();
//   return src(['index.html'])
//     .pipe(replace(/cb=\d+/g, 'cb=' + cbString))
//     .pipe(dest('.'));
// }

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchJS() {
  watch(
    [files.jsCustom, files.jsVendor, files.jsSingle],
    { interval: 1000, usePolling: true }, //Makes docker work
    series(
      parallel(
        /*scssTask, jsHint, */ jsVendor,
        jsCustom,
        jsSingle
      ) /*, cacheBustTask*/
    )
  );
}

function bsServe(cb) {
  browserSync.init(files.scssPath, {
    proxy: 'http://local.cancancleanse.com',
    notify: true,
  });
  cb();
}

function bsReload(cb) {
  browserSync.reload();
  cb();
}
function watchSass() {
  watch(
    files.scssPath,
    series(scssTask, bsReload)
    //{interval: 1000, usePolling: true}, //Makes docker work
    // series(
    //   parallel(scssTask, /*jsHint, */ jsVendor, jsCustom) /*, cacheBustTask*/
    // )
  );
}
function customPlumber(errTitle) {
  return plumber({
    errorHandler: notify.onError({
      title: errTitle || 'Error running Gulp',
      message: 'Error: <%= error.message %>',
      sound: 'Glass',
    }),
  });
}
// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
// then runs cacheBust, then watch task
exports.default = series(
  parallel(
    /*scssTask, jsHint,*/
    jsVendor,
    jsCustom,
    jsSingle,
    watchJS,
    watchSass,
    bsServe
  )
  /*cacheBustTask,*/
);
