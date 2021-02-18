(function ($) {
	"use strict";

	var $window = $(window),
	        $body = $('body');

	/*=============================
	        Menu - Toggle button
	==============================*/
	$(".toggle-btn").on("click", function () {
	    $(this).toggleClass("active");
	    $(".main-menu").toggleClass("active");
	});

	/*=============================
	        Sticky header
	==============================*/
	$window.on('scroll', function() {
    	if ($(".navbar").offset().top > 10) {
    	    $(".navbar-fixed-top").addClass("top-nav-collapse");
    	} else {
    	    $(".navbar-fixed-top").removeClass("top-nav-collapse");
    	}
	});


	/*=============================
	        Blog Masonry
	==============================*/
	var $blocks = $(".blog-masonry"); //Masonry blocks
	
	$blocks.masonry({
		itemSelector: '.masonry-entry'
	});

	// layout Masonry after each image loads
	$blocks.imagesLoaded().progress( function() {
	  $blocks.masonry('layout');
	});
	
	$(document).ready( function() { 
		setTimeout( function() { 
			$blocks.masonry('layout');
		}, 1000); 
	});

	$(window).resize(function () {
		setTimeout( function() { 
			$blocks.masonry('layout');
		}, 1000);
	});


	/*=========================================================
	        Update Masonry after Jetpack Infinite Scroll
	=========================================================*/
	$(document).ready( function() { 
		// change infinite-handle location
	    $("#infinite-handle").prependTo("#infinite-handle-container");
	    var infinite_count = 1;

	     // Triggers re-layout on infinite scroll
	    $( document.body ).on( 'post-load', function () {

			infinite_count = infinite_count + 1;
			var $container = $('#blog-masonry');
			var $selector = $('#infinite-view-' + infinite_count);
			var $elements = $selector.find('.hentry');
			$elements.hide();

			// append items to grid
			$container.append($elements).masonry( 'appended', $elements );

			// re-arrange the grid
			setTimeout( function() { 
				$container.imagesLoaded().progress( function() {
				  $container.masonry('layout');
				});
				// change infinite-handle location
			    $("#infinite-handle").prependTo("#infinite-handle-container");
			}, 500);

			// Worst case scenario - re-arrange the grid again
			setTimeout( function() { 
				$container.masonry('layout');
			}, 1000);

			$elements.fadeIn();
	    });
	});


	/*=============================
	        Flexslider
	==============================*/
    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: false,
        prevText: " ",
        nextText: " ",
        smoothHeight: false,
        pauseOnHover: true,
        slideshowSpeed: 3000,
        pauseOnAction: false,
        after: function(){
        	$blocks.masonry();
        }
    });


    /*=============================
       resize videos after container
    ==============================*/
	var vidSelector = ".post iframe, .post object, .post video, .widget-content iframe, .widget-content object, .widget-content iframe";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).resize(function() {
		resizeVideo(vidSelector);
	});

})(jQuery);

jQuery( document ).ready( function( $ ) {
	// change infinite-handle location
    $("#infinite-handle").prependTo("#infinite-handle-container");
    var infinite_count = 1;

     // Triggers re-layout on infinite scroll
    $( document.body ).on( 'post-load', function () {

		infinite_count = infinite_count + 1;
		var $container = $('#blog-masonry');
		var $selector = $('#infinite-view-' + infinite_count);
		var $elements = $selector.find('.hentry');
		$elements.hide();

		// append items to grid
		$container.append($elements).masonry( 'appended', $elements );

		// re-arrange the grid
		setTimeout( function() { 
			$container.imagesLoaded().progress( function() {
			  $container.masonry('layout');
			});
			// change infinite-handle location
		    $("#infinite-handle").prependTo("#infinite-handle-container");
		}, 500);

		$elements.fadeIn();
    });
});
