module.exports = function( grunt ) {
	var theme_folder = grunt.ev_inc.theme_config.theme.THEME_FOLDER;

	var glob = require( 'glob' ),
		path = require( 'path' ),
		paths = {
			module: 'modules/icons/v1',
			src: '../icon-font',
			dest: '../fonts'
		},
		options = [],
		suboptions = [];

	glob.sync( '*', { cwd: paths.src } ).forEach( function( option ) {

		grunt.ev_inc.utils.config( 'webfont', option, {
			src: paths.src + '/' + option + '/*.svg',
			dest: paths.dest + '/' + option,
			destCss: paths.dest + '/' + option,
			options: {
				styles: 'font',
				stylesheets: ['css'],
				optimize: false,
				types: [ 'woff', 'woff2' ],
				htmlDemo: false,
				font: theme_folder + '_' + option,
				template: paths.module + '/templates/template.css',
				templateOptions: {
					classPrefix: 'icon_' + option + '_'
				},
				customOutputs: [{
					template: paths.module + '/templates/template_var.scss',
					dest: paths.dest + '/' + option + '.scss'
				}]
			}
		} );

	} );

	grunt.ev_inc.utils.config( 'watch', 'icon-font', {
		files: [
			paths.src + '/**/*.svg'
		],
		tasks: [
			'webfont'
		],
		options: {
			spawn: false
		}
	} );

	grunt.ev_inc.utils.config( 'clean', 'webfont', {
		options: {
			force: true
		},
		src: [ paths.dest ]
	} );

	grunt.loadNpmTasks( 'grunt-webfont' );

	/**
	 * Create the icon font starting from the 'icon-font' theme folder.
	 */
	grunt.registerTask( 'icon-font', [ 'clean:webfont', 'webfont', 'watch:icon-font' ] );

};
