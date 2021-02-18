module.exports = function( grunt ) {
	var path = require( 'path' );

	grunt.ev_inc.config.sass.options.loadPath.push( path.resolve(  './modules/scss/v1' ) );
};
