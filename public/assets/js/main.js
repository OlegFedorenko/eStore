jQuery(function ($) {

   var $loadingmask = $('#loading-mask');

   $('.js-add-to-cart').click(function (event) {
       var $me = $(this);

       event.preventDefault();
       $loadingmask.show();

       $.get($me.attr('href'), function (data) {
           $('js-cart-in-header').html(data);
           $loadingmask.hide();
       })
   })
});