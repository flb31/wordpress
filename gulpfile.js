const PUBLIC = 'wp-content/themes/lumen/assets';

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    livereload = require('gulp-livereload'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify'),
    watch = require('gulp-watch');

gulp.task('watch', () => {
  livereload({ start: true });
  livereload.listen();

  gulp.watch('src/js/**/*.js', ['js']);
  gulp.watch('src/sass/**/*.scss', ['sass']);
});

gulp.task('js', () => {
  return gulp
    .src('src/js/**/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
    .pipe(concat('script.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(PUBLIC + '/js'))
    .pipe(livereload());
});

gulp.task('sass', () => {
  return gulp
    .src('src/sass/*.scss')
    .pipe(sass({outputStyle: 'compressed'})
    .on('error', sass.logError))
    .pipe(gulp.dest(PUBLIC + '/css'))
    .pipe(livereload());
});

gulp.task('default', ['sass', 'js', 'watch']);
