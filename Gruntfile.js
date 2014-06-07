'use strict';
module.exports = function(grunt) {

	// load all tasks
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			files: ['scss/*.scss'],
			tasks: 'sass',
			options: {
				livereload: true,
			},
		},
		sass: {
			default: {
		  		options : {
			  		style : 'expanded'
			  	},
			  	files: {
					'style.css':'scss/style.scss',
				}
			}
		},
	    autoprefixer: {
            options: {
				browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie 9']
			},
			single_file: {
				src: 'style.css',
				dest: 'style.css'
			}
		},
		csscomb: {
			options: {
                config: '.csscomb.json'
            },
            files: {
                'style.css': ['style.css'],
            }
		},
		concat: {
		    build: {
		        src: [
		            'js/skip-link-focus-fix.js',
		            'js/navigation.js',
		            'js/jquery.fitvids.js',
		            'js/global.js'
		        ],
		        dest: 'js/platform.min.js',
		    }
		},
		uglify: {
		    build: {
		        src: 'js/platform.min.js',
		        dest: 'js/platform.min.js'
		    }
		},
	    makepot: {
	        target: {
	            options: {
	                domainPath: '/languages/',    // Where to save the POT file.
	                potFilename: 'platform.pot',   // Name of the POT file.
	                type: 'wp-theme',  // Type of project (wp-plugin or wp-theme).
	                updateTimestamp: false
	            }
	        }
	    },
	    replace: {
			styleVersion: {
				src: [
					'scss/style.scss',
				],
				overwrite: true,
				replacements: [{
					from: /Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				}]
			},
			functionsVersion: {
				src: [
					'functions.php'
				],
				overwrite: true,
				replacements: [ {
					from: /^define\( 'PLATFORM_VERSION'.*$/m,
					to: 'define( \'PLATFORM_VERSION\', \'<%= pkg.version %>\' );'
				} ]
			},
		}
	});

	grunt.registerTask( 'default', [
		'sass',
		'autoprefixer',
		'csscomb',
    ]);

    grunt.registerTask( 'build', [
    	'replace',
    	'sass',
    	'autoprefixer',
    	'csscomb',
    	'concat:build',
		'uglify:build',
		'makepot'
	]);

};