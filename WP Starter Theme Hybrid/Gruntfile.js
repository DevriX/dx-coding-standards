module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					style: 'compressed',
					sourcemap: 'none',
					cacheLocation: 'assets/sass/.cache-location',
				},
				files: [{
					'assets/css/master.css': 'assets/sass/master.scss',
				}],
			},
		},

		autoprefixer:{
			dist: {
				files: {
					'assets/css/master.css': 'assets/css/master.css',
				},
			},
		},

		watch: {
			options: {
				livereload: true,
			},
			scripts: {
				files: ['assets/**/*.js'],
				tasks: ['jshint'],
			},
			css: {
				files: 'assets/**/*.scss',
				tasks: ['sass', 'autoprefixer'],
			},
		},

		jshint: {
			all: ['Gruntfile.js', 'assets/scripts/scripts.js'],
		},
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-autoprefixer');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('css', ['sass', 'autoprefixer']);
};