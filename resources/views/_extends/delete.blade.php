<div id="modalDelete" class="modal" tabindex="-1" role="dialog">
	<form action="" method="post" id="formDelete">
	  @csrf
	  @method('DELETE')
	  <h4 class="h4">Delete this item ?</h4>
	  <div class="d-flex justify-content-end">
	  	<a href="#" class="btn btn-secondary mr-1">Cancel</a>
	  	<button type="submit" class="btnDelete btn btn-danger">Delete</button>
	  </div>
	</form>
</div>