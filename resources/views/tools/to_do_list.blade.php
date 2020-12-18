@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap">
    @include('tools.tools_nav')
    <div class="wrapper">
        <form id="app-navigation-form">
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="esential" value="-1">
            <input type="hidden" name="category" value="-1">
            <input type="hidden" name="period" value="-1">
        </form>
        <div class="overflow mb0">
            <div class="pure-g">
                <div class="pure-u-7-10">
                    <h1 class="tools-title"> Checklist </h1>
                </div>
                <div class="pure-u-3-10 flex flex-right text-right">
                    <div style="display: inline-block;">
                        <a class="btn-outline outline-transparent" href="{{url('tools/todo-list-csv')}}"><i class="icon-tools icon-tools-download"></i> Download </a>
                    </div>
                    <div style="display: inline-block;">
                        <a class="btn-outline outline-transparent" href="{{url('tools/checklistprint')}}"><i class="icon-tools icon-tools-print icon-left"></i> Print </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-3-4">
                <div class="pure-s pure-g">
                    <div class="pure-u-1-4">
                        <div class="mr35 app-checklist-ajaxNav">
                            <div class="app-active-filters-wrapper mr35 mb30">
                            <p class="tools-subtitle">Your search</p>
                                <ul class="directory-search-tags app-active-filters">
                                    <li class="tag-filter" data-param="status" data-value="0" onclick="Frontend.todoHandleSearchData(this)">
                                        <span class="custome-search-status">Pending</span>
                                    </li>
                                    <li class="tag-filter hide" data-param="date" data-value="0" onclick="Frontend.todoHandleSearchData(this)">
                                        <span class="custome-search-date">2 Weeks</span>
                                    </li>
                                    <li class="tag-filter hide" data-param="category" data-value="0" onclick="Frontend.todoHandleSearchData(this)">
                                        <span class="custome-search-category">Planning</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-filters-status-container">
                                <p class="tools-subtitle">Status</p>
                                <ul class="tools-filters tools-filters-bullets customer-class-handler">
                                    <li class="tools-filters-item tools-filters-item-green app-filters-status app-task-filter current-class-handler" data-value="complete">
                                        <span class="tools-filters-item-name" data-status="pending" onclick="Frontend.todoFilter(this)">Completed</span>
                                        <span class="tools-filters-item-count app-checklist-estado-completadas notablet">{{$data['tasks']['complete']}}</span>
                                    </li>
                                    <li class="tools-filters-item tools-filters-item-orange app-filters-status app-task-filter current-class-handler current" data-value="pending" data-param="status">
                                        <span class="tools-filters-item-name" data-status="complete" onclick="Frontend.todoFilter(this)">Pending</span>
                                        <span class="tools-filters-item-count app-checklist-estado-pendientes notablet">{{$data['tasks']['pending']}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-filters-period-container">
                                <p class="tools-subtitle">By date</p>
                                <ul class="tools-filters tools-filters-bullets tools-filters-lineal">
                                    @if(isset($data['dates']) && !empty($data['dates']))
                                        @foreach($data['dates'] as $dateData)
                                            <li class="tools-filters-item app-filters-period app-task-filter ">
                                                <span class="tools-filters-item-name" date-text="{{$dateData['title']}}" date-id="{{$dateData['id']}}" onclick="Frontend.todoFilterDate(this)" >{{$dateData['title']}}</span>
                                                <span class="tools-filters-item-count notablet">
                                                @if(isset($data['tasks']['full_data'][$dateData['id']]) && !empty($data['tasks']['full_data'][$dateData['id']]))
                                                    {{count($data['tasks']['full_data'][$dateData['id']])}}
                                                @else
                                                    0
                                                @endif
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="app-filters-category-container">
                                <p class="tools-subtitle">By category</p>
                                <ul class="tools-filters custom-category-handler">
                                    @if(isset($data['cats']) && !empty($data['cats']))
                                        @php $catList = array_column($data['cats'],'title','id'); @endphp
                                        @foreach($data['cats'] as $catsData)
                                            <li class="tools-filters-item app-tools-scroll-up app-filters-category app-task-filter" data-value="{{$catsData['id']}}">
                                                <span class="tools-filters-item-name" cat-text="{{$catsData['title']}}" cat-id="{{$catsData['id']}}" onclick="Frontend.todoFilterCats(this)">{{$catsData['title']}}</span>
                                                <span class="tools-filters-item-count notablet">
                                                @if(isset($data['tasks']['cat_data'][$catsData['id']]) && !empty($data['tasks']['cat_data'][$catsData['id']]))
                                                    {{$data['tasks']['cat_data'][$catsData['id']]}}
                                                @else
                                                    0
                                                @endif
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pure-u-3-4">
                        @if(session()->has('message')) {!!session()->get('message')!!} @endif
                        @if( count( $errors ) > 0 )
                            <span class="alert alert-danger">@foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach</span>
                        @endif
                        <!--<button onclick="Frontend.hideShowTodoListForm();" class="btn-flat red app-add-vendor-modal mb15 app-tools-main-add-vendor-modal" data-toolredirect="true"><i class="fa fa-plus"></i> Add Task </button>-->
                        <div class="checklist-boxNew app-container-newTask-form app-container-newTask-form-handlar">
                            <form class="app-newTask-form" method="post" action="{{url('tools/save_form_task')}}">
                                {{csrf_field()}}
                                <div id="app-message-error"></div>
                                <div class="checklist-boxNew-content">
                                    <i class="app-newTask-icon app-newTask-open icon-tools icon-tools-plus-circle-outline-big fleft mr15 pointer"></i>
                                    <div class="overflow">
                                        <div class="input-group-line input-group-line-naked">
                                            <input name="title" class="app-newTask-title" placeholder="Add a new task" data-msgerror="The title of the task must contain a minimum of four characters." type="text" value="{{old('title')}}" autofocus>
                                        </div>
                                        <div class="input-group-line app-newTask-description mt20 hidden">
                                            <textarea name="description" placeholder="Description">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <footer class="app-newTask-footer checklist-boxNew-footer hidden">
                                    <div class="checklist-boxNew-select">
                                        <select class="app-newTask-categ" name="todo_cat_id" data-msgerror="You must select a category for the task">
                                            <option value="">Category</option>
                                            @if(isset($data['cats']) && !empty($data['cats']))
                                                @foreach($data['cats'] as $catsData)
                                                    <option value="{{$catsData['id']}}" @if(old('todo_cat_id') == $catsData['id']) selected @endif>{{$catsData['title']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <i class="icon icon-arrow-down-red"></i>
                                    </div>
                                    <div class="checklist-boxNew-select">
                                        <select class="app-newTask-period" name="todo_date_id" data-msgerror="You must select a range of dates">
                                            <option value="">Start date</option>
                                            @if(isset($data['dates']) && !empty($data['dates']))
                                                @foreach($data['dates'] as $dateData)
                                                    <option value="{{$dateData['id']}}" @if(old('todo_date_id') == $dateData['id']) selected @endif>{{$dateData['title']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <i class="icon icon-arrow-down-red"></i>
                                    </div>
                                    <div class="checklist-boxNew-footer-submit">
                                        <a class="app-newTask-cancel color-grey pointer mr15" data-action="hide" role="button">Cancel</a>
                                        <input class="app-newTask-submit btn-flat red" type="submit" data-action="hide" value="Create">
                                    </div>
                                </footer>
                            </form>
                        </div>
                        <div class="app-checklist-container">
                            @php $valueExists = array_keys($data['tasks']['full_data']); @endphp
                            @if(isset($data['dates']) && !empty($data['dates']))
                                @foreach($data['dates'] as $datesVal)
                                    @if(in_array($datesVal['id'],$valueExists))
                                    <div data-section="{{$datesVal['id']}}" class="date-filter-div date-filter-{{$datesVal['id']}}">
                                        <span class="tools-subtitle"> {{$datesVal['title']}} </span>
                                        <span class="tooltip icon-tools icon-tools-tooltip-clock" data-tooltip="You have missed the recommended date to complete these tasks. Don't wait until the last minute!"></span>
                                        <span class="tools-subtitleInner fright"></span>
                                        <ul class="checklist-tasks app-tasks-list-container mt10">
                                            @if(isset($data['tasks']['full_data'][$datesVal['id']]) && !empty($data['tasks']['full_data'][$datesVal['id']]))
                                                @foreach($data['tasks']['full_data'][$datesVal['id']] as $tas)
                                                <li class="app-navTask app-task-item app-link checklist-tasks-item task-line-{{$tas['list_id']}} @if($tas['task_status']==2) complete hide @endif @if($tas['task_status']==1) pending @endif">
                                                    <div class="all-category-show category-handler-{{$tas['todo_cat_id']}}">
                                                        <div class="checklist-tasks-item-checkBox">
                                                            <a class="app-checklist-checkbox" role="button" data-id="{{$tas['list_id']}}" data-check="icon-tools-checkbox-green" data-uncheck="icon-tools-checkbox-grey" data-status="1" data-essential="0" data-category="116" data-vendors-booked="" data-section="checklist">
                                                                <i class="@if($tas['task_status'] !=1 ) hide @endif icon-tools icon-tools-checkbox-grey task-pending-{{$tas['list_id']}}" data-id="{{$tas['list_id']}}" data-oper="pending" onclick="Frontend.setTaskHandler(this)"></i>
                                                                <i class="@if($tas['task_status'] !=2 ) hide @endif icon-tools icon-tools-checkbox-green task-complete-{{$tas['list_id']}}" data-id="{{$tas['list_id']}}" data-oper="complete" onclick="Frontend.setTaskHandler(this)"></i>
                                                            </a>
                                                        </div>
                                                        <div class="checklist-tasks-item-description">
                                                            <p class="checklist-tasks-item-title">
                                                                <a href="{{url('tools')}}/todolist-task-details?taskid={{$tas['list_id']}}">{{$tas['title']}}</a>
                                                            </p>
                                                            <span class="checklist-tasks-item-tag">{{$catList[$tas['todo_cat_id']] ?? 'Category Not Found'}}</span>
                                                        </div>
                                                        <a href="{{url('tools')}}/todolist-task-details?taskid={{$tas['list_id']}}" style="right:60px;" class="btn-outline outline-transparent checklist-tasks-item-remove app-checklist-remove app-icon-hover" role="button" data-type="1">
                                                            <i class="icon-tools icon-tools-plus-circle-outline link pointer app-add-spending"></i>NOTE
                                                        </a>
                                                        <a class="btn-outline outline-transparent checklist-tasks-item-remove app-checklist-remove app-icon-hover" role="button" data-type="1">
                                                            <i class="icon-tools icon-tools-trash-grey task-delete-{{$tas['list_id']}}" data-id="{{$tas['list_id']}}" data-oper="delete" onclick="Frontend.setTaskHandler(this)"></i>
                                                        </a>
                                                        <div class="app-task-vendor-content"> </div>
                                                    </div>
                                                </li>      
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="pure-u-1-4">
                <div class="tools-boxProgress">
                    <p class="tools-boxProgress-title">My To-Do List</p>
                    <span class="icon-tools icon-tools-checklist-circle"></span>
                    <div class="tools-boxProgress-container">
                        <span class="tools-boxProgress-tooltip app-progressTip" data-progress="{{$data['tasks']['percent']}}" style="display: inline; left: {{$data['tasks']['percent']}}%;">{{$data['tasks']['percent']}}%</span>
                        <div class="tools-boxProgress-progress" style="width: 100% !important;">
                            <div class="app-checklist-progress" data-complete="{{$data['tasks']['percent']}}" data-total="{{$data['tasks']['total']}}" style="width: {{$data['tasks']['percent']}}%;"></div>
                        </div>
                    </div>
                    <p class="tools-boxProgress-description-ex"> <span class="app-checklist-progressComplete">{{$data['tasks']['complete']}}</span> of <span class="app-checklist-progressTotal">{{$data['tasks']['total']}}</span> completed :) </p>
                    <input type="hidden" data-value="{{$data['tasks']['complete']}}" id="hold-complete-task">
                    <input type="hidden" data-value="{{$data['tasks']['total']}}" id="hold-total-task">
                    <input type="hidden" data-value="{{$data['tasks']['percent']}}" id="hold-percent-task">
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.footer')
<script type="text/javascript">
$(document).ready(function() {
    $(".app-newTask-title").focus(function() {
        $(".app-newTask-icon").removeClass('icon-tools-plus-circle-outline-big');
        $(".app-newTask-icon").addClass('icon-tools-checkbox-grey');
        $(".app-newTask-description, .app-newTask-footer").removeClass('hidden');
    });
    $(".app-newTask-cancel").on('click', function() {
        $(".app-newTask-icon").addClass('icon-tools-plus-circle-outline-big');
        $(".app-newTask-icon").removeClass('icon-tools-checkbox-grey');
        $(".app-newTask-description, .app-newTask-footer").addClass('hidden');
    });
});
</script>
@endsection