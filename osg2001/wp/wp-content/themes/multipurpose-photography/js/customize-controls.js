( function( api ) {

	// Extends our custom "multipurpose-photography" section.
	api.sectionConstructor['multipurpose-photography'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );