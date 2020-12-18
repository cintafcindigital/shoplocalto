@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="d-inline-block font-weight-normal text-body mb-0">Company Settings</h1>
                    <div class="table-responsive">
                        @if(count($company) > 0)
                        <table id="tasktable" class="table table-hover table-center mb-0 ">
                            <tbody>
                                @foreach($company as $comp)
                                    <tr>
                                        <td width="20%"><b>Company Name</b></td>
                                        <td>{{$comp->company_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address</b></td>
                                        <td>{{$comp->email_id}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Emails Goes To</b></td>
                                        <td>{{$comp->email_goes_to}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number</b></td>
                                        <td>{{$comp->phone_number}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Toll Free Number</b></td>
                                        <td>{{$comp->toll_free_number}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Fax Number</b></td>
                                        <td>{{$comp->fax_number}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td>{{$comp->address}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Logo</b></td>
                                        <td><img src="{{URL::asset('/public/images')}}/{{$comp->logo}}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a class="btn btn-primary" title="Edit" href="{{url('admin/edit-company-settings')}}/{{$comp->id}}"><i class="fas fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
</body>
</html>