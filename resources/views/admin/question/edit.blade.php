@extends('layouts.app')
@section('content')
 <section class="content-header">
      <h1>
            Testimonials        
      </h1>
    <ol class="breadcrumb">         
        <li><a href="{{url('admin/admin-testimonials')}}"><i class="fa fa-backward"></i>Back</a></li>
    </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="panel-heading">Edit Testimonial</div>
                <div class="panel-body">                   
                     @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ url('admin/save_changes_testimonial') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}                                                                                             
                    <div class="box-body">               
                     <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data['name'] }}"  autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                     </div>
                     <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Testimonial Description</label>
                             <textarea  name="description" id="description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{ $data['description'] }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                     </div>
                   
                     <div class="form-group">
                            <label>Image</label>
                                <input id="file" type="file" class="form-control" name="image" value="{{ old('image') }}"  autofocus>
                                <br><img src="{{URL::asset('public/testimonials')}}/{{$data['image']}}" style="width:150px;">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                     </div>
                     <input type="hidden" name="tes_id" value="{{ $data['id'] }}">
                     <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                     </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
