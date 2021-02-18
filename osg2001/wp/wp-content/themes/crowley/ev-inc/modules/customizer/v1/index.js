module.exports = function( grunt ) {

	var path = require( 'path' ),
		glob = require( 'glob' ),
		paths = {
			src: 'modules/customizer/v1/assets/admin/scss',
			dest: 'modules/customizer/v1/assets/admin/css'
		},
		sassOptions = {
			loadPath: [
				path.resolve() + '/modules/customizer/v1/assets/admin/scss/_ref',
				require( 'bourbon' ).includePaths
			],
			sourcemap: 'none',
			quiet: true,
			precision: 8,
			style: 'compressed'
		};

	/* Adding Customizer mixins on the SASS load paths. */
	grunt.ev_inc.config.sass.options.loadPath.push( path.resolve(  './modules/customizer/v1/assets/frontend' ) );

	/**
	 * Set the Customizer task to run after the styles have fully compiled.
	 */
	grunt.ev_inc.utils.add_hook( 'styles', 'customizer' );

	grunt.ev_inc.utils.config( 'watch', 'customizer_components', {
		files: [
			'modules/customizer/v1/assets/admin/js/controls/components/*.js'
		],
		tasks: [
			'concat:customizer_components'
		],
		options: {
			spawn: false
		}
	} );

	grunt.ev_inc.utils.config( 'concat', 'customizer_components', {
		options: {
			separator: ';'
		},
		src: [ 'modules/customizer/v1/assets/admin/js/controls/components/*.js' ],
		dest: 'modules/customizer/v1/assets/admin/js/controls/components/min/components.js'
	} );

	grunt.ev_inc.utils.config( 'sass', 'customizer_style', {
		options: sassOptions,
		files: [ {
			expand: true,
			cwd: paths.src + '/',
			src: [
				'!_ref/*.scss',
				'*.scss'
			],
			dest: paths.dest,
			ext: '.css'
		} ]
	} );

	grunt.ev_inc.utils.config( 'watch', 'customizer_style', {
		files: [
			paths.src + '/*.scss'
		],
		tasks: [
			'sass:customizer_style'
		],
		options: {
			spawn: false
		}
	} );

	/**
	 * Retrieve a list of Google Fonts.
	 */
	grunt.ev_inc.utils.config( 'curl', 'get_google_fonts', {
		src: 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=AIzaSyD6nnCUyF4hroYmodGq7RNeHAJLy5nT5i4',
		dest: '../config/customizer/webfonts.json'
	} );

	/**
	 * Filter the list of Google Fonts according to theme-specific preferences.
	 */
	grunt.registerTask( 'filter-google-fonts', function() {
		var theme_pkg = grunt.file.readJSON( path.resolve( '../package.json' ) );

		if ( typeof theme_pkg.config.modules.customizer.families === 'undefined' ) {
			return;
		}

		var fonts = grunt.file.readJSON( path.resolve( '../config/customizer/webfonts.json' ) );

		var k = fonts.items.length - 1;

		while ( k >= 0 ) {
			var font = fonts.items[ k ];

			if ( theme_pkg.config.modules.customizer.families.indexOf( font.family ) < 0 ) {
				fonts.items.splice( k, 1 );
			}

			k--;
		}

		grunt.file.write( path.resolve( '../config/customizer/webfonts.json' ), JSON.stringify( fonts ) );
	} );

	/**
	 * Update the list of Google Fonts.
	 */
	grunt.registerTask( 'get-google-fonts', [ 'curl:get_google_fonts', 'filter-google-fonts' ] );

	/**
	 * Customizer task that compiles all the stylesheets to differet ruleset files.
	 */
	grunt.registerTask( 'customizer', function() {
		grunt.task.run( [
			'sass:customizer_style'
		] );

		glob.sync( '*.css', { cwd: path.resolve( '../css' ) } ).forEach( function( f ) {
			var filename = f.replace( '.css', '' ),
				file = grunt.file.read( path.resolve( '../css', f ) ),
				patt = /.*\n/g,
				rules = {},
				content = [];

			file.match( patt ).forEach( function( line ) {
				customizer_parser( line, '', rules );
			} );

			content.push( '<?php' );
			content.push( '/**' );
			content.push( ' * Customizer ' + filename + ' ruleset.' );
			content.push( ' *' );
			content.push( ' * @package WordPress' );
			content.push( ' * @since 1.0.0' );
			content.push( ' * @version 1.0.0' );
			content.push( ' */' );
			content.push( '' );
			content.push( "$evolvethemes_ruleset = json_decode( '" + JSON.stringify( rules ) + "', true );" ); // jshint ignore:line
			content.push( 'return $evolvethemes_ruleset;' );
			content.push( '' );

			grunt.file.write( '../config/customizer/ruleset-' + filename + '.php', content.join( '\n' ) ); // TODO: va bene come path?
		} );
	} );

	/**
	 * Parse customizer rules.
	 */
	var customizer_parser = function( match, p1, rules ) {
		var check = ' /*! ~',
		reg = /~(.*?)~/g;

		if ( match.indexOf( check ) !== -1 ) {
			var matches = match.match( reg );

			if ( matches ) {
				var theme_pkg = grunt.file.readJSON( path.resolve( '../package.json' ) );

				var selector = '',
					media_query = '';

				if ( match.indexOf( '@media' ) !== -1 ) {
					selector = match.split( '{' )[1].trim();
					media_query = match.split( '{' )[0].trim();
				}
				else {
					selector = match.split( '{' )[0].trim();
					media_query = '';
				}

				var type = media_query ? media_query : 'desktop';

				for ( var j = 0; j < matches.length; j++ ) {
					matches[j] = matches[j].replace(/~/g, '');

					var match_data = matches[j].split( '|' ),
						group = match_data[0],
						key = match_data[1],
						// params = match_data[2].split( ';' ),
						properties = match_data[3].split( ';' );

					key = group + '_' + key;

					if ( typeof theme_pkg.config.modules.customizer.ruleset === 'undefined' ) {
						if ( theme_pkg.config.modules.customizer.ruleset.indexOf( key ) < 0 ) {
							continue;
						}
					}

					if ( typeof rules[key] === 'undefined' ) {
						rules[key] = {
							'group': group,
							'selectors': {}
						};
					}

					if ( ! rules[ key ].selectors[ selector ] ) {
						rules[ key ].selectors[ selector ] = {};
					}

					rules[ key ].selectors[ selector ]._type = type;

					for ( var i = 0; i < properties.length; i++ ) {
						var property = properties[i].split( ':' ),
							rule = property[0].trim(),
							value = property[1].trim();

						rules[ key ].selectors[ selector ][ rule ] = value;
					}
				}

				return '';
			}
		}

		return '';
	};
};
