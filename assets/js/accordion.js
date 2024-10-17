"use strict";

jQuery(function ($) {
  // アコーディオン
jQuery('.accordion__header').click(function() {
  jQuery(this).next().slideToggle();
  jQuery(this).toggleClass('active');
});

});
