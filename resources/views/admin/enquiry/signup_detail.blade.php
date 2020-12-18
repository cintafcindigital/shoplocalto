@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Signup Details</h1>
                    </div>
                    <div class="col-sm-12">
                      
                      <div id="signup-details" style="padding: 15px; border:1px solid #DDD; background: #FFF;">
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Full Name:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->firstname.' '.$request->lastname!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Practice Name:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->practice_name!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Email:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->email!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Phone:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->phone!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Service Specialty:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->service_specialty!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Interested in:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  <ul>
                                  <?php 
                                        echo $request->profile_page ? '<li>Profile page</li>':''; 
                                        echo $request->content_provider ? '<li>Participating in content (providing blogs)</li>':'';
                                        echo $request->online_booking ? '<li>Online booking & scheduling services</li>':'';
                                        echo $request->public_speaker ? '<li>Acting as public speakers for Corporate Clients</li>':'';
                                  ?>
                                  </ul>
                              </div>

                          </div>
                          
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  No of Employees:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->employees!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Best Time to contact:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {!!$request->appointment_at!!}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  Submited on:
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  {{date('d M Y, H:ia',strtotime($request->created_at))}}
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  &nbsp;
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  
                              </div>

                          </div>
                          
                          <div class="row" style="margin:15px 0;">
                              
                              <div class="col-sm-3">
                                  &nbsp;
                              </div>
                              <div class="col-sm-6" style="font-weight:bold;">
                                  <a href="/admin/reply-signup/{{$request->id}}" class="btn btn-success">Reply</a> <a href="/admin/signup-enquiry" class="btn btn-info">Back</a> 
                              </div>

                          </div>
                          
                      </div>
                      
                      
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/menu-setting.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>

</body>
</html>