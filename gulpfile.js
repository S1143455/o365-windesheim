var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');


//Change this to your local development hostname.
const hostname = 'wwi.local';

/**
 * DO NOT TOUCH PLEASE, OR MAYBE. JUST READ THE DOCUMENTATION ONLINE
 * https://gulpjs.com/
 */
// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("theme/scss/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("theme/css"))
        .pipe(browserSync.stream());
});

// Static Server + watching scss/html files
gulp.task('serve', gulp.series('sass', function() {

    browserSync.init({
        proxy: hostname
    });

    gulp.watch("theme/scss/*.scss", gulp.task('sass'));
    gulp.watch("content/*Product.php").on('change', browserSync.reload);
}));

