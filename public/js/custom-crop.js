var CustomeCrop = (function() {

	function popupResult(result) {
		var html;
		if (result.html) {
			html = result.html;
		}
		if (result.src) {
			html = '<img src="' + result.src + '" />';
		}
		swal({
			title: '',
			html: true,
			text: html,
			allowOutsideClick: true
		});
		setTimeout(function(){
			$('.sweet-alert').css('margin', function() {
				var top = -1 * ($(this).height() / 2),
					left = -1 * ($(this).width() / 2);

				return top + 'px 0 0 ' + left + 'px';
			});
		}, 1);
	}

	function demoUpload() {
		var $uploadCrop;
		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();	            
	            reader.onload = function (e) {
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	});
	            	$('.upload-demo').addClass('ready');
	            }	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
	        	$('#myModalCrop').modal('hide');
		        //swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 200,
				height: 200,
				type: 'circle'
			},
			boundary: {
				width: 300,
				height: 300
			},
			exif: true
		});

		$('#upload').on('change', function () { 
			//$('#myModalCrop').modal('show');
			readFile(this);
		});
		$('.upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				
				///////////////////////////////////////////
				     var userId = GlobalVariables.userId;
		             var postUrl = GlobalVariables.baseUrl + 'my_wedding_pic';
		             var userType = $('#user_type_crop').val();
		              $.ajax({
		                url:postUrl,
		                data:{'user_id':userId,'userType':userType,'imageData':resp},
		                type: 'POST',
		                success :function(response){
		                   console.log(response);
		                },
		                error: function(data){
		                        var errors = data.responseJSON;
		                        console.log(errors);
		                }
		            });
              /////////////////////////////////////////
              $('#myModalCrop').modal('hide');
              $('.'+userType+'-avatar-image').html('<img src="'+resp+'">');
				popupResult({
					src: resp
				});
			});
		});
	}

	function init() {			
		demoUpload();		
	}

	return {
		init: init
	};
})();

