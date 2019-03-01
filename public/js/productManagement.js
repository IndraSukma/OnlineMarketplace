$(document).ready(function () {
	// Datatables
  $('#products-table').DataTable();

  // Form Validation
  // $('#formAdd button[type="submit"], #formEdit button[type="submit"]').click(function (event) {
  //   var form = $(this).data('form-id');

  //   event.preventDefault();
  //   formValidation(form);
  // });

  // Show Image Preview
  $('#modalAdd #productImageInput, #modalEdit #productImageInput').change(function () {
    var modal = $(this).data('modal-id');

    if (this.files.length > 0) {
      var file = this.files;
      var fileArray = $.map(file, function(value) {
        return value;
      });

      var imageBox = $(modal + ' .image-box');
      var totalBox = imageBox.length;
      var ramainingBox = 4 - totalBox;

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
         //  delay(function () {
	      		// updateProductImages(modal);
         //  }, 1000);
          setDefaultThumbnail(modal);
          delay(function () {
            rearrangeImages(modal);
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
    // updateProductImages(modal);
    setDefaultThumbnail(modal);
    rearrangeImages(modal);
    // console.log($(modal + ' #productThumbnail').val());
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
      if (imageBox.is('[thumbnail]')) {
        $(modal + ' #productThumbnail').val(croppedImage);
        // console.log($(modal + ' #productThumbnail').val());
      }
      // updateProductImages(modal);
	    rearrangeImages(modal);
	  });
  });

  //Set as Thumbnail
  $('body').on('mouseenter', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-radiobox-blank').addClass('mdi-check-circle-outline');
  }).on('mouseleave', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-check-circle-outline').addClass('mdi-radiobox-blank');
  }).on('click', '.btnSetThumbnail.nonactive', function () {
    var imageBox = $(this).parent().parent();
    var modal = imageBox.data('modal-id');
    var thumbnail = imageBox.css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');

    $(this).hide();
    $(this).siblings().show();
    $('.btnSetThumbnail.nonactive').not(this).show();
    $('.btnSetThumbnail.active').not($(this).siblings()).hide();

    imageBox.attr('thumbnail', '');
    $(modal + ' .image-box').not(imageBox).removeAttr('thumbnail');
    $(modal + ' #productThumbnail').val(thumbnail);
    rearrangeImages(modal);
    // console.log($(modal + ' #productThumbnail').val());
  });

  // Show Product
  $('#products-table').on('click', '.btnShow', function() {
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

    $(imageArray).each(function (i) {
      var imageUrl = baseUrl + '/img/product-img/' + this;

      $.get(imageUrl).done( function() {
        $(imageBox[i]).css('background-image', 'url(' + imageUrl + ')');
        $(imageBox[i]).show();
      }).fail( function() {
        $(imageBox[i]).css('background-image', 'url(' + baseUrl + '/img/product-img/image-not-found.png)');
        $(imageBox[i]).show();
      });
    });

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
  $('#products-table').on('click', '.btnEdit', function() {
  	var imageArray = $(this).data('images');
  	var totalImages = imageArray.length;
  	var baseUrl = window.location.origin;

  	if (totalImages < 4) {
  		$('#modalEdit #btnUploadImage').show();
  	}

    // for (i = 0; i < imageArray.length; i++) {
    //   // var imageUrl[i] = baseUrl + '/img/product-img/' + imageArray[i];

    //   $.get(baseUrl + '/img/product-img/' + imageArray[i]).done( function() { 
    //     // console.log(this.url);
    //     $('#modalEdit #btnUploadImage').before(`
    //       <div class="col-6 col-lg-3 p-2">
    //         <div class="image-box animated fadeIn faster" data-modal-id="#modalEdit" data-original-background="` + this.url + `" style="background-image: url('` + this.url + `');">
    //           <div class="actions">
    //             <a class="btnSetThumbnail nonactive" title="Set as Thumbnail">
    //               <i class="mdi mdi-24px mdi-radiobox-blank text-white"></i>
    //             </a>
    //             <a class="btnSetThumbnail active" title="Set as Thumbnail" style="display: none;">
    //               <i class="mdi mdi-24px mdi-check-circle-outline text-primary"></i>
    //             </a>
    //             <div>
    //               <a class="btnEditImage" title="Edit Image" data-toggle="modal" data-target="#modalEditImage">
    //                 <i class="mdi mdi-24px mdi-pencil-outline text-white"></i>
    //               </a>
    //               <a class="btnRemoveImage" title="Remove Image">
    //                 <i class="mdi mdi-24px mdi-delete-outline text-white"></i>
    //               </a>
    //             </div>
    //           </div>
    //         </div>
    //       </div>
    //     `);

    //     // updateImageBoxId('#modalEdit');
    //     // // updateProductImages('#modalEdit');
    //     // setDefaultThumbnail('#modalEdit');
    //     // rearrangeImages('#modalEdit');
    //   });
    // }

  	$(imageArray).each(function (i) {
  		var imageUrl = baseUrl + '/img/product-img/' + this;

      $.get(imageUrl).done( function() { 
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

        updateImageBoxId('#modalEdit');
        // updateProductImages('#modalEdit');
        setDefaultThumbnail('#modalEdit');
        rearrangeImages('#modalEdit');
      });
  	});

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
  $('#products-table').on('click', '.btnDelete' ,function() {
    $('#formDelete').attr('action', '/manage/products/' + $(this).data('id'));
    $('#modalDelete').on('hide.bs.modal', function () {
      $('#formDelete').attr('action', '');
    });
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

  // function updateProductImages(modal) {
  //   var imageBox = $(modal + ' .image-box');
  //   var totalBox = imageBox.length;
  //   var images = [];

  //   for (i = 0; i < totalBox; i++) {
  //     var image = $(imageBox[i]).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
  //     images.push(image);
  //   }

  //   $(modal + ' #productImages').val(JSON.stringify(images));
  //   // console.log(images);
  // }
  
  function setDefaultThumbnail(modal) {
    var thumbnail = $(modal + ' .image-box[thumbnail]');
    var imageBox = $(modal + ' .image-box');
    var totalBox = imageBox.length;

    if (totalBox == 0) {
      $(modal + ' #productThumbnail').val('');
      // console.log($(modal + ' #productThumbnail').val());
    }

    if (totalBox > 0 && thumbnail.length == 0) {
      var image = $(imageBox[0]).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');

      $(imageBox[0]).attr('thumbnail', '');
      $(imageBox[0]).find('.btnSetThumbnail.nonactive').hide();
      $(imageBox[0]).find('.btnSetThumbnail.active').show();

      $(modal + ' #productThumbnail').val(image);
      // console.log($(modal + ' #productThumbnail').val());
    }
  }

  function rearrangeImages(modal) {
    var thumbnail = $(modal + ' .image-box[thumbnail]').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
    var imageBox = $(modal + ' .image-box');
    var images = [];

    imageBox.each(function (i) {
      var image = $(this).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
      images.push(image);
    });

    var thumbnailIndex = images.indexOf(thumbnail);
    if (thumbnailIndex > 0) {
      images.splice(thumbnailIndex, 1);
      images.unshift(thumbnail);
    }

    $(modal + ' #productImages').val(JSON.stringify(images));
    // console.log(images);
  }

  // function formValidation(form) {
  //   var thumbnail = $(form + ' .image-box[thumbnail]');
  //   var imageBox = $(form + ' .image-box');
  //   var totalBox = imageBox.length;

  //   if (totalBox == 0) {
  //     alert('Please upload product images.');
  //   }

  //   if (thumbnail.length == 0) {
  //     alert('Please select thumbnail image.');
  //   }

  //   if (totalBox > 0 && thumbnail.length == 1) {
  //     $(form).submit();
  //   }
  // }

  var delay = (function () {
    var timer = 0;

    return function(callback, ms) {
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
  })();
});