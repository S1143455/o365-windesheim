var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("theme/scss/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("theme/css"))
        .pipe(browserSync.stream());
});

// Static Server + watching scss/html files
gulp.task('serve', gulp.parallel('sass', function() {

    browserSync.init({
        proxy: "wwi.local:8070"
    });

    gulp.watch("theme/scss/*.scss", ['sass']);
    gulp.watch("app/*.php").on('change', browserSync.reload);
}));

// Compile SCSS(SASS) files
// gulp.task('scss', gulp.series('bootstrap:scss', function compileScss() {
//     return gulp.src(['./assets/scss/*.scss'])
//         .pipe(sass.sync({
//             outputStyle: 'expanded'
//         }).on('error', sass.logError))
//         .pipe(autoprefixer())
//         .pipe(gulp.dest('./assets/css'))
// }));



gulp.task('default', ['serve']);