module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        // Task configuration.
        jshint: {
            options: {
                curly: true,
                eqeqeq: true,
                immed: true,
                newcap: true,
                noarg: true,
                sub: true,
                undef: true,
                unused: true,
                boss: true,
                eqnull: true,
                browser: true,
                freeze: true,
                globals: {
                    "$": false,
                    "console": false
                }
            },
            gruntfile: {
                src: 'Gruntfile.js'
            },
            lib_test: {
                src: ['public/js/site.js', 'public/js/speech.js', 'public/js/profile.js']
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['public/js/*.js'],
                dest: 'public/dist/<%= pkg.name %>.min.js'
            }
        },
        watch: {
            gruntfile: {
                files: '<%= jshint.gruntfile.src %>',
                tasks: ['jshint:gruntfile']
            },
            lib_test: {
                files: '<%= jshint.lib_test.src %>',
                tasks: ['jshint:lib_test']
            }
        },
        csslint: {
            strict: {
                options: {
                    import: 2
                },
                src: ['public/css/style.css']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-concat');


    // Default task.
    grunt.registerTask('default', ['jshint', 'csslint', 'concat']);
};
