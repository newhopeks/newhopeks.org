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

  // Store the navigation as a variable
  var $nav = $('.header .nav');

  // Add the navigation toggle button
  $nav.before('<button type="button" class="nav-toggle"><i class="fa fa-bars"></i> Menu</button>');

  // Store navigation toggle button as a variable
  var $navToggle = $('.header .nav-toggle');

  // Prepare the navigation
  $nav.attr('data-nav-status', 'closed');
  $navToggle.attr('data-nav-toggle-status', 'closed');

  // Toggle the navigation
  $navToggle.on('click', function() {
    if ($nav.attr('data-nav-status') !== 'open') {
      $navToggle.attr('data-nav-toggle-status', 'open').find('i.fa').removeClass('fa-bars').addClass('fa-times');
      $nav.slideDown(200, function() {
        $nav.attr('data-nav-status', 'open').removeAttr('style');
      });
    } else {
      $nav.slideUp(200, function() {
        $nav.attr('data-nav-status', 'closed').removeAttr('style');
        $navToggle.attr('data-nav-toggle-status', 'closed').find('i.fa').removeClass('fa-times').addClass('fa-bars');
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
