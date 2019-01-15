<script type="text/javascript">
  $(document).ready(function () {
    // Add to Cart Function
    @foreach(App\Product::all() as $p)
    $('#{{$p->id}}').click(function() {
      var id = this.id;

      $.ajax({
        type: 'get',
        url: '{{url('/addToCart')}}',
        data: {
          'id_user' :
            @if (Auth::check())
              {{Auth::user()->id}}
            @else
              null
            @endif
            ,
          'product_id' : id,
          'amount_of_item' : 0
        },
        success: function(response) {
          $('#navCart').addClass('red-dot');
          console.log(response);
        }
      });
    })
    @endforeach

    // Add to Wishlist Function
    @foreach(App\Product::all() as $p)
    $('#wish{{$p->id}}').click(function() {
      var id = $('#wish{{$p->id}}').val();

      $.ajax({
        type: 'get',
        url: '{{url('/addToWishlist')}}',
        data: {
          'id_user' :
            @if (Auth::check())
              {{Auth::user()->id}}
            @else
              null
            @endif
            ,
          'product_id' : id
        },
        success: function(response) {
          $('#navWishlist').addClass('red-dot');
          $('#heart{{$p->id}}').removeClass('mdi-heart-outline');
          $('#heart{{$p->id}}').addClass('mdi-heart');
          console.log(response);
        }
      });
    })
    @endforeach
  })
</script>
