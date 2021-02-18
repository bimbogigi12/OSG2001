/*
    Version 1.3.2
    The MIT License (MIT)

    Copyright (c) 2014 Dirk Groenen

    Permission is hereby granted, free of charge, to any person obtaining a copy of
    this software and associated documentation files (the "Software"), to deal in
    the Software without restriction, including without limitation the rights to
    use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
    the Software, and to permit persons to whom the Software is furnished to do so,
    subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
*/

(function(jQuery){
    jQuery.fn.viewportChecker = function(useroptions){
        // Define options and extend with user
        var options = {
            classToAdd: 'visible',
            offset: 100,
            callbackFunction: function(elem){}
        };
        jQuery.extend(options, useroptions);

        // Cache the given element and height of the browser
        var jQueryelem = this,
            windowHeight = jQuery(window).height();

        this.checkElements = function(){
            // Set some vars to check with
            var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
                viewportTop = jQuery(scrollElem).scrollTop(),
                viewportBottom = (viewportTop + windowHeight);

            jQueryelem.each(function(){
                var jQueryobj = jQuery(this);
                // If class already exists; quit
                if (jQueryobj.hasClass(options.classToAdd)){
                    return;
                }

                // define the top position of the element and include the offset which makes is appear earlier or later
                var elemTop = Math.round( jQueryobj.offset().top ) + options.offset,
                    elemBottom = elemTop + (jQueryobj.height());

                // Add class if in viewport
                if ((elemTop < viewportBottom) && (elemBottom > viewportTop)){
                    jQueryobj.addClass(options.classToAdd);

                    // Do the callback function. Callback wil send the jQuery object as parameter
                    options.callbackFunction(jQueryobj);
                }
            });
        };

        // Run checkelements on load and scroll
        jQuery(window).scroll(this.checkElements);
        this.checkElements();

        // On resize change the height var
        jQuery(window).resize(function(e){
            windowHeight = e.currentTarget.innerHeight;
        });
    };
})(jQuery);
