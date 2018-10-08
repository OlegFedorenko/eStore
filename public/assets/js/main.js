jQuery(function ($) {

   var $loadingmask = $('#loading-mask');

   $('.js-add-to-cart').click(function (event) {
       var $me = $(this);

       event.preventDefault();
       $loadingmask.show();

       $.get($me.attr('href'), function (data) {
           $('.js-cart-in-header').html(data);
           $loadingmask.hide();
       })
   });

   $('#cart-table').each(function () {
       var $me = $(this);

       $me.find('.js-item-quantity').on('input', function () {
           var $input = $(this),
               data = {};

           data[$input.attr('name')] = $input.val();
           $.post($input.data('update-url'), data)
               .done(updateCart)
               .fail(function () {
                   alert("Cart refresh error");
                   //document.location.reload();
               });
       });

       function updateCart(cartData) {
           updateCartInHeader();
           $me.find('js-order-amount').html(cartData.amount);

           $.each(cartData.items, function (itemId, itemCost) {

               var selector = '[data-item-id=' + itemId + '] .js-item-cost';

               $me.find(selector).html(itemCost);
           });
       }
   });

   function updateCartInHeader() {
       var $cart = $('.js-cart-in-header');

       $cart.load($cart.data('url'));
   }
});