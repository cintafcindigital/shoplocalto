@extends('layouts.app')
@section('content')
 <section class="content-header">
      <h1>
            FAQs        
      </h1>
    <ol class="breadcrumb">         
            <li><a href="{{url('admin/faqs')}}"><i class="fa fa-backward"></i>Back</a></li>
    </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="panel-heading">Add FAQs</div>
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
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/save_faq') }}">
                        {{ csrf_field() }}                                                                                             
                    <div class="box-body">               
                     <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                            <label>Question</label>
                                <input id="question" type="text" class="form-control" name="question" value="{{ old('question') }}"  autofocus>
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                     </div>
                      <div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label>Answer</label>
                             <textarea  name="answer" id="description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{ old('answer') }}</textarea>
                                @if ($errors->has('answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                     </div>
                    
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
