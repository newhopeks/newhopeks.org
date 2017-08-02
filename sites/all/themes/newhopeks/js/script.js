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

  // Navigation
  // -------------------------

  // Add the navigation toggle button
  $('.header .nav').before('<button type="button" class="nav-toggle"><i class="fa fa-bars"></i> Menu</button>');

  // Prepare the navigation
  $('.header .nav').attr('data-nav-status', 'closed');

  // Toggle the navigation
  $('.header .nav-toggle').on('click', function() {
    if ($('.header .nav').attr('data-nav-status') !== 'open') {
      $('.header .nav-toggle i.fa').removeClass('fa-bars').addClass('fa-times');
      $('.header .nav').slideDown(200, function() {
        $(this).attr('data-nav-status', 'open').removeAttr('style');
      });
    } else {
      $('.header .nav-toggle i.fa').removeClass('fa-times').addClass('fa-bars');
      $('.header .nav').slideUp(200, function() {
        $(this).attr('data-nav-status', 'closed').removeAttr('style');
      });
    }
  });


  // Home page hero slideshow
  // -------------------------

  $('.hero').removeClass('js-hide').slick({
    autoplay: true,
    autoplaySpeed: 6000,
    arrows: false,
    dots: true,
    dotsClass: 'hero__nav'
  });

}); })(jQuery);
