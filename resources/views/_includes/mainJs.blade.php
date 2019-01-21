<script>
  @auth
    $(document).ready(function() {
      // Cart
      $('.btn-cart').click(function() {
        var csrf_token = '{{ csrf_token() }}';
        var product_id = $(this).val();

        // $(this).removeClass('bg-transparent').addClass('disabled');
        $.ajax({
          type: 'post',
          url: '{{ route('products.addToCart') }}',
          data: {
            '_token': csrf_token,
            'product_id': product_id
          },
          success: function(response) {
            $('#navCart').addClass('red-dot');
            alert(response);
            // console.log(response);
          }
        });
      });

      // Wishlist
      $('.btn-wishlist').click(function() {
        var action = $(this).data('action');
        var csrf_token = '{{ csrf_token() }}';
        var product_id = $(this).val();

        switch(action) {
          case 'add':
            $(this).data('action', 'remove');
            $(this).data('original-title', 'Add to Wishlist');
            $(this).children().removeClass('mdi-heart-outline').addClass('mdi-heart');
            $('#navWishlist').addClass('red-dot');
            $.ajax({
              type: 'post',
              url: '{{ route('products.addToWishlist') }}',
              data: {
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                alert(response);
                // console.log(response);
              }
            });
          break;
          case 'remove':
            $(this).data('action', 'add');
            $(this).data('original-title', 'Remove Wishlist');
            $(this).children().removeClass('mdi-heart').addClass('mdi-heart-outline');
            $.ajax({
              type: 'delete',
              url: '/removeWishlist/' + product_id,
              data: {
                '_method': 'DELETE',
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                alert(response);
                // console.log(response);
              }
            });
          break;
        }
      });
    });
  @else
    $(document).ready(function () {
      $('.btn-cart').click(function() {
        alert('You must login first.');
      });

      $('.btn-wishlist').click(function() {
        alert('You must login first.');
      });
    });
  @endauth
</script>
