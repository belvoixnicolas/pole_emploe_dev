module.exports = function(grunt) {
    // Configuration de Grunt
    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    style: "expanded",
                },
                files: [
                    {
                        expand: true,
                        cwd: './sass/',
                        src: ['*.scss'],
                        dest: './css/',
                        ext: '.css',
                    },
                ],
            },
        },
        postcss: {
            options: {
              map: true, // inline sourcemaps
              processors: [
                require('pixrem')(), // add fallbacks for rem units
                require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
                require('cssnano')() // minify the result
              ]
            },
            dist: {
              src: 'css/style.css'
            }
        },
    });

    // Import du package
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
  
    // Définition des tâches Grunt
    grunt.registerTask("default", ['sass:dist', 'postcss:dist']);
  };