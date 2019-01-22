<script type="text/javascript">
  $(document).ready(function () {
    // Modal
    var modal = new tingle.modal({
        footer: false,
        stickyFooter: false,
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Close",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            console.log('modal open');
        },
        onClose: function() {
            console.log('modal closed');
        },
        beforeClose: function() {
            // here's goes some logic
            // e.g. save content before closing the modal
            return true; // close the modal
            return false; // nothing happens
        }
    });

    // Add Product
    $('#btnAddProduct').click(function() {
      var content = $('#modalAddProduct').html();
      modal.setContent(content);
      modal.open();
    });

    $('#btnCloseModalAddProduct').click(function() {
      modal.setContent('');
      modal.close();
    });
    // End Of Add Product

    // Show Product
    @foreach (App\Product::all() as $p)
    $('#btnShowProduct{{$p->id}}').click(function() {
      var content = $('#modalShowProduct{{$p->id}}').html();
      modal.setContent(content);
      modal.open();
    });
    @endforeach
    // End Of Show Product

    // Edit Product
    @foreach(App\Product::all() as $p)
    $('#btnEditProduct{{$p->id}}').click(function() {
      var content = $('#modalEditProduct{{$p->id}}').html();
      modal.setContent(content);
      modal.open();
    });
    @endforeach
    // End Of Edit Product

    // Add Category
    $('#btnAddCategory').click(function() {
      var content = $('#modalAddCategory').html();
      modal.setContent(content);
      modal.open();
    });

    // Edit Product
    @foreach(App\ProductCategory::all() as $p)
    $('#btnEditCategory{{$p->id}}').click(function() {
      var content = $('#modalEditCategory{{$p->id}}').html();
      modal.setContent(content);
      modal.open();
    });
    @endforeach
    // End Of Edit Product

    // Datatables
    $('#products-table').DataTable();
    $('#categories-table').DataTable();

  });
</script>
