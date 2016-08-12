
/** LIBRARIES **/

var gulp = require('gulp');
var sass = require('gulp-sass');
var del = require('del');


/** PATHS **/

var paths = {
  /* CSS */
  scss: './scss/*.scss',     // SCSS files
  csslib: './css/lib/*.css', // CSS Libraries (pre-minified)
  cssbuild: './css/*.css',   // Compiled CSS files
  cssdest: './css',          // Compiled CSS directory
  /* BUILD */
  build: ['./css/*.css']     // Compiled CSS
}


/** TASKS **/

// Task: Clean - delete the current build and start fresh.
gulp.task('clean',['clean:build']);                                     // CLEAN!
gulp.task('clean:css',   function(){ return del([paths.cssbuild]); });  // Clean only compiled CSS
gulp.task('clean:build', function(){ return del(paths.build); });       // Clean all compiled files

// Task: Compile - compile SCSS
gulp.task('compile',['compile:all']);                                   // COMPILE!
gulp.task('compile:all', ['compile:scss']);              // Compile all compilable files.
gulp.task('compile:scss', ['clean:css'], function () {                  // Compile SCSS into CSS
  return gulp.src(paths.scss)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(paths.cssdest))
});
// Task: Watch - re-run the appropriate task when files change.
gulp.task('watch', function() {
  gulp.watch(paths.scss, ['compile:scss']); 
});

// Task: Default - (1) Initiate Watcher  (2) Compile SCSS  (3) Compile PUG
gulp.task('default', [ 'watch' , 'compile:scss' ] );
