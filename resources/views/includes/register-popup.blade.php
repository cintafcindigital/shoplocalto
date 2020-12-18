<style type="text/css">
    label input[type=checkbox] {
        display: inline;
        float:left;
        width: auto;
        height:auto;
        margin-right:15px;
    }
    .modal-body {
    padding: 25px 40px;
    }

    #service_choose li label {
        font-size: 90%;
    }

    .modal .modal-dialog {
        width: 800px;
        max-width: 90% !important;
    }
</style>
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Get Started with My Health Squad</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="signup-form" validation>
        <div class="modal-body">
            
            <strong>Increase your visibility in the marketplace by joining My Health Squad. Get the process started today.</strong>
            <p class="info-text"><small>All fields are mandatory</small></p>
            
            <hr/>
            
            <div class="row">
                @php
                    if(@$vendorDetails['contact_person'])
                    {
                        $names      = explode(' ',$vendorDetails['contact_person']);
                        $firstname  = @$names[0];
                        $lastname   = substr($vendorDetails['contact_person'],strlen(@$names[0]),strlen($vendorDetails['contact_person']));
                    }
                @endphp
                <div class="col-sm-6 form-group">
                    <label>Firstname</label>
                    <input type="text" name="firstname" class="form-control" value="{{@$firstname}}" required />
                    <span class="form-error"></span>
                </div>
                <div class="col-sm-6 form-group">
                    <label>Lastname</label>
                    <input type="text" value="{{@$lastname}}" name="lastname" class="form-control" required />
                    <span class="form-error"></span>
                </div>
                <div class="col-sm-12 form-group">
                    <label>Name of Practice</label>
                    <input type="text" name="practice_name" value="{{@$vendorDetails['company_data']['business_name']}}" class="form-control" required />
                    <span class="form-error"></span>
                </div>
                
                <div class="col-sm-6 form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required />
                    <span class="form-error"></span>
                </div>
                
                <div class="col-sm-6 form-group">
                    <label>Phone number</label>
                    <input type="text" name="phone" class="form-control" required />
                    <span class="form-error"></span> 
                </div>
                
                <div class="col-sm-12 form-group">
                    <label>Service & Specialty</label>
                    <input type="text" name="service_specialty" value="{{@$singleCategories}}" class="form-control" required />
                    <span class="form-error"></span>
                </div>
                
                <div class="col-sm-6 form-group">
                    <label>No. of Employees</label>
                    <input type="text" name="employees" class="form-control" required />
                    <span class="form-error"></span>
                </div>
                
                <div class="col-sm-12 form-group">
                    <p>Service offered by My Health Squad that you are interested in (select all that apply):</p>
                    
                    <ul id="service_choose">
                        <li><label><input type="checkbox" name="profile_page" class="form-control" value="1" /> Profile page on My Health Squad</label></li>
                        <li><label><input type="checkbox" name="content_provider" class="form-control" value="1" /> Participating in content (providing blogs)</label></li>
                        <li><label><input type="checkbox" name="online_booking" class="form-control" value="1" /> Online booking & scheduling services</label></li>
                        <li><label><input type="checkbox" name="public_speaker" class="form-control" value="1" /> Acting as public speakers for Corporate Clients (promoting your profession and services)</label></li>
                    </ul>
                    <hr/>
                </div>
                
                <div class="col-sm-12 form-group">
                    <label class="agreement">
                        <input type="checkbox" name="agree" class="form-control" required />
                         By submitting this form, I agree to have a My Health Squad membership specialist get in touch with you.
                    </label>
                    <span class="form-error"></span>
                </div>
                
                @if(env('GOOGLE_RECAPTCHA_KEY'))
                    
                @endif
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="g-recaptcha" data-sitekey="{{'6Lfst80ZAAAAALX7HIMxbftvMW-Fqit6kS8ajQh3'}}" data-callback="enableBtn"></div>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-sm-12">
                    @csrf
                    <input class="btn btn-lg btn-signup" type="submit" value="Submit" id="submit-button" style="width:100%;" disabled="disabled" />
                </div>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    
    function enableBtn() {
        $("#submit-button").removeAttr("disabled");
    }
    
</script>