@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
    @include('tools.tools_nav')
    <div class="wrapper">
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <a href="{{url('tools/to-do-list')}}">
                        <h1 class="tools-header-title pointer" onclick="">
                            <i class="icon-header icon-header-arrow-left mr10"></i> Back to my planner
                        </h1>
                    </a>
                 </div>
                <div class="pure-u-1-2 tools-header-actionContainer">
                    <div style="display: inline-block;">
                        <a class="btn-outline outline-transparent" href="{{url('tools/checklistprint')}}">
                            <i class="icon-tools icon-tools-print icon-left"></i> Print
                        </a>
                    </div>
                    <div style="display: inline-block;">
                        <a class="btn-outline outline-transparent" onclick="return confirm('Are you sure you want to remove this item?')" href="{{url('tools/todo-list-remove').'/'.$data['list_id']}}">
                            <i class="icon icon-trash icon-left pointer"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
            <div class="pure-g">
                <div class="pure-u-3-4">
                    <div class="pure-s">
                     <div class="alert-msg">
                        @if (\Session::has('message'))
                             {!! \Session::get('message') !!}       
                        @endif
                     </div>

                    @if(isset($data['task_details']) && !empty($data['task_details']))
                        <div class="app-checklist-container">
                <div class="app-task-item task" data-id="954" data-status="0">
                    <div class="task-header">
                        <a class="app-checklist-checkbox fleft pointer">
                           <i class="fa fa-check-square-o"></i>
                        </a>
                        <div class="clearfix">
                            <span class="input-group-line-label ml20">Task:</span>
                            <div class="input-group-line task-title">
                                <input name="title" class="app-title-editable" data-prev-value="Choose a city and season and start researching venues" data-field="title" data-id="{{$data['task_details'][0]['id']}}" value="{{$data['task_details'][0]['title']}}" onblur="Frontend.editTodoList(this)">
                            </div>
                            <i class="icon icon-edit-grey app-task-edit-title pointer"></i>
                        </div>
                        <div class="input-group-line">
                            <span class="dnone app-error-msg-title"></span>
                        </div>
                    </div>
        <div class="task-options pure-g">
            <div class="pure-u-1-4">
                <div class="task-options-item task-options-itemSelect">
                    <div class="app-input-select input-select app-taskPeriod">
                        <select class="form-control selectpicker bs-select-hidden" data-live-search="true" data-field="todo_date_id" data-id="{{$data['task_details'][0]['id']}}" onchange="Frontend.editTodoList(this)">
                             @if(isset($data['dates']) && !empty($data['dates']))
                              @foreach($data['dates'] as $datesd)
                               <option value="{{$datesd['id']}}" @if($datesd['id'] == $data['task_details'][0]['todo_date_id']) selected="" @endif>{{$datesd['title']}}</option>
                              @endforeach
                            @endif
                        </select>
                        <input class="app-input-hidden" type="hidden" name="period" value="1">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-4"> 
                <div class="task-options-item task-options-itemSelect">
                    <div class="app-input-select input-select app-taskCateg">
                        <select class="form-control selectpicker bs-select-hidden" data-live-search="true" data-field="todo_cat_id" data-id="{{$data['task_details'][0]['id']}}" onchange="Frontend.editTodoList(this)">
                            @if(isset($data['cats']) && !empty($data['cats']))
                              @foreach($data['cats'] as $catd)
                               <option value="{{$catd['id']}}" @if($catd['id'] == $data['task_details'][0]['todo_cat_id']) selected="" @endif>{{$catd['title']}}</option>
                              @endforeach
                            @endif
                        </select>
                    <input class="app-input-hidden" type="hidden" name="categ" value="13"></div>
                </div>
            </div>
            <div class="pure-u-1-4">
                <div class="task-options-item app-checklist-assign-provider app-tools-checklist-vendor ">   
            <p role="button" class="pointer">
                <i class="fa fa-plus"></i>
                <span class="task-options-text"  data-toolredirect="true" data-toggle="modal" data-target="#myModalAddListVendor" data-cat-id="2">Vendors</span>
               
            </p>
                </div>
            </div>
            @php
                $key_val =  array_search($data['task_details'][0]['todo_cat_id'], array_column($data['cats'], 'id'));
                $parent_id = $data['cats'][$key_val]['cat_id'];
            @endphp
            <div class="pure-u-1-4">
                <div class="task-options-item">
                    <p class="app-budget-task-no-budget" data-task-id="954">
                        <span class="icon-tools icon-left"></span>
                        <span class="task-options-text" onclick="Frontend.showAddBudgetPopup(this)" data-parent-id="{{$parent_id ?? 1}}" data-task-id="{{$data['task_details'][0]['id']}}">
                          <i class="fa fa-plus"></i>
                          Budget
                      </span>
                    </p>
                    </div>
            </div>
        </div>
    <div class="task-content">
                        <div class="task-description"><p>{{$data['task_details'][0]['description']}}</p></div>
                    <textarea class="app-addNote task-note app-task-textarea-expand-note" placeholder="Add note..." data-type="note" data-field="note" data-id="{{$data['task_details'][0]['id']}}" onblur="Frontend.editTodoList(this)">{{$data['task_details'][0]['note']}}</textarea>
    </div>
        </div>
        </div>
        @endif
                        <div class="pure-g row">
                            <div class="pure-u-1-2 task-concept-box">
                                <div class="box task-concept-box-content app-taskVendor-content">
                    <div class="app-task-vendor-empty">
                    <i class="fa fa-heart-o"></i>
                    <p class="task-concept-empty-title">Link your vendors to this task</p>
                    <button class="btn-outline outline-red app-checklist-assign-provider pointer" data-toolredirect="true" data-toggle="modal" data-target="#myModalAddListVendor" data-cat-id="2">
                        Add a vendor              
                    </button>
                </div>
                                </div>
                            </div>
                            <div class="pure-u-1-2 task-concept-box">
                                <div class="box task-concept-box-content"> 
                <div class="app-task-budget-box-zero taskBudget">
                    <i class="fa fa-database"></i>
                    <!-- <p class="task-concept-empty-title">Add a budget for this task</p> -->
                    <p class="task-concept-empty-title">Add expense for this task</p>
                    <a class="btn-outline outline-red app-budget-task app-budget-task-no-budget" role="button" onclick="Frontend.showAddBudgetPopup(this)" data-parent-id="{{$parent_id ?? 1}}" data-task-id="{{$data['task_details'][0]['id']}}">
                        Add expense    </a>
                </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-related-vendors">
                                                    </div>
                        <div class="app-related-articles">
                        </div>

                        @if(isset($data['taskVendorData']) && !empty($data['taskVendorData']))
                        <div class="app-related-vendors">
                            <div class="mt20">
                                <div class="pure-g">
                                    <div class="pure-u-2-3">
                                        <div class="widget-related-title">
                                        <p class="title">Related vendors</p>
                                        </div>
                                    </div>
                                    <div class="pure-u-1-3 text-right">
                                    </div>
                                </div>
                                <div class="widget-related-vendors widget-related-vendors-3">
                                    <ul class="pure-g-r row">
                                    @foreach($data['taskVendorData'] as $taskV)
                                        <li class="pure-u-1-3 app-mirror-link flex">
                                            <div class="box">
                                                <a data-track-c="RelatedContentTracking" data-track-a="a-click" data-track-l="d-desktop+s-related_content+o-tools_checklist_show+dt-vendors_profile" data-track-v="0" data-track-ni="0" class=" widget-related-vendors-img photo-zoom app-ua-track-event" href="{{url('tools/vendors-category')}}?id_categ=&status=">
                                                <img width="100%" id="app_imgEmp_24189" src="{{url('public/vendors')}}/{{$taskV->vendor_folder}}/{{$taskV->image}}"></a>
                                                <div class="widget-related-dress-content-vertical">
                                                    <a data-track-c="RelatedContentTracking" data-track-a="a-click" data-track-l="d-desktop+s-related_content+o-tools_checklist_show+dt-vendors_profile" data-track-v="0" data-track-ni="0" class="widget-related-item-title app-ua-track-event" href="{{url('tools/vendors-category')}}?id_categ=&status=">{{$taskV->business_name}}</a>
                                                    <p class="vendors-related-item-location">
                                                    {{$taskV->city}} ({{$taskV->province}})                                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
              <div class="pure-u-1-4">
                <div class="tools-boxProgress">
                  <p class="tools-boxProgress-title">My To-Do List</p>
                  <span class="icon-tools icon-tools-checklist-circle"></span>
                  <div class="tools-boxProgress-container">
                      <span class="tools-boxProgress-tooltip app-progressTip" data-progress="{{$data['summary']['percent_task']}}" style="display: inline; left: {{$data['summary']['percent_task']}}%;">{{round($data['summary']['percent_task'])}}%</span>
                      <div class="tools-boxProgress-progress" style="width:100% !important">
                      <div class="app-checklist-progress" data-complete="{{$data['summary']['complete_task']}}" data-total="{{$data['summary']['total_task']}}" style="width: {{$data['summary']['percent_task']}}%;"></div>
                      </div>
                  </div>
                  <p class="tools-boxProgress-description-ex">
                      <span class="app-checklist-progressComplete">{{$data['summary']['complete_task']}}</span> of <span class="app-checklist-progressTotal">{{$data['summary']['total_task']}}</span> completed :)
                  </p>
                </div>
                <div style="min-height:190px;" data-idgrupo="" data-autopromo="" data-idregion="" data-idregionadm1="" data-idsubseccion="" class="app-DFP">
                    <a rel="nofollow" target="_blank" href="{{url('wedding-vendors')}}">
                     <img border="0" style="max-width: 100%; height: auto;" src="{{URL::asset('public/images/banner-img.jpg')}}">
                    </a>
                </div>                
              </div>
            </div>
        </div>
</section>
<style>
.icon-edit-grey::before {
    background-position: -52px -165px;
    height: 16px;
    width: 16px;
}
</style>
@include('includes.add_budget_popup')
@include('includes.list_add_vendor_popup')
@include('includes.footer')
@endsection       
