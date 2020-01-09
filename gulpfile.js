let gulp = require('gulp'),
    del = require('del'),
    rename = require("gulp-rename"),
    phplint = require("phplint").lint;

const OUTPUT_PATH = '../pr';
const CLEAN_PATH = ['../pr/**/*\', \'!../pr/.git'];

const FOLDERS = ['app', 'bootstrap', 'config', 'database', 'routes', 'resources/lang', 'resources/views', 'vendor'];

const PATHS = [
    {
        src: ['public/**/*', 'public/**/.*', '!public/index.php', '!public/index.apache.php'],
        dest: ''
    },
    {
        src: ['storage/**/.gitignore'],
        dest: '/storage'
    },
    {
        src: ['.env.example', 'artisan', 'server.php', 'composer.json', 'composer.lock'],
        dest: ''
    }
];

const RENAME_PATHS = [
    {
        src: 'public/index.apache.php',
        new_name: 'index.php',
        dest: ''
    }
];

// DELETE BUILD FOLDER
gulp.task('clean', function () {
    return del(CLEAN_PATH, {force: true});
});

// COPY SOURCE CODE TO THE DISTRIBUTION FOLDER
gulp.task('build:source', function () {
    let copies = [];

    for (let i = 0; i < FOLDERS.length; i++) {
        let sources = [FOLDERS[i] + '/**/*', FOLDERS[i] + '/**/.*'];
        let dest = OUTPUT_PATH + '/' + FOLDERS[i];
        copies.push(gulp.src(sources)
            .pipe(gulp.dest(dest)));
    }

    for (let i = 0; i < PATHS.length; i++) {
        copies.push(gulp.src(PATHS[i].src)
            .pipe(gulp.dest(OUTPUT_PATH + PATHS[i].dest)));
    }

    for (let i = 0; i < RENAME_PATHS.length; i++) {
        copies.push(gulp.src(RENAME_PATHS[i].src)
            .pipe(rename(RENAME_PATHS[i].new_name))
            .pipe(gulp.dest(OUTPUT_PATH + RENAME_PATHS[i].dest)));
    }

    return Promise.all(copies);
});

gulp.task('default', gulp.series('clean', 'build:source', function (done) {
    done();
}));
