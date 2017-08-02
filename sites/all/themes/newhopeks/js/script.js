/*
=====================================================

Title:      New Hope Church
Authors:    Kyle Beyer
            D. Nathan Dillon, https://natedillon.com
            Kyle Gach, https://kylegach.com
Copyright:  (c) 2014 New Hope Church

=====================================================
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

  $('.hero').removeClass('js-hide').slick({
    autoplay: true,
    autoplaySpeed: 6000,
    arrows: false,
    dots: true,
    dotsClass: 'hero__nav'
  });

}); })(jQuery);
