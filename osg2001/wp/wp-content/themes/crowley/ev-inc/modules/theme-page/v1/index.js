module.exports = function( grunt ) {

	var paths = {
			src: 'modules/theme-page/v1/scss',
			dest: 'modules/theme-page/v1/css'
		},
		sassOptions = {
			loadPath: [
				require( 'bourbon' ).includePaths
			],
			sourcemap: 'none',
			quiet: true,
			precision: 8,
			style: 'compressed'
		};

	grunt.ev_inc.utils.config( 'sass', 'theme-page', {
		options: sassOptions,
		files: [ {
			expand: true,
			cwd: paths.src + '/',
			src: [
				'*.scss'
			],
			dest: paths.dest,
			ext: '.css'
		} ]
	} );

	grunt.ev_inc.utils.config( 'watch', 'theme-page', {
		files: [
			paths.src + '/*.scss'
		],
		tasks: [
			'sass:theme-page'
		],
		options: {
			spawn: false
		}
	} );

	/**
	 * Compile all the stylesheets from the ../scss folder.
	 */
	grunt.registerTask( 'theme-page', [ 'sass:theme-page' ] );

};
