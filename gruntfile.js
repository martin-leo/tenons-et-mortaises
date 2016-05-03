module.exports = function (grunt) {

  //require
  //Google closure compiler
  require('google-closure-compiler').grunt(grunt);

  // init
  grunt.initConfig({

    // concaténation des fichiers javascript
    concat: {
      dev: {
        src: ['src/site/scripts/*.js'],
        dest: 'site/templates/scripts/s.js',
      },
      prod: {
        src: ['src/site/scripts/*.js'],
        dest: 'src/tmp/s.uncompiled.js', // fichier passé au Google closure compiler
      },
    },

    // conversion SCSS vers CSS
    sass: {
      dev: { // version développement : expanded + map
        options: {
          style: 'expanded',
        },
        files: {
          'site/templates/styles/s.css': 'src/site/styles/styles.scss',
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
          'site/templates/scripts/s.js': 'src/tmp/s.uncompiled.js',
        },
        options: {
          compilation_level: 'ADVANCED',
          language_in: 'ECMASCRIPT5_STRICT',
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

    // surveillance des répertoires
    watch: {
      options: {
        spawn: false,
        livereload: true,
      },
      script: {
        files: ['src/site/**/*'],
        tasks: ['concat:dev', 'sass:dev', 'copy:templates'],
      },
    },

  });

  // loadNpmTasks
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

  // registerTask
  grunt.registerTask('default', ['concat:dev', 'sass:dev', 'copy:templates', 'watch']);
  grunt.registerTask('prod', ['concat:prod', 'sass:prod', 'closure-compiler:prod', 'copy:templates']);
};
