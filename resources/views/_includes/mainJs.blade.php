<script>
  @auth
    $(document).ready(function() {
      // Cart
      $('.btn-cart').click(function() {
        var action = $(this).data('action');
        var csrf_token = '{{ csrf_token() }}';
        var product_id = $(this).val();

        var totalItem = $('#totalItem');
        var totalPrice = $('#subTotal');
        var totalPriceText = totalPrice.text();
        var totalPriceTextFormatted = totalPriceText.substr(0, totalPriceText.length - 2).replace(/[^a-z0-9\s]/gi, '');
        var multiplePrice = $(this).siblings().find('.multiplePrice');
        var multiplePriceText = multiplePrice.text();
        var multiplePriceTextFormatted = multiplePriceText.substr(0, multiplePriceText.length - 2).replace(/[^a-z0-9\s]/gi, '');
        var subTotal = totalPriceTextFormatted - multiplePriceTextFormatted;

        switch(action) {
          case 'add':
            $.ajax({
              type: 'post',
              url: '{{ route('products.addToCart') }}',
              data: {
                '_token': csrf_token,
                'product_id': product_id,
              },
              success: function(response) {
                $('#navCart').addClass('red-dot');
                iziToast.show({
                  message: response
                });
              }
            });
          break;
          case 'remove':
            $(this).tooltip('hide');
            $(this).parent().remove();
            totalItem.text(totalItem.text() - 1);
            totalPrice.number(subTotal, 2, ',', '.');

            $.ajax({
              type: 'delete',
              url: '{{ route('products.removeFromCart') }}',
              data: {
                '_method': 'DELETE',
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                if (response == 0) {
                  $('#navCart').removeClass('red-dot');
                  $('#cartEmpty').show();
                  $('#cartFilled').hide();
                }

                iziToast.show({
                  message: 'Item has been removed from the cart.',
                  // onOpening: function() {
                  //   location.reload();
                  // }
                });
              }
            });
          break;
        }
      });

      // Wishlist
      $('.btn-wishlist').click(function() {
        var action = $(this).data('action');
        var csrf_token = '{{ csrf_token() }}';
        var product_id = $(this).val();

        switch(action) {
          case 'add':
            $(this).data('action', 'remove');
            // $(this).data('original-title', 'Remove from Wishlist');
            $(this).children().removeClass('mdi-heart-outline').addClass('mdi-heart');
            $.ajax({
              type: 'post',
              url: '{{ route('products.addToWishlist') }}',
              data: {
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                $('#navWishlist').addClass('red-dot');
                iziToast.show({
                  message: response,
                  backgroundColor: '#ff5983',
                  messageColor: '#fff'
                });
              }
            });
          break;
          case 'remove':
            $(this).data('action', 'add');
            // $(this).data('original-title', 'Add to Wishlist');
            $(this).children().removeClass('mdi-heart').addClass('mdi-heart-outline');
            $.ajax({
              type: 'delete',
              url: '{{ route('products.removeFromWishlist') }}',
              data: {
                '_method': 'DELETE',
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                iziToast.show({
                  message: response,
                  backgroundColor: '#ff5983',
                  messageColor: '#fff'
                });
              }
            });
          break;
        }
      });
    });
  @else
    $(document).ready(function () {
      $('.btn-cart, .btn-wishlist').click(function() {
        alert('You must login first.');
      });
    });
  @endauth
</script>
