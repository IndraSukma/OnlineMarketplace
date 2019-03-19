{{-- <div id="modalDelete" class="modal" tabindex="-1" role="dialog">
	<form action="" method="post" id="formDelete">
	  @csrf
	  @method('DELETE')
	  <h4 class="h4">Delete this item ?</h4>
	  <div class="d-flex justify-content-end">
	  	<a href="#" class="btn btn-secondary mr-1">Cancel</a>
	  	<button type="submit" class="btn btn-danger">Delete</button>
	  </div>
	</form>
</div> --}}

<div id="modalDelete" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="modal-content" id="formDelete">
      <div class="modal-header border-bottom-0">
        <h3 class="modal-title">Delete this item ?</h3>
      </div>
      <div class="modal-body py-0">
        @csrf
        @method('DELETE')
        <p id="itemName"></p>
      </div>
      <div class="modal-footer border-top-0 pt-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div>
</div>