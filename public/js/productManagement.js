$(document).ready(function () {
	// Datatables
  $('#products-table').DataTable();

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
                	<a class="btnSetThumbnail active" title="Thumbnail" style="display: none;">
                		<i class="mdi mdi-24px mdi-check-circle text-primary check-white"></i>
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
          setDefaultThumbnail(modal);
          delay(function () {
            rearrangeImages(modal);
          }, 1500);
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
    setDefaultThumbnail(modal);
    rearrangeImages(modal);
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
  });

  $('.btnControl').click(function () {
    var cropperImage = $('#cropperImage');
    var method = $(this).data('method');
    var option = $(this).data('option');
    var secondOption = $(this).data('second-option');

    cropperImage.cropper(method, option, secondOption);

    if ($(this).hasClass('toggle')) {
      if ($(this).data('option') == -1) {
        $(this).data('option', 1);
      } else {
        $(this).data('option', -1);
      }
    }
  });

  $('#btnApply').click(function () {
    var modal = $(this).attr('data-modal-id');
    var imageBox = $(modal + ' ' + $(this).attr('data-imagebox-id'));
    var cropperImage = $('#cropperImage');
    var cropperImageData = cropperImage.cropper('getData');

    if (cropperImageData.width > 500) {
      var croppedImage = cropperImage.cropper('getCroppedCanvas', {width: 500, height: 500}).toDataURL();
    } else {
      var croppedImage = cropperImage.cropper('getCroppedCanvas').toDataURL();
    }

    imageBox.css('background-image', 'url(' + croppedImage + ')');
    if (imageBox.is('[thumbnail]')) {
      $(modal + ' #productThumbnail').val(croppedImage);
    }
    rearrangeImages(modal);
  });

  //Set Thumbnail
  $('body').on('mouseenter', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-radiobox-blank').addClass('mdi-check-circle check-primary');
  }).on('mouseleave', '.btnSetThumbnail.nonactive', function () {
  	$(this).children().removeClass('mdi-check-circle check-primary').addClass('mdi-radiobox-blank');
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
        $(imageBox[i]).css('background-image', 'url(' + this.url + ')');
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
    var i = 0;

  	if (totalImages < 4) {
  		$('#modalEdit #btnUploadImage').show();
  	}

    if (totalImages > 0) {
      $.get(baseUrl + '/img/product-img/' + imageArray[i]).done( function () {
        var interval = setInterval(function(){
          if (i === totalImages - 1){
            clearInterval(interval);
          }

          $('#modalEdit #btnUploadImage').before(`
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box animated fadeIn faster" data-modal-id="#modalEdit" data-original-background="` + baseUrl + '/img/product-img/' + imageArray[i] + `" style="background-image: url('` + baseUrl + '/img/product-img/' + imageArray[i] + `');">
                <div class="actions">
                  <a class="btnSetThumbnail nonactive" title="Set as Thumbnail">
                    <i class="mdi mdi-24px mdi-radiobox-blank text-white"></i>
                  </a>
                  <a class="btnSetThumbnail active" title="Thumbnail" style="display: none;">
                    <i class="mdi mdi-24px mdi-check-circle text-primary check-white"></i>
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
          setDefaultThumbnail('#modalEdit');
          rearrangeImages('#modalEdit');

          i++;
        }, 100);
      });
    }

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
  
  function setDefaultThumbnail(modal) {
    var thumbnail = $(modal + ' .image-box[thumbnail]');
    var imageBox = $(modal + ' .image-box');
    var totalBox = imageBox.length;

    if (totalBox == 0) {
      $(modal + ' #productThumbnail').val('');
    }

    if (totalBox > 0 && thumbnail.length == 0) {
      var image = $(imageBox[0]).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');

      $(imageBox[0]).attr('thumbnail', '');
      $(imageBox[0]).find('.btnSetThumbnail.nonactive').hide();
      $(imageBox[0]).find('.btnSetThumbnail.active').show();

      $(modal + ' #productThumbnail').val(image);
    }
  }

  function rearrangeImages(modal) {
    var imageBox = $(modal + ' .image-box');
    var images = [];

    imageBox.each(function (i) {
      var image = $(this).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
      images.push(image);
    });

    if (imageBox.length > 0) {
      var thumbnail = $(modal + ' .image-box[thumbnail]').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
      var thumbnailIndex = images.indexOf(thumbnail);
      
      if (thumbnailIndex > 0) {
        images.splice(thumbnailIndex, 1);
        images.unshift(thumbnail);
      }
    }
    

    $(modal + ' #productImages').val(JSON.stringify(images));
  }

  var delay = (function () {
    var timer = 0;

    return function(callback, ms) {
      clearTimeout(timer);
      timer = setTimeout(callback, ms);
    };
  })();
});