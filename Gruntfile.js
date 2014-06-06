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
    	// https://www.npmjs.org/package/grunt-wp-i18n
	    makepot: {
	        target: {
	            options: {
	                domainPath: '/languages/',    // Where to save the POT file.
	                potFilename: 'platform.pot',   // Name of the POT file.
	                type: 'wp-theme'  // Type of project (wp-plugin or wp-theme).
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
	});

	grunt.registerTask( 'default', [
		'sass',
		'autoprefixer',
    ]);

    grunt.registerTask( 'build', [
    	'sass',
    	'autoprefixer',
		'makepot'
	]);

};