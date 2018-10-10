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
               data = {},
               value = parseInt($input.val()),
               min = parseInt($input.attr('min')),
               max = parseInt($input.attr('max'));

           if ($input.val() === ''){
               value = min;
           } else {
               if (isNaN(value || value < min)) {
                   value = min;
               } else if (value > max){
                   value = max;
               }
                   $input.val(value);
           }

           data[$input.attr('name')] = value;
           $.post($input.data('update-url'), data)
               .done(updateCart)
               .fail(function () {
                   alert("Cart refresh error");
                   //document.location.reload();
               });
       });

       $me.find('.js-remove-item').on('click', function (event) {
           var $a = $(this);

           event.preventDefault();

           if (confirm('Really?')){
               $a.closest('tr').remove();
               $.post(this.href).done(updateCart);
           }
       });


       function updateCart(cartData) {
           updateCartInHeader();
           $me.find('.js-order-amount').html(cartData.amount);

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