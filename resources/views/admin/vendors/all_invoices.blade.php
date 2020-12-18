@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Invoices</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success"> {{ session()->get('success') }} </div>
                @endif
                @if(session()->has('failure'))
                    <div class="alert alert-danger"> {{ session()->get('failure') }} </div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="filestable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Invoice Details</th>
                                                <th>Vendor Name</th>
                                                <th>Subscription Date</th>
                                                <th>Subscription Amount</th>
                                                <th>Monthly Billing</th>
                                                <th>Reminder</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($vendorInvoices as $vi)
                                            <tr>
                                                <td><div class="media">
                                                        <div class="d-inline-flex align-item-center justify-content-center wid-40 hei-40 bg-light">
                                                            <img src="{{url('/')}}/assets/images/uikit/card-icon-3.svg" alt="images" class="img-fluid wid-25">
                                                        </div>
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1">{{$vi->subscription->type.' ( '.$vi->subscription->duration.' )'}}</h5>
                                                            <p class="mb-0"><i># </i>{{$vi->invoice_id}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>@if(@$vi->vendor_data->profile)
                                                		<img src="{{url('/public/vendors/VENDOR_').$vi->vendor_data->vendor_id.'/'.$vi->vendor_data->profile}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                                                	@else
                                                		<img src="{{url('/public/storage/no-image.png')}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                                                	@endif
                                                	<label>{{@$vi->vendor_data->contact_person}}</label>
                                                </td>
                                                <td>{{date_format(date_create($vi->subscription_date),'d M Y')}}</td>
                                                <td>{{'C$'.$vi->subscription_amount}}</td>
                                                <td><?php $reminder = 0; ?>
                                                    @foreach($vi->vendor_bills as $ky => $vb)
                                                        @if($ky == 0)
                                                            <p>C${{$vb->paid_amount}}</p>
                                                        @endif
                                                        <?php if($vb->status == 0){ $reminder++; } ?>
                                                    @endforeach
                                                </td>
                                                <td>@if($reminder > 0)
                                                        <a href="{{url('admin/invoice-reminder').'/'.@$vi->vendor_data->vendor_id}}" class="badge badge-pill badge-danger f-12 text-uppercase">Reminder</a>
                                                    @else
                                                        <span class="badge badge-pill f-12">- - - -</span>
                                                    @endif
                                                </td>
                                                <td>@if($vi->status == 1)
                                                    	<span class="badge badge-pill badge-success f-12 text-uppercase">Active</span>
                                                	@else
                                                    	<span class="badge badge-pill badge-danger f-12 text-uppercase">Inactive</span>
                                                	@endif
                                                </td>
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <div class="btn-group card-option">
                                                            <a href="{{url('admin/download-invoice').'/'.$vi->id.'/'.$vi->vendor_id}}" class="btn shadow-none" style="font-size:20px;"><i class="feather icon-download"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$('#filestable').DataTable();
</script>
</body>
</html>