module.exports = function( grunt ) {
	var path = require( 'path' );

	grunt.ev_inc.config.sass.options.loadPath.push( path.resolve(  './modules/images/v1/assets' ) );
};
