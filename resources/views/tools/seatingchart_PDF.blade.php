<!DOCTYPE html>
<html lang="en">
    <head>
<!--         <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
      <!--   <link rel="stylesheet" href="{{ URL::asset('css/tools.css') }}" media="all"> -->
        <style type="text/css" media="all">
            .wrapper-tools-tables {
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-orient: horizontal;
                -webkit-box-direction: normal;
                -webkit-flex-direction: row;
                -moz-box-orient: horizontal;
                -moz-box-direction: row;
                -ms-flex-direction: row;
                flex-direction: row;
                position: relative;
                margin-top: -20px;
                max-width: 100%;
                overflow: hidden;
            }
            .tools-tables-right-content {
                overflow: auto;
                width: 100%;
            }
            .tools-tables-viewbox {
                border-bottom: 1px solid #D9D9D9;
                min-width: -webkit-fill-available;
                min-width: -moz-available;
                min-width: fill-available;
                background-size: 58px;
                position: relative;
                min-height: 550px;
                padding: 55px;
                z-index: 1;
            }
            .tools-tables-content {
                width: 100%;
                height: 100%;
                position: relative;
                z-index: 9;
            }
            .tools-tables-gridItem {
                padding: 10px;
                cursor: move;
                transition: transform .09s ease-in;
            }
            .tools-tables-gridItem-square {
                border: 1px solid #444;
                background-color: #FFF;
                position: relative;
                z-index: -1;
                box-sizing: border-box;
                text-align: center;
                line-height: 180px;
            }
            .tools-tables-gridItem-squareLabel {
                color: #8C8C8C;
             /*   text-overflow: ellipsis;
                display: block;
                white-space: nowrap;*/
                display: block;
                font-weight: 400;
                font-size: 12px;
                line-height: 26px;
            }
            .tools-tables-gridItem-seat {
                border: 1px solid #444;
                background-color: #F5F5F5;
                border-radius: 100%;
                text-align: center;
                position: relative;
                height: 33px;
                width: 33px;
                text-align: center;
            }
            .tools-tables-gridItem-circle {
                /*position: absolute;
                top: 47px;
                left: 44px;*/

                position: relative;
                top: -54px;
                left: -51px;
                box-sizing: border-box;
                border: 1px solid #444;
                border-radius: 50px;
                background: #FFF;
                height: 133px;
                width: 137px;
            }
            .tools-tables-gridItem-guest {
                display: inline-block;
                position: absolute;
                z-index: 3;
                left: 1px;
                top: 2px;
            }
            .icon-tools-seating::before {
                content: '';
                display: inline-block;
                vertical-align: middle;
                background-image: url(http://test.perfectweddingday.ca/public/images/icon-tools-s89878a46c0.png);
                background-repeat: no-repeat;
                margin-top: -1px;
                -webkit-print-color-adjust: exact;
            }
            .tools-tables-gridItem-guestName {
                background: rgba(255,255,255,.7);
              /*  -webkit-transform: translateX(50%);
                transform: translateX(50%);*/
                border: 1px solid #e2e2e2;
                position: absolute;
                border-radius: 3px;
                padding: 2px 4px;
                z-index: 12;
                /*top: 50%;*/
                top: 34px;
                width: 30px;
                left: -3px;
              /*  max-width: 48px;*/
            }
            .tools-tables-gridItem-guestName span {
                line-height: 12px;
                font-size: 10px;
               /* max-width: 100%;*/
                display: block;
                /*overflow: hidden;*/
            }
            .icon-tools-groom-small::before {
                background-position: -29px -693px;
                height: 29px;
                width: 29px;
            }
            .tools-tables-gridItem-circleLabel {
                position: absolute;
                top: 60px;
                left: 40%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                color: #8C8C8C;
                font-weight: 400;
                font-size: 12px;
                padding: 0 10px;
                box-sizing: border-box;
                text-align: center;
                width: 100%;
            }

           .tools-tables-gridItem-topSide {
                height: 35px;
               /* float: left;*/
                position: relative;
               /* top: -24px;*/
                margin: 0 22px;
                    width: 146px;
            }
            .tools-tables-gridItem-lateralSide.leftSide {
                    /* float: left; */
                    top: 68px;
                    position: absolute;
                    left: -24px;
            }
            .tools-tables-gridItem-lateralSide.rightSide {
                position: absolute;
                right: -24px;
                top: 68px;
            }
            .tools-tables-gridItem-lateralSide {
              /*  display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
                float: left;
                align-self: center;*/
            }
           .tools-tables-gridItem-bottomSide {
                height: 35px;
                margin: 0 22px;
                /*float: left;*/
                direction: rtl;
                    width: 146px;
            }
            .tools-tables-gridItem-seat.seatX {
                margin: 0 5px;
              /*  display: inline-block;*/
              float: left;
            }
            .tools-tables-gridItem-seat.seatY {
                margin: 7px 0;
                /*float: left;*/
            }
            .tools-tables-gridItem-guest img {
                margin-top: -3px;
                margin-left: -2px;  
            }
            .table-common {
                position: absolute;
                display: block;
                vertical-align: top;
                margin: 25px;
            }
        </style>
    </head>

    <?php $tableChartCount = count($tableChart);
     $count = 1;
     ?>

    <body data-spy="scroll" data-offset="0" data-target="#navbar-main" class="dashbord">

    <div class="image-wr" style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #00AEAF">
        <img src="{{$pdfImage}}" alt="PDF LOGO">
    </div>

    <div class="htmlseatwr" style="position: relative; margin: 80px">
           <!--  <table> -->
                <?php 

                $counter = 0;
                foreach($tableChart as $tableC) { 

                    // if ($counter % 3 == 0) {
                    //     echo '</tr>';
                    //     echo '<tr>';
                    // }

                    if($tableC->table_type == '2side') { ?>
                     <!--  <td> -->
                        <div id="table_{{$tableC->id}}" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable table-common" style="width:{{$tableC->table_width.'px'}}; left: {{$tableC->posX.'px'}}; top: {{$tableC->posY.'px'}};">

                            <div style="height:34px;width:{{$tableC->table_width.'px'}}; position: relative;">
                                <?php $i = 0;
                                    while($i < $tableC->top_seat) { ?>
                                          
                                        <div style="margin: 0 7px; float:left;position:relative;left:0px;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">

                                            @foreach($tableC['seatdata'] as $seat)
                                                @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                @if($seat->seat_id == $seatID)
                                                    <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                    @foreach($currenUserGeust as $currenUserGeustVal)
                                                        @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                            <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span></div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach


                                        </div>
                                        <?php 
                                        $i++;
                                     }
                                ?>
                            </div>

                            <div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:{{$tableC->table_width.'px'}}"> 
                                <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; {{$tableC->table_nm}} &nbsp;</div>
                            </div>

                            <div style="height:34px; width:{{$tableC->table_width.'px'}}; position: relative;">
                            <?php $j = 0;
                                 while($j < $tableC->bottom_seat) {
                                        $styleMargin = '';
                                        if($tableC->top_seat > $tableC->bottom_seat && $j== 0) {
                                            $styleMargin = '0 7px 0 32px';
                                        }else {
                                             $styleMargin = '0 7px';
                                        } ?>
                                <div style="margin: {{$styleMargin}};float:left;position:relative;left:0px;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                    
                                    @foreach($tableC['seatdata'] as $seat)
                                        @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                        @if($seat->seat_id == $seatID)
                                           <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                            @foreach($currenUserGeust as $currenUserGeustVal)
                                                @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                    <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                </div>
                                <?php
                                    $i++;
                                    $j++;
                                } ?>
                            </div>
                        </div>
                     <!--  </td> -->
                    <?php  }//end of 2side


                    if($tableC->table_type == '1side') { ?>
                         <!--  <td> -->
                            <div id="table_{{$tableC->id}}" class="table-common" style="width:{{$tableC->table_width.'px'}}; left: {{$tableC->posX.'px'}}; top: {{$tableC->posY.'px'}};">

                                    <div style="height:34px; margin-bottom:-4px;width:{{$tableC->table_width.'px'}};position:relative;left:0px;display:block">
                                        <?php
                                         $i = 0;
                                         while ( $i < $tableC->table_seat) { ?>
                                              
                                              <div style="margin: 0 7px; float: left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                                
                                                @foreach($tableC['seatdata'] as $seat)
                                                            @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                            @if($seat->seat_id == $seatID)
                                                                <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                                @foreach($currenUserGeust as $currenUserGeustVal)
                                                                    @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                                        <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                              </div>

                                            <?php
                                            $i++;
                                         } ?>
                                    </div>

                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:{{$tableC->table_width.'px'}}; position: relative; left: 0"> <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; {{$tableC->table_nm}} &nbsp;</div></div>

                            </div>
                         <!--  </td> -->

                    <?php
                    }//end of 1side


                    if($tableC->table_type == 'round2') { ?>            
                         <!--  <td> -->
                            @php
                               $x = $tableC->posX + 100;
                               $y = $tableC->posY + 120;
                             @endphp
                            <div class="app-mesa-item tools-tables-gridItem table-common" id="table_{{$tableC->id}}" style="width:{{$tableC->table_width.'px'}}; height: {{$tableC->table_width.'px'}}; left: {{$x.'px'}}; top: {{$y.'px'}};">

                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-circle" style="z-index: -1;height: 120px; width: 120px">
                                        <div class="tools-tables-gridItem-circleLabel" id="table_{{$tableC->id}}">{{$tableC->table_nm}}</div>
                                    </div>
                                <?php
                                  $i = 0;
                                  $seatAngle = 270;
                                  while ( $i < $tableC->table_seat) { ?>
                                    <div id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}" class="app-table-seat tools-tables-gridItem-seat ui-droppable" style="position: absolute; top: calc(50% - 17.5px); left: calc(50% - 17.5px); z-index: -1; transform: rotate({{-$seatAngle.'deg'}}) translate({{$tableC->circle_tansform.'px'}}) rotate({{$seatAngle.'deg'}});">
                                            
                                            @foreach($tableC['seatdata'] as $seat)
                                                @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                @if($seat->seat_id == $seatID)
                                                    <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                    @foreach($currenUserGeust as $currenUserGeustVal)
                                                        @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                            <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                    </div>
                                    <?php
                                    $seatAngle = $seatAngle + $tableC->circle_angle;

                                    if($seatAngle > 360) {
                                      $seatAngle = $seatAngle - 360;
                                    }elseif($seatAngle == 360) {
                                        $seatAngle = 0;
                                    }
                                    $i++;
                                  } ?>

                            </div>
                         <!--  </td> -->
                    <?php
                    } // end of round2


                    if($tableC->table_type == 'square') { ?>

                         <!--  <td> -->
                            <div id="table_{{$tableC->id}}" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable table-common" style="width:{{$tableC->table_width.'px'}}; left: {{$tableC->posX.'px'}}; top: {{$tableC->posY.'px'}};">

                                    <div class="tools-tables-gridItem-topSide">
                                        <?php
                                        $i = 1;
                                        while ( $i <= $tableC->right_seat ) { ?>
                                        <div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="tables_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                            @foreach($tableC['seatdata'] as $seat)
                                                        @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                        @if($seat->seat_id == $seatID)
                                                            <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                            @foreach($currenUserGeust as $currenUserGeustVal)
                                                                @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                                    <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                        </div>
                                        <?php
                                            $i++;
                                      } ?>
                                    </div>


                                    <div class="flex">
                                        <div class="tools-tables-gridItem-lateralSide leftSide">
                                            <?php
                                            $j = 1;
                                             while ( $j <= $tableC->right_seat ) { ?>
                                                <div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                                    @foreach($tableC['seatdata'] as $seat)
                                                            @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                            @if($seat->seat_id == $seatID)
                                                                <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                                @foreach($currenUserGeust as $currenUserGeustVal)
                                                                    @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                                        <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                </div>
                                                <?php
                                              $j++; 
                                              $i++;
                                            } ?>
                                          </div>

                                          <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:{{$tableC->table_width.'px'}}; width:{{$tableC->table_width.'px'}};">
                                              <div class="tools-tables-gridItem-squareLabel" id="table1140089_label">{{$tableC->table_nm}}</div>
                                          </div>

                                          <div class="tools-tables-gridItem-lateralSide rightSide">
                                            <?php
                                            $k = 1;
                                             while ( $k <= $tableC->right_seat ) { ?>
                                                <div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                                    
                                                    @foreach($tableC['seatdata'] as $seat)
                                                            @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                            @if($seat->seat_id == $seatID)
                                                                <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                                @foreach($currenUserGeust as $currenUserGeustVal)
                                                                    @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                                        <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                </div>
                                                <?php
                                              $k++; $i++;
                                            } ?>
                                            
                                          </div>
                                    </div>

                                    <div class="tools-tables-gridItem-bottomSide">
                                        <?php
                                         $l = 1;
                                            while ( $l <= $tableC->bottom_seat ) { ?>
                                              <div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_{{$tableC->id.'_s'.$i}}" tbl-id="{{$tableC->id}}">
                                                
                                                @foreach($tableC['seatdata'] as $seat)
                                                            @php $seatID = 'table_'.$tableC->id.'_s'.$i; @endphp
                                                            @if($seat->seat_id == $seatID)
                                                                <img src="{{asset('images/author.png')}}" alt="Guest"/>
                                                                @foreach($currenUserGeust as $currenUserGeustVal)
                                                                    @if($currenUserGeustVal['id'] == $seat->gust_id)
                                                                        <div class="app-tables-persona-name tools-tables-gridItem-guestName" title="Cesario Ginjo"><span>{{ $currenUserGeustVal['name'] }}</span><!-- <span>Cesario</span><span>Ginjo</span> --></div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                              </div>
                                              <?php
                                              $l++; $i++;
                                            } ?>
                                    </div>
                            </div>
                         <!--  </td> -->
                    <?php
                    }// end of square


                    if($tableC->table_type == 'noSeats') { ?>
                         <!--  <td> -->
                            <div id="table_{{$tableC->id}}" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable table-common" style="width:{{$tableC->table_width.'px'}}; left: {{$tableC->posX.'px'}}; top: {{$tableC->posY.'px'}};">

                                <div class="flex">
                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:{{$tableC->table_width.'px'}}; width:{{$tableC->table_width.'px'}}">
                                        <div class="tools-tables-gridItem-squareLabel" id="table_{{$tableC->id}}_label">{{$tableC->table_nm}}</div>
                                    </div>
                                </div>
                           </div>
                         <!--  </td> -->
                    <?php
                    } // end of noSeats

                   $counter++;
                }   //end of foreach ?>
          <!--   </table> -->
</div>

</body> 
</html>