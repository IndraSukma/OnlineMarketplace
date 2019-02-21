$(document).ready(function () {
	// Datatables
  $('#products-table').DataTable();

  // Show Image Preview
  $('#modalAdd #productImageInput, #modalEdit #productImageInput').change(function () {
    // readURL(this);
    var modal = $(this).data('modal-id');

    if (this.files.length > 0) {
      var file = this.files;
      var fileArray = $.map(file, function(value) {
        return value;
      });

      var imageBox = $(modal + ' .image-box');
      var totalBox = imageBox.length;
      var ramainingBox = 4 - totalBox;
      // console.log(imageBox.attr('id'));

      if (fileArray.length > ramainingBox) {
        fileArray.length = ramainingBox;
      }

      for (i = 0; i < fileArray.length; i++) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $(modal + ' #btnUploadImage').before(`
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box animated fadeIn faster" data-modal-id="` + modal + `" data-original-background="` + e.target.result + `" style="background-image: url('` + e.target.result + `');">
                <div class="actions">
                	<a class="btnSetThumbnail nonactive" title="Set as Thumbnail">
                		<i class="mdi mdi-24px mdi-radiobox-blank text-white"></i>
                	</a>
                	<a class="btnSetThumbnail active" title="Set as Thumbnail" style="display: none;">
                		<i class="mdi mdi-24px mdi-check-circle-outline text-primary"></i>
                	</a>
                  <div>
                    <a class="btnEditImage" title="Edit Image" data-toggle="modal" data-target="#modalEditImage">
                    	<i class="mdi mdi-24px mdi-pencil-outline text-white"></i>
                    </a>
                    <a class="btnRemoveImage" title="Remove Image">
                    	<i class="mdi mdi-24px mdi-delete-outline text-white"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          `);

	        updateImageBoxId(modal);
          delay(function () {
	      		updateProductImages(modal);
					}, 1000);
        }
        reader.readAsDataURL(this.files[i]);
      }
    }
  });

  // Remove Image Preview
  $('body').on('click', '.btnRemoveImage', function () {
  	var imageBox = $(this).parent().parent().parent();
  	var modal = imageBox.data('modal-id');

  	imageBox.parent().remove();
    updateImageBoxId(modal);
    updateProductImages(modal);
  });

  // Edit Image Preview
  $('body').on('click', '.btnEditImage', function () {
    var imageBox = $(this).parent().parent().parent();
    var imageCrop = imageBox.data('original-background');
    var cropperImage = $('#cropperImage');
    var modal = imageBox.data('modal-id');
    
    cropperImage.cropper('destroy');
    $('#cropperImage').attr('src', imageCrop);
    $('#btnApply').attr('data-imagebox-id', '#' + imageBox.attr('id'));
    $('#btnApply, #btnCancel').attr('data-modal-id', modal);
  });

  $('#modalEditImage').on('shown.bs.modal', function() {
    var cropperImage = $('#cropperImage');

    cropperImage.cropper({
      aspectRatio: 1 / 1,
      viewMode: 3
    });

    $('#btnApply').click(function () {
	    var croppedImage = cropperImage.cropper('getCroppedCanvas').toDataURL();
	    var modal = $(this).attr('data-modal-id');
	    var imageBox = $(modal + ' ' + $(this).attr('data-imagebox-id'));

	    imageBox.css('background-image', 'url(' + croppedImage + ')');
	    updateProductImages(modal);
	  });
  });

  //Set as Thumbnail
  $('body').on('mouseenter', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-radiobox-blank').addClass('mdi-check-circle-outline');
  }).on('mouseleave', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-check-circle-outline').addClass('mdi-radiobox-blank');
  }).on('click', '.btnSetThumbnail.nonactive', function () {
  	$(this).hide();
  	$(this).siblings().show();
  	$('.btnSetThumbnail.nonactive').not(this).show();
  	$('.btnSetThumbnail.active').not($(this).siblings()).hide();

  	var modal = $(this).parent().parent().data('modal-id');
  	var thumbnail = $(this).parent().parent().css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
		$(modal + ' #productThumbnail').val(thumbnail);
  });

  // Show Product
  $('.btnShow').click(function() {
  	var thumbnailBox = $('#modalShow .thumbnail-box');
  	var imageBox = $('#modalShow .image-box-static');
  	var thumbnail = $(this).data('thumbnail');
  	var imageArray = $(this).data('images');
  	var totalThumbnail = thumbnail.length;
  	var totalImages = imageArray.length;
  	var baseUrl = window.location.origin;

  	for (i = 0; i < totalThumbnail; i++) {
  		thumbnailBox.attr('src', baseUrl + '/img/product-thumbnail/' + thumbnail);
  		thumbnailBox.show();
  	}

  	for (i = 0; i < totalImages; i++) {
    	$(imageBox[i]).css('background-image', 'url(' + baseUrl + '/img/product-img/' + imageArray[i] + ')');
			$(imageBox[i]).show();
    }

  	$('#modalShow #name').text($(this).data('name'));
    $('#modalShow #category').text($(this).data('category'));
    $('#modalShow #condition').text($(this).data('condition'));
    $('#modalShow #price').text($(this).data('price'));
    $('#modalShow #weight').text($(this).data('weight'));
    $('#modalShow #stock').text($(this).data('stock'));
    $('#modalShow #views').text($(this).data('views'));
    $('#modalShow #description').text($(this).data('description'));

	  $('#modalShow').on('hide.bs.modal', function () {
  		thumbnailBox.hide();
	  	imageBox.hide();
	  });
  });

  // Edit Product
  $('.btnEdit').click(function() {
  	var imageArray = $(this).data('images');
  	var totalImages = imageArray.length;
  	var baseUrl = window.location.origin;

  	if (totalImages < 4) {
  		$('#modalEdit #btnUploadImage').show();
  	}

  	$(imageArray).each(function (i) {
  		var imageUrl = baseUrl + '/img/product-img/' + this;

  		$('#modalEdit #btnUploadImage').before(`
	      <div class="col-6 col-lg-3 p-2">
	        <div class="image-box animated fadeIn faster" data-modal-id="#modalEdit" data-original-background="` + imageUrl + `" style="background-image: url('` + imageUrl + `');">
	          <div class="actions">
	          	<a class="btnSetThumbnail nonactive" title="Set as Thumbnail">
	          		<i class="mdi mdi-24px mdi-radiobox-blank text-white"></i>
	          	</a>
	          	<a class="btnSetThumbnail active" title="Set as Thumbnail" style="display: none;">
	          		<i class="mdi mdi-24px mdi-check-circle-outline text-primary"></i>
	          	</a>
	            <div>
	              <a class="btnEditImage" title="Edit Image" data-toggle="modal" data-target="#modalEditImage">
	              	<i class="mdi mdi-24px mdi-pencil-outline text-white"></i>
	              </a>
	              <a class="btnRemoveImage" title="Remove Image">
	              	<i class="mdi mdi-24px mdi-delete-outline text-white"></i>
	              </a>
	            </div>
	          </div>
	        </div>
	      </div>
	    `);
  	});

    updateImageBoxId('#modalEdit');
		updateProductImages('#modalEdit');

  	$('#formEdit').attr('action', '/manage/products/' + $(this).data('id'));
    $('#modalEdit #name').val($(this).data('name'));
    $('#modalEdit #category').val($(this).data('category'));
    $('#modalEdit #condition').val($(this).data('condition'));
    $('#modalEdit #price').val($(this).data('price'));
    $('#modalEdit #weight').val($(this).data('weight'));
    $('#modalEdit #stock').val($(this).data('stock'));
    $('#modalEdit #views').val($(this).data('views'));
    $('#modalEdit #description').val($(this).data('description'));

    $('#modalEdit').on('hide.bs.modal', function () {
  		$('#modalEdit .image-box').parent().remove();
  		$('#modalEdit #btnUploadImage').hide();
	  });
  });

  // Delete Product
  $('.btnDelete').click(function() {
    $('#formDelete').attr('action', '/manage/products/' + $(this).data('id'));
  });

  // Multiple Modal Issue
  $('#modalEditImage').on('hide.bs.modal', function() {
    $('body').css('overflow-y', 'hidden');
  });

  $('#modalAdd, #modalEdit').on('hiden.bs.modal', function() {
    $('body').css('overflow-y', 'visible');
  });
  
  function updateImageBoxId(modal) {
    var imageBox = $(modal + ' .image-box');
    var totalBox = imageBox.length;

    if (totalBox >= 4) {
      $(modal + ' #btnUploadImage').hide();
    } else {
      $(modal + ' #btnUploadImage').show();
    }

    for (i = 0; i < totalBox; i++) {
      $(imageBox[i]).attr('id', 'box-' + (i+1));
    }
  }

  function updateProductImages(modal) {
    var imageBox = $(modal + ' .image-box');
    var totalBox = imageBox.length;
    var images = [];

    for (i = 0; i < totalBox; i++) {
      var image = $(imageBox[i]).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
      images.push(image);
    }

    $(modal + ' #productImages').val(JSON.stringify(images));
  }

  var delay = (function () {
    var timer = 0;

    return function(callback, ms) {
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
  })();
});