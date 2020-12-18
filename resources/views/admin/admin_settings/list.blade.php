@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('admin/admin-setting')}}">Manage Admin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="d-inline-block font-weight-normal text-body mb-0">Admin</h1>
                    <div class="table-responsive">
                        @if(count($admins) > 0)
                        <table id="tasktable" class="table table-hover table-center mb-0 ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td width="7%">{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td width="30%">{{$admin->email}}</td>
                                    <td width="20%">********</td>
                                    <td width="10%">Super Admin</td>
                                    <td width="10%" align="center">
                                        <a title="Edit" href="{{url('admin/edit-admin')}}/{{$admin->id}}"><i class="fas fa-edit"></i></a>
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