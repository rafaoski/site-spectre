var gulp = require('gulp');
var browserSync = require('browser-sync').create()
var sass = require('gulp-sass');
var cleancss = require('gulp-clean-css');
var csscomb = require('gulp-csscomb');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');

var URL = 'http://spectre.dev/';

var paths = {
  source: './assets/scss/**/*.scss',
  // doc: './docs/src/*.scss'
};

// Static Server + watching scss/php files
gulp.task('serve', function () {
  browserSync.init({
    // proxy: 'localhost/processwire-folder/',
    proxy: URL,
    notify: false,
    browser: 'chrome',
    // browser: "firefox",

    // WATCH PHP FILES
    files: ["**/*.php"],
  })

  // WATCH SASS
  gulp.watch("assets/scss/**/*.scss", ['sass']);
})

gulp.task('sass', function() {
  gulp.src(paths.source)
    .pipe(sass({outputStyle: 'compact', precision: 10})
      .on('error', sass.logError)
    )
    .pipe(autoprefixer())
    .pipe(csscomb())
    .pipe(gulp.dest('assets/css'))
    .pipe(cleancss())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream());
});

// COPY FONT AWESOME
gulp.task('copy-fonts', function () {
  gulp.src('./node_modules/font-awesome/fonts/**/*')
    .pipe(gulp.dest('./assets/fonts'))
})

gulp.task('copy-css', function() {
    gulp.src([
            './node_modules/font-awesome/css/font-awesome.min.css'
        ])
        .pipe(gulp.dest('./assets/css'));
});

gulp.task('copy-js', function() {
  gulp.src([
          './node_modules/lazyload/lazyload.min.js'
      ])
      .pipe(gulp.dest('./assets/js'));
});

// COPY ASSETS
gulp.task('copy', ['copy-fonts','copy-css','copy-js']);

// WATCH CHANGES
gulp.task('watch', ['serve','sass']);

// FINISH BUILDED PACKAGES
gulp.task('build', ['sass','copy']);
