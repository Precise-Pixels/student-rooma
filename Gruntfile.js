module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        autoprefixer: {
            no_dest: {
                flatten: true,
                src: 'css/*.css'
            }
        },
        cssmin: {
            options: {
                banner: '/*!\r\n  * Precise Pixels | http://precisepixels.co.uk\r\n  * https://github.com/Precise-Pixels/student-rooma\r\n  */'
            },
            minify1: {
                src: 'css/styles.css',
                dest: 'build/styles.min.css'
            },
            minify2: {
                src: 'css/styles-landing.css',
                dest: 'build/styles-landing.min.css'
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/styles.css': 'sass/styles.scss',
                    'css/styles-landing.css': 'sass/styles-landing.scss'
                }
            },
            dev: {
                options: {
                    style: 'expanded'
                },
                files: [{
                    expand: true,
                    cwd: 'sass/',
                    src: ['*.scss', '!_*.scss'],
                    dest: 'css/',
                    ext: '.css'
                }]
            }
        },
        uglify: {
            build: {
                options: {
                    preserveComments: 'some'
                },
                files: [{
                    expand: true,
                    cwd: 'js',
                    src: '*.js',
                    dest: 'build',
                    ext: '.min.js'
                }]
            }
        },
        watch: {
            scripts: {
                options: {
                    spawn: false
                },
                files: [
                    'sass/**/*'
                ],
                tasks: ['sass:dev', 'autoprefixer']
            }
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Register tasks
    grunt.registerTask('default', 'List grunt tasks', function() {
        grunt.log.writeln('\n  grunt s     : watches for Sass changes and adds vendor prefixes\
                           \n  grunt build : minifies the JS and CSS');
    });

    grunt.registerTask('s', ['sass:dev', 'watch']);
    grunt.registerTask('build', ['cssmin:minify1', 'cssmin:minify2', 'uglify']);
};