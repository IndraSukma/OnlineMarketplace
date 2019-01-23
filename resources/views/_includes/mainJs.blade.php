<script>
  @auth
    $(document).ready(function() {
      // Cart
      $('.btn-cart').click(function() {
        var action = $(this).data('action');
        var csrf_token = '{{ csrf_token() }}';
        var product_id = $(this).val();

        var totalItem = $('#totalItem').text();
        var subTotal = $('#subTotal').text();
        var product_price = $(this).data('price');

        switch(action) {
          case 'add':
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
          break;
          case 'remove':
            $(this).parent().removeClass('d-flex').addClass('d-none');
            $.ajax({
              type: 'delete',
              url: '{{ route('products.removeFromCart') }}',
              data: {
                '_method': 'DELETE',
                '_token': csrf_token,
                'product_id': product_id
              },
              success: function(response) {
                $('#totalItem').text(totalItem - 1);
                $('#subTotal').text(subTotal - product_price);
                alert(response);
                // console.log(response);
                // location.reload();
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
                alert(response);
                // console.log(response);
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
      $('.btn-cart, .btn-wishlist').click(function() {
        alert('You must login first.');
      });
    });
  @endauth
</script>
