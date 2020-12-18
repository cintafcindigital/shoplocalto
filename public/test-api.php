<html>
	<head>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	</head>
	<body>

		
		
	    <div id="results"></div>

	    <?php if($_GET['action']=='profile_image'){ ?>
		    <form id="profile_img" method="post" action="#" enctype="multipart/form-data">
				Select image to upload:
			    <input type="file" name="fileToUpload" id="fileToUpload">
			    <input type="submit" value="Upload Image" name="submit" id="submit">
		    </form>

		    <script type="text/javascript">
				$(document).ready(function(){		
					$('#profile_img').submit(function(event){ 
						event.preventDefault();
						var form = new FormData(document.getElementById('profile_img'));
					    //append files
					    var file = document.getElementById('fileToUpload').files[0];
					    if (file) {   
					        form.append('upload_image', file);
					        form.append('id', 30);
					    }
						$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
						  .done(function( data ) {
						    const token = data.csrf_token;
						    console.log( "Received token: " + token  );
						    form.append('_token', token);
						    // Got CSRF token; now send request 	
							$.ajax({
							    url: 'http://test.perfectweddingday.ca/api/userdata/profilepicture',
							    data: form,
							    type: 'POST',	
							    cache: false,						    
							    contentType: false,
							    processData: false, 
							}).done(function(data) {
						      console.log('Received Update RESPONSE: ' + JSON.stringify( data ) );
						      $('#results').html(JSON.stringify( data )); // test response data in a section 
						    });						
						});
					});			
				    			
				});
				
			</script>	

		<?php } elseif($_GET['action']=='save-wedding-data'){ ?>
<form id="profile_img" method="post" action="#" enctype="multipart/form-data">
				Select image to upload for website:
			    <input type="file" name="fileToUpload" id="fileToUpload">
			     <input type="file" name="fileToUpload" id="fileToUpload1">
			    <input type="submit" value="Save website" name="submit" id="submit">
		    </form>



			<script type="text/javascript">
				$(document).ready(function(){
					$('#profile_img').submit(function(event){ 
						event.preventDefault();
						var form = new FormData();
					    //append files
					    	var file = document.getElementById('fileToUpload').files[0];
					    	var file1 = document.getElementById('fileToUpload1').files[0];
					    // All Required Field is here
						    if (file) {   
						        form.append('selfimage', file);
						        form.append('id', '30');
						        form.append('name', 'CITS');
						        form.append('partner_name', 'Dev');
						        form.append('gender', 'groom');
						        form.append('partner_gender', 'bride');
						        form.append('wedding_date', '23/05/2019');
						        form.append('venue', 'Venue Address');
						       
						        form.append('partnerimage', file1);
						       // form.append('_token', token);
						    }
						$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
						  .done(function( data ) {
						    const token = data.csrf_token;
						    console.log( "Received token: " + token  );
						     form.append('_token', token);
						    //Got CSRF token; now send request 			
						  
						    	$.ajax({
								    url: 'http://test.perfectweddingday.ca/api/userdata/save-my-wedding-data',
								    data: form,
								    type: 'POST',	
								    cache: false,						    
								    contentType: false,
								    processData: false, 
								})
						    .done(function(data) {
						      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
						      $('#results').html(JSON.stringify( data )); // test response data in a section
						    });
						});
				});
					});
				
			</script>		 

		<?php } elseif($_GET['action']=='signup'){ ?>

			<script type="text/javascript">
				$(document).ready(function(){	
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send request 			
					    $.post('http://test.perfectweddingday.ca/api/usersignup', // Add full url of test website
					    	{name: 'CITS', email: 'citstestdev@gmail.com',address:'testaddress',country:'IN',phone:'1234567890',event_date:'15/05/2019',event_role:'groom','mail_allow':'1' , password: '123456', _token: token}) // Place email and password from login form
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
				
			</script>

		<?php } else if($_GET['action'] == 'todotaskdetails') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/todolist-task-details', // Add full url of test website
					    	{user_id: '3', todolist_id: '3', _token: token}) // Place email and password from login form
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>

		<?php } else if($_GET['action'] == 'todotaskcreate') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save_todo_task', // Add full url of test website
					    	{user_id: '3', title: 'API task', description: 'test API description', todo_cat_id:'5', todo_date_id:'1', _token: token}) // Place email and password from login form
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>

		<?php } else if($_GET['action'] == 'update_user_task') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/udpate_todo_list', // Add full url of test website
					    	{task_id: '115', fields: 'todo_cat_id', data: 10 , _token: token}) // Place email and password from login form
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>


		<?php } else if($_GET['action'] == 'add_totask_to_vendor') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/add-vendor-to-todo-task', // Add full url of test website
					    	{user_id: '3', vendor_search_data: '21', vendor_hired: '0', list_id:'19', _token: token}) // vendor_search_data = vendotID And vendor_hired = if you allready hired 1 for yes 0 for no And list_id = todo task list data
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>

		<?php } else if($_GET['action'] == 'savebookvendor_getdata') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf/3') // Add full url of test website
					  .done(function( data ) {
					    const token = data.token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/user-vendors-category', // Add full url of test website
					    	{user_id: '3', cat_id: '', status: '', _token: token}) //  For booked vendor passed status = 6 for save vendor passed status = '';
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>

		<?php } else if($_GET['action'] == 'savebookvendor_updatedata') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/udpate-saved-vendor-data', // Add full url of test website
					    	{user_booked_vendors_id: '31', fields: 'add_note', data_message: 'Hello', _token: token}) // user biiked vendor id when user save this vendor and then genrate by user_booked_vendors Table form database
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				});
			</script>

		<?php } else if($_GET['action'] == 'savebookvendor_remove') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/remove-booked-vendor', // Add full url of test website
					    	{ user_id: '3', user_booked_vendors_id: '31', _token: token}) // user biiked vendor id when user save this vendor and then genrate by user_booked_vendors Table form database
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_guest') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-guest-data', // Add full url of test website
					    	{ user_id: '3', name: 'webindore', group_id: '1', menu: 'adult', gender: 'male', age_type: 'adult', mail: 'citstestdev00@gmail.com', phone:'1478523693', city: 'Ontirio', country: 'CA', address: '323 Ontirio', postal_code: '145236', attendance: 'confirmed', relatedData: [{fname:'webkhazana',lname:'indore',gender:'male',age_type:'children'}, {fname:'newtest',lname:'indore',gender:'female',age_type:'adult'}],  _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'edit_guest') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/edit-guest-data', // Add full url of test website
					    	{ user_id: '3', guest_id:'57', name: 'webcitsindore', group_id: '1', menu: 'adult', gender: 'male', age_type: 'adult', mail: 'citstestdev01@gmail.com', phone:'963258741', city: 'Ontirio', country: 'CA', address: '323 Ontirio', postal_code: '145236', attendance: 'confirmed', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_total_estimate_budget') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf/3') // Add full url of test website
					  .done(function( data ) {
					    const token = data.token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-total-estimate-budget_data', // Add full url of test website
					    	{ user_id: '3', estimate_budget: '42000', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'add_budget_to_todo_task') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/add-budget-to-todo-task', // Add full url of test website
					    	{ user_id: '3', concept: 'New budget with task id', estimate_budget: '3200', final_cost: '2800', cat_id: '24', task_id:'38', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_budget_data') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-budget-data', // Add full url of test website
					    	{ user_id: '3', concept: 'New budget', estimate_budget: '3200', final_cost: '2800', cat_id: '24', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'edit_budget_data') { ?>

			<!-- User_id and budget_id required all other are optinal  -->

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/edit-budget-data', // Add full url of test website
					    	{ user_id: '3', budget_id:'908', concept: 'Theme Color', estimate_budget: '4200', final_cost: '2800', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'add_budget_payment') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/add-budget-payment', // Add full url of test website
					    	{ user_id: '3', budget_id:'908', paid_amount: '600', is_paid: 'yes', paid_date: '01/06/2019', paid_by: 'Cits', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_wedding_data') { ?>

			<form id="profile_img" method="post" action="#" enctype="multipart/form-data">
				Select image to upload for website:
			    <input type="file" name="fileToUpload" id="fileToUpload">
			    <input type="submit" value="Save website" name="submit" id="submit">
		    </form>

		    <script type="text/javascript">
				$(document).ready(function() {
					$('#profile_img').submit(function(event){ 
						event.preventDefault();
						var form = new FormData();
					    //append files
					    	var file = document.getElementById('fileToUpload').files[0];
					    // All Required Field is here
						    if (file) {   
						        form.append('image', file);
						        form.append('user_id', '3');
						        form.append('website_id', '7');
						        form.append('couple_name', 'Cesario and Tina');
						        form.append('wedding_date', '27/12/2019');
						        form.append('title', 'Our wedding is coming');
						        form.append('description', 'Our wedding is coming test');
						        form.append('background_color', '794BF1');
						        form.append('website_link', 'cesario-and-tina-new');
						    }

							$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
							  .done(function( data ) {
							    const token = data.csrf_token;
							    console.log( "Received token: " + token  );
							    form.append('_token', token);
							    // Got CSRF token; now send request 	
								$.ajax({
								    url: 'http://test.perfectweddingday.ca/api/userdata/save-wedding-website',
								    data: form,
								    type: 'POST',	
								    cache: false,						    
								    contentType: false,
								    processData: false, 
								}).done(function(data) {
							      console.log('Received Update RESPONSE: ' + JSON.stringify( data ) );
							      $('#results').html(JSON.stringify( data )); // test response data in a section 
							    });						
							});
					});			
				});
			</script>

		<?php } else if($_GET['action'] == 'save_wedshoots_settings') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-wedshoots-settings', // Add full url of test website
					    	{ user_id: '3', album_id: '9', couple_name:'Cesario and Tina &', album_link: 'cesario-and-tina-and', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'upload_album_images') { ?>

			<form id="profile_img" method="post" action="#" enctype="multipart/form-data">
				Select image to upload User Album:
			    <input type="file" name="fileToUpload" id="fileToUpload">
			    <input type="submit" value="Upload Image" name="submit" id="submit">
		    </form>

		    <script type="text/javascript">
				$(document).ready(function() {		
					$('#profile_img').submit(function(event) { 
						event.preventDefault();
						var form = new FormData();
					    //append files
					    var file = document.getElementById('fileToUpload').files[0];
					    if (file) {   
					        form.append('userImageAlbum', file);
					        form.append('user_id', '3');
					    }
						$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
						  .done(function( data ) {
						    const token = data.csrf_token;
						    console.log( "Received token: " + token  );
						    form.append('_token', token);
						    // Got CSRF token; now send request 	
							$.ajax({
							    url: 'http://test.perfectweddingday.ca/api/userdata/upload-album-images',
							    data: form,
							    type: 'POST',	
							    cache: false,						    
							    contentType: false,
							    processData: false, 
							}).done(function(data) {
						      console.log('Received Update RESPONSE: ' + JSON.stringify( data ) );
						      $('#results').html(JSON.stringify( data )); // test response data in a section 
						    });						
						});
					});			
				});
			</script>

		<?php } else if($_GET['action'] == 'save_album_image_note') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-album-image-note', // Add full url of test website
					    	{ user_id: '3', album_image_id: '5', title:'My lovely life', note: 'This is test note for image', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_user_task') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-user-task', // Add full url of test website
					    	{ user_id: '3', task_id: '3', task_oper:'complete', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'booked_vendors') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/booked-vendor', // Add full url of test website
					    	{ user_id: '3', vendor_search_data: '34', vendor_hired:'1', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_user_profile_settings') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-user-settings', // Add full url of test website
					    	{ user_id: '3', name: 'Cesario and Tina', address:'Woodbridge', country:'CA', phone:'416-990-0944', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_account_password_settings') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-account-settings', // Add full url of test website
					    	{ user_id: 3, current_password: '654321', password:'123456', password_confirmation:'123456', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'delte_mailbox') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/delete-mailinbox', // Add full url of test website
					    	{ user_id: 3, mailbox_id: ['4'], _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'mailbox_send_by_user') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/mailbox-send', // Add full url of test website
					    	{ user_id: 3, name: 'Flowers Canada', email:'citstestdev@gmail.com', enquiry_id:'46', cc: 'citstestjitu@gmail.com', business_detail: '<p>Type your message here....for API test<br><br>Thanks,<br>Cesario And Tina </p>', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'request_enquiry_to_vendor') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf/3') // Add full url of test website
					  .done(function( data ) {
					    const token = data.token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/vender-request-enquiry', // Add full url of test website
					    	{ user_id: 0, name: 'Cesario and Tina', email:'citstestdev@gmail.com', number_of_guests:'4', event_date: '27/12/2019', phone: '416-990-0944', comment: 'This is test API comment', company_id: '55',  _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'page_request_enquiry_to_vendor') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/vendor-page-request-enquiry', // Add full url of test website
					    	{ user_id: 3, name: 'Cesario and Tina', email:'citstestdev@gmail.com', number_of_guests:'4', event_date: '27/12/2019', phone: '416-990-0944', comment: 'This is test API comment', company_id: '55',  _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'website_newsletter') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/website/save_newsletter', // Add full url of test website
					    	{ email: 'citstestjitu@gmail.com', _token: token }) 
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'website_contact_page_enquiry') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/website/send-enquiry', // Add full url of test website
					    	{ user_id: 3, name: 'Cits dev', email:'citstestdev@gmail.com', reason:'Planning tools', phone: '416-990-0944', comment: 'This is test API comment', _token: token })  
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>

		<?php } else if($_GET['action'] == 'save_reviews_to_vendor') { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userdata/save-review', // Add full url of test website
					    	{ user_id: 3, vendor_id: 8, rname: 'Cits dev', remail:'citstestdev@gmail.com', score:'3.00', review_description: 'This is test Review API comment', _token: token })  
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					});
				});
			</script>
			
		<?php } else { ?>

			<script type="text/javascript">
				$(document).ready(function(){
					var token = "";
					$.get('http://test.perfectweddingday.ca/api/csrf') // Add full url of test website
					  .done(function( data ) {
					    const token = data.csrf_token;
					    console.log( "Received token: " + token  );
					    // Got CSRF token; now send login request 
					    $.post('http://test.perfectweddingday.ca/api/userlogin', // Add full url of test website
					    	{email: 'cesario@indigitalgroup.ca', password: '123456', _token: token}) // Place email and password from login form
					    .done(function(data) {
					      console.log('Received login RESPONSE: ' + JSON.stringify( data ) );
					      $('#results').html(JSON.stringify( data )); // test response data in a section
					    });
					  });
				})
			</script>

		<?php } ?>
		
	</body>
</html>