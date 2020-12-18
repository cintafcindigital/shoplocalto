@include('include/header');
<style type="text/css">
    .categories {
        list-style-type: none;
        color: #000;
    }
    .categories li label {
        font-size: 19px;
        font-weight: normal;
    }
    .categories ul {
        list-style-type: none;
        color: #000;
    }
    .categories ul li label {
        font-size: 17px;
        font-weight: normal;
    }
    .container-ul {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      color: #000;
    }
    .container-ul input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }
    .container-ul:hover input ~ .checkmark {
      background-color: #ccc;
    }
    .container-ul input:checked ~ .checkmark {
      background-color: #2c3e98;
    }
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    .container-ul input:checked ~ .checkmark:after {
      display: block;
    }
    .container-ul .checkmark:after {
        left: 9px;
        top: 2px;
        width: 8px;
        height: 17px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add New Promocode</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/promocodes')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
                        <!-- <i class="feather icon-plus mr-2"> -->
                    </div>
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(count($errors) > 0 || session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    @if(count($errors) > 0)
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if(session()->has('error'))
                    <ul>
                        <li>{{session()->get('error')}}</li>
                    </ul>
                    @endif
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Code</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@@include('./include/footer.php')
</body>
</html>