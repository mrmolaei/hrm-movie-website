'use strict';

const { src, dest, watch, series, parallel} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const { rollup } = require('rollup');
const babel = require('@rollup/plugin-babel').babel;
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const { nodeResolve } = require('@rollup/plugin-node-resolve');
const commonjs = require('@rollup/plugin-commonjs');
const { terser } = require('rollup-plugin-terser');

const config = {
    srcScss: './assets/src/scss/**/**/*.scss', // Ensure this grabs all main SCSS files
    srcCss: './assets/src/scss/main.scss', // Ensure this grabs all main SCSS files
    srcEditorCss: './assets/src/scss/editor.scss', // Ensure this grabs all main SCSS files
    distSrcCss: './assets/src/css',
    distCss: './assets/css',
    srcJs: './assets/src/js/*.js', // Make sure this grabs all main JS files
    distJs: './assets/js/',
    srcConcatCss: './assets/src/css/**/*.css', // This should point to compiled CSS, not SCSS
    srcConcatJs: './assets/src/js/index.js',
    srcJsWatch: './assets/src/js/**/*.js'
};

function buildStyles() {
    return src(config.srcCss)
        .pipe(sass().on('error', sass.logError))
        .pipe(dest(config.distSrcCss)); // Output compiled CSS here directly
}

function buildEditorStyles() {
    return src(config.srcEditorCss)
        .pipe(sass().on('error', sass.logError))
        .pipe(dest(config.distCss)); // Output compiled CSS here directly
}

function concatCss() {
    return src(config.distSrcCss + '/**/*.css') // Adjusted to use compiled CSS
        .pipe(concat('main.css'))
        .pipe(dest(config.distCss))
        .pipe(browserSync.stream());
}

async function compileJs() {
    const bundle = await rollup({
        input: config.srcConcatJs, // Entry point of your app
        plugins: [
            nodeResolve(), // Resolves node modules
            commonjs(), // Converts CommonJS modules to ES6
            babel({ babelHelpers: 'bundled', presets: ['@babel/preset-env'] }), // Transpile to ES5
            terser() // Minify the bundle
        ]
    });

    return bundle.write({
        file: config.distJs + "main.js",
        format: 'iife', // Immediately-invoked function expression (suitable for browsers)
        sourcemap: true
    });
}

function serve() {
    browserSync.init({
        proxy: "hrm-movie-website.local"
    });

    watch(config.srcScss, series(buildStyles, concatCss)); // Watch for changes in SCSS files
    watch(config.srcJsWatch, series(compileJs));
}

// Export tasks
exports.buildStyles = buildStyles;
exports.concatCss = concatCss;
exports.compileJs = compileJs;
exports.editor = buildEditorStyles;
exports.serve = serve;

// Define default task
exports.default = serve;
