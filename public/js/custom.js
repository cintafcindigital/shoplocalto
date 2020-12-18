
window.Frontend = window.Frontend || {};
/**
*  Perfect Wedding
*
* This module contains functions that are used in the fontend section of the application.
*
* @module Frontend
*/
(function(exports) {

    'use strict';

    /**
     * Constants
     */
    exports.EXCEPTIONS_TITLE = 'Error';
    exports.EXCEPTIONS_MESSAGE = 'Something went wrong. Please try again.';
    exports.WARNINGS_TITLE = 'Warning';
    exports.WARNINGS_MESSAGE = 'Something went wrong. Please try again.';
    exports.REQUEST_FORM_CAPTCHA_VALUE = "";
    exports.requestFormValidator = function(){
        grecaptcha.render('request-form-recaptcha', {'sitekey' : $('#request-form-recaptcha').attr('data-sitekey'), 'callback' : requestFormCaptcha});
        // grecaptcha.render('request-form-recaptcha', {'sitekey' : $('#request-form-recaptcha').attr('data-sitekey'), 'callback' : requestFormCaptcha});
    }
    var requestFormCaptcha = function(response){
        // alert(JSON.stringify(response));
        exports.REQUEST_FORM_CAPTCHA_VALUE = response;
    }

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         setTimeout(function() {
           $('#show-error').fadeOut('slow');
         }, 4000);

         $('.reload-page').click(function(){
             window.location.reload();
         });

         $("#drop-area").on('dragenter', function (e){
              e.preventDefault();
              $(this).css('background', '#e3ffff');
         });

         $("#drop-area").on('dragover', function (e){
           e.preventDefault();
         });

         $("#drop-area").on('drop', function (e){
          $(this).css('background', '#fff');
          e.preventDefault();
          var image = e.originalEvent.dataTransfer.files;
            createFormData(image);
          });

          //////////////////////////////////////////

          $('#profile-image-upload').change(function() {
               var formData = new FormData();
               formData.append('userImage', this.files[0]);
               uploadProfileImage(formData);
          });
              
          $("#myModalSearchVendor").on("hidden.bs.modal", function(e) {
              $('.no-match').addClass('hide');
              $('#vendor_search_data_show').val('');
              $('#vendor_search_data').val('');
              $('#search_cat_id').val('');
              $('.vendor-suggest-list').addClass('hide');
              $('.app-addvendor-footer').addClass('dnone');
          });

          //triggered when modal is about to be shown
          $('#myModalSearchVendor').on('show.bs.modal', function(e) {
              var catId = $(e.relatedTarget).data('cat-id');
              $(e.currentTarget).find('input[name="search_cat_id"]').val(catId);
          });

          /*
          * Handling album image
          * @Page Album Settings
          */

          $("#drop-area-album").on('dragenter', function (e){
                    e.preventDefault();
                    $(this).css('background', '#e3ffff');
               });

          $("#drop-area-album").on('dragover', function (e){
             e.preventDefault();
           });

          $("#drop-area-album").on('drop', function (e){
            $(this).css('background', '#fff');
            e.preventDefault();
            var image = e.originalEvent.dataTransfer.files;
              createFormDataAlbum(image);
          });

          /**
           * Wedshoots image handler
           */
          $('#wedshoots-image-upload').change(function() {
                     var formData = new FormData();
                     formData.append('userImageAlbum', this.files[0]);
                     uploadAlbumImage(formData);
          });

          /**
           * Wedshoots image handler
           */
          $('#vendor-image-upload').change(function() {
                     var formData = new FormData();
                     formData.append('imageVendor', this.files[0]);
                     uploadVendorImage(formData);
          });

    });


    function addtionalGuest(fname,lname,gender,age_type){
        this.fname = fname;
        this.lname = lname;
        this.gender = gender;
        this.age_type = age_type;
    }

    /*
    * Upload image form data
    * @Page Edit Profile
    */

    function createFormData(image)
    {
        var formImage = new FormData();
        formImage.append('userImage', image[0]);
        uploadProfileImage(formImage);
    }

    /*
    * Handling user profile image
    * @Page Edit Profile
    */

    function uploadProfileImage(formData) {
        var postUrl = GlobalVariables.baseUrl + 'upload_images';
        $('.image-error-msg').html('');
        $.ajax({
                url:postUrl,
                data:formData,
                type: 'POST',
                contentType:false,
                cache: false,
                processData: false,
                success :function(response){
                    if(!response.errorVal){
                        var imageHtml = '<div class="col-md-3"><div class="thumbnail"><img style="height: 253px;width:100%" src="'+GlobalVariables.baseUrl+'public/vendors/'+response.msg+'" alt="Lights"></div></div>';
                        $('.append-image').append(imageHtml);
                        $('.image-error-msg').attr("style", "color: #00aeaf;")
                        $('.image-error-msg').html('Image Uploaded Successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                        $('.image-error-msg').html(errors.userImage);
                }
            });
    }

    /*
    * Handing character in add leads form
    * 
    */
   
    exports.wordCounter = function ( val ){
        var wom = val.match(/\S+/g);
        return {
            charactersNoSpaces : val.replace(/\s+/g, '').length,
            characters         : val.length,
            words              : wom ? wom.length : 0,
            lines              : val.split(/\r*\n/).length
        };
    }

    /*
    * Handing Newsletter
    * @Page footer
    */

    exports.saveNewsletter = function(){
       var emailId = $('#newsletter_email').val();
        $('#newsletter-error').html('');
        if(emailId != undefined){
        var postUrl = GlobalVariables.baseUrl + 'save_newsletter';
        $.ajax({
                url:postUrl,
                data:{'email':emailId},
                type: 'POST',
                success :function(response){
                   $('#newsletter_email').html('');
                   var responseData = JSON.parse(response);
                    if(!responseData.errorVal){
                        $('#newsletter-error').html(responseData.msg);
                    }else{
                         $('#newsletter-error').html(responseData.msg);
                    }
                     $('#newsletter_email').val('');
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                        $('#newsletter-error').html(errors.email);
                }
            });
          }else{
            $('#newsletter-error').html('Invalid Email Address.');
          }
    }

    /*
    * Handing customer id for request enquiry
    * @Page venues, vendor listing
    */

    exports.setRequestForm = function(companyId){
       $('#show-msg').removeClass('alert');
       $('#show-msg').html('');
       $('.l-email,.l-name,.l-phone').css('color','black');
       $('#r-name,#r-email,#r-phone').css('border-bottom','1px solid #e8e8e8');
       //$('.record-details').find('input, textarea').val('');
       $('#r-company_id').val(companyId);
    }

     /*
    * Save request enqury to database.
    * @Page venues, vendor listing
    */
    
    exports.sendRequestForm = function(){
       var name = $('#r-name').val();
       var emailId = $('#r-email').val();
       var phone = $('#r-phone').val();
        var status = true;
        if(name != undefined && name != null)
        {
          var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!nameValidation.test(name))
          {
            status = false; 
            $('.l-name').css('color','red');
            $('#r-name').css('border-bottom','1px solid #F55A5A');
          } else {
            $('.l-name').css('color','black');
            $('#r-name').css('border-bottom','1px solid #e8e8e8');
          }
        }
        if(emailId != undefined && emailId != null)
        {
          var filter = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
          if(!filter.test(emailId)){
            status = false;
            $('.l-email').css('color','red');
             $('#r-email').css('border-bottom','1px solid #F55A5A');
          } 
          else{ $('.l-email').css('color','black');
          $('#r-email').css('border-bottom','1px solid #e8e8e8'); }     
        } 
        if(phone != undefined && phone != null)
        {
          if((phone.length <= 6) || (phone.length >= 16)){
            status = false;
            $('.l-phone').css('color','red');
             $('#r-phone').css('border-bottom','1px solid #F55A5A');
          } 
          else{ $('.l-phone').css('color','black');
          $('#r-phone').css('border-bottom','1px solid #e8e8e8'); }     
        }
        ////////////////////
        
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'request-enquiry';
            var nGuest = $('#r-number_of_guests').val();
            var event_date = $('#r-event_date').val();
            var comment = $('#r-comment').val();
            var company_id = $('#r-company_id').val();
            // var gResponse = $('form[name="frmContactoInline"]').find('')
            $.ajax({
                url:postUrl,
                data:{'name':name,'phone':phone,'email':emailId,'number_of_guests':nGuest,'event_date':event_date,'comment':comment,'company_id':company_id,'g-recaptcha-response':exports.REQUEST_FORM_CAPTCHA_VALUE},
                type: 'POST',
                success :function(response){
                   $('.record-details').find('input, textarea').val('');
                   $('#show-msg').html('');
                   var responseData = JSON.parse(response);
                    if(!responseData.errorVal){
                        $('#show-msg').addClass('alert alert-info');
                        $('#show-msg').html(responseData.msg);
                         window.setTimeout(function(){
                          window.location.reload(true);
                        }, 1000);
                    } else {
                        $('#show-msg').addClass('alert alert-danger');
                        $('#show-msg').html(responseData.msg);
                    }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                        $('#show-msg').html(errors);
                }
            });
        }
    }


    /*
    * RemoveWhish List
    * @Page venues, vendor listing
    */

     exports.removeWishList =  function(companyid,identity){
          var login = GlobalVariables.userLogin;
          if(login=='true'){
             var userId = GlobalVariables.userId;
             var postUrl = GlobalVariables.baseUrl + 'wishlist/remove';
             var companyId = companyid;
              $.ajax({
                url:postUrl,
                data:{'user_id':userId,'company_id':companyId},
                type: 'POST',
                global: false,
                success :function(response){
                   $('#add_'+identity).attr('style','');
                   $('#remove_'+identity).attr('style','display:none;');
                   console.log(response);
                },
                error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                }
            });
          }else{
             $('#myModalLogin').modal('show');
          }
     }

   /*
    * Check user Login or not
    * @Page venues, vendor listing
    */

     exports.checkLogin =  function(companyid,identity){
          var login = GlobalVariables.userLogin;
          if(login=='true'){
             var userId = GlobalVariables.userId;
             var postUrl = GlobalVariables.baseUrl + 'wishlist/store';
             var companyId = companyid;
              $.ajax({
                url:postUrl,
                data:{'user_id':userId,'company_id':companyId},
                type: 'POST',
                global: false,
                success :function(response){
                   $('#remove_'+identity).attr('style','');
                   $('#add_'+identity).attr('style','display:none;');
                   console.log(response);
                },
                error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                }
            });
          }else{
             $('#myModalLogin').modal('show');
          }
     }


   /*
    * Login user via ajax
    * @Page venues, vendor listing
    */

    exports.loginViaPopup = function(){
          var emailAddress =  $('#login-email').val();
          var password =  $('#login-password').val();
          var validation = true;
          if(emailAddress != undefined && emailAddress != null)
          {
            var filter = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(!filter.test(emailAddress)){
              validation = false;
              $('#login-email').css('border-bottom','1px solid #F55A5A');
            } 
            else{ 
              $('#login-email').css('border-bottom','1px solid #e8e8e8'); 
             }     
          } 
          if(password != undefined && password != null)
          {
            if((password.length <= 1) || (password.length >= 50)){
              validation = false;
              $('#login-password').css('border-bottom','1px solid #F55A5A');
            } 
            else{ 
              $('#login-password').css('border-bottom','1px solid #e8e8e8');      
            }   
          }

        if(validation){
           var postUrl = GlobalVariables.baseUrl + 'login';
           $.ajax({
                url:postUrl,
                data:{'email':emailAddress,'password':password},
                type: 'POST',
                success :function(response){
                   $('.record-details').find('input').val('');
                   location.reload();
                },error: function(data){
                        var errors = data.responseJSON;
                        $('#login-msg').addClass('alert alert-danger');
                        $('#login-msg').html(errors.email);
                }
            });
 
        }

    }

    /*
    * Handle slider page search form
    *
    */

    exports.SearchForm = function(){
        /*var catSlug =  $('.handler-cat_slug').find(":selected").val();
        var location =  $('.handler-location').find(":selected").val();*/
        var catSlug  = $('.selectWedVals.selected').data('value');
        var location = $('.selectLocVals.selected').data('value');
        if(catSlug != undefined && catSlug!='' ){
            var redirectUrl = GlobalVariables.baseUrl + 'search/' + catSlug;
            if(location != undefined && location !=''){
                redirectUrl += '/' +location;
            }
            window.location.href = redirectUrl;
        } else {
            $('#myModalWarning').modal('show');
        }
    }

   
   /*
    * Showing crop model
    * @Page dashboard
    */

     exports.showCropModel =  function(uesrType,title){
        $('#myModalLabelCrop').html(title);
        $('#user_type_crop').val(uesrType);
        $('#myModalCrop').modal('show');
     }
 
    /*
    * Make gender selection
    * @Page dashboard popup
    */

     exports.myWeddingGender =  function(obj){
         $('.my-gender-select').css('border','1px solid #D9D9D9');
         $('.my-gender-select').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).attr('data-gender');
         $('#gender').val(genderVal);
     }

       /*
    * Make gender selection
    * @Page dashboard popup
    */

     exports.myWeddingGenderPro =  function(obj){
         $('.my-gender-select-pro').css('border','1px solid #D9D9D9');
         $('.my-gender-select-pro').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).attr('data-gender');
         $('#my_gender_pro').val(genderVal);
     }

     /*
    * Make partner gender selection
    * @Page dashboard popup
    */

     exports.myWeddingPartnerGender =  function(obj){
         $('.my-partner-gender-select').css('border','1px solid #D9D9D9');
         $('.my-partner-gender-select').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).attr('data-gender');
         $('#partner_gender').val(genderVal);
     }

      /*
    * Make partner gender selection
    * @Page dashboard popup
    */

     exports.myWeddingPartnerGenderPro =  function(obj){
         $('.my-partner-gender-select-pro').css('border','1px solid #D9D9D9');
         $('.my-partner-gender-select-pro').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).attr('data-gender');
         $('#partner_gender_pro').val(genderVal);
     }

   

    /*
    * Get Venues data selection
    * @Page dashboard popup
    */

     exports.getVanuesData =  function(obj){
         var searchVenues = $(obj).val();
         if(searchVenues){
            var postUrl = GlobalVariables.baseUrl + 'get_venues_list';
            $.ajax({
                url:postUrl,
                data:{'search_venues':searchVenues},
                type: 'POST',
                global: false, 
                success :function(response){
                  if(response.length){
                      var htmlVal = '';
                      $.each(response, function(key,values) {
                         htmlVal += '<li class="nav-main-list-item pure-u-1-1" onclick="Frontend.setSelectedVenues(this)" data-val="'+values.business_name_slug+'" show-val="'+values.business_name+'"><a class="nav-main-list-link droplayer-tools-icon tasklist" href="#">'+values.business_name+', '+ values.province +'</a></li>';
                      });
                      $('.search-venues-list').html(htmlVal);
                      $('.app-suggest-vendor-div-default').removeClass('hide');
                  }else{
                    $('.app-suggest-vendor-div-default').addClass('hide');
                  }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                }
            });
        }else{
          $('.app-suggest-vendor-div-default').addClass('hide');
        }
     }


    /*
    * Set selected venues data
    * @Page dashboard Edit Popup
    */
   
     exports.setSelectedVenues = function(obj){
         var getNameSlug = $(obj).attr('data-val');
         var getName = $(obj).attr('show-val');
         $('.app-suggest-vendor-div-default').addClass('hide');
         $('#venues_slug_data_show').val(getName);
         $('#venues_slug_data').val(getNameSlug);
         $('#venues_slug_data_show_pro').val(getName);
         $('#venues_slug_data_pro').val(getNameSlug);
         return true;
     }


    /*
    * Save my wedding popup data.
    * @Page dashboard Edit Popup
    */

    exports.saveMyWeddingData = function(){
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var emails = $('#emails').val();
      var partner_firstname = $('#partner_firstname').val();
      var partner_lastname = $('#partner_lastname').val();
      var partner_email = $('#partner_email').val();
       // var name = $('#my_name').val();
       // var partner_name = $('#partner_name').val();
       var gender = $('#gender').val();
       var partner_gender = $('#partner_gender').val();
       // var venues = $('#venues_slug_data_pro').val();
       var venues = $('#venues_slug_data_show').val();
       // var wedding_date = $('#my_wedding_date').val();
       var wedding_date = $('#wedding_date').val();
       var status = true;
        if(firstname != undefined && firstname != null)
        {     
          var firstnameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!firstnameValidation.test(firstname))
          {
            status = false; 
            $('#firstname').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#firstname').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(partner_firstname != undefined && partner_firstname != null)
        {     
          var partner_firstnameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!partner_firstnameValidation.test(partner_firstname))
          {
            status = false; 
            $('#partner_firstname').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#partner_firstname').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(lastname != undefined && lastname != null)
        {     
          var lastnameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!lastnameValidation.test(lastname))
          {
            status = false; 
            $('#lastname').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#lastname').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(partner_lastname != undefined && partner_lastname != null)
        {     
          var partner_lastnameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!partner_lastnameValidation.test(partner_lastname))
          {
            status = false; 
            $('#partner_lastname').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#partner_lastname').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(emails != undefined && emails != null)
        {     
          var emailValidation = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!emailValidation.test(emails))
          {
            status = false; 
            $('#emails').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#emails').css('border-bottom','1px solid #e8e8e8');
           }
        }

       if(gender != undefined && gender != null)
        {     
          if(gender)
          {
            $('.my-gender-select').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('.my-gender-select').css('border','1px solid #F55A5A');
           }
        }

         if(partner_gender != undefined && partner_gender != null)
        {     
          if(partner_gender)
          {
            $('.my-partner-gender-select').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('.my-partner-gender-select').css('border','1px solid #F55A5A');
           }
        }
        ////////////////////
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'save_my_wedding_data';
            $.ajax({
                url:postUrl,
                data:{'firstname':firstname,'partner_firstname':partner_firstname,'lastname':lastname,'partner_lastname':partner_lastname,'emails':emails,'partner_email':partner_email,'gender':gender,'partner_gender':partner_gender,'wedding_date':wedding_date,'venues':venues},
                type: 'POST',
                success :function(response){
                    $('#show-msg-wedding').html('');
                    $('#show-msg-wedding').css('color','#90caa4');
                    $('#show-msg-wedding').html(response.msg+ ' Please Wait..');
                    window.location.reload();
                },error: function(data){
                    $('#show-msg-wedding').css('color','red');
                    $('#show-msg-wedding').html('Something went wrong please try again.');
                }
            });
        }
    }
/*
    * Save my wedding popup data.
    * @Page dashboard Edit Popup
    */

    exports.saveMyWeddingPromoData = function(){
       var name = $('#my_name_pro').val();
       var partner_name = $('#partner_name_pro').val();
       var gender = $('#my_gender_pro').val();
       var partner_gender = $('#partner_gender_pro').val();
       var venues = $('#venues_slug_data_pro').val();
       var wedding_date = $('#my_wedding_date_pro').val();
       var status = true;
        if(name != undefined && name != null)
        {     
          var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!nameValidation.test(name))
          {
            status = false; 
            $('#my_name_pro').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#my_name_pro').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(partner_name != undefined && partner_name != null)
        {     
          var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!nameValidation.test(partner_name))
          {
            status = false; 
            $('#partner_name_pro').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#partner_name_pro').css('border-bottom','1px solid #e8e8e8');
           }
        }

       if(gender != undefined && gender != null)
        {     
          if(gender)
          {
            $('.my-gender-select-pro').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('.my-gender-select-pro').css('border','1px solid #F55A5A');
           }
        }

         if(partner_gender != undefined && partner_gender != null)
        {     
          if(partner_gender)
          {
            $('.my-partner-gender-select-pro').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('.my-partner-gender-select-pro').css('border','1px solid #F55A5A');
           }
        }
        ////////////////////
        
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'save_my_wedding_data';
            $.ajax({
                url:postUrl,
                data:{'name':name,'partner_name':partner_name,'gender':gender,'partner_gender':partner_gender,'wedding_date':wedding_date,'venues':venues},
                type: 'POST',
                success :function(response){
                    $('#show-msg-wedding-pro').html('');
                    $('#show-msg-wedding-pro').css('color','#90caa4');
                    $('#show-msg-wedding-pro').html(response.msg+ ' Please Wait..');
                    window.location.href = GlobalVariables.baseUrl + 'tools/my-wedding';
                },error: function(data){
                    $('#show-msg-wedding-pro').css('color','red');
                    $('#show-msg-wedding-pro').html('Something went wrong please try again.');
                }
            });
        }
    }

     /*
    * Get Vendor data selection
    * @Page dashboard popup
    */

     exports.getVendorsData =  function(obj){
         var searchVenues = $(obj).val();
         var catId = $('#search_cat_id').val();
           if(searchVenues){
              var postUrl = GlobalVariables.baseUrl + 'get_vendor_list';
           }else{
              var postUrl = GlobalVariables.baseUrl + 'get_vendor_list_full';
           }
            $.ajax({
                url:postUrl,
                data:{'search_venues':searchVenues,'cat_id':catId},
                type: 'POST',
                global: false, 
                success :function(response){
                  if(response.length){
                      var htmlVal = '';
                      $.each(response, function(key,values) {
                         htmlVal += '<li class="nav-main-list-item pure-u-1-1" onclick="Frontend.setSelectedVendor(this)" data-val="'+values.vendor_id+'" show-val="'+values.business_name+'"><a style="padding:15px 0px;" class="nav-main-list-link droplayer-tools-icon tasklist" href="#service-wedding">'+values.business_name+', '+ values.province +'</a></li>';
                      });
                      $('.no-match').addClass('hide');
                      $('.search-vendor-list').html(htmlVal);
                      $('.vendor-suggest-list').removeClass('hide');
                  }else{
                    $('.no-match').removeClass('hide');
                    $('.vendor-suggest-list').addClass('hide');
                    $('.app-addvendor-footer').addClass('dnone');
                  }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                }
            });
     }

    /*
    * Set selected vendor data
    * @Page dashboard Edit Popup
    */
   
     exports.setSelectedVendor = function(obj){
         var getNameSlug = $(obj).attr('data-val');
         var getName = $(obj).attr('show-val');
         $('.vendor-suggest-list').addClass('hide');
         $('#vendor_search_data_show').val(getName);
         $('#vendor_search_data').val(getNameSlug);
         $('.app-addvendor-footer').removeClass('dnone');
         return true;
     }

    /*
    * Make vendor hire or not selection
    * @Page vendor add popup
    */

    exports.vendorHiredOrNot =  function(obj){
         $('.app-switch-vendor-item').removeClass('search-active');
         $('.modal-vendors-switch-right').css('background','#fff');
         $('.modal-vendors-switch-right').css('font-weight','400');
         $('.modal-vendors-switch-right').css('color','#666');
         $(obj).addClass('search-active');         
         var isHireVal = $(obj).attr('data-switch-item');
         $('#vendor_hired').val(isHireVal);
    }

   /*
    * Make vendor hire or not selection
    * @Page vendor add popup
    */

    exports.setTaskHandler =  function(obj){
        var taskId = $(obj).attr('data-id');
        var taskOper = $(obj).attr('data-oper');
        if(taskOper == 'complete'){
           $('.task-complete-'+taskId).addClass('hide');
           $('.task-pending-'+taskId).removeClass('hide');
           $('.task-line-'+taskId).removeClass('complete');
           $('.task-line-'+taskId).addClass('pending');
        }else if(taskOper == 'pending'){
           $('.task-pending-'+taskId).addClass('hide');
           $('.task-complete-'+taskId).removeClass('hide');
           $('.task-line-'+taskId).removeClass('pending');
           $('.task-line-'+taskId).addClass('complete');
        }
        if(taskId != undefined && taskId != ''){
            var postUrl = GlobalVariables.baseUrl + 'save_user_task';
            $.ajax({
                url:postUrl,
                data:{'task_id':taskId,'task_oper':taskOper},
                type: 'POST',
                global: false,
                success :function(response){
                  var selectedStatus = $('ul.customer-class-handler').find('li.current').attr('data-value');
                  if((taskOper =='complete' || taskOper=='pending') && selectedStatus == undefined){
                    // No action required..
                  }else{
                   $('.task-line-'+taskId).addClass('hide');
                  }
                  //////////////// Handle Change Data////////////////
                 // if(taskOper =='complete' || taskOper=='pending'){
                    var completeTask = $('#hold-complete-task').attr('data-value');
                    var totalTask = $('#hold-total-task').attr('data-value');
                    var pendingTask = totalTask - completeTask;
                    var percentTask = $('#hold-percent-task').attr('data-value');
                    if(taskOper =='pending'){
                       completeTask = parseInt(completeTask) + 1;
                       pendingTask = parseInt(pendingTask) - 1;
                    }
                    if(taskOper =='complete'){
                       completeTask = parseInt(completeTask) - 1;
                       pendingTask = parseInt(pendingTask) + 1;
                    }
                    if(taskOper =='delete'){
                       totalTask = parseInt(totalTask) - 1;
                       $('.app-checklist-progressTotal').html(totalTask);
                       var classData = $(obj).closest("li").hasClass('pending');
                       if(classData){
                           pendingTask = parseInt(pendingTask) - 1;
                       }else{
                          completeTask = parseInt(completeTask) - 1;                        
                       }
                    }
                    totalTask = (totalTask > 0)?totalTask:1;
                    percentTask = ( completeTask * 100 ) / totalTask;
                    percentTask = Math.round(percentTask);
                    $('#hold-total-task').attr('data-value',totalTask);
                    $('#hold-percent-task').attr('data-value',percentTask);
                    $('#hold-complete-task').attr('data-value',completeTask);
                    $('.app-checklist-estado-completadas').html(completeTask);
                    $('.app-checklist-progressComplete').html(completeTask);
                    $('.app-checklist-estado-pendientes').html(pendingTask);
                    $('.app-checklist-progress').css('width',percentTask+'%');
                    $('.app-progressTip').html(percentTask+'%');
                //  }
                  ///////////////////////////////////////////////////
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
    }


   /**
     * Convert AJAX exceptions to HTML.
     *
     */
    exports.exceptionsToHtml = function(exceptions) {
        var errorMsg = 'Something went wrong';
        var html = '';
        $.each(exceptions, function(index, exception) {
            html +=   exception['message'];
        });

         $('#error-message').html(html);
         $('#errorModel').modal('show');
    };

    /**
   * AJAX Failure Handler
   *
   * @param {jqXHR} jqxhr
   * @param {String} textStatus
   * @param {Object} errorThrown
   */

    exports.ajaxFailureHandler = function(jqxhr, textStatus, errorThrown) {
        var exceptions = [
            {
                message: 'AJAX Error: ' + errorThrown
            }
        ];
        Frontend.exceptionsToHtml(exceptions)
    };

  /**
   * AJAX Todo Filter Handler
   *
   * @param {obj} span
   */

    exports.todoHandleSearchData = function(obj){
       var dataParam = $(obj).attr('data-param');
       if(dataParam !=undefined && dataParam =='status'){
          $(obj).addClass('hide');
          var catId = $('ul.custom-category-handler').find('li.current').attr('data-value');
          if(catId != undefined){
             $('.category-handler-'+catId).closest("li.pending").removeClass('hide');
             $('.category-handler-'+catId).closest("li.complete").removeClass('hide');
          }else{
            $('.complete').removeClass('hide');
            $('.pending').removeClass('hide');
          }
          $('.current-class-handler').removeClass('current');
       }
       if(dataParam !=undefined && dataParam =='date'){
          $(obj).addClass('hide');
          $('.date-filter-div').removeClass('hide');
          $('.app-filters-period').removeClass('current');
       }
       if(dataParam !=undefined && dataParam =='category'){
          $(obj).addClass('hide');
          $('.app-filters-category').removeClass('current');
          var selectedStatus = $('ul.customer-class-handler').find('li.current').attr('data-value');
          if(selectedStatus != undefined){
            $('.all-category-show').closest("li."+selectedStatus).removeClass('hide');
            //$('.category-handler-'+dateFilterId).closest("li."+selectedStatus).removeClass('hide');
          }else{
            $('.all-category-show').closest("li").removeClass('hide');
            //$('.category-handler-'+dateFilterId).closest("li").removeClass('hide');
          }

       }
    }

 /**
   * AJAX Todo Filter Handler
   *
   * @param {obj} span
   */

    exports.todoFilter = function(obj){
       var dataStatus = $(obj).attr('data-status');
       $('.current-class-handler').removeClass('current');
       $(obj).closest("li").addClass('current');
       $('.custome-search-status').closest("li").removeClass('hide');
       var catId = $('ul.custom-category-handler').find('li.current').attr('data-value');
       if(dataStatus == 'complete'){
            $('.custome-search-status').html('Pending');
            $('.complete').addClass('hide');
            //$('.pending').removeClass('hide');
            if(catId != undefined){
               $('.category-handler-'+catId).closest("li.pending").removeClass('hide');
            }else{
               $('.pending').removeClass('hide');
            }
       }else{
             $('.custome-search-status').html('Complete');
            $('.pending').addClass('hide');
            // $('.complete').removeClass('hide');
             if(catId != undefined){
               $('.category-handler-'+catId).closest("li.complete").removeClass('hide');
             }else{
                $('.complete').removeClass('hide');
             }
       }
    }

   /**
   * Todo Filter Date
   *
   * @param {obj} span
   */

    exports.todoFilterDate = function(obj){
       var dateFilterId = $(obj).attr('date-id');
       var dateText = $(obj).attr('date-text');
       $('.custome-search-date').closest("li").removeClass('hide');
       $('.custome-search-date').html(dateText);
       $('.app-filters-period').removeClass('current');
       $(obj).closest("li").addClass('current');
       $('.date-filter-div').addClass('hide');
       $('.date-filter-'+dateFilterId).removeClass('hide');
    }

     /**
   *  Todo Filter Cats
   *
   * @param {obj} span
   */

    exports.todoFilterCats = function(obj){
       var dateFilterId = $(obj).attr('cat-id');
       var dateText = $(obj).attr('cat-text');
       $('.custome-search-category').closest("li").removeClass('hide');
       $('.custome-search-category').html(dateText);
       $('.app-filters-category').removeClass('current');
       $(obj).closest("li").addClass('current');
       $("body").animate({ scrollTop: 150 }, 1000);
       var selectedStatus = $('ul.customer-class-handler').find('li.current').attr('data-value');
       if(selectedStatus != undefined){
        $('.all-category-show').closest("li."+selectedStatus).addClass('hide');
        $('.category-handler-'+dateFilterId).closest("li."+selectedStatus).removeClass('hide');
       }else{
          $('.all-category-show').closest("li").addClass('hide');
          $('.category-handler-'+dateFilterId).closest("li").removeClass('hide');
       }

    }

   /**
   * Move to vendor list page
   *
   * @param {obj} span
   */

    exports.vendorSearhList = function(obj){
      var moveUrl = $(obj).data('href');
      if(moveUrl != undefined && moveUrl!='' ){
         var redirectUrl = GlobalVariables.baseUrl + moveUrl;
         window.location.href = redirectUrl;
      }else{
         $('#error-message').text('Something went wrong! Please try again.');
         $('#errorModel').modal('show');
      }
    }
    
   /**
   * Vendors search page
   *
   * @param {obj} span
   */

    exports.redirectVendorSearch = function(obj){
      var moveUrl = $(obj).data('href');
      if(moveUrl != undefined && moveUrl!='' ){
         var redirectUrl = GlobalVariables.baseUrl + moveUrl;
         window.location.href = redirectUrl;
         $(obj).addClass('hide');
      }else{
         $('#error-message').text('Something went wrong! Please try again.');
         $('#errorModel').modal('show');
      }
    }
    
   /**
   * Delete saved vendors
   *
   * @param {obj} span
   */

    exports.deleteSavedVendor = function(obj){
      var bookedId = $(obj).data('booked-id');
            BootstrapDialog.confirm(
              {
            title: 'WARNING',
            message: '<p>Are you sure that you want to remove this vendor?</p>',
            type: BootstrapDialog.TYPE_WARNING,
            closable: true, 
            draggable: true, 
            btnCancelLabel: 'Cancel', 
            btnCancelClass: 'btn-flat', 
            btnOKLabel: 'Yes', 
            btnOKClass: 'btn-danger', 
            callback: function(result) {            
               if(result) {   
               window.location.href  =  GlobalVariables.baseUrl+'tools/remove-booked-vendor'+'/'+bookedId;               
              }
            }
        });
    }

  /**
   * Update Note and price for saved vendor
   *
   * @param {obj} span
   */

    exports.saveAddNoteData = function(obj){
      var bookedId = $(obj).data('id');
      var fields = $(obj).data('field');
      var updateData = $(obj).val();
      var postUrl = GlobalVariables.baseUrl + 'tools/udpate_saved_vendor_data';
      $.ajax({
              url:postUrl,
              data:{'id':bookedId,'fields':fields,'data':updateData},
              type: 'POST',
              global: false, 
              success :function(response){
                  console.log(response);
              },error: function(data){
                  var errors = data.responseJSON;
                  console.log(errors);
            }
      });
    }

   /**
   * Update book status for saved vendor
   *
   * @param {obj} span
   */

    exports.updateSavedVendor = function(obj){
      var bookedId = $(obj).data('id');
      var fields = 'book_status';
      var updateData = $(obj).val();
      if(updateData == 6){
         $(obj).addClass('new-reserved');
      }else{
         $(obj).removeClass('new-reserved');
      }
      var postUrl = GlobalVariables.baseUrl + 'tools/udpate_saved_vendor_data';
      $.ajax({
              url:postUrl,
              data:{'id':bookedId,'fields':fields,'data':updateData},
              type: 'POST',
              global: false, 
              success :function(response){
                  console.log(response);
              },error: function(data){
                  var errors = data.responseJSON;
                  console.log(errors);
            }
      });
    }
    
    /**
   * Update Note and price for saved vendor
   *
   * @param {obj} span
   */

    exports.editTodoList = function(obj){
      var bookedId = $(obj).data('id');
      var fields = $(obj).data('field');
      var updateData = $(obj).val();
      var postUrl = GlobalVariables.baseUrl + 'tools/udpate_todo_list';
      $.ajax({
              url:postUrl,
              data:{'id':bookedId,'fields':fields,'data':updateData},
              type: 'POST',
              success :function(response){
                  $('.alert-msg').html('<span class="alert alert-success">Task updated successfully.</span>');
                  //console.log(response);
                  $("html, body").animate({ scrollTop: 135 }, "slow");
              },error: function(data){
                  var errors = data.responseJSON;
                  console.log(errors);
            }
      });
    }

    /*
    * Get Vendor data selection
    * @Page Task Details
    */

     exports.allVendorsData =  function(obj){
            var searchVenues = $(obj).val();
            var postUrl = GlobalVariables.baseUrl + 'all_vendor_list_search';
            $.ajax({
                url:postUrl,
                data:{'search_venues':searchVenues},
                type: 'POST',
                global: false, 
                success :function(response){
                  if(response.length){
                      var htmlVal = '';
                      $.each(response, function(key,values) {
                         htmlVal += '<li class="nav-main-list-item pure-u-1-1" onclick="Frontend.setSelectedVendor(this)" data-val="'+values.vendor_id+'" show-val="'+values.business_name+'"><a style="padding:15px 0px;" class="nav-main-list-link droplayer-tools-icon tasklist" href="#service-wedding">'+values.business_name+', '+ values.province +'</a></li>';
                      });
                      $('.no-match').addClass('hide');
                      $('.search-vendor-list').html(htmlVal);
                      $('.vendor-suggest-list').removeClass('hide');
                  }else{
                    $('.no-match').removeClass('hide');
                    $('.vendor-suggest-list').addClass('hide');
                    $('.app-addvendor-footer').addClass('dnone');
                  }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                }
            });
     }

  /**
   * Delete guest list record
   *
   * @param {obj} span
   */

    exports.deleteGuestList = function(obj){
      var guestId = $(obj).data('id');
            BootstrapDialog.confirm(
              {
            title: 'WARNING',
            message: '<p>Are you sure that you want to remove this guest from list?</p>',
            type: BootstrapDialog.TYPE_WARNING,
            closable: true, 
            draggable: true, 
            btnCancelLabel: 'Cancel', 
            btnCancelClass: 'btn-flat', 
            btnOKLabel: 'Yes', 
            btnOKClass: 'btn-danger', 
            callback: function(result) {            
               if(result) {   
               window.location.href  =  GlobalVariables.baseUrl+'tools/remove-guest'+'/'+guestId;               
              }
            }
        });
    }

    exports.handleTab = function(obj){
       var divId = $(obj).data('step-menu');
       $('.app-tools-guests-layer-section-header').removeClass('active');
       $('.modal-addGuest-section').removeClass('active');
       $(obj).addClass('active');
       $('.addGuest-'+divId).addClass('active');
    }

     /*
    * Make gender selection
    * @Page add guest popup
    */

     exports.addGuestGender =  function(obj){
         $('.select-switcher-section-gender').css('border','1px solid #D9D9D9');
         $('.select-switcher-section-gender').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#guest_gender').val(genderVal);
     }

   /*
    * Make gender selection
    * @Page add guest popup
    */

     exports.addGuestAgeType =  function(obj){
         $('.select-switcher-section-age').css('border','1px solid #D9D9D9');
         $('.select-switcher-section-age').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#age_type').val(genderVal);
     }

   /*
    * Save Data
    * @Page add guest popup
    */

     exports.toolsGuestsLayerSubmit =  function(refresh){
       $('.app-guest-add').addClass('dnone');
       var name = $('#guest_name').val();
       var guest_group = $('#guest_group').val();
       var attendance = $('#attendance').val();
       var guest_menu = $('#guest_menu').val();
       var guest_gender = $('#guest_gender').val();
       var age_type = $('#age_type').val();
       var guest_mail = $('#guest_mail').val();
       var guest_phone = $('#guest_phone').val();
       var guest_city = $('#guest_city').val();
       var guest_country = $('#guest_country').val();
       var guest_address = $('#guest_address').val();
       var guest_postal_code = $('#guest_postal_code').val();
       var status = true;
        if(name != undefined && name != null)
        {     
          var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!nameValidation.test(name))
          {
            status = false; 
            $('#guest_name').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#guest_name').css('border-bottom','1px solid #e8e8e8');
           }
        }

       if(guest_group != undefined && guest_group != null)
        {     
          if(guest_group)
          {
            $('#guest_group').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#guest_group').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(guest_menu != undefined && guest_menu != null)
        {     
          if(guest_menu)
          {
            $('#guest_menu').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#guest_menu').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(attendance != undefined && attendance != null)
        {     
          if(attendance)
          {
            $('#attendance').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#attendance').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/save_guest_data';
            var relatedData = GlobalVariables.dataHandler;
            $.ajax({
                url:postUrl,
                data:{'name':name,'group_id':guest_group,'menu':guest_menu,'gender':guest_gender,
                'age_type':age_type,'mail':guest_mail,'phone':guest_phone,'city':guest_city,'country':guest_country,
                'address':guest_address,'postal_code':guest_postal_code,'attendance':attendance,'relatedData':relatedData},
                type: 'POST',
                success :function(response){
                    $('.app-guest-add').removeClass('dnone alert-danger');
                    $('.app-guest-add').addClass('alert-success');
                    $('.app-guest-add').html('<p>Guest added successfully.</p>');
                    $('#frmToolLayer').find('input, textarea, select').val('');
                    $('.select-switcher-section-gender').removeClass('active');
                    $('.select-switcher-section-age').removeClass('active');
                    $('.app-list-companions-content').html('');
                    GlobalVariables.dataHandler = {};
                    if(refresh){
                      location.reload();
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#addGuestPopup').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
     }

    /*
    * Get Edit Data
    * @Page add guest popup
    */
 
    exports.getEditGuestListData = function(obj){
      $('#frmToolLayerEdit').find('input, textarea, select').val('');
      $('.select-switcher-section-gender-edit').removeClass('active');
      $('.select-switcher-section-age-edit').removeClass('active');
      var guestId = $(obj).data('id');
       var postUrl = GlobalVariables.baseUrl + 'tools/get_guest_data';
            $.ajax({
                url:postUrl,
                data:{'id':guestId},
                type: 'POST',
                global: false,
                dataType: 'JSON',
                success :function(response){
                  var genEdit = response.data[0].gender;
                  var ageEdit = response.data[0].age_type;
                  $('#edit_guest_id').val(response.data[0].id);
                  $('#edit_guest_name').val(response.data[0].name);
                  $('#edit_guest_group').val(response.data[0].group_id);
                  $('#edit_attendance').val(response.data[0].attendance);
                  $('#edit_guest_menu').val(response.data[0].menu);
                  $('#edit_guest_gender').val(response.data[0].gender);
                  $('#edit_age_type').val(response.data[0].age_type);
                  $('#edit_guest_mail').val(response.data[0].email);
                  $('#edit_guest_phone').val(response.data[0].phone);
                  $('#edit_guest_city').val(response.data[0].city);
                  $('#edit_guest_country').val(response.data[0].country);
                  $('#edit_guest_address').val(response.data[0].address);
                  $('#edit_guest_postal_code').val(response.data[0].postal_code);
                  $('.edit-'+genEdit).addClass('active');
                  $('.edit-'+ageEdit).addClass('active');
                  if(response.data[0].gender == 'male'){
                    $('.custom-icon-tools').addClass('icon-tools-men-big');
                  }else{
                    $('.custom-icon-tools').addClass('icon-tools-woman-big');
                  }
                  $('#editGuestPopup').modal('show');
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#editGuestPopup').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
          });
    }

    /*
    * Edit Data
    * @Page add guest popup
    */

     exports.toolsGuestsLayerEdit =  function(refresh){
       var name = $('#edit_guest_name').val();
       var guest_group = $('#edit_guest_group').val();
       var attendance = $('#edit_attendance').val();
       var guest_menu = $('#edit_guest_menu').val();
       var guest_gender = $('#edit_guest_gender').val();
       var age_type = $('#edit_age_type').val();
       var guest_mail = $('#edit_guest_mail').val();
       var guest_phone = $('#edit_guest_phone').val();
       var guest_city = $('#edit_guest_city').val();
       var guest_country = $('#edit_guest_country').val();
       var guest_address = $('#edit_guest_address').val();
       var guest_postal_code = $('#edit_guest_postal_code').val();
       var guest_id = $('#edit_guest_id').val();
       var status = true;
        if(name != undefined && name != null)
        {     
          var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
          if(!nameValidation.test(name))
          {
            status = false; 
            $('#guest_name').css('border-bottom','1px solid #F55A5A');
          }
          else
          { 
            $('#guest_name').css('border-bottom','1px solid #e8e8e8');
           }
        }

       if(guest_group != undefined && guest_group != null)
        {     
          if(guest_group)
          {
            $('#guest_group').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#guest_group').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(guest_menu != undefined && guest_menu != null)
        {     
          if(guest_menu)
          {
            $('#guest_menu').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#guest_menu').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(attendance != undefined && attendance != null)
        {     
          if(attendance)
          {
            $('#attendance').css('border-bottom','1px solid #e8e8e8');
          }
          else
          {
            status = false; 
            $('#attendance').css('border-bottom','1px solid #F55A5A');
           }
        }

        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/edit_guest_data';
            $.ajax({
                url:postUrl,
                data:{'name':name,'group_id':guest_group,'menu':guest_menu,'gender':guest_gender,
                'age_type':age_type,'mail':guest_mail,'phone':guest_phone,'city':guest_city,'country':guest_country,
                'address':guest_address,'postal_code':guest_postal_code,'attendance':attendance,'guest_id':guest_id},
                type: 'POST',
                success :function(response){
                    $('.app-guest-add').removeClass('dnone alert-danger');
                    $('.app-guest-add').addClass('alert-success');
                    $('.app-guest-add').html('<p>Guest update successfully.</p>');
                    $('#frmToolLayer').find('input, textarea, select').val('');
                    if(refresh){
                      location.reload();
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#editGuestPopup').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
     }

      /*
    * Make gender selection
    * @Page edit guest popup
    */

     exports.addGuestGenderEdit =  function(obj){
         $('.select-switcher-section-gender-edit').css('border','1px solid #D9D9D9');
         $('.select-switcher-section-gender-edit').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#edit_guest_gender').val(genderVal);
     }

   /*
    * Make gender selection
    * @Page edit guest popup
    */

     exports.addGuestAgeTypeEdit =  function(obj){
         $('.select-switcher-section-age-edit').css('border','1px solid #D9D9D9');
         $('.select-switcher-section-age-edit').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#edit_age_type').val(genderVal);
     }


   /*
    * Change tab section
    * @Page Budget
    */

     exports.showCategoryBudget =  function(obj){
         $('.budget-categories-item').removeClass('current');
         var catId = $(obj).data('category-id');
         $(obj).addClass('current');
         $('.budget-summary').addClass('dnone');
         $('.budget-categDetail').removeClass('dnone');
     }

  /**
   * Delete Budget
   *
   * @param {obj} span
   */

    exports.deleteBudgetData = function(obj){
      var catId = $(obj).data('category-id');
            BootstrapDialog.confirm(
              {
            title: 'WARNING',
            message: '<p>Are you sure that you want to remove this from budget?</p>',
            type: BootstrapDialog.TYPE_WARNING,
            closable: true, 
            draggable: true, 
            btnCancelLabel: 'Cancel', 
            btnCancelClass: 'btn-flat', 
            btnOKLabel: 'Yes', 
            btnOKClass: 'btn-danger', 
            callback: function(result) {            
               if(result) {   
               window.location.href  =  GlobalVariables.baseUrl+'tools/remove-budget'+'/'+catId;               
              }
            }
        });
    }

     /*
    * Showing add budget model
    * @Budget category
    */

     exports.showAddBudgetPopup =  function(obj){
        var parentId = $(obj).data('parent-id');
        var taskId = $(obj).data('task-id');
        if(taskId!= undefined && taskId !=''){
           $('#current_task_id').val(taskId);
        }
        $('#current_budget_cat_id').val(parentId);
        $('#addBudgetPopup').modal('show');  
     }

     /*
    * Save Budget expense
    * @Page add budget popup
    */

     exports.toolsBudgetLayerSubmit =  function(refresh){
       $('.app-budget-add').addClass('dnone');
       var concept = $('#popup_concept').val();
       var estimate_budget = $('#popup_estimate_budget').val();
       var final_cost = $('#popup_final_cost').val();
       var catId = $('#current_budget_cat_id').val();
       var taskId = $('#current_task_id').val();
      
       var status = true;
        if(concept != undefined && concept != null)
        {     
          if(concept)
          {
            $('#popup_concept').css('border-bottom','1px solid #e8e8e8');
          }
          else
          { 
            status = false; 
            $('#popup_concept').css('border-bottom','1px solid #F55A5A');
           }
        }

       if(estimate_budget != undefined && estimate_budget != null)
        {     
          var moneyValidation = /^\$?[0-9][0-9\,]*(\.\d{1,2})?$|^\$?[\.]([\d][\d]?)$/
          if(!moneyValidation.test(estimate_budget))
          {
            status = false; 
            $('#popup_estimate_budget').css('border-bottom','1px solid #F55A5A');
          }
          else
          {
            $('#popup_estimate_budget').css('border-bottom','1px solid #e8e8e8');
           }
        }

        if(final_cost != undefined && final_cost != null)
        {     
          var moneyValidation2 = /^\$?[0-9][0-9\,]*(\.\d{1,2})?$|^\$?[\.]([\d][\d]?)$/
          if(!moneyValidation2.test(final_cost))
          {
            status = false; 
            $('#popup_final_cost').css('border-bottom','1px solid #F55A5A');
          }
          else
          {
            $('#popup_final_cost').css('border-bottom','1px solid #e8e8e8');
           }
        }
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/save_budget_data';
            $.ajax({
                url:postUrl,
                data:{'concept':concept,'estimate_budget':estimate_budget,'final_cost':final_cost,'cat_id':catId,'task_id':taskId},
                type: 'POST',
                success :function(response){
                    if(refresh){
                      $('.app-budget-add').removeClass('dnone alert-danger');
                      $('.app-budget-add').addClass('alert-success');
                      $('.app-budget-add').html('<p>Expense added successfully.</p>');
                       window.setTimeout(function(){location.reload()},2500);
                    }else{
                      $('.app-budget-add').removeClass('dnone alert-danger');
                      $('.app-budget-add').addClass('alert-success');
                      $('.app-budget-add').html('<p>Expense added successfully.</p>');
                      $('#popup_concept').val('');
                      $('#popup_final_cost').val('');
                      $('#popup_estimate_budget').val('');
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#addBudgetPopup').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
     }

    /*
    * Update Budget Data
    * @Budget category
    */

     exports.updateBudgetData =  function(obj){
        var budgetId = $(obj).data('budget-id');
        var fieldVal = $(obj).data('field');
        var currentVal = $(obj).data('val');
        var newValue = $(obj).val();
        var status = true;
        if(fieldVal == 'concept'){
           if(newValue){ $(obj).css('border-bottom','1px solid #e8e8e8'); }
           else{ status = false; $(obj).css('border-bottom','1px solid #F55A5A'); }
        }else if(fieldVal == 'estimate_budget'){
          var moneyValidation = /^\$?[0-9][0-9\,]*(\.\d{1,2})?$|^\$?[\.]([\d][\d]?)$/
          if(!moneyValidation.test(newValue)){status = false; $(obj).css('border-bottom','1px solid #F55A5A'); }
          else{ $(obj).css('border-bottom','1px solid #e8e8e8'); }
        }else if(fieldVal == 'final_cost'){
          var moneyValidation1 = /^\$?[0-9][0-9\,]*(\.\d{1,2})?$|^\$?[\.]([\d][\d]?)$/
          if(!moneyValidation1.test(newValue)){status = false; $(obj).css('border-bottom','1px solid #F55A5A'); }
          else{ $(obj).css('border-bottom','1px solid #e8e8e8');  }
        }

        /////////////////////////////
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/edit_budget_data';
            $.ajax({
                url:postUrl,
                data:{'id':budgetId,'field':fieldVal,'value':newValue},
                type: 'POST',
                global:false,
                success :function(response){
                  if(fieldVal == 'estimate_budget'){
                      var totalEstimate = $('#total_estimate_value').val();
                      if(totalEstimate !=''){ totalEstimate = totalEstimate.replace(/\,/g,''); }
                      if(currentVal !=''){ currentVal = currentVal.replace(/\,/g,''); }
                      if(newValue !=''){ newValue = newValue.replace(/\,/g,''); }
                      totalEstimate = totalEstimate - currentVal;
                      totalEstimate = parseInt(totalEstimate) + parseInt(newValue);
                      $(obj).data('val',newValue);
                      $(obj).attr('value',newValue);
                      $('#total_estimate_value').val(commaSeparateNumber(totalEstimate));
                      $('.estimated-cost-new').html(commaSeparateNumber(totalEstimate));
                  }
                  if(fieldVal == 'final_cost'){
                      var totalFinal = $('#total_final_value').val();
                      if(totalFinal !=''){ totalFinal = totalFinal.replace(/\,/g,''); }
                      if(currentVal !=''){ currentVal = currentVal.replace(/\,/g,''); }
                      if(newValue !=''){ newValue = newValue.replace(/\,/g,''); }
                      totalFinal = totalFinal - currentVal;
                      totalFinal = parseInt(totalFinal) + parseInt(newValue);
                      $(obj).data('val',newValue);
                      $(obj).attr('value',newValue);
                      $('#total_final_value').val(commaSeparateNumber(totalFinal));
                      $('.app-budget-final-cost').html(commaSeparateNumber(totalFinal));
                  }
                  console.log(response);
                  //$('#app-error').html('data added');
                },error: function(jqxhr, textStatus, errorThrown){
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
        /////////////////////////////
     }
    

    function commaSeparateNumber(val){
      while (/(\d+)(\d{3})/.test(val.toString())){
        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
      }
      return val;
    }

     exports.addBudgetPayment =  function(obj){
         var budgetId = $(obj).data('budget-id');
         var field = $(obj).data('field');
         var amount = $(obj).data('amount');
         var date = $(obj).data('date');
         var paidBy = $(obj).data('paid-by');
         var concept = $(obj).data('concept');
         if(field=='paid'){
           $('#check').prop('checked',true);
         }else{
            $('#check').prop('checked',false);
         }
         $('#app-budget-inputamount').val(amount);
         $('#paid_date').val(date);
         $('.msg-show-payment').html(concept);
         $('#paid_by').val(paidBy);
         $('#payment_budget_id').val(budgetId);
         $('#addBudgetPaymentPopup').modal('show');
     }

    /**
     * Website is not created 
     *
     */

    exports.websiteNotFound = function(msg) {
         $('#error-message').html(msg);
         $('#errorModel').modal('show');
    };

     /**
     * Copy text
     *
     */

    exports.copyText = function(obj) {
        $(obj).html('Link copied!');
    };


    /*
    * Upload image form data
    * @Page Album
    */

    function createFormDataAlbum(image)
    {
        var formImage = new FormData();
        formImage.append('userImageAlbum', image[0]);
        uploadAlbumImage(formImage);
    }

    /*
    * Upload image form data
    * @Page Album
    */

    function uploadAlbumImage(formData) {
        var postUrl = GlobalVariables.baseUrl + 'tools/upload_album_images';
        $('.image-error-msg').html('');
        $.ajax({
                url:postUrl,
                data:formData,
                type: 'POST',
                contentType:false,
                cache: false,
                processData: false,
                success :function(response){
                    if(!response.errorVal){
                        var imageHtml = '<div class="col-sm-4 mb30 image-webshoots" id="webshoot_image_'+response.id+'"> <img style="width:100%" src="'+response.msg+'" alt="Lights"> <div class="budget-spending-item-cells b-text-white col-sm-8"><span class="icon-tools icon-left icon-tools-plus-circle-outline link pointer app-add-spending" data-title="Cake Title" data-note="Cake description here." data-id="'+response.id+'" onclick="Frontend.AddAlbumImageNote(this)">Add Note</span></div><div class="budget-spending-item-cells col-sm-2"></div><div class="budget-spending-item-cells col-sm-2"><i class="fa fa-trash text-red trash-icon" data-id="'+response.id+'" onclick="Frontend.DeleteAlbumImage(this)"></i></div></div>';
                        $('.add-images-via').append(imageHtml);
                        $('.image-error-msg').attr("style", "background-color: #00aeaf;font-size: 13px;margin-top: 10px;color: #fff;padding: 5px;")
                        $('.image-error-msg').html('Image Uploaded Successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }
                },error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                        $('.image-error-msg').html(errors.userImageAlbum);
                }
            });
    }

     /*
    * Delete image form album
    * @Page Album
    */
    
    exports.DeleteAlbumImage =  function(obj){
        var postUrl = GlobalVariables.baseUrl + 'tools/delete_album_images';
        var imageId = $(obj).data('id');
        $.ajax({
                url:postUrl,
                data:{'id':imageId},
                type: 'POST',
                success :function(response){
                    if(!response.errorVal){
                        $('#webshoot_image_'+imageId).remove();
                        $('.image-error-msg').html('Image Delete Successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }

     /*
    * Showing add note on album images
    * @webshoots page
    */

     exports.AddAlbumImageNote =  function(obj){
        var imageId = $(obj).data('id');
        $('#id_user_album_image').val(imageId);
        $('#popup_album_image_title').val($(obj).data('title'));
        $('#popup_album_image_note').val($(obj).data('note'));
        $('.app-album-image-note').html('');
        $('#addAlbumImageNote').modal('show');
     }

        /*
    * Save note data on image
    * @Page add budget popup
    */

     exports.SaveAlbumImageNote =  function(refresh){
       var id = $('#id_user_album_image').val();
       var title = $('#popup_album_image_title').val();
       var note = $('#popup_album_image_note').val();
       var status = true;
       if(title != undefined && title != null)
        {     
          if(title)
          {
            $('#popup_album_image_title').css('border-bottom','1px solid #e8e8e8');
          }
          else
          { 
            status = false; 
            $('#popup_album_image_title').css('border-bottom','1px solid #F55A5A');
           }
        }
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/save_album_image_note';
            $.ajax({
                url:postUrl,
                data:{'title':title,'note':note,'id':id},
                type: 'POST',
                success :function(response){
                      $('.app-album-image-note').html('<p style="color:#3C763D;padding: 5px 30px;font-weight: 600;">Memory has been updated successfully.</p>');
                      location.reload();
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#addAlbumImageNote').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
     }


     /*
    * Showing add total estimate budget model
    * @Budget category
    */

     exports.showAddEstimateBudgetPopup =  function(obj){
        var TotalEstimate = $(obj).data('total-estimate');
        $('#popup_total_estimate_budget').val(TotalEstimate);
        $('#addEstimateBudgetPopup').modal('show');
     }

      /*
    * Save Total Estimated Budget expense
    * @Page add budget popup
    */

     exports.toolsTotalBudgetLayerSubmit =  function(refresh){
       var estimate_budget = $('#popup_total_estimate_budget').val();
       var status = true;
       if(estimate_budget != undefined && estimate_budget != null)
        {     
          var moneyValidation = /^\$?[0-9][0-9\,]*(\.\d{1,2})?$|^\$?[\.]([\d][\d]?)$/
          if(!moneyValidation.test(estimate_budget))
          {
            status = false; 
            $('#popup_total_estimate_budget').css('border-bottom','1px solid #F55A5A');
          }
          else
          {
            $('#popup_total_estimate_budget').css('border-bottom','1px solid #e8e8e8');
           }
        }
        if(status){
            var postUrl = GlobalVariables.baseUrl + 'tools/save_total_estimate_budget_data';
            var userId = GlobalVariables.userId;
            $.ajax({
                url:postUrl,
                data:{'estimate_budget':estimate_budget,'user_id':userId},
                type: 'POST',
                success :function(response){
                    if(refresh){
                      $('.app-total-budget-add').removeClass('dnone alert-danger');
                      $('.app-total-budget-add').html('<p style="color:#3C763D;">Budget added successfully.</p>');
                      location.reload();
                    }else{
                      $('.app-total-budget-add').removeClass('dnone alert-danger');
                      $('.app-total-budget-add').html('<p style="color:#3C763D;">Budget added successfully.</p>');
                      $('#popup_total_estimate_budget').val('');
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                   $('#addEstimateBudgetPopup').modal('hide');
                   Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
        }
     }

    /*
    * Show Todo list form
    * @Page Todo List
    */

     exports.hideShowTodoListForm =  function(){
        $('.app-container-newTask-form-handlar').toggle();
        $(".app-container-newTask-form-handlar").removeClass("hidden");
         $(".app-newTask-title").focus();
     }

     /*
    * Make gender selection for additional guest
    * @Page add guest popup
    */

     exports.addAdditionalGuestGender =  function(obj){
         $('.additional-guest-gender').css('border','1px solid #D9D9D9');
         $('.additional-guest-gender').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#additionalg_gender').val(genderVal);
     }

    /*
    * Make additionalgestType selection
    * @Page edit guest popup
    */

    exports.addAdditionalGuestAgeTypeEdit =  function(obj){
         $('.additional-guest-age-type').css('border','1px solid #D9D9D9');
         $('.additional-guest-age-type').removeClass('active');
         $(obj).addClass('active');
         $(obj).css('border','1px solid #dec9c0');
         var genderVal = $(obj).data('selected');
         $('#additionalg_age_type').val(genderVal);
     }

    /*
    * Hold additional guests data
    * @Page edit guest popup
    */

    exports.addAdditionalGuests = function(){
      var fname = $('#additionalg_first_name').val();
      var lname = $('#additionalg_last_name').val();
      var guest_gender = $('#additionalg_gender').val();
      var age_type = $('#additionalg_age_type').val();
      var status = true;
      if(fname != undefined && fname != null)
      {     
        var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
        if(!nameValidation.test(fname))
        {
          status = false; 
          $('#additionalg_first_name').css('border-bottom','1px solid #F55A5A');
        }
        else
        { 
          $('#additionalg_first_name').css('border-bottom','1px solid #e8e8e8');
         }
      }

      /* if(lname != undefined && lname != null)
      {     
        var nameValidation = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
        if(!nameValidation.test(lname))
        {
          status = false; 
          $('#additionalg_last_name').css('border-bottom','1px solid #F55A5A');
        }
        else
        { 
          $('#additionalg_last_name').css('border-bottom','1px solid #e8e8e8');
         }
      }*/

      if(status){
        var icon = '';
        var getCounter = GlobalVariables.counter;
        var guest = new addtionalGuest(fname,lname,guest_gender,age_type);
        GlobalVariables.dataHandler[getCounter] = guest; 
        GlobalVariables.counter = parseInt(getCounter) + 1;
        $('#additionalg_first_name').val('');
        $('#additionalg_last_name').val('');
        $('#additionalg_gender').val('male');
        $('#additionalg_age_type').val('adult');
        $('.app-list-companions-container').removeClass('hide');
        $('.additional-guest-age-type').removeClass('active');
        $('.additional-guest-gender').removeClass('active');
        if(age_type == 'adult'){ var icon = (guest_gender =='female')?'bride':'groom'; }
        if(age_type == 'children'){ var icon = (guest_gender =='female')?'girl':'boy'; }
        if(age_type == 'baby'){ var icon = 'child'; }
        $('.app-list-companions-content').append('<div class="pure-u-1-3 app-tools-guest-acompanante" data-idcontact="5189003"><div class="unit"><i class="icon-tools icon-tools-'+icon+'"></i><p>'+fname+' '+lname+'</p></div></div>');
      }

  }

    /*
    * Upload image form data
    * @Page Album
    */

    function uploadVendorImage(formData) {
        var postUrl = GlobalVariables.baseUrl + 'upload_vendor_images';
        $('.image-error-msg').html('');
        $.ajax({
                url:postUrl,
                data:formData,
                type: 'POST',
                contentType:false,
                cache: false,
                processData: false,
                success :function(response){
                    if(!response.errorVal){
                        var imageHtml = '<div class="col-sm-4 mb30 image-vendor" id="vendor_image_'+response.id+'"> <img style="width:100%" src="'+GlobalVariables.baseUrl+'/public/vendors/'+response.msg+'" alt="Lights"> <div class="budget-spending-item-cells b-text-white col-sm-8"><span class="icon-tools icon-left icon-tools-plus-circle-outline link pointer app-add-spending" data-title="Cake Title" data-note="Cake description here." data-id="'+response.id+'" onclick="Frontend.SetAsProfileImageVendor(this)">Set As Profile Image</span></div><div class="budget-spending-item-cells col-sm-2"></div><div class="budget-spending-item-cells col-sm-2"><i class="fa fa-trash text-red trash-icon" data-id="'+response.id+'" onclick="Frontend.DeleteVendorImage(this)"></i></div></div>';
                        $('.add-images-via').append(imageHtml);
                        $('.image-error-msg').attr("style", "background-color: #00aeaf;font-size: 13px;margin-top: 10px;color: #fff;padding: 5px;")
                        $('.image-error-msg').html('Image Uploaded Successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }

     /*
    * Delete image form album
    * @Page Album
    */
    
    exports.DeleteVendorImage =  function(obj){
        var postUrl = GlobalVariables.baseUrl + 'delete_vendor_images';
        var imageId = $(obj).data('id');
        $.ajax({
                url:postUrl,
                data:{'id':imageId},
                type: 'POST',
                success :function(response){
                    if(!response.errorVal){
                        $('#vendor_image_'+imageId).remove();
                        $('.image-error-msg').html('Image Delete Successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }
  /*
    * set image as profile for vendor
    * @Page Album
    */
    
    exports.SetAsProfileImageVendor =  function(obj){
        var postUrl = GlobalVariables.baseUrl + 'set_as_profile_image';
        var imageId = $(obj).data('id');
        $.ajax({
                url:postUrl,
                data:{'id':imageId},
                type: 'POST',
                success :function(response){
                   /* if(!response.errorVal){
                        $('.image-error-msg').html('Profile image set successfully.');
                    }else{
                         $('.image-error-msg').html(response.msg);
                    }*/
                    window.location.href  =  GlobalVariables.baseUrl+'/image-settings';
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }

    /*
    * Uddate Vendor questions
    * @Page vendor questions
    */
    
    exports.updateVendorQuestions =  function(obj){
        var postUrl = GlobalVariables.baseUrl + 'update_vendor_questions';
        var id = $(obj).data('qsid');
        var value = $(obj).val();
        $.ajax({
                url:postUrl,
                data:{'id':id,'value':value},
                type: 'POST',
                success :function(response){
                    if(!response.errorVal){
                        $('.question-error-msg').html('<div class="alert alert-success">'+response.msg+'</div>');
                    }else{
                         $('.question-error-msg').html('<div class="alert alert-danger">'+response.msg+'</div>');
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }

    /*
    * Uddate Checkbox Questions
    * @Page vendor questions
    */

    exports.updateVendorCheckboxQuestions =  function(obj){
        var postUrl = GlobalVariables.baseUrl + 'update_vendor_questions';
        var id = $(obj).data('qsid');
        var name = $(obj).data('name');
        var holdArray = [];
        $("input[name='"+name+"[]']:checkbox:checked").each( function () {
            holdArray.push($(this).val());
        });
        $.ajax({
                url:postUrl,
                data:{'id':id,'value':holdArray.join()},
                type: 'POST',
                success :function(response){
                    if(!response.errorVal){
                        $('.question-error-msg').html('<div class="alert alert-success">'+response.msg+'</div>');
                    }else{
                         $('.question-error-msg').html('<div class="alert alert-danger">'+response.msg+'</div>');
                    }
                },error: function(jqxhr, textStatus, errorThrown){
                  Frontend.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                }
            });
    }


})(window.Frontend);

