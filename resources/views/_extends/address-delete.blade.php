<!-- Modal Delete Address -->
<div class="modal fade" id="modalDeleteAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header blue-gradient">
        <h5 class="modal-title" id="exampleModalLabel">
					<b class="text-white">
						Delete Address
					</b>
				</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formDeleteAddress">
					@csrf
					@method('DELETE')
					<h4>Delete this item?</h4>
    			<div class="float-right">
    				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-danger btn-sm ">Delete</button>
    			</div>
				</form>
      </div>
    </div>
  </div>
</div>