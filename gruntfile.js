module.exports = function (grunt) {

  //require
  //Google closure compiler
  require('google-closure-compiler').grunt(grunt);

  // init
  grunt.initConfig({

    // concaténation des fichiers javascript
    concat: {
      dev: {
        src: [
          'additional_assets/js/*',
          'src/site/scripts/globales.js',
          'src/site/scripts/abstracts/*.js',
          'src/site/scripts/classes/*.js',
          'src/site/scripts/components/*.js',
          'src/site/scripts/main.js',
        ],
        dest: 'site/templates/scripts/s.js',
      },
      prod_pre_compilation: {
        /* on concatène les fichiers qui ne sont pas d3 etc.
        pour compilation avec closure-compiler
        */
        src: [
          'src/site/scripts/globales.js',
          'src/site/scripts/abstracts/*.js',
          'src/site/scripts/classes/*.js',
          'src/site/scripts/components/*.js',
          'src/site/scripts/main.js',
        ],
        dest: 'src/tmp/s.uncompiled.js', // fichier a passer au Google Closure Compiler
      },
      prod_post_compilation: {
        /* on concatène les fichiers compilés et les libs externes minifiées
        */
        src: [
          'additional_assets/js/*',
          'src/tmp/s.compiled.js',
        ],
        dest: '/site/templates/scripts/s.js', // fichier définitif
      },
    },

    // conversion SCSS vers CSS
    sass: {
      dev: { // version développement : expanded + map
        options: {
          style: 'expanded',
        },
        files: {
          'site/templates/styles/s.css': 'src/site/styles/main.scss',
        },
      },
      prod: { // version prod : compressée et sans map
        options: {
          style: 'compressed',
          sourcemap: 'none',
        },
        files: {
          'site/templates/styles/s.css': 'src/site/styles/styles.scss',
        },
      },
    },

    // closure compiler
    'closure-compiler': {
      prod: {
        files: {
          'site/tmp/s.compiled.js': 'src/tmp/s.uncompiled.js',
        },
        options: {
          compilation_level: 'SIMPLE',
          language_in: 'ECMASCRIPT5_STRICT',
          debug: true,
        },
      },
    },

    // copie des fichiers vers ProcessWire
    copy: {
      templates: { // copie des templates
        files: [
          {expand: true, cwd: 'src', src: ['site/templates/**'], dest: ''},
        ],
      },
    },

    // suppression des commentaires
    // Supprime tous les commentaires // et /* */ même hors balises php/js
    comments: {
      traitement: {
        options: {
            singleline: true,
            multiline: true
        },
        src: [ 'site/templates/**/*.php']
      },
    },

    // surveillance des répertoires
    watch: {
      options: {
        spawn: false,
        livereload: true,
      },
      script: {
        files: ['src/site/**/*'],
        tasks: ['concat:dev', 'sass:dev', 'copy:templates', 'comments'],
      },
    },

  });

  // loadNpmTasks
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-stripcomments');

  // registerTask
  grunt.registerTask('default', ['concat:dev', 'sass:dev','copy:templates',  'comments', 'watch']);
  grunt.registerTask('prod', ['concat:prod_pre_compilation', 'sass:prod', 'closure-compiler:prod', 'concat:prod_pre_compilation', 'copy:templates', 'comments']);
};
