(function($) {
$.fn.reverseOrder = function() {
	return this.each(function() {
		$(this).prependTo( $(this).parent() );
	});
};
})(jQuery);