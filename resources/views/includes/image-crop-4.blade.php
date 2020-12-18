<script src="{{asset('public/js/crop/croppie.js')}}"></script>
<link rel="stylesheet" href="{{asset('public/js/crop/croppie.css')}}" />
<!-- <br /> -->
<div id="uploaded_image_{{@$name}}" class="uploaded_image_all"></div>
<input type="file" name="upload_image_{{@$name}}" id="upload_image_{{@$name}}" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" class="form-control" />
<input type="hidden" name="{{@$name}}" id="{{@$name}}">
<div id="uploadimageModal_{{@$name}}" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="overflow:auto;<?php echo isset($width)?'width: '.((int) $width+250).'px !important;':''; ?>">
            <div class="modal-header">
                <h4 class="modal-title">Crop Image</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                          <div id="image_demo_{{@$name}}" style="width:100%; margin-top:30px"></div>
                    </div>
                </div>
                <div class="row" style="padding: 20px 0px;">
                    <div class="col-md-12 text-center">
  		            	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		            	<span style="padding: 0px 15px;"></span>
                      	<button type="button" class="btn btn-success crop_image">Crop Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $image_crop_{{@$name}} = $('#image_demo_{{@$name}}').croppie({
    enableExif: true,
    viewport: {
      width:<?php echo isset($width)?((int) $width):'200'; ?>,
      height:<?php echo isset($height)?((int) $height):'200'; ?>,
      type:'square' //circle
    },
    boundary:{
      width:<?php echo isset($width)?(((int) $width) > 320 ?((int) $width)+100:'400'):'200'; ?>,
      height:<?php echo isset($height)?(((int) $height) > 350 ?((int) $height)+100:'450'):'200'; ?>
    }
  });

  $('#upload_image_{{@$name}}').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop_{{@$name}}.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal_{{@$name}}').modal({backdrop: 'static', keyboard: false});
  });
	$("#uploadimageModal_{{@$name}}").on("hidden.bs.modal", function () {
		$('#upload_image_{{@$name}}').val('');
	});
  $('.crop_image').click(function(event){
  	event.preventDefault();
    $image_crop_{{@$name}}.croppie('result', {
      type: 'canvas',
      format: 'webp',
      quality: 1,
      size: 'viewport'
    }).then(function(response){
	    var form = document.getElementById("{{@$form}}");
	    if(response != 'data:,' && response.length > 6){
			$('#uploadimageModal_{{@$name}}').modal('hide');
			var response_{{@$name}} = response;
			$('#uploaded_image_{{@$name}}').html('<img src="'+response_{{@$name}}+'" class="img-thumbnail" />');
			$('#{{@$name}}').val(response);
			$('#upload_image_{{@$name}}').val('');
	    }
    })
  });
});  
</script>