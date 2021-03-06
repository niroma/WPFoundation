'use strict';

import plugins       from 'gulp-load-plugins';
import yargs         from 'yargs';
import gulp          from 'gulp';
import rimraf        from 'rimraf';
import yaml          from 'js-yaml';
import fs            from 'fs';
import webpackStream from 'webpack-stream';
import webpack2      from 'webpack';
import named         from 'vinyl-named';
import autoprefixer  from 'autoprefixer';

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const { COMPATIBILITY, PORT, UNCSS_OPTIONS, PATHS } = loadConfig();

function loadConfig() {
  let ymlFile = fs.readFileSync('config.yml', 'utf8');
  return yaml.load(ymlFile);
}

// Build the "dist" folder by running all of the below tasks
// Sass must be run later so UnCSS can search for used classes in the others assets.
gulp.task('build',
 gulp.series(clean, gulp.parallel(pages, javascript, images, copy, fonts), sass));

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', /*server, */watch));

// Delete the "dist" folder
// This happens every time a build starts
function clean(done) {
  rimraf(PATHS.dist, done);
}

// Copy files out of the assets folder
// This task skips over the "img", "js", and "scss" folders, which are parsed separately
function copy() {
  return gulp.src(PATHS.assets)
    .pipe(gulp.dest(PATHS.dist + '/assets'));
}

// Copy page templates into finished HTML files
function pages() {
  return gulp.src('src/pages/**/*')
    /*.pipe(panini({
      root: 'src/pages/',
      layouts: 'src/layouts/',
      partials: 'src/partials/',
      data: 'src/data/',
      helpers: 'src/helpers/'
    }))*/
    .pipe(gulp.dest(PATHS.dist));
}

// Copy translation files into
function languages() {
  return gulp.src('src/languages/*')
    .pipe(gulp.dest(PATHS.dist + '/languages'));
}

// Copy fonts
function fonts() {
  return gulp.src(PATHS.fonts)
    .pipe(gulp.dest(PATHS.dist + '/assets/fonts'));
}

// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {

  const postCssPlugins = [
    // Autoprefixer
    autoprefixer({ browsers: COMPATIBILITY }),

    // UnCSS - Uncomment to remove unused styles in production
    // PRODUCTION && uncss.postcssPlugin(UNCSS_OPTIONS),
  ].filter(Boolean);

  return gulp.src('src/assets/scss/style.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    })
      .on('error', $.sass.logError))
    .pipe($.postcss(postCssPlugins))
    .pipe($.if(PRODUCTION, $.cleanCss({ compatibility: 'ie9' })))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist));
    /*.pipe(browser.reload({ stream: true }));*/
}

let webpackConfig = {
  mode: (PRODUCTION ? 'production' : 'development'),
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [ "@babel/preset-env" ],
            compact: false
          }
        }
      }
    ]
  },
  devtool: !PRODUCTION && 'source-map'
}

// Combine JavaScript into one file
// In production, the file is minified
function javascript() {
  return gulp.src(PATHS.entries)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe(webpackStream(webpackConfig, webpack2))
    .pipe($.if(PRODUCTION, $.uglify()
      .on('error', e => { console.log(e); })
    ))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/assets/js'));
}

// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
  return gulp.src('src/assets/img/**/*')
    .pipe($.if(PRODUCTION, $.imagemin([
      $.imagemin.jpegtran({ progressive: true }),
    ])))
    .pipe(gulp.dest(PATHS.dist + '/assets/img'));
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
  gulp.watch(PATHS.assets, copy);
  gulp.watch('src/pages/**/*').on('all', pages);
  gulp.watch('src/languages/*').on('all', languages);
  gulp.watch('src/assets/scss/**/*.scss').on('all', sass);
  gulp.watch('node_modules/@fortawesome/fontawesome-free/webfonts').on('all', gulp.series(fonts, sass));
  gulp.watch('src/assets/js/**/*.js').on('all', javascript);
  gulp.watch('src/assets/img/**/*').on('all', images);
}
