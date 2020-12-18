@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<style type="text/css"></style>
<script src="https://www.google.com/jsapi"></script>
<section class="section-padding dashboard-wrap dash_main_sect">
   @include('vendor.tools_nav')
   <div class="wrapper">
    <div class="col-sm-12">
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible">
        <strong>Success!</strong> {{ session()->get('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
      @endif
        <div class="adminHomeResume">
          <div class="row">
            <!-- <div class="col-sm-1"></div> -->
            <div class="col-sm-2">
              <div class="adminHomeResume__item app-link" data-href="{{url('messages')}}">
                    <span class="adminHomeResume__count adminHomeResume__count--envelope">{{ $data['messageCount'] }}</span>
                    <p class="adminHomeResume__description admin_desc_wrp">
                       <span>Message received</span> in the last 12 months
                    </p>
                 </div>
            </div>
            <div class="col-sm-3">
              <div class="adminHomeResume__item app-link--" data-href="">
                    <span class="adminHomeResume__count adminHomeResume__count--time">{{ $data['avarageResponcetime'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Average response time</span> the last 3 months
                    </p>
                 </div>
            </div>
            <div class="col-sm-2">
              <div class="adminHomeResume__item app-link" data-href="{{url('reviews-list')}}">
                    <span class="adminHomeResume__count adminHomeResume__count--star">{{ $data['reviewCount'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Reviews</span> in the last 12 months
                    </p>
                 </div>
            </div>
            <div class="col-sm-2">
              <div class="adminHomeResume__item">
                    <span class="adminHomeResume__count adminHomeResume__count--eye">{{ $data['storefrontView'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Profile impressions</span> in the last 12 months
                    </p>
                 </div>
            </div>
            <div class="col-sm-3">
              <div class="adminHomeResume__item">
                    <span class="adminHomeResume__count adminHomeResume__count--phone">{{ @$data['phoneNumberViews'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Phone number views</span> in the last 12 months<br>
                    </p>
                 </div>
            </div>
            <!-- <div class="col-sm-1"></div> -->
          </div>
           <div class="pure-g hidden">
              <div class="pure-u-1-5">
                 <div class="adminHomeResume__item app-link--" data-href="">
                    <span class="adminHomeResume__count adminHomeResume__count--envelope">{{ $data['messageCount'] }}</span>
                    <p class="adminHomeResume__description admin_desc_wrp">
                       <span>Message received</span> in the last 12 months
                    </p>
                 </div>
              </div>
              <div class="pure-u-1-5">
                 <div class="adminHomeResume__item app-link--" data-href="">
                    <span class="adminHomeResume__count adminHomeResume__count--time">{{ $data['avarageResponcetime'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Average response time</span> the last 3 months
                    </p>
                 </div>
              </div>
              <div class="pure-u-1-5">
                 <div class="adminHomeResume__item app-link--" data-href="">
                    <span class="adminHomeResume__count adminHomeResume__count--star">{{ $data['reviewCount'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Reviews</span> in the last 12 months
                    </p>
                 </div>
              </div>
              <div class="pure-u-1-5">
                 <div class="adminHomeResume__item">
                    <span class="adminHomeResume__count adminHomeResume__count--eye">{{ $data['storefrontView'] }}</span>
                    <p class="adminHomeResume__description">
                       <span>Profile impressions</span> in the last 12 months
                    </p>
                 </div>
              </div>
              <div class="pure-u-1-5">
                 <div class="adminHomeResume__item">
                    <span class="adminHomeResume__count adminHomeResume__count--phone">0</span>
                    <p class="adminHomeResume__description">
                       <span>Phone number views</span> in the last 12 months<br>
                    </p>
                 </div>
              </div>
           </div>
        </div>
    </div>
      <div class="row">
        <div class="col-sm-12">
          <p class="adminHomeAlert app-link dash_msg" data-href="">
             <span class="adminHomeAlert__icon"></span>
             You have <strong>{{@$unmessa}} unread message</strong>.
             <a href="{{url('messages')}}">
             See all  <span class="icon icon-arrow-right ml5"></span>
             </a>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="mr40---">
               <div class="app-va-stats-dashboard-div mt10">
                  <div class="clearfix mb10">
                    <div class="col-sm-6">
                       <h2 class="adminTitleSection pull-left">Analytics</h2>
                    </div>
                    <div class="col-sm-6">
                     <div class="app-ui-dropdown app-va-stats-dashboard-year-dropdown adminFiltersBox__select adminFiltersBox__select--blood year_test_sel pull-right" data-year-value="0">
                        <span class="month_wrp">in the last 12 months</span>
                        <i class="icon icon-arrow-down"></i>
                        <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown year_dropdown" style="display:none;">
                           <li>
                              <a class="app-va-stats-dashboard-change-year year_link" data-iditem="2019">2019</a>
                           </li>
                        </ul>
                     </div>
                   </div>
                  </div>
                  <div class="adminHomeAnalytics row">
                     <div class="col-sm-3" style="padding-left: 0;padding-right: 0;">
                        <div class="adminHomeAnalytics__filters">
                           <button data-button="visits" class="app-analytics-tabs-button adminHomeAnalytics__button active">
                           <span class="adminHomeAnalytics__buttonCounter">{{ $data['storefrontView'] }}</span>
                           Profile Impressions </button>
                           <button data-button="solics" class="app-analytics-tabs-button adminHomeAnalytics__button">
                           <span class="adminHomeAnalytics__buttonCounter">{{ $data['messageCount'] }}</span>
                           Leads </button>
                           <button data-button="phone" class="app-analytics-tabs-button adminHomeAnalytics__button">
                           <span class="adminHomeAnalytics__buttonCounter">0</span>
                           Phone number views </button>
                        </div>
                     </div>
                     <div class="col-sm-9" style="padding-left: 0;padding-right: 0;">
                        <div class="app-analytics-tabs" id="visits">
                           <div class="adminHomeAnalytics__content">
                              <h3 class="adminSubtitle store_title">Profile impressions</h3>
                              <p class="color-grey">View the monthly Profile impressions you received on MyHealthSquad.</p>
                              <div class="adminHomeAnalytics__chart">
                                 <div class="app-va-stats-dashboard" id="app-va-stats-visitas">
                                    
                                 </div>
                                 <script>
                                    google.load("visualization", "1", {packages: ["corechart"]});
                                    google.setOnLoadCallback(drawChartVisitas);
                                    function drawChartVisitas() {
                                        var __instance__ = arguments.callee;
                                        var data = google.visualization.arrayToDataTable([
                                            ['', 'Impressions '],
                                            @foreach($data['storefrontmonthView'] as $datavalue)
                                            ['{{$datavalue['name']}}', {{$datavalue['count']}}],
                                            @endforeach        ]);
                                    
                                        var options = {
                                            height: '180',
                                            legend: 'none',
                                            chartArea: {'top': 0, 'left': '5%', 'width': '100%', 'height': '100%'},
                                            fontSize: 10,
                                            backgroundColor: '#FFF',
                                            colors: ['#19b5bc'],
                                            hAxis: {
                                                textStyle: {
                                                    color: '#424242'
                                                },
                                                baselineColor: '#F9F9F9'
                                            },
                                            vAxis: {
                                                textStyle: {
                                                    color: '#424242'
                                                },
                                                gridlines: {
                                                    color: '#dadada'
                                                },
                                                baselineColor: '#dadada',
                                                viewWindow:{
                                                    min:0
                                                }
                                            }
                                        };
                                    
                                        var chartGoogle = document.getElementById('app-va-stats-visitas');
                                    
                                        !__instance__.googleChart &&
                                        (__instance__.googleChart = new google.visualization.ColumnChart(chartGoogle));
                                    
                                        __instance__.googleChart.draw(data, options);
                                    }
                                 </script><script src="https://www.google.com/uds/?file=visualization&amp;v=1&amp;packages=corechart" type="text/javascript"></script>
                                 <link href="https://www.google.com/uds/api/visualization/1.0/36558b280aac4fa99ed8215e60015cff/ui+en_GB.css" type="text/css" rel="stylesheet">
                                 <script src="https://www.google.com/uds/api/visualization/1.0/36558b280aac4fa99ed8215e60015cff/format+en_GB,default+en_GB,ui+en_GB,corechart+en_GB.I.js" type="text/javascript"></script>
                              </div>
                              <div class="adminHomeAnalytics__counter">
                                 <p class="adminHomeAnalytics__total">
                                    in the last 12 months:
                                    <span>{{ $data['storefrontView'] }}</span>
                                 </p>
                                 <p class="adminHomeAnalytics__total">
                                    Total:
                                    <span>{{ $data['storefrontView'] }}</span>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="app-analytics-tabs" id="solics" style="display:none;">
                           <div class="adminHomeAnalytics__content">
                              <h3 class="adminSubtitle">Leads Received</h3>
                              <p class="color-grey">View the monthly leads you received on PerfectWedding.</p>
                              <div class="adminHomeAnalytics__chart">
                                 <div class="app-va-stats-dashboard" id="app-va-stats-solicitudes">
                                    
                                 </div>
                                 <script>
                                    google.load("visualization", "1", {packages: ["corechart"]});
                                    google.setOnLoadCallback(drawChartSolics);
                                    
                                    function drawChartSolics() {
                                        var ashiq ="ASHIQ";
                                        var __instance__ = arguments.callee;
                                    
                                        var data = google.visualization.arrayToDataTable([
                                            ['', 'Messages'],
                                            @foreach($data['leadsmsmonthView'] as $datavalue)
                                            ['{{$datavalue['name']}}', {{$datavalue['count']}}],
                                            @endforeach         ]);
                                    
                                        var options = {
                                            height: '180',
                                            legend: 'none',
                                            chartArea: {'top': 0, 'left': '5%', 'width': '100%', 'height': '100%'},
                                            fontSize: 10,
                                            backgroundColor: '#fff',
                                            colors: ['#19b5bc'],
                                            hAxis: {
                                                textStyle: {
                                                    color: '#424242'
                                                },
                                                baselineColor: '#dadada'
                                            },
                                            vAxis: {
                                                textStyle: {
                                                    color: '#424242'
                                                },
                                                gridlines: {
                                                    color: '#dadada'
                                                },
                                                baselineColor: '#dadada',
                                                viewWindow:{
                                                    min:0
                                                }
                                            }
                                        };
                                    
                                        var chartGoogle = document.getElementById('app-va-stats-solicitudes');
                                    
                                        __instance__.googleChart = new google.visualization.ColumnChart(chartGoogle);
                                    
                                        __instance__.googleChart.draw(data, options);
                                    }
                                 </script>
                              </div>
                              <div class="adminHomeAnalytics__counter">
                                 <p class="adminHomeAnalytics__total">
                                    in the last 12 months:
                                    <span>{{ $data['messageCount'] }}</span>
                                 </p>
                                 <p class="adminHomeAnalytics__total">
                                    Total:
                                    <span>{{ $data['messageCount'] }}</span>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="app-analytics-tabs" id="phone" style="display:none;">
                           <div class="adminHomeAnalytics__content">
                              <h3 class="adminSubtitle">Clicks to view telephone</h3>
                              <p class="color-grey">View clicks to view your phone number on your PerfectWedding Storefront.</p>
                              <div class="adminHomeAnalytics__chart">
                                 <div class="app-va-stats-dashboard" id="app-va-stats-telefono">
                                    <div style="position: relative;">
                                       <div dir="ltr" style="position: relative; width: 400px; height: 180px;">
                                          <div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                                             <svg width="400" height="180" aria-label="A chart." style="overflow: hidden;">
                                                <defs id="defs">
                                                   <clipPath id="_ABSTRACT_RENDERER_ID_10">
                                                      <rect x="20" y="0" width="380" height="180"></rect>
                                                   </clipPath>
                                                </defs>
                                                <rect x="0" y="0" width="400" height="180" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                                <g>
                                                   <rect x="20" y="0" width="380" height="180" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                                   <g clip-path="url()">
                                                      <g>
                                                         <rect x="20" y="179" width="380" height="1" stroke="none" stroke-width="0" fill="#dadada"></rect>
                                                         <rect x="20" y="90" width="380" height="1" stroke="none" stroke-width="0" fill="#dadada"></rect>
                                                         <rect x="20" y="0" width="380" height="1" stroke="none" stroke-width="0" fill="#dadada"></rect>
                                                      </g>
                                                      <g>
                                                         <rect x="26" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="55" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="84" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="114" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="143" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="172" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="201" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="230" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="259" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="288" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="318" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="347" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                         <rect x="376" y="179" width="18" height="0.5" stroke="none" stroke-width="0" fill="#19b5bc"></rect>
                                                      </g>
                                                      <g>
                                                         <rect x="20" y="179" width="380" height="1" stroke="none" stroke-width="0" fill="#dadada"></rect>
                                                      </g>
                                                   </g>
                                                   <g></g>
                                                   <g>
                                                      <g>
                                                         <text text-anchor="end" x="10" y="183" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#424242">0.0</text>
                                                      </g>
                                                      <g>
                                                         <text text-anchor="end" x="10" y="93.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#424242">0.5</text>
                                                      </g>
                                                      <g>
                                                         <text text-anchor="end" x="10" y="4" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#424242">1.0</text>
                                                      </g>
                                                   </g>
                                                </g>
                                                <g></g>
                                             </svg>
                                             <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                                <table>
                                                   <thead>
                                                      <tr>
                                                         <th></th>
                                                         <th>Clicks</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>Jul</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Aug</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Sep</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Oct</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Nov</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Dec</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Jan</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Feb</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Mar</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Apr</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>May</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Jun</td>
                                                         <td>0</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Jul</td>
                                                         <td>0</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                       <div aria-hidden="true" style="display: none; position: absolute; top: 190px; left: 410px; white-space: nowrap; font-family: Arial; font-size: 10px;">...</div>
                                       <div></div>
                                    </div>
                                 </div>
                                 <script>
                                    google.load("visualization", "1", {packages: ["corechart"]});
                                    google.setOnLoadCallback(drawChartTelef);
                                    
                                    function drawChartTelef() {
                                    
                                      var __instance__ = arguments.callee;
                                    
                                      var data = google.visualization.arrayToDataTable([
                                        ['', 'Clicks'],
                                        ['Jul', 0],['Aug', 0],['Sep', 0],['Oct', 0],['Nov', 0],['Dec', 0],['Jan', 0],['Feb', 0],['Mar', 0],['Apr', 0],['May', 0],['Jun', 0],['Jul', 0]    ]);
                                    
                                      var options = {
                                        height: '180',
                                        legend: 'none',
                                        chartArea: {'top': 0, 'left': '5%', 'width': '100%', 'height': '100%'},
                                        fontSize: 10,
                                        backgroundColor: '#fff',
                                        colors: ['#19b5bc'],
                                        hAxis: {
                                          textStyle: {
                                            color: '#424242'
                                          },
                                          baselineColor: '#dadada'
                                        },
                                        vAxis: {
                                          textStyle: {
                                            color: '#424242'
                                          },
                                          gridlines: {
                                            color: '#dadada'
                                          },
                                          baselineColor: '#dadada',
                                          viewWindow:{
                                            min:0
                                          }
                                        }
                                      };
                                    
                                      var chartGoogle = document.getElementById('app-va-stats-telefono');
                                    
                                      !__instance__.googleChart &&
                                      (__instance__.googleChart = new google.visualization.ColumnChart(chartGoogle));
                                    
                                      __instance__.googleChart.draw(data, options);
                                    }
                                 </script>
                              </div>
                              <div class="adminHomeAnalytics__counter">
                                 <p class="adminHomeAnalytics__total">
                                    in the last 12 months:
                                    <span>0</span>
                                 </p>
                                 <p class="adminHomeAnalytics__total">
                                    Total:
                                    <span>0</span>
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="pure-u-1">
                        <div class="app-analytics-tabs" data-target="visits">
                        </div>
                        <div class="app-analytics-tabs" data-target="solics" style="display:none;">
                        </div>
                     </div>
                  </div>
               </div>
               @if(isset($data['message']) && @$data['message']->count() > 0)
               <h2 class="mt40 adminTitleSection">Recent messages</h2>
               <ul class="adminHomeSol">
               @foreach($data['message'] as $messageVal)

                  <li class="adminHomeSol__item pure-g @if(!@$messageVal->read_status) adminHomeSol__item--new @endif">
                     <div class="pure-u-7-10">

                        <div class="fleft mr10">
                           <div class="adminHomeSol__avatar app-link--">

                              @if(@$messageVal->user['profile_image'])
                                <figure>
                                    <img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ @$messageVal->user['id'] }}/{{ @$messageVal->user['profile_image'] }}" alt="Emily" width="60" height="60">
                                </figure>
                              @else
                                <div class="avatar-alias size-avatar-medium ">
                                   <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                      <circle fill="#C097A0" cx="100" cy="100" r="100"></circle>
                                      <text transform="translate(100,130)" y="0">
                                         <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst(substr(@$messageVal->name,0,1)) }}</tspan>
                                      </text>
                                   </svg>
                                </div>
                            @endif
                           </div>
                        </div>

                        <div class="overflow">
                           <a class="adminHomeSol__name" href="{{ url('message-details') }}/{{ @$messageVal->id }}">
                           {{ @$messageVal->name }} <span>{{ count(@$messageVal->replies) }}</span>
                           </a>
                           <div>
                           @if(@$messageVal->reply_status == 0)
                              <span class="adminHomeSol__status adminHomeSol__status--pending">Pending</span>
                           @elseif(@$messageVal->reply_status == 1)
                              <span class="adminHomeSol__status adminHomeSol__status--info">Replied</span>
                           @endif
                              <time class="adminHomeSol__date">
                                 {{ date('d/M/Y', strtotime(@$messageVal->created_at)) }} at {{ date('H:i', strtotime(@$messageVal->created_at)) }} 
                              </time>
                           </div>
                           <p class="adminHomeSol__description"> 
                              {{ str_limit(strip_tags(@$messageVal->comment), $limit = 150, $end = '...') }}
                            </p>
                        </div>

                     </div>
                     <div class="pure-u-3-10">
                        <div clas="pure-g">
                           <div class="adminHomeSol__info cmn_date_wrp pure-u-1-2">
                              <span class="adminHomeSol__icon adminHomeSol__icon--envelope"></span>
                              <time class="adminHomeSol__info-number"> {{ date('d', strtotime(@$messageVal->created_at)) }} {{ date('M', strtotime(@$messageVal->created_at)) }} <span class="adminHomeSol__info-extra">{{ date('Y', strtotime(@$messageVal->created_at)) }}</span></time>
                           </div>
                        </div>
                     </div>
                  </li>

               @endforeach
                  <li>
                     <a class="adminHomeSol__more unread_link" rel="nofollow" href="{{url('messages')}}">
                     See all</a>
                  </li>
               </ul>
               @else
               <!--<h2 class="mt40 adminTitleSection">You have no messages to be displayed</h2>-->
               @endif
               @if($data['ratingDataCount'] > 0)
                    <h2 class="mt40 adminTitleSection">You have {{$data['ratingDataCount']}} reviews found</h2>
                    <ul class="adminHomeSol">
                   @foreach($data['ratingDatas'] as $rts)
              <?php
                $shortName = str_replace(substr($rts->name, 1),'',$rts->name);
                    $ratingIndi = '0%';
                    if($rts->average_rating == 1) {
                        $ratingIndi = '20%';
                    } else if($rts->average_rating == 2) {
                        $ratingIndi = '40%';
                    } else if($rts->average_rating == 3) {
                        $ratingIndi = '60%';
                    } else if($rts->average_rating == 4) {
                        $ratingIndi = '80%';
                    } else if($rts->average_rating == 5) {
                        $ratingIndi = '100%';
                    }
              ?>
                  <li class="adminHomeSol__item pure-g @if(@$messageVal->highlights == 1) adminHomeSol__item--new @endif">
                      <div class="pure-u-7-10">
                          <div class="fleft mr10">
                              <div class="adminHomeSol__avatar app-link">
                                  <div class="avatar-alias size-avatar-medium ">
                                      <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                              <circle fill="#BCB0B5" cx="100" cy="100" r="100"></circle>
                              <text transform="translate(100,130)" y="0">
                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ strtoupper($shortName) }}</tspan>
                              </text>
                            </svg>
                                  </div>
                              </div>
                          </div>
                  <!--<div class="app-review-rating-container mt5">-->
                    
                  <!--</div>-->
                          <div class="overflow">
                              <div class="rating-stars-vendor">
                      <span class="rating-stars-vendor rating-stars-vendor-bar" style="width: {{ $ratingIndi }}"></span>
                    </div>
                    <span class="review__ratio ml5">{{ round($rts->average_rating).'.0' }}&nbsp;&nbsp;&nbsp;</span>
                              <a class="adminHomeSol__name" href="#">{{ ucfirst($rts->name) }} <span></span></a>
                              <p class="adminHomeSol__description">{{ $rts->review_title }}</p>
                          </div>
                          <br>
                      </div>
                </li>
              @endforeach
              <li>
                            <a class="adminHomeSol__more unread_link" rel="nofollow" href="{{url('reviews-list')}}">
                             See detail</a>
                        </li>
              </ul>
               @else
               <div class="adminEmpty empty_wrp">
                  <i class="adminEmpty__icon adminEmpty__icon--reviews"></i>
                  <p class="adminEmpty__title empty_head">
                     You haven't received any reviews yet!                        
                  </p>
                  <p class="adminEmpty__description">
                     Reviews are critical when it comes time to choose a health professional. Encourage your clients & patients to leave reviews and evaluate your services                        
                  </p>
                  <a class="btnFlat btnFlat--primary reviews_btn" href="{{url('reviews')}}">
                  Request reviews                        </a>
               </div>
               @endif
            </div>
        </div>
        <div class="col-sm-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="adminHomePercent mt10" @if($vendor_progress_percentage >= 100) style="display:none;" @endif>
                   <div class="app-link" data-href="{{url('vendor-checklist')}}">
                      <div class="adminHomePercent__content pure-g">
                         <div class="pure-u-2-3">
                            <p class="adminHomePercent__title mb5">Complete your professional profile.</p>
                            <p>
                               You are just few steps away from completing your professional profile
                            </p>
                            <span class="adminPercent__bar adminPercent__bar--{{$vendor_progress_percentage}}">
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            </span>
                         </div>
                         <div class="pure-u-1-3 app-link">
                            <div class="app-va-percentage adminHomePercent__circle animate dnone easyPieChart" data-percent="{{$vendor_progress_percentage}}" data-size="{{$vendor_progress_percentage}}" data-line="3" style="display: block; width: 90px; height: 90px; line-height: 90px;">
                               <span class="adminHomePercent__number">{{$vendor_progress_percentage}}%</span>
                               <canvas width="90" height="90"></canvas>
                            </div>
                         </div>
                      </div>
                   </div>
                   @if($vendor_progress_reviewAsk == 'no')
                   <footer class="adminHomePercent__footer"><a id="lnkSugerencia" href="{{url('reviews')}}">Ask 5 clients or patients for reviews</a></footer>
                   @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="adminHomeVendorFeature">
                   <div class="app-link--" data-href="">
                      <div class="adminHomeVendorFeature__content">
                         <div class="adminHomeVendorFeature__feature">
                            Feature highlight                        
                         </div>
                         <div class="pt10 pb10 rating_wrp">
                            <div class="rating-stars-vendor rating-stars-vendor-large-2x inline-block">
                               <span class="rating-stars-vendor rating-stars-vendor-bar" style=" width:0%;"></span>
                            </div>
                            <div class="inline-block ml10 strong">0.0 / 5.0</div>
                         </div>
                         <p class="adminHomeVendorFeature__title">Boost your credibility with great reviews</p>
                         <p>Quickly and easily request reviews with a customized email to past clients.</p>
                      </div>
                      <div class="adminHomeVendorFeature__footer request_link">
                         <a class="link--primary" href="{{url('reviews')}}">Request reviews</a>
                      </div>
                   </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="pure-g hidden">
         <div class="pure-u-7-10">
            
         </div>

         <div class="pure-u-3-10">
            
            
            <!-- <div class="adminHomeBanner" style="">
               <div class="adminHomeBanner__content">
                  <p class="adminHomeBanner__title">Download the PerfectWedding for Business App</p>
                  <p class="adminHomeBanner__description">Manage your messages from anywhere with our vendor app!</p>
               </div>
               <footer class="adminHomeBanner__footer">
                  <a href="javascript:;" rel="nofollow" class="button-app-market-small android">Available for</a>
                  <a href="javascript:;" rel="nofollow" class="button-app-market-small iphone">Available for</a>
               </footer>
            </div> -->
         </div>
      </div>
   </div>
</section>
@include('includes.footer')
<script type="text/javascript">
  $(document).ready(function() {

    $('.month_wrp').click(function(){
      $('.year_dropdown').toggle();
    });

    $('.app-analytics-tabs-button').on('click', function() {
      var dataval = $(this).attr('data-button');
      $(this).siblings().removeClass('active');
      $(this).addClass('active');
      $('.app-analytics-tabs').hide();
      $('#'+dataval).show();
    });

  });
</script>
@endsection