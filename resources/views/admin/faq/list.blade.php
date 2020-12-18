@extends('layouts.app')
@section('content')
 <section class="content-header">
      <h1>
           All FAQs      
      </h1>
    <ol class="breadcrumb">         
            <li><a href="{{url('admin/add-faq')}}"><i class="fa fa-plus"></i>Add FAQ</a></li>
    </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                   <form class="navbar-form navbar-left" role="search" method="get" action="{{url('admin/faqs')}}">
                    <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    <a class="btn btn-default" href="{{url('admin/faqs')}}"><i class="fa fa-refresh"></i></a>
                    </form>                  
                </div><!-- /.box-header -->
                <div class="box-body">
                 @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                @endif
                @if (isset($faqs) && count($faqs) > 0)
                <table id="example" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>                    
                    @foreach($faqs as $faq)                 
                    <tr>
                      <td width="7%">{{$faq->id}}</td>
                      <td width="30%">{{$faq->question}}</td>
                      <td width="30%">{!!$faq->answer!!}</td>
                      <td width="15%">
                      <a class="btn btn-primary" style="float:left;" title="Edit" href="{{url('admin/edit-faq')}}/{{$faq->id}}"><i class="fa fa-pencil"></i></a>
                       @php $status = ($faq->status==1)?0:1 @endphp
                        <a style="float: left;margin-right:5px;margin-left:5px;" title="<?php echo $status==1?'Disable':'Enable'; ?>" class="btn <?php echo $status==1?'btn-danger':'btn-primary'; ?>" href="{{url('admin/status-faq')}}/{{$faq->id}}/{{$status}}">
                        <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                        </a>&nbsp;
                      <form style="float: left;width: 30%;" action="{{ url('admin/delete_faq/'.$faq->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-danger" title="Delete">
                             <i class="fa fa-btn fa-trash"></i>
                          </button>
                      </form>
                      </td>
                    </tr>
                    @endforeach                                                         
                  </tbody>
                  </table>
                  @else
                  <h2 class="text-center">No FAQs Found</h2>
                  @endif
                 </div><!-- /.box-body -->
               <div class="box-footer clearfix">  </div>               
              </div>

        </div>
    </div>

</section>
@endsection
