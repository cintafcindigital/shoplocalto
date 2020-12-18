@include('include/header')

<style>
#taskfull-dashboard-chart-visitors .apexcharts-datalabel-value {
    font-size: 50px !important;
}
#taskfull-dashboard-chart-vendors .apexcharts-datalabel-value {
    font-size: 50px !important;
}
#taskfull-dashboard-chart-couplesProvince .apexcharts-datalabel-value {
    font-size: 50px !important;
}
</style>
<?php
if(@$data['totalVisits'] == 0) {
    $totalVisits = 1;
} else {
    $totalVisits = @$data['totalVisits'];
}
if(@$data['monthlySignup'] == 0) {
    $monthlySignup = 1;
} else {
    $monthlySignup = @$data['monthlySignup'];
}
?>
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        @if(session()->has('success'))
        <div class="row">
            <div class="col-sm-12">
                {!! session()->get('success') !!}
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <h2 class="font-weight-normal">Hi {{Session::get('adminData')[0]['name']}}, Welcome back!</h2>
                <p>{{Session::get('adminData')[0]['email']}}</p>
                <!--<div id="dashboarddatepicker1" class="form-control d-inline-block w-auto mb-4">
                    <i class="feather icon-calendar"></i>&nbsp;
                    <span></span> <i class="feather icon-chevron-down"></i>
                </div>-->
            </div>
            <div class="col-sm-6">
                <!-- <button class="btn btn-primary float-right">Send Message</button> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart1"></div>
                                <h5 class="text-success">{{@$data['monthlySignup']}} <small class="text-body">This Month</small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart2"></div>
                                <h5 class="text-danger">{{@$data['totalVisits']}} <small class="text-body">This Month</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card d-none">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-4">Vendors By Active VS Pending</h2>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div id="taskfull-dashboard-chart-vendors" class="my-2"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mb-3"><i class="fas fa-circle text-c-color3 f-10 m-r-10"></i>Total Vendors <span class="float-right h6 mb-0 text-body">{{$data['totalVendors']}}</span></p>
                                        <p class="mb-3"><i class="fas fa-circle text-c-color2 f-10 m-r-10"></i>Active Vendors <span class="float-right h6 mb-0 text-body">{{$data['activeVendors']}}</span></p>
                                        <p class="mb-3"><i class="fas fa-circle text-c-color5 f-10 m-r-10"></i>Pending Vendors <span class="float-right h6 mb-0 text-body">{{$data['inactiveVendors']}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-4">Recent Vendors</h2>
                        <div class="row align-items-center">
                            <!--<div class="col-md-4">
                                <div id="taskfull-dashboard-chart-visitors" class="my-2"></div>
                            </div>-->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @foreach($data['recentVendors'] as $proNum => $proVists)
                                            <p class="mb-3"><i class="fas fa-circle text-c-color{{$proNum+1}} f-10 m-r-10"></i>{{$proVists->business_name}} <span class="float-right h6 mb-0 text-body"></span></p>
                                            @if(($proNum+1)%2 == 0)
                                                </div><div class="col-sm-6">
                                            @endif
                                            @if($proNum == 9) break; @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-4">Recent Community Posts</h2>
                        <div class="row align-items-center">
                            <!--<div class="col-md-4">
                                <div id="taskfull-dashboard-chart-leads" class="my-2"></div>
                            </div>-->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @foreach($data['recentCommunityPosts'] as $proNum => $proVists)
                                            <p class="mb-3"><i class="fas fa-circle text-c-color{{$proNum+1}} f-10 m-r-10"></i>{{$proVists->name}} <span class="float-right h6 mb-0 text-body"></span></p>
                                            @if(($proNum+1)%2 == 0)
                                                </div><div class="col-sm-6">
                                            @endif
                                            @if($proNum == 9) break; @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-4">Top Searches</h2>
                        <div class="row align-items-center">
                            <!--<div class="col-md-4">
                                <div id="taskfull-dashboard-chart-sales" class="my-2"></div>
                            </div>-->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @foreach($data['topSearches'] as $proNum => $proVists)
                                            <p class="mb-3"><i class="fas fa-circle text-c-color{{$proNum+1}} f-10 m-r-10"></i>{{$proVists->name}} <span class="float-right h6 mb-0 text-body"></span></p>
                                            @if(($proNum+1)%2 == 0)
                                                </div><div class="col-sm-6">
                                            @endif
                                            @if($proNum == 9) break; @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!--<div class="card">-->
                    <!--<div class="card-body">
                        <h3 class="font-weight-normal">Leads By Category</h3>
                        <div id="taskfull-dashboard-chart-leadsCategory" class="mb-3 mt-5"></div>
                        <div>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color1 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color2 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color3 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color4 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color5 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color6 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color7 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color8 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color9 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-circle text-c-color10 f-10 m-r-10"></i>Category &nbsp; <b style="font-size:20px;"># </b>10 Days <span class="float-right h6 mb-0 mt-2 text-body"># Month</span>
                            </p>
                        </div>
                    </div>-->
                    <!--<hr style="margin:0px;">
                    <div class="card-body">
                        <h3 class="font-weight-normal">Couples by Province</h3>
                        <div id="taskfull-dashboard-chart-couplesProvince" class="mb-4 mt-4"></div>
                        <div>
                            @foreach($data['provinceCouples'] as $ky => $prc)
                                <p class="mb-2">
                                    <i class="fas fa-circle text-c-color{{$ky+1}} f-10 m-r-10"></i>{{$prc->province}}
                                    <span class="float-right h6 mb-0 text-body">{{$prc->visits}}</span>
                                </p>
                                @if($ky == 9) break; @endif
                            @endforeach
                        </div>
                    </div>-->
                <!--</div>-->
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-normal">Top Categories</h3>
                        <div class="table-responsive">
                            <table class="table table-borderless post-table table-center mb-0 top-category">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th style="text-align:center;">Vendors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['catVisits'] as $key => $value)
                                        <?php $visits = 0; ?>
                                        <!--if(count((array) -->
                                        <!--if(count(@$value->vendor_data) > 0)-->
                                            <?php /*foreach($value->vendor_data as $comp) {
                                                if($comp->cat_id == $value->id) {
                                                    $visits += $comp->company_data['visits'];
                                                }
                                            }*/ ?>
                                            <!--if($visits > 0)-->
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td><h5 class="mb-0 font-weight-normal">{{@$value->title}}</h5></td>
                                                <td style="text-align:center;"> {{@$value->vendors}}</td>
                                            </tr>
                                            <!--endif-->
                                        <!--endif-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- <hr><div class="text-center"><a href="javascript:;" class="text-body">See all</a></div> -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-normal">Featured Venodrs</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{url('admin/set-vendors')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select class="js-data-example-ajax form-control" required name="vendor[]" multiple="true"></select>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right">Submit</button>
                                    <br><br><br>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless post-table table-center mb-0 top-category">
                                <thead>
                                    <th>#</th>
                                    <th>Vendor</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($data['vendorsHomePage'] as $vendor)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                @if(empty($vendor->img))
                                                    <img src="{{url('public/storage/no-image.png')}}" alt="Vendor Image" class="img-fluid avtar avtar-s" style="width: 100px; height: 50px;font-size: 14px;object-fit: contain;border-radius: 0%;">
                                                @else
                                                    <img src="{{url('public/vendors/VENDOR_'.$vendor->vendor_id.'/'.$vendor->img)}}" alt="Vendor Image" class="img-fluid avtar avtar-s" style="width: 100px; height: 50px;font-size: 14px;object-fit: contain;border-radius: 0%;">
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{@$vendor->company_data->business_name}}</td>
                                        <td><a href="{{url('admin/remove-home-page-vendors/'.$vendor->vendor_id)}}" class="text-danger" onclick="javascript:return confirm('Do you want to remove this item from home page slider ?')"><i class="fa fa-trash"></i></a></td>
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
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
<script src="{{url('public/js/select2.min.js')}}" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('.js-data-example-ajax').select2({
          ajax: {
            url: '{{url("admin/get-vendors")}}',
            dataType: 'json'
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
          }
        });
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();
            function cb(start, end) {
                $('#dashboardtaskreportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#dashboardtaskreportrange2').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
    });
    $(function() {
        var options = {
            chart: {
                height: 220,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                },
            },
            colors: ['#2DCA73', '#d7dfe9'],
            series: [{
                name: 'PRODUCT A',
                data: [10, 12, 15, 10, 8]
            }, {
                name: 'PRODUCT B',
                data: [18, 16, 13, 18, 20]
            }],
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: ['MON', 'Tue', 'Wed', 'Thu', 'Fri'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                }
            },
            grid: {
                show: false,
            },
            yaxis: {
                show: false,
            },
            legend: {
                show: false,
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(document.querySelector("#dashboardtastbar6"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                height: 220,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                },
            },
            colors: ['#FFB800', '#d7dfe9'],
            series: [{
                name: 'PRODUCT A',
                data: [8, 10, 12, 15, 10]
            }, {
                name: 'PRODUCT B',
                data: [20, 18, 16, 13, 18]
            }],
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: ['MON', 'Tue', 'Wed', 'Thu', 'Fri'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                }
            },
            grid: {
                show: false,
            },
            yaxis: {
                show: false,
            },
            legend: {
                show: false,
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(document.querySelector("#dashboardtastbar5"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                height: 220,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                },
            },
            colors: ['#FF0B37', '#FFB800', '#d7dfe9'],
            series: [{
                name: 'PRODUCT A',
                data: [13, 13, 13, 13, 13]
            }, {
                name: 'PRODUCT B',
                data: [15, 15, 15, 15, 15]
            }, {
                name: 'PRODUCT c',
                data: [20, 20, 20, 20, 20]
            }],
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: ['MON', 'Tue', 'Wed', 'Thu', 'Fri'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                }
            },
            grid: {
                show: false,
            },
            yaxis: {
                show: false,
            },
            legend: {
                show: false,
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(document.querySelector("#dashboardtastbar4"), options);
        chart.render();
    });
    $(function() {
        var activeVendors = "{{number_format($data['activeVendors'])}}";
        var inactiveVendors = "{{number_format($data['inactiveVendors'])}}";
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [Number(activeVendors), Number(inactiveVendors)],
            tooltip: {
                enabled: true,
                y: {
                    formatter: function(val) {
                        if(val == activeVendors) {
                            return "Active Vendors "+" - "+val
                        } else {
                            return "Pending Vendors "+" - "+val
                        }
                    },
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                }
            },
            colors: ["#0e9e4a", "#ff5252"],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: false
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-vendors"), options);
        chart.render();
    });
    $(function() {
        var provClr = ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252", "#1edacc", "#d2377f", "#06affe", "#e4e900", "#ad06c6"];
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [
                <?php
                    foreach($data['provinceVisits'] as $key => $value) {
                        ?>
                            Number("{{$value->visits}}")
                        <?php
                        echo ", ";
                    }
                ?>
            ],
            tooltip: {
                enabled: true,
                y: {
                    formatter: function(val) {
                        <?php
                        foreach($data['provinceVisits'] as $key => $value) {
                            ?>
                            if(val == '{{$value->visits}}') {
                                return "{{$value->province}}"+" - "+"{{$value->visits}}"
                            }
                            <?php
                        }
                        ?>
                    },
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                }
            },
            colors: [
                <?php
                    foreach($data['provinceVisits'] as $key => $value) {
                        ?>
                            provClr[Number("{{$key}}")]
                        <?php
                        echo ", ";
                    }
                ?>
            ],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: false
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-visitors"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [200, 100, 300, 200, 100, 200, 100, 300, 200, 100],
            colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252","#1edacc", "#d2377f", "#06affe", "#e4e900", "#ad06c6"],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: true
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-leads"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [200, 100, 300, 200, 100, 200, 100, 300, 200, 100],
            colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252","#1edacc", "#d2377f", "#06affe", "#e4e900", "#ad06c6"],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: true
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-sales"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [44, 55, 41, 17, 15,44, 55, 41, 17, 15],
            colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252","#1edacc", "#d2377f", "#06affe", "#e4e900", "#ad06c6"],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: true
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-leadsCategory"), options);
        chart.render();
    });
    $(function() {
        var provClr = ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252", "#1edacc", "#d2377f", "#06affe", "#e4e900", "#ad06c6"];
        var options = {
            chart: {
                height: 200,
                type: 'donut',
                sparkline: {
                    enabled: true
                },
            },
            series: [
                <?php
                    foreach($data['provinceCouples'] as $key => $value) {
                        ?>
                            Number("{{$value->visits}}")
                        <?php
                        echo ", ";
                    }
                ?>
            ],
            tooltip: {
                enabled: true,
                y: {
                    formatter: function(val) {
                        <?php
                        foreach($data['provinceCouples'] as $key => $value) {
                            ?>
                            if(val == '{{$value->visits}}') {
                                return "{{$value->province}}"+" - "+"{{$value->visits}}"
                            }
                            <?php
                        }
                        ?>
                    },
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    }
                }
            },
            colors: [
                <?php
                    foreach($data['provinceCouples'] as $key => $value) {
                        ?>
                            provClr[Number("{{$key}}")]
                        <?php
                        echo ", ";
                    }
                ?>
            ],
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            name: {
                                show: false
                            },
                            value: {
                                show: true
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
        }
        var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart-couplesProvince"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                type: 'radialBar',
                offsetY: -20,
                sparkline: {
                    enabled: true
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#D7DFE9",
                        strokeWidth: '97%',
                        margin: 5, // margin is in pixels
                        shadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            color: '#999',
                            opacity: 1,
                            blur: 2
                        }
                    },
                    dataLabels: {
                        value: {
                            offsetY: -40,
                            fontSize: '22px'
                        }
                    }
                }
            },
            colors: ['#FFB800'],
            fill: {
                type: 'solid',
            },
            series: ["{{number_format((@$data['todaySignup'] * 100)/ @$monthlySignup)}}"],
            labels: ['Today Signup'],
        }
        var chart = new ApexCharts(document.querySelector("#opentask-taskchart1"), options);
        chart.render();
    });
    $(function() {
        var options = {
            chart: {
                type: 'radialBar',
                offsetY: -20,
                sparkline: {
                    enabled: true
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#D7DFE9",
                        strokeWidth: '97%',
                        margin: 5, // margin is in pixels
                        shadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            color: '#999',
                            opacity: 1,
                            blur: 2
                        }
                    },
                    dataLabels: {
                        value: {
                            offsetY: -40,
                            fontSize: '22px'
                        }
                    }
                }
            },
            colors: ['#ff0b37'],
            fill: {
                type: 'solid',
            },
            series: ["{{number_format((@$data['todayVisits'] * 100)/ @$totalVisits)}}"],
            labels: ['Today Visitors'],
        }
        var chart = new ApexCharts(document.querySelector("#opentask-taskchart2"), options);
        chart.render();
    });
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#dashboarddatepicker1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#dashboarddatepicker1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
    });
</script>
</body>
</html>
<?php /** @extends('layouts.app')
@section('content')
 <section class="content-header">
    <h1>
           Dashboard
           <small>Control panel</small> 
    </h1>
    <ol class="breadcrumb">         
        <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    </ol>
    </section>
 <section class="content">
     <div class="row">
        <!-- ./col -->
        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">0</span>
              <span class="info-box-number">Orders</span>
            </div>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion-ios-person-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{$data['users']}}</span>
              <span class="info-box-number">Users</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{$data['vendors']}}</span>
              <span class="info-box-number">Vendors</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{$data['enquiries']}}</span>
              <span class="info-box-number">Enquiry</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
                
    </div>
</section>
@endsection */ ?>