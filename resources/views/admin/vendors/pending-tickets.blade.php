@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Pending Tickets</h1>
                    </div>
                    <div class="col-sm-8 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <select name="search_subject" class="form-control" style="width:80%;" onchange="getSearchData();">
                            <option value="">Search by Subject</option>
                            <option value="customer-service">Customer Service</option>
                            <option value="sales-support">Sales / Billing Support</option>
                            <option value="technical-support">Technical Support</option>
                        </select>&nbsp;
                        <div class="input-group search-form" style="width:80%;">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent"><i class="feather icon-search"></i></span></div>
                            <input name="search_name" class="form-control nav-search" onchange="getSearchData();" placeholder="#Name  #Email">
                        </div>&nbsp;
                        <a href="{{url('/admin/pending-tickets')}}" class="btn d-block ml-auto btn-warning"><i class="fa fa-undo"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Ticket Id</th>
                                                <th>Vendor Name</th>
                                                <th>Subject</th>
                                                <th>Title</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Ticket Since</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            function time_elapsed_string($datetime, $full = false) {
                                                $now = new DateTime;
                                                $ago = new DateTime($datetime);
                                                $diff = $now->diff($ago);
                                                $diff->w = floor($diff->d / 7);
                                                $diff->d -= $diff->w * 7;
                                                $string = array('y'=>'year', 'm'=>'month', 'w'=>'week', 'd'=>'day', 'h'=>'hour', 'i'=>'minute', 's'=>'second');
                                                foreach($string as $k => &$v) {
                                                    if($diff->$k) {
                                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                                    } else {
                                                        unset($string[$k]);
                                                    }
                                                }
                                                if (!$full) $string = array_slice($string, 0, 1);
                                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                                            } ?>
                                            @foreach($tickets as $tkt)
                                            <tr>
                                                <td>{{$tkt->ticket_id}}</td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body align-self-center">
                                                            <h5 class="mb-1">
                                                                <a href="{{url('admin/ticket-details')}}/{{$tkt->id}}" class="text-dark">{{$tkt->name}}</a>
                                                            </h5>
                                                            <p class="mb-0"><a href="mailto:{{$tkt->email}}" class="text-secondary">{{$tkt->email}}</a></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ucwords($tkt->subject)}}</td>
                                                <td>@if(strlen($tkt->title) > 50)
                                                        {{substr($tkt->title,0,stripos($tkt->title, ' ', 50)).'...'}}
                                                    @else
                                                        {{$tkt->title}}
                                                    @endif
                                                </td>
                                                <td>{{$tkt->priority}}</td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body align-self-center">
                                                            <h5 class="mb-1">
                                                                @if($tkt->status == 0)
                                                                <span style="color:#ffb800;font-weight:bold;">Open</span>
                                                                @elseif($tkt->status == 1)
                                                                <span style="color:#0097e1;font-weight:bold;">{{$tkt->awaiting_support}}</span>
                                                                @elseif($tkt->status == 2)
                                                                <span style="color:#2dca73;font-weight:bold;">Closed</span>
                                                                @endif
                                                            </h5>
                                                            <p class="mb-0">
                                                                @if($tkt->is_read == 1)
                                                                <span style="color:#2dca73;font-weight:bold;">Read</span>
                                                                @else
                                                                <span style="color:#ff0b37;font-weight:bold;">Not Read</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo time_elapsed_string($tkt->created_at); ?></td>
                                                <td>
                                                    <a href="{{url('admin/ticket-details')}}/{{$tkt->id}}"><i class="fa fa-eye text-success btn shadow-none" style="font-size:20px;"></i></a>
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
<script src="{{url('assets/js/menu-setting.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $('#usertable').DataTable();
    function getSearchData() {
        var name = $('input[name=search_name]').val();
        var subject = $('select[name=search_subject]').val();
        if(name != '') {
            window.location.href = "{{url('admin/pending-tickets')}}?name="+name;
        } else if(subject != '') {
            window.location.href = "{{url('admin/pending-tickets')}}?subject="+subject;
        }
    }
</script>
</body>
</html>