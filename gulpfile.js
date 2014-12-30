/* Gulpfile */

// Relative path to assets from root dir.
var asset_path = 'public_html/assets';

// Create handles to npm installed libraries.
var gulp   = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var es     = require('event-stream');

// Concat and minify scripts.
gulp.task('scripts', function () {

	// get js from coffee converter
	var jsFromCoffeeTask = gulp.src('public_html/assets/scripts/*.coffee')
							   .pipe(coffee());

	// get js from src dir
	var jsFromSrc = gulp.src('public_html/assets/scripts/*.js');

	// merge the two gulp outputs together, concat and minify
	return es.merge(jsFromCoffeeTask, jsFromSrc) 
		.pipe(concat('scripts.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('public_html/assets/js'));
});

// Define the watcher
gulp.task('watch'), function () {
	// Gulp will watch for new files or changes to files matching the string.
	gulp.watch('src/*.{js,coffee}',['scripts']);
});
});