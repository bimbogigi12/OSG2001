( function( api ) {

	// Extends our custom "businessly" section.
	api.sectionConstructor['businessly'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
