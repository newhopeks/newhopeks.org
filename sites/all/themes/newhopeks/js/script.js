/*
====================================================================================================

Title:		New Hope Church
Authors: 	Kyle Beyer
            D. Nathan Dillon, http://natedillon.com
            Kyle Gach, http://kylegach.com
Copyright:	(c) 2014 New Hope Church

====================================================================================================
*/



(function ($) { $(document).ready(function() {

/*
 * Slideshow
 * -------------------------------------------------------------------------------------------------
 */

/*
// turn the slideshow on or off
var showSlideshow = false;

// choose the slideshow script to use ('slides' or 'nivoSlider')
var slideshowScript = 'slides';

if (showSlideshow == true) {

	if (typeof slideshowItems !== 'undefined') {

		// get the images source code
		var items = slideshowItems;

		// clear the div and add the images
		$('.slideshow .slides-container').empty().append(items);

	}

	// start the slideshow
	if (slideshowScript === 'slides') {
		$('.slideshow').slides({
			container: 'slides-container',
			pagination: false,
			generatePagination: false,
			effect: 'fade',
			fadeSpeed: 2000,
			crossfade: true,
			play: 7000
		});
	}
	if (slideshowScript === 'nivoSlider') {
		$('.slideshow').nivoSlider();
	}

}
*/


/*
 * Fix icon fonts for Internet Explorer by forcing IE8 to redraw before and after pseudo elements
 * http://stackoverflow.com/questions/9809351/ie8-css-font-face-fonts-only-working-for-before-content-on-over-and-sometimes
 * -------------------------------------------------------------------------------------------------
 */

if ($.browser.msie && 8 === parseInt($.browser.version)) {
	var head = document.getElementsByTagName('head')[0], style = document.createElement('style');
	style.type = 'text/css';
	style.styleSheet.cssText = ':before,:after{content:none !important';
	head.appendChild(style);
	setTimeout(function(){
		head.removeChild(style);
	}, 0);
}



}); })(jQuery);
