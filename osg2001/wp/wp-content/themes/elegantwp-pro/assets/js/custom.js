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

    if(elegantwp_ajax_object.news_ticker){

    $('.elegantwp-marquee').marquee({
        /*
        allowCss3Support: true,
        css3easing: 'linear',
        easing: 'linear',
        delayBeforeStart: 1000,
        direction: 'left',
        duplicated: false,
        duration: 5000,
        gap: 20,
        pauseOnCycle: false,
        pauseOnHover: false,
        startVisible: false
        */
        delayBeforeStart: 0, //time in milliseconds before the marquee will start animating
        direction: 'left', //'left' or 'right'
        duplicated: true, //true or false - should the marquee be duplicated to show an effect of continues flow
        duration: 60000, //duration in milliseconds of the marquee
        gap: 0, //gap in pixels between the tickers
        pauseOnHover: true,
        startVisible: true
    });

    }

    if ( $().owlCarousel ) {
        var elegantwpcarouselwrapper = $('.elegantwp-posts-carousel');
        var imgLoad = imagesLoaded(elegantwpcarouselwrapper);
        imgLoad.on( 'always', function() {
            elegantwpcarouselwrapper.each(function(){
                    var $this = $(this);
                    $this.find('.owl-carousel').owlCarousel({
                        autoplay: true,
                        loop: true,
                        margin: 0,
                        smartSpeed: 250,
                        dots: false,
                        nav: true,
                        autoplayTimeout: 4000,
                        autoHeight: true,
                        navText: [ '<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>' ],
                        responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        991:{
                            items: 2
                        }
                    }
                });
            });
        });
    } // end if

    if(elegantwp_ajax_object.sticky_sidebar){
    $('.elegantwp-main-wrapper, .elegantwp-sidebar-one-wrapper, .elegantwp-sidebar-two-wrapper').theiaStickySidebar({
        containerSelector: ".elegantwp-content-wrapper",
        additionalMarginTop: 0,
        additionalMarginBottom: 0,
        minWidth: 890,
    });
    }

    $(".elegantwp-tabbed-wrapper").each(function(){
    var $thistab = $(this);

    $thistab.find(".elegantwp-tabbed-content").hide();
    $thistab.find("ul.elegantwp-tabbed-names li:first a").addClass("elegantwp-tabbed-current").show();
    $thistab.find(".elegantwp-tabbed-content:first").show();

    $thistab.find("ul.elegantwp-tabbed-names li a").click(function() {
        $thistab.find("ul.elegantwp-tabbed-names li a").removeClass("elegantwp-tabbed-current a"); 
        $(this).addClass("elegantwp-tabbed-current"); 
        $thistab.find(".elegantwp-tabbed-content").hide(); 
        var elegantwpactivetab = $(this).attr("href"); 
        $thistab.find(elegantwpactivetab).fadeIn();
        return false;
    });

    });

});