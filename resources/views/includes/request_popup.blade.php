<div class="modal fade request-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Request information</h4>
                <p>Fill out the form and we will contact you shortly. All the information you enter is confidential.</p>
            </div>
            <div class="modal-body">
                <form class="request-form record-details text-left clearfix" name="frmContactoInline" action="" method="post" >
                    <div id="show-msg"></div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="l-name" for="">FIRST AND LAST NAME</label>
                            <i class="icon-header icon-header-form-user"></i>
                            <input name="name" id="r-name" type="text" value="{{isset(Auth::user()->name)?Auth::user()->name:''}}" placeholder="First and Last Name" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="l-email" for="">E-MAIL</label>
                            <i class="icon-header icon-header-form-mail"></i>
                            <input type="text" id="r-email" name="email" value="{{isset(Auth::user()->email)?Auth::user()->email:''}}" placeholder="E-mail" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="l-phone" for="">PHONE NUMBER</label>
                            <i class="icon-header icon-header-form-phone"></i>
                            <input type="number" id="r-phone" name="phone" value="{{isset(Auth::user()->phone)?Auth::user()->phone:''}}" placeholder="Phone number" class="form-control" max=9999999999 min=111111>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Number of guests</label>
                            <i class="icon-header icon-header-form-guests"></i>
                            <input type="text" id="r-number_of_guests" name="number_of_guests" placeholder="Number of guests" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">EVENT DATE</label>
                            <i class="icon-header icon-header-form-cal"></i>
                            <input name="event_date" id="r-event_date" placeholder="Event Date" type="text" value="{{isset(Auth::user()->event_date)?date('d/m/Y',strtotime(Auth::user()->event_date)):''}}"  class="form-control datetimepicker">
                        </div>
                    </div> 
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">COMMENT</label>
                            <textarea name="comment" id="r-comment" placeholder="Comment" rows="5" class="form-control"></textarea>
                        </div>
                    </div>//-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="g-recaptcha" id="request-form-recaptcha" data-sitekey="6Lfst80ZAAAAALX7HIMxbftvMW-Fqit6kS8ajQh3" data-callback="requestFormValidator"></div>
                        </div>
                    </div>
                    <script src="https://www.google.com/recaptcha/api.js?onload=requestFormValidator&render=explicit" async defer></script>
                    <script>
                        function requestFormValidator(){
                            Frontend.requestFormValidator();
                        }
                    </script>
                    <input type="hidden" id="r-company_id" name="company_id">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-full btn-lg" onclick="Frontend.sendRequestForm()" type="button">Send Request</button>
                        <div class="icheckbox_grey checked">
                            <input class="app-icheck" type="checkbox" data-icheck-skin="grey" name="" value="1" checked="checked">
                            <p>Yes, I want My Health Squad to send me promotional emails about My Health Squad, their services and health professionals partners.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- Popup -->