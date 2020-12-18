<div class="tools-navigation">
    <div class="container">
        <ul class="pure-g hidden">
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{(Request::is('tools/my-wedding') || Request::is('dashboard'))?'current':''}}" href="{{url('tools/my-wedding')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/wedding-icon.png')}}" alt=""></span> My Health Squad
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{Request::is('tools/to-do-list')?'current':''}} {{Request::is('tools/todolist-task-details')?'current':''}}" href="{{url('tools/to-do-list')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/todo-list-icon.png')}}" alt=""></span> Checklist
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{Request::is('tools/vendors')?'current':''}} {{Request::is('tools/vendors-category')?'current':''}}" href="{{url('tools/vendors')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/vendors-icon.png')}}" alt=""></span> Vendors
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{(Request::segment(2)=='guests')?'current':''}}" href="{{url('tools/guests')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/guest-icon.png')}}" alt=""></span> Guests
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{(Request::segment(2)=='seating_chart')?'current':''}}{{(Request::segment(2)=='seating_list')?'current':''}}" href="{{url('tools/seating_chart')}}">
                    <span class="tools-navigation-icon icon-tools-navigation icon-tools-navigation-tables"><img src="{{url('public/images/seating1.png')}}" alt=""></span> Seating Chart 
                </a>
            </li>
            <!-- <li class="pure-u-1-9">
                <a class="tools-navigation-link " href="#">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/table-icon.png')}}" alt=""></span> Tables
                </a>
            </li> -->
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{(Request::segment(2)=='budget')?'current':''}} {{(Request::segment(2)=='budget-category')?'current':''}} {{(Request::segment(2)=='budget-payments')?'current':''}}" href="{{url('tools/budget')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/budget-icon.png')}}" alt=""></span> Budget
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{Request::is('tools/dresses')?'current':''}}" href="{{url('tools/dresses')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/dress-icon.png')}}" alt=""></span> Dresses
                </a>
            </li>
            <li class="pure-u-1-9">
                <a class="tools-navigation-link {{Request::is('tools/wedding-website')?'current':''}}" href="{{url('tools/wedding-website')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/web-icon.png')}}" alt=""></span> Website
                </a>
            </li>
            <!-- <li class="pure-u-1-9">
                <a class="tools-navigation-link {{Request::is('tools/wedshoots')?'current':''}} {{Request::is('tools/wedshoots-settings')?'current':''}}" href="{{url('tools/wedshoots')}}">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/wed-shoots-icon.png')}}" alt=""></span> WedShoots
                </a>
            </li> -->
            <!--  <li class="pure-u-1-9">
                <a class="tools-navigation-link " href="#">
                    <span class="tools-navigation-icon"><img src="{{url('public/images/contest-icon.png')}}" alt=""></span> Contest
                </a>
            </li> -->
        </ul>
    </div>
</div><!-- Tools Navigation -->
<style>
.tools-boxProgress-popup {
    border: none;
    padding: 20px;
    /*text-align: center;*/
    width: 100%;
}
.tools-boxProgress-title-popup {
    margin-bottom: 25px;
    font-size: 18px;
    font-weight: 600;
}
.tools-boxProgress-progress-popup {
    width: 100% !important;
}
.tools-boxProgress-description-ex {
    font-size: 16px;
}
.compltitNow {
    background-color: #f7686e !important;
}
.to_division-div .to_division-div-first-div{
    display: inline-block;
    vertical-align: top;
}
</style>
<!-- Bride-toDoList Modal START -->
<div id="bride-toDoList" class="modal fade " tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-large">
        <div class="modal-content app-review-request-importer">
            <button type="button" class="close close-white progress-notifier-close" aria-hidden="true" style="font-size:60px;margin-top:-20px;">×</button>
            <div class="adminModalImport__title"><h3>Have you completed all your tasks?</h3></div>
            <div class="ctChecklistTasks__item pt2 pb2">
                <div class="tools-boxProgress-popup">
                    <p style="text-align:justify;font-size:18px;">Welcome to My Health Squad. We have organized your health squad planning tasks into categories to make planning your to-do-list as easy as possible. Now it’s time to start filling in some of your tasks.</p><hr>
                    <div class="to_division-div" style="width:100%">
                        <div class="text-left to_division-div-first-div" style="width:58%">
                            @if($toDoTabFirst == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Set up your ‘My Health Squad’ dashboard</span>
                            </p>
                            @endif
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Completed {{$bride_todo_complete}} number of ‘To Do’ tasks out of {{$bride_todo_total}}</span>
                            </p>
                            @if($toDoTabSecond == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Started your guestlist</span>
                            </p>
                            @endif
                            @if($toDoTabThird == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Started your seating chart</span>
                            </p>
                            @endif
                            @if($toDoTabFourth == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Started your budget</span>
                            </p>
                            @endif
                            @if($toDoTabFifth == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Created you health squad website</span>
                            </p>
                            @endif
                            @if($toDoTabSixth == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Created your vendor lists</span>
                            </p>
                            @endif
                            @if($toDoTabSeventh == 0)
                            <p class="tools-boxProgress-description-ex"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                <span class="app-checklist-progressComplete">Joined a Community</span>
                            </p>
                            @endif
                        </div>
                        <div class="text-right to_division-div-first-div" style="width:38%">
                            <p style="margin-bottom:25px;font-weight:600;">Your health squad planning progress:</p>
                            <p style="margin-bottom:35px;margin-right:80px;"><span class="icon-tools icon-tools-checklist-circle"></span></p>
                            <p>
                                <div class="tools-boxProgress-container" style="margin-right:25px;">
                                    <span class="tools-boxProgress-tooltip app-progressTip" data-progress="{{$bride_todo_percent}}" style="display:inline;left: {{$bride_todo_percent}}%;">{{$bride_todo_percent}}%</span>
                                    <div class="tools-boxProgress-progress tools-boxProgress-progress-popup">
                                        <div class="app-checklist-progress" data-complete="{{$bride_todo_percent}}" data-total="{{$bride_todo_total}}" style="width: {{$bride_todo_percent}}%;"></div>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div><hr>
                    <!-- <p class="tools-boxProgress-description-ex">
                        <span class="app-checklist-progressComplete">{{$bride_todo_complete}}</span> of <span class="app-checklist-progressTotal">{{$bride_todo_total}}</span> completed :)
                    </p>
                    <p class="tools-boxProgress-description-ex">
                        <span class="app-checklist-progressComplete">Total {{$bride_todo_pending}} are pending To-Do List </span>
                    </p> -->
                    <div class="text-center"><a href="{{url('tools/to-do-list')}}" class="btn btn-info compltitNow"> Complete it Now</a></div>
                </div>
            </div>
            <div class="adminModalImport__actions p5"></div>
        </div>
    </div>
</div><!-- / END Bride-toDoList Modal -->