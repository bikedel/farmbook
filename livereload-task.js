var gulp = require('gulp');
var elixir = require('laravel-elixir');
var config = elixir.config;
var livereload = require('gulp-livereload');

elixir.extend('livereload', function(src, output) {
    gulp.task('livereload', function() {
        livereload.listen();
        gulp.on('stop', function() {
            livereload.changed('localhost');
        });
    });
    this.registerWatcher('livereload');
    return this.queueTask('livereload');
});