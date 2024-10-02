"use strict";

jQuery(function ($) {
  // アコーディオン
$('.accordion-header').click(function() {
  $(this).next().slideToggle();
  $(this).toggleClass('active');
});

});
