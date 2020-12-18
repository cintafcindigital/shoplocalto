/*
Perfectweddingday admin js by cits developer
*/


$(document).ready(function() {

	// get designer data

		$('#weddingdress_type').on('change', function() {
			var wdt = $(this).val();

			if(wdt != '') {
				$.ajax({
					type: 'GET',
					url: ajaxUrl+'/get-designer-ajax/'+wdt,
					success: function(responce) {
						console.log(responce);
						$('#weddingdress_designer').html(responce);
					}
				})
			} else {
				$('#weddingdress_designer').html('<option value="">-- Select Desinger  --</option>');
			}
		});

	// Remove Product Images

		$('.removepImg').on('click', function() {
			var cv = $(this);
			if(confirm("Are you want to Delete this Image")) {
				var imgid = cv.attr('data-imgid');
				//alert(imgid);
				$.ajax({
					Type: 'POST',
					url: ajaxUrl+'/delete-productimages-ajax/'+imgid,
					success: function(responce) {
						console.log(responce);
						$('#pimg-'+responce).remove();
					}
				});
			}
		});
});