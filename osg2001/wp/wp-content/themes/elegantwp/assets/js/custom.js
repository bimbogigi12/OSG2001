jQuery(document).ready(function($) {

    $(".elegantwp-nav-secondary .elegantwp-secondary-nav-menu").addClass("elegantwp-secondary-responsive-menu").before('<div class="elegantwp-secondary-responsive-menu-icon"></div>');

    $(".elegantwp-secondary-responsive-menu-icon").click(function(){
        $(this).next(".elegantwp-nav-secondary .elegantwp-secondary-nav-menu").slideToggle();
    });

    $(window).resize(function(){
        if(window.innerWidth > 1112) {
            $(".elegantwp-nav-secondary .elegantwp-secondary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
            $(".elegantwp-secondary-responsive-menu > li").removeClass("elegantwp-secondary-menu-open");
        }
    });

    $(".elegantwp-secondary-responsive-menu > li").click(function(event){
        if (event.target !== this)
        return;
        $(this).find(".sub-menu:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-secondary-menu-open");
        });
        $(this).find(".children:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-secondary-menu-open");
        });
    });

    $("div.elegantwp-secondary-responsive-menu > ul > li").click(function(event) {
        if (event.target !== this)
            return;
        $(this).find("ul:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-secondary-menu-open");
        });
    });

    if(elegantwp_ajax_object.sticky_menu){
    // grab the initial top offset of the navigation 
    var elegantwpstickyNavTop = $('.elegantwp-primary-menu-container').offset().top;
    
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var elegantwpstickyNav = function(){
        var elegantwpscrollTop = $(window).scrollTop(); // our current vertical position from the top
             
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (elegantwpscrollTop > elegantwpstickyNavTop) { 
            $('.elegantwp-primary-menu-container').addClass('elegantwp-fixed');
        } else {
            $('.elegantwp-primary-menu-container').removeClass('elegantwp-fixed'); 
        }
    };

    elegantwpstickyNav();
    // and run it again every time you scroll
    $(window).scroll(function() {
        elegantwpstickyNav();
    });
    }

    $(".elegantwp-nav-primary .elegantwp-nav-primary-menu").addClass("elegantwp-primary-responsive-menu").before('<div class="elegantwp-primary-responsive-menu-icon"></div>');

    $(".elegantwp-primary-responsive-menu-icon").click(function(){
        $(this).next(".elegantwp-nav-primary .elegantwp-nav-primary-menu").slideToggle();
    });

    $(window).resize(function(){
        if(window.innerWidth > 1112) {
            $(".elegantwp-nav-primary .elegantwp-nav-primary-menu, nav .sub-menu, nav .children").removeAttr("style");
            $(".elegantwp-primary-responsive-menu > li").removeClass("elegantwp-primary-menu-open");
        }
    });

    $(".elegantwp-primary-responsive-menu > li").click(function(event){
        if (event.target !== this)
        return;
        $(this).find(".sub-menu:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-primary-menu-open");
        });
        $(this).find(".children:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-primary-menu-open");
        });
    });

    $("div.elegantwp-primary-responsive-menu > ul > li").click(function(event) {
        if (event.target !== this)
            return;
        $(this).find("ul:first").slideToggle(function() {
            $(this).parent().toggleClass("elegantwp-primary-menu-open");
        });
    });

    $(".elegantwp-social-search-icon").on('click', function (e) {
        e.preventDefault();
        $('.elegantwp-social-search-box').slideToggle(400);
    });

    $(".post").fitVids();

    $( 'body' ).prepend( '<div class="elegantwp-scroll-top"></div>');
    var scrollButtonEl = $( '.elegantwp-scroll-top' );
    scrollButtonEl.hide();

    $( window ).scroll( function () {
        if ( $( window ).scrollTop() < 20 ) {
            $( '.elegantwp-scroll-top' ).fadeOut();
        } else {
            $( '.elegantwp-scroll-top' ).fadeIn();
        }
    } );

    scrollButtonEl.click( function () {
        $( "html, body" ).animate( { scrollTop: 0 }, 300 );
        return false;
    } );

    if(elegantwp_ajax_object.sticky_sidebar){
    $('.elegantwp-main-wrapper, .elegantwp-sidebar-one-wrapper, .elegantwp-sidebar-two-wrapper').theiaStickySidebar({
        containerSelector: ".elegantwp-content-wrapper",
        additionalMarginTop: 0,
        additionalMarginBottom: 0,
        minWidth: 890,
    });
    }

});