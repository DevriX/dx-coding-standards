module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					style: 'compact',
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
			scripts: {
				files: ['assets/**/*.js'],
				tasks: ['jshint'],
			},
			css: {
				files: 'assets/**/*.scss',
				tasks: ['sass', 'autoprefixer', 'cssmin'],
			},
		},

		cssmin: {
			options: {
				shorthandCompacting: false,
				roundingPrecision: -1
			},
			target: {
				files: {
					'assets/css/master.min.css': ['assets/css/master.css']
				}
			}
		},

		jshint: {
			all: ['Gruntfile.js', 'assets/scripts/scripts.js'],
		},
	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-autoprefixer');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('css', ['sass', 'autoprefixer']);
	grunt.registerTask('minify', ['cssmin']);
};