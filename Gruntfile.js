'use strict';
module.exports = function(grunt) {

	// load all tasks
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
    	// https://www.npmjs.org/package/grunt-wp-i18n
	    makepot: {
	        target: {
	            options: {
	                domainPath: '/languages/',    // Where to save the POT file.
	                potFilename: 'package.pot',   // Name of the POT file.
	                type: 'wp-theme'  // Type of project (wp-plugin or wp-theme).
	            }
	        }
	    },
	});

    grunt.registerTask( 'build', [
		'makepot'
	]);

};