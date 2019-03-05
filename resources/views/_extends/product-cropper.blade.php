<!-- Modal Cropper -->

<div id="modalEditImage" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h3 class="modal-title">Edit Image</h3>
      </div>
      <div class="modal-body py-0">
        <div class="row">
          <div class="col-12">
						<div>
							<img src="" class="w-100" id="cropperImage">
						</div>
          </div>
          <div class="col-12 pt-3">
            <div class="btn-group">
              <button class="btnControl btn btn-light px-2 py-0" title="Zoom In" data-method="zoom" data-option="0.1">
                <i class="mdi mdi-24px mdi-magnify-plus-outline"></i>
              </button>
              <button class="btnControl btn btn-light px-2 py-0" title="Zoom Out" data-method="zoom" data-option="-0.1">
                <i class="mdi mdi-24px mdi-magnify-minus-outline"></i>
              </button>
            </div>
            <div class="btn-group">
              <button class="btnControl toggle btn btn-light px-2 py-0" title="Flip Horizontal" data-method="scaleX" data-option="-1">
                <i class="mdi mdi-24px mdi-reflect-horizontal"></i>
              </button>
              <button class="btnControl toggle btn btn-light px-2 py-0" title="Flip Vertical" data-method="scaleY" data-option="-1">
                <i class="mdi mdi-24px mdi-reflect-vertical"></i>
              </button>
            </div>
            <div class="btn-group float-right">
              <button class="btnControl btn btn-light px-2 py-0" title="Move Left" data-method="move" data-option="-10" data-second-option="0">
                <i class="mdi mdi-24px mdi-arrow-left"></i>
              </button>
              <button class="btnControl btn btn-light px-2 py-0" title="Move Right" data-method="move" data-option="10" data-second-option="0">
                <i class="mdi mdi-24px mdi-arrow-right"></i>
              </button>
              <button class="btnControl btn btn-light px-2 py-0" title="Move Up" data-method="move" data-option="0" data-second-option="-10">
                <i class="mdi mdi-24px mdi-arrow-up"></i>
              </button>
              <button class="btnControl btn btn-light px-2 py-0" title="Move Down" data-method="move" data-option="0" data-second-option="10">
                <i class="mdi mdi-24px mdi-arrow-down"></i>
              </button>
            </div>
          </div>
				</div>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancel">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="btnApply">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- End of Modal Cropper -->