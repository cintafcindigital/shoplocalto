<div class="modal fade request-info" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Login to your account</h4>
        <p>Don't have an account? <a href="<?=url('login/register')?>">Sign up</a></p>
      </div>
      <div class="modal-body">
        <form class="cus-login-form record-details text-left clearfix" name="frmContactoInline" action="" method="post" >
            <div class="col-sm-12">
               <div class="form-group">
                    <div class="facebook-login text-center">
                        <a href="<?=url('login/facebook')?>"><img src="<?=URL::asset('public/images/fb-login.jpg')?>" alt="Facebook Login"></a>
                        <br><p class="cus-login-msg">We will not publish anything without your permission</p>
                    </div><!-- Facebook Login -->
                </div>
            </div>
            <h5 class="text-center">Or login with your email</h5><br>
            <div id="login-msg"></div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input name="name" id="login-email" type="text" value="" placeholder="Your email" class="form-control">
                </div>
            </div>
             <div class="col-sm-12">
                <div class="form-group">
                    <input name="name" id="login-password" type="password" value="" placeholder="Your password" class="form-control">
                </div>
            </div>
            <p class="text-right forgot-pass" style="margin-right:15px;"><a href="<?=url('password/reset')?>">Forgot your password?</a></p>
            <input type="hidden" id="login-company_id" name="company_id">
            <div class="col-sm-12">
              <div class="form-group">
                <button class="btn btn-primary btn-full btn-lg" onclick="Frontend.loginViaPopup()" type="button">Log In</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- Popup -->