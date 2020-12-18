
<?php
   $year = $data['year'];
   $month = $data['month'];
   $tab = $data['tab'];
   $filter = $data['filter'];
   $showOnlyWeekendDays = $data['showOnlyWeekendDays'];
   $showOnlyWeekends = $data['showOnlyWeekends'];
   $dateObj = DateTime::createFromFormat('!m', $month);
   $longMonth = $dateObj->format('F');
   $shortMonth = $dateObj->format('M');
   $preMonth = ($month - 1);
   $nxtMonth = ($month + 1);
   $preYear  = $nxtYear  = $year;
   if($month == '01') {
      $preMonth = '12';
      $preYear = ($year - 1);
   } else
   if($month == '12') {
      $nxtMonth = '1';
      $nxtYear = ($year + 1);
   }
   if($preMonth < 10) {
      $preMonth = '0'.$preMonth;
   }
   if($nxtMonth < 10) {
      $nxtMonth = '0'.$nxtMonth;
   }
   $predateObj = DateTime::createFromFormat('!m', $preMonth);
   $preLongMonth = $predateObj->format('F');
   $nxtdateObj = DateTime::createFromFormat('!m', $nxtMonth);
   $nxtLongMonth = $nxtdateObj->format('F');
   ////// full month days......
   $monthList = array();
   for($d = 1; $d <= 31; $d++) {
      $time = mktime(12, 0, 0, $month, $d, $year);
      if(date('m', $time) == $month) {
         $monthList[] = date('d-D-W', $time);
      }
   }
   $weekArray = array();
   for($nm = 1; $nm <= count($monthList); $nm++) {
      $nmDays = explode('-', $monthList[$nm-1]);
      if(!in_array($nmDays[2],$weekArray)) {
         $weekArray[] = $nmDays[2];
      }
   }
   $bookedDate = array();
   foreach($data['avlEvent'] as $evt) {
      $bookedDate[] = $evt->date;
   }
   $enableDate = array();
   $disableDate = array();
   foreach($data['avlStatus'] as $sts) {
      if($sts->status == 0) {
         $disableDate[] = $sts->date;
      } else if($sts->status == 1) {
         $enableDate[] = $sts->date;
      }
   }
   $lastViewYear = @$data['avlSetting']->goal_year2;
   if(@$data['avlSetting']->goal_year1 == $year) {
      $yearTarget = @$data['avlSetting']->target1;
   } else if(@$data['avlSetting']->goal_year2 == $year) {
      $yearTarget = @$data['avlSetting']->target2;
   } else {
      $yearTarget = '0';
   }
   if($yearTarget > 0) {
      $chkPercentChk = $precntage = round((($data['yearNum'])/$yearTarget)* 100);
      for($pnm = 0; $pnm < 5; $pnm++) { 
         if($chkPercentChk % 5 == 0) {
            $chkPercent = $chkPercentChk;
         } else {
            $chkPercentChk--;
         }
      }
   } else {
      $precntage = '0';
      $chkPercent = '0';
   }
   if($precntage > 100 || $chkPercent > 100) {
      $precntage = '100';
      $chkPercent = '100';
   }
?>
<section class="section-padding dashboard-wrap">
   @include('vendor.tools_nav')
   <div class="wrapper">
      <div class="pure-g">
         <div class="pure-u-2-7">
            <div class="mr40">
               <div class="app-calendar-container">
               	<!-- info_calendar START here -->
                  <div class="adminSingleCalendar">
                     <div class="adminSingleCalendar__header">
                        <span class="strong mr5">{{ $shortMonth }}</span><span>{{ $year }}</span>
                        <div class="adminSingleCalendar__navigator">
                           <span class="app-vendors-availability-next-prev-month mr10" data-year="{{$preYear}}" data-month="{{$preMonth}}">
                              <i class="svgIcon svgIcon__angleLeft adminSingleCalendar__angle">
                                 <svg viewBox="0 0 582 998">
                                    <path d="M582 83c0 8.667-3.333 16.333-10 23L179 499l393 393c6.667 6.667 10 14.333 10 23s-3.333 16.333-10 23l-50 50c-6.667 6.667-14.333 10-23 10s-16.333-3.333-23-10L10 522c-6.667-6.667-10-14.333-10-23s3.333-16.333 10-23L476 10c6.667-6.667 14.333-10 23-10s16.333 3.333 23 10l50 50c6.667 6.667 10 14.333 10 23z" fill-rule="nonzero"/>
                                 </svg>
                              </i>
                           </span>
                           <span class="app-vendors-availability-next-prev-month" data-year="{{$nxtYear}}" data-month="{{$nxtMonth}}">
                              <i class="svgIcon svgIcon__angleRight adminSingleCalendar__angle">
                                 <svg viewBox="0 0 582 998">
                                    <path d="M582 499c0 8.667-3.333 16.333-10 23L106 988c-6.667 6.667-14.333 10-23 10s-16.333-3.333-23-10l-50-50c-6.667-6.667-10-14.333-10-23s3.333-16.333 10-23l393-393L10 106C3.333 99.333 0 91.667 0 83s3.333-16.333 10-23l50-50C66.667 3.333 74.333 0 83 0s16.333 3.333 23 10l466 466c6.667 6.667 10 14.333 10 23z" fill-rule="nonzero"/>
                                 </svg>
                              </i>
                           </span>
                        </div>
                     </div>
                     <div class="adminSingleCalendar__body">
                        <div class="adminSingleCalendar__row">
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Mon </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Tue </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Wed </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Thu </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Fri </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Sat </div>
                           <div class="adminSingleCalendar__item adminSingleCalendar__item--bold"> Sun </div>
                        </div>
                        <div class="adminSingleCalendar__row">
                           @for($mnt = 1; $mnt <= count($monthList); $mnt++)
                              @php
                                 $mDay = explode('-', $monthList[$mnt-1]);
                                 $ymdDate = $year.'-'.$month.'-'.$mDay[0];
                                 $noSpaceDate = $year.''.$month.''.$mDay[0];
                              @endphp
                              @if($mDay[1] == 'Mon' && $mnt == 1)
                                 @if($showOnlyWeekendDays == 1)
                                    <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                 @else
                                    @if(@$data['avlSetting']->monday == 'false')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$disableDate))
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Tue' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 @if($showOnlyWeekendDays == 1)
                                    <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                 @else
                                    @if(@$data['avlSetting']->tuesday == 'false')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$disableDate))
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Wed' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 @if($showOnlyWeekendDays == 1)
                                    <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                 @else
                                    @if(@$data['avlSetting']->wednesday == 'false')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$disableDate))
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Thu' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 @if($showOnlyWeekendDays == 1)
                                    <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                 @else
                                    @if(@$data['avlSetting']->thursday == 'false')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$disableDate))
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Fri' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 @if(@$data['avlSetting']->friday == 'false')
                                    @if(in_array($ymdDate,$bookedDate))
                                       @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                    @endif
                                 @else
                                    @if(in_array($ymdDate,$disableDate))
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Sat' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 @if(@$data['avlSetting']->saturday == 'false')
                                    @if(in_array($ymdDate,$bookedDate))
                                       @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                    @endif
                                 @else
                                    @if(in_array($ymdDate,$disableDate))
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                       @endif
                                    @endif
                                 @endif
                              @elseif($mDay[1] == 'Sun' && $mnt == 1)
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 <span class="adminSingleCalendar__item"></span>
                                 @if(@$data['avlSetting']->sunday == 'false')
                                    @if(in_array($ymdDate,$bookedDate))
                                       @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                    @endif
                                 @else
                                    @if(in_array($ymdDate,$disableDate))
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                       @endif
                                    @endif
                                 @endif
                              @else
                                 @if($showOnlyWeekendDays == 1 && ($mDay[1] == 'Mon' || $mDay[1] == 'Tue' || $mDay[1] == 'Wed' || $mDay[1] == 'Thu'))
                                    <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                 @else
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$disableDate))
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item adminSingleCalendar__item--disabled">{{$mDay[0]}}</span>
                                          @endif
                                       @else
                                          @if(in_array($ymdDate,$bookedDate))
                                             @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--full">{{$mDay[0]}}</span>
                                             @else
                                                <span class="adminSingleCalendar__item adminSingleCalendar__item--events">{{$mDay[0]}}</span>
                                             @endif
                                          @else
                                             <span class="adminSingleCalendar__item">{{$mDay[0]}}</span>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @endif
                              @if($mDay[1] == 'Sun')
                                 </div><div class="adminSingleCalendar__row">
                              @endif
                           @endfor
                        </div>
                     </div>
                  </div><!-- info_calendar END here -->
               </div>
               <div class="adminSingleCalendar__updateText"></div>
               <p class="adminAsideTitle">Filter by availability</p>
               <nav class="adminAside">
                  <a class="app-vendors-availability-change-aside-tab adminBullet--double pointer adminAside__item @if($tab == '0') active @endif" data-tab="0">
                     <i class="adminBullet adminBullet--transparent"></i> All
                  </a>
                  <a class="app-vendors-availability-change-aside-tab adminBullet--double pointer adminAside__item @if($tab == '1') active @endif" data-tab="1">
                     <i class="adminBullet adminBullet--green"></i> Available
                  </a>
                  <a class="app-vendors-availability-change-aside-tab adminBullet--double pointer adminAside__item @if($tab == '2') active @endif" data-tab="2">
                     <i class="adminBullet adminBullet--light-grey"></i> Unavailable
                  </a>
               </nav>
               <hr class="adminAsideSeparator">
               <p class="adminAsideTitle">Filter by bookings</p>
               <nav class="adminAside">
                  <a class="app-vendors-availability-change-aside-filter pointer adminBullet--double adminAside__item @if($filter == '3') active @endif" data-filter="3">
                     <i class="adminBullet adminBullet--transparent"></i> All
                  </a>
                  <a class="app-vendors-availability-change-aside-filter pointer adminBullet--double adminAside__item @if($filter == '4') active @endif" data-filter="4">
                     <i class="adminBullet adminBullet--gray"></i> Free
                  </a>
                  <a class="app-vendors-availability-change-aside-filter pointer adminBullet--double adminAside__item @if($filter == '5') active @endif" data-filter="5">
                     <i class="adminBullet adminBullet--light-red"></i> Partially Booked
                  </a>
                  <a class="app-vendors-availability-change-aside-filter pointer adminBullet--double adminAside__item @if($filter == '6') active @endif" data-filter="6">
                     <i class="adminBullet adminBullet--red"></i> Fully Booked
                  </a>
               </nav>
            </div>
         </div>
         <div class="pure-u-5-7">
            <div class="pure-g mb20">
               <div class="pure-u-2-3">
                  <h1 class="adminTitle">Availability</h1>
               </div>
               <div class="pure-u-1-3 text-right">
                  <span class="btnOutline btnOutline--primary app-icon-hover availabilitySettings app-vendors-availability-show-config setting_ability_btn" data-icon-old="icon-refresh-active" data-icon-new="icon-refresh-white">
                     <i class="svgIcon svgIcon__gear availabilitySettings__icon">
                        <svg viewBox="0 0 49 49">
                           <path d="M41.688 27.942c-.323 2.506-.781 3.87-1.652 5.358l4.78 4.78-7.112 7.113-4.808-4.804c-.433.213-.931.423-1.509.643-.073.028-1.44.513-2.223.81v6.875h-9.99v-6.874c-.78-.297-2.143-.781-2.226-.813-.577-.22-1.075-.43-1.509-.643l-4.804 4.806-7.115-7.112 4.805-4.805c-.706-1.416-1.302-3.366-1.644-5.334H.001V19.55h6.781c.357-1.138.948-2.61 1.538-3.74l-4.798-4.8 7.113-7.113 4.797 4.796a23.558 23.558 0 0 1 3.743-1.544V.374h9.99v6.772c1.086.334 2.591.947 3.739 1.548l4.798-4.797 7.114 7.113-4.791 4.791a18.882 18.882 0 0 1 1.539 3.75h6.774v8.391h-6.65zm-4.176 5.661l.41-.671c.316-.518.258-.422.342-.565.851-1.432 1.233-2.656 1.54-5.53l.095-.895h6.44V21.55H40.01l-.186-.763c-.396-1.62-1.064-3.254-1.903-4.63l-.41-.672 4.475-4.475-4.285-4.285-4.476 4.475-.672-.41c-1.237-.754-3.638-1.71-4.58-1.892l-.81-.157V2.374h-5.99v6.349l-.787.17c-1.105.24-3.36 1.138-4.604 1.897l-.671.41-4.477-4.475L6.35 11.01l4.475 4.477-.41.672c-.73 1.197-1.618 3.449-1.904 4.627l-.186.764H2v4.392h6.414l.116.867c.315 2.344 1.068 4.784 1.885 6.123l.41.671L6.35 38.08l4.285 4.285 4.476-4.478.672.411c.448.274 1.066.554 1.877.863-.084-.032 2.594.919 2.995 1.137l.52.284v6.135h5.99v-6.134l.52-.285c.402-.219 3.093-1.174 2.992-1.136.812-.309 1.43-.589 1.878-.862l.671-.41 4.478 4.475 4.284-4.285-4.475-4.477zm-3.555-9.058c0 5.407-4.382 9.79-9.788 9.79-5.406 0-9.788-4.383-9.788-9.79 0-5.406 4.382-9.789 9.788-9.789 5.406 0 9.788 4.383 9.788 9.79zm-2 0a7.789 7.789 0 1 0-7.788 7.79 7.789 7.789 0 0 0 7.788-7.79z" fill-rule="nonzero"></path>
                        </svg>
                     </i> Settings
                  </span>
               </div>
            </div>
            <div class="app-vendors-availability-container mb30">
            	<!-- event_calendar START here -->
               <form name="frmAvailability" id="app-form-availability" action="javascript:;" method="post">
                  <input type="hidden" id="year" name="year" value="{{$year}}">
                  <input type="hidden" id="month" name="month" value="{{$month}}">
                  <input type="hidden" id="tab" name="tab" value="{{$tab}}">
                  <input type="hidden" id="filter" name="filter" value="{{$filter}}">
                  <input type="hidden" id="showOnlyWeekendDays" name="showOnlyWeekendDays" value="{{$showOnlyWeekendDays}}">
                  @if($year <= $lastViewYear)
                  <div class="availabilitySummary pure-g date_info_wrp">
                     <div class="pure-u-1-3 store_avail">
                        <div class="pure-g-r">
                           <div class="pure-u-1-4">
                              <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-availability"></i>
                           </div>
                           <div class="pure-u-2-4 pt5 pl10">
                              <span class="availabilitySummary__title"> Bookings </span>
                              <p class="availabilitySummary__subtitle"> this month </p>
                           </div>
                           <div class="pure-u-1-4">
                              <p class="availabilitySummary__counter">@if($yearTarget > 0) {{$data['monthNum']}} @else 0 @endif</p>
                           </div>
                        </div>
                     </div>
                     <div class="pure-u-1-3 ">
                        @if($yearTarget > 0)
                           <div class="pure-g-r">
                              <div class="pure-u-1-2 pt5">
                                 <span class="availabilitySummary__title"> Goal Bookings </span>
                                 <p class="availabilitySummary__subtitle"> for {{$year}} </p>
                              </div>
                              <div class="pure-u-1-2 text-right pr15">
                                 <span class="availabilitySummary__counter">{{$data['yearNum']}}</span>
                                 <span class="availabilitySummary__counter availabilitySummary__counter--small"> of {{$yearTarget}}</span>
                              </div>
                           </div>
                        @else
                           <p>Set your <strong>booking goal for {{$year}}</strong> to see your progress!</p>
                        @endif
                     </div>
                     <div class="pure-u-1-3 pt5 availability_summery_wrp">
                        <div class="adminPercent adminPercent--blood fright">
                           <p class="adminPercent__title adminPercent__title--big color-grey">
                              @if($precntage > 0)
                                 Well done!
                              @else
                                <span data-year="{{$year}}" class="app-vendors-availability-show-config pointer setting_ability_btn link--primary">Set Goal</span>
                              @endif
                              <small class="adminPercent__count adminPercent__count--big color-black">{{$precntage}}%</small>
                           </p>
                           <span class="adminPercent__bar adminPercent__bar--small adminPercent__bar--{{$chkPercent}}">
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           <span class="adminPercent__barItem adminPercent__barItem--small adminPercent__barItem--borderless"></span>
                           </span>
                        </div>
                     </div>
                  </div>
                  @endif
                  <div class="app-availability-alerts" style="display:none;"></div>
                  <div class="mb20 pure-g availability_select_wrp">
                     <div class="pure-u-1-2">
                        <div class="select-fake mr10">
                           <select class="app-vendors-availability-change-year">
                              @for($yrs = date('Y'); $yrs <= (date('Y')+5); $yrs++)
                                 <option value="{{$yrs}}" data-year="{{$year}}" @if($yrs == $year) selected @endif>{{$yrs}}</option>
                              @endfor
                           </select>
                        </div>
                        <div class="select-fake">
                           <select class="app-vendors-availability-change-month">
                              <option value="01" @if('01' == $month) selected @endif>January</option>
                              <option value="02" @if('02' == $month) selected @endif>February</option>
                              <option value="03" @if('03' == $month) selected @endif>March</option>
                              <option value="04" @if('04' == $month) selected @endif>April</option>
                              <option value="05" @if('05' == $month) selected @endif>May</option>
                              <option value="06" @if('06' == $month) selected @endif>June</option>
                              <option value="07" @if('07' == $month) selected @endif>July</option>
                              <option value="08" @if('08' == $month) selected @endif>August</option>
                              <option value="09" @if('09' == $month) selected @endif>September</option>
                              <option value="10" @if('10' == $month) selected @endif>October</option>
                              <option value="11" @if('11' == $month) selected @endif>November</option>
                              <option value="12" @if('12' == $month) selected @endif>December</option>
                           </select>
                        </div>
                     </div>
                     <div class="pure-u-1-2 show_wee_wrp">
                        <div class="input-group-line input-group-line--noMargin fright mt10">
                           <label>
                              <input type="checkbox" name="showOnlyWeekends" id="showOnlyWeekends" class="app-vendors-availability-change-weekend-days app-not-icheck" value="{{$showOnlyWeekends}}" @if($showOnlyWeekendDays == '1') checked @endif>
                              <span></span>
                              <span class="ml5">Only show weekends</span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="availabilityNavigator">
                     <span class="app-vendors-availability-next-prev-month availabilityNavigator__button" data-year="{{$preYear}}" data-month="{{$preMonth}}">
                        <i class="svgIcon svgIcon__angleLeft availabilityPaginator__angle">
                           <svg viewBox="0 0 582 998">
                              <path d="M582 83c0 8.667-3.333 16.333-10 23L179 499l393 393c6.667 6.667 10 14.333 10 23s-3.333 16.333-10 23l-50 50c-6.667 6.667-14.333 10-23 10s-16.333-3.333-23-10L10 522c-6.667-6.667-10-14.333-10-23s3.333-16.333 10-23L476 10c6.667-6.667 14.333-10 23-10s16.333 3.333 23 10l50 50c6.667 6.667 10 14.333 10 23z" fill-rule="nonzero"></path>
                           </svg>
                        </i> {{$preLongMonth}}
                     </span>
                     <p class="availabilityNavigator__current">{{$longMonth}} {{$year}}</p>
                     <span class="app-vendors-availability-next-prev-month availabilityNavigator__button" data-year="{{$nxtYear}}" data-month="{{$nxtMonth}}">
                        {{$nxtLongMonth}}
                        <i class="svgIcon svgIcon__angleRight availabilityPaginator__angle">
                           <svg viewBox="0 0 582 998">
                              <path d="M582 499c0 8.667-3.333 16.333-10 23L106 988c-6.667 6.667-14.333 10-23 10s-16.333-3.333-23-10l-50-50c-6.667-6.667-10-14.333-10-23s3.333-16.333 10-23l393-393L10 106C3.333 99.333 0 91.667 0 83s3.333-16.333 10-23l50-50C66.667 3.333 74.333 0 83 0s16.333 3.333 23 10l466 466c6.667 6.667 10 14.333 10 23z" fill-rule="nonzero"></path>
                           </svg>
                        </i>
                     </span>
                  </div>
                  <p class="pt10 text-center no_info" style="display: none;">No info available.</p>
                  <div class="availability_head_wrp">
                     <?php
                     for($wnm = 1; $wnm <= count($weekArray); $wnm++){
                        $weekAllow = '';
                        if($month == '12' && $weekArray[$wnm-1] == '01') {
                           $weekNum = '53';
                           if($showOnlyWeekendDays == 1) {
                              $weekAllow = 'No';
                           }
                        } else {
                           $weekNum = $weekArray[$wnm-1];
                        }
                        $dto = new DateTime();
                        $dto->setISODate($year, $weekNum);
                        $week_start = $dto->format('Y-m-d');
                        $dto->modify('+6 days');
                        $week_end = $dto->format('Y-m-d');
                     ?>
                     @if($weekAllow == '')
                     <div class="availabilityList__header" data-numdates="">
                        <span class="availabilityList__title">Week {{$wnm}}</span>
                        <span>{{date_format(date_create($week_start),"jS \of F")}} - {{date_format(date_create($week_end),"jS \of F")}}</span>
                        <span class="flex-left-auto">Available?</span>
                     </div>
                     @endif
                     @for($mnt = 1; $mnt <= count($monthList); $mnt++)
                        @php
                           $mDay = explode('-', $monthList[$mnt-1]);
                           $ymdDate = $year.'-'.$month.'-'.$mDay[0];
                           $dmyDate = $mDay[0].'-'.$month.'-'.$year;
                           $noSpaceDate = $year.''.$month.''.$mDay[0];
                        @endphp
                        @if($mDay[2] == $weekArray[$wnm-1])
                           @if($week_start <= $ymdDate && $week_end >= $ymdDate)
                              @if($showOnlyWeekendDays == 1 && ($mDay[1] == 'Mon' || $mDay[1] == 'Tue' || $mDay[1] == 'Wed' || $mDay[1] == 'Thu'))
                                 <!-- <div class=""></div> -->
                              @else
                                 @if($tab == 0 && $filter == 3) <!-- All - All -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @else
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @else
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @endif
                                 @elseif($tab == 0 && $filter == 4) <!-- All - Free -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @if(in_array($ymdDate,$enableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @else
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                          @else
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                          @endif
                                          <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$mDay[1]}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events"></div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @endif
                                 @elseif($tab == 0 && $filter == 5) <!-- All - Partialiy-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @else
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 0 && $filter == 6) <!-- All - Full-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @if(in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                @else
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                @endif
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$dStats}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events">
                                                      @foreach($data['avlEvent'] as $ev)
                                                         @if($ymdDate == $ev->date)
                                                         <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                            {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                            @if($ev->time != '' || $ev->time != null)
                                                               <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                            @endif
                                                         </div>
                                                         @endif
                                                      @endforeach
                                                   </div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 1 && $filter == 3) <!-- Available - All -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 1 && $filter == 4) <!-- Available - Free -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$disableDate))
                                             @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                             <div class="pure-g availabilityList__item  app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 1 && $filter == 5) <!-- Available - Partialiy-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 1 && $filter == 6) <!-- Available - Full-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = 'active';  $stsDsbl = '';  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 2 && $filter == 3) <!-- Unavailable - All -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                          @else
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                          @endif
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                <div class="availabilityList__day">{{$dStats}}</div>
                                             </div>
                                             <div class="pure-u-7-8 availabilityList__sectionRight">
                                                <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                   <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                </div>
                                                <div class="availabilityList__events">
                                                   @foreach($data['avlEvent'] as $ev)
                                                      @if($ymdDate == $ev->date)
                                                      <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                         {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                         @if($ev->time != '' || $ev->time != null)
                                                            <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                         @endif
                                                      </div>
                                                      @endif
                                                   @endforeach
                                                </div>
                                                <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                   <span class="switchSimple__bounce"></span>
                                                </div>
                                             </div>
                                          @endif
                                          </div>
                                       @else
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 2 && $filter == 4) <!-- Unavailable - Free -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(!in_array($ymdDate,$enableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(!in_array($ymdDate,$bookedDate))
                                          @if(in_array($ymdDate,$disableDate))
                                             @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="0">
                                                <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                   <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                   <div class="availabilityList__day">{{$mDay[1]}}</div>
                                                </div>
                                                <div class="pure-u-7-8 availabilityList__sectionRight">
                                                   <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                      <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                   </div>
                                                   <div class="availabilityList__events"></div>
                                                   <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                      <span class="switchSimple__bounce"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 2 && $filter == 5) <!-- Unavailable - Partialiy-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day > $data[$noSpaceDate])
                                             @php $dStats = $mDay[1]; @endphp
                                             <div class="pure-g availabilityList__item app-availability-day" data-numevents="1">
                                                @if(in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @elseif($tab == 2 && $filter == 6) <!-- Unavailable - Full-booked -->
                                    @if(@$data['avlSetting']->monday == 'false' && $mDay[1] == 'Mon')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->tuesday == 'false' && $mDay[1] == 'Tue')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->wednesday == 'false' && $mDay[1] == 'Wed')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->thursday == 'false' && $mDay[1] == 'Thu')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->friday == 'false' && $mDay[1] == 'Fri')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->saturday == 'false' && $mDay[1] == 'Sat')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @elseif(@$data['avlSetting']->sunday == 'false' && $mDay[1] == 'Sun')
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(!in_array($ymdDate,$enableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @else
                                       @if(in_array($ymdDate,$bookedDate))
                                          @if(@$data['avlSetting']->wed_per_day <= $data[$noSpaceDate])
                                             @php $dStats = 'Fully Booked'; @endphp
                                             <div class="pure-g availabilityList__item availabilityList__item--full app-availability-day" data-numevents="1">
                                                @if(in_array($ymdDate,$disableDate))
                                                   @php  $stsActv = '';  if($data[$noSpaceDate] > 0){ $stsDsbl = ''; } else { $stsDsbl = 'disabled'; }  @endphp
                                                   <div class="pure-u-1-8 availabilityList__sectionLeft">
                                                      <div class="availabilityList__number {{$stsDsbl}}">{{$mDay[0]}}</div>
                                                      <div class="availabilityList__day">{{$dStats}}</div>
                                                   </div>
                                                   <div class="pure-u-7-8 availabilityList__sectionRight">
                                                      <div class="availabilityList__add app-availability-add-booking" data-day="{{$dmyDate}}">
                                                         <span class="availabilityList__addSymbol">+<span class="availabilityList__addText">Booking</span></span>
                                                      </div>
                                                      <div class="availabilityList__events">
                                                         @foreach($data['avlEvent'] as $ev)
                                                            @if($ymdDate == $ev->date)
                                                            <div class="availabilityList__event app-availability-edit-booking" data-event-id="{{$ev->id}}" style="order:0">
                                                               {{$ev->name.' '.$ev->surname}} @if($ev->customType != ''){{$ev->customType}}' @else {{$ev->title}}' @endif
                                                               @if($ev->time != '' || $ev->time != null)
                                                                  <span class="availabilityList__eventHour">{{$ev->time}}</span>
                                                               @endif
                                                            </div>
                                                            @endif
                                                         @endforeach
                                                      </div>
                                                      <div class="switchSimple flex-left-auto app-switch-input-availability-day {{$stsActv}}" data-cDate="{{$ymdDate}}">
                                                         <span class="switchSimple__bounce"></span>
                                                      </div>
                                                   </div>
                                                @endif
                                             </div>
                                          @endif
                                       @endif
                                    @endif
                                 @endif
                              @endif
                           @endif
                        @endif
                     @endfor
                     <?php
                     }
                     ?>
                  </div>
                  <div class="availabilityPaginator">
                     <p class="availabilityPaginator__title"> {{$longMonth}} {{$year}} </p>
                     <div class="btn-outline outline-grey availabilityPaginator__button mr5 app-vendors-availability-next-prev-month" data-year="{{$preYear}}" data-month="{{$preMonth}}">
                        <i class="svgIcon svgIcon__arrowLongLeft availabilityPaginator__arrow availabilityPaginator__arrow--left">
                           <svg viewBox="0 0 22 12">
                              <path d="M2.207 5.833h19.025v1H2.331l4.332 3.79-.659.753L.268 6.358 5.98.646l.707.708-4.48 4.48z" fill-rule="nonzero"></path>
                           </svg>
                        </i> {{$preLongMonth}} {{$preYear}}
                     </div>
                     <div class="btn-outline outline-grey availabilityPaginator__button ml5 app-vendors-availability-next-prev-month inline" data-year="{{$nxtYear}}" data-month="{{$nxtMonth}}">
                        {{$nxtLongMonth}} {{$nxtYear}}
                        <i class="svgIcon svgIcon__arrowLongRight availabilityPaginator__arrow availabilityPaginator__arrow--right">
                           <svg viewBox="0 0 22 12">
                              <path d="M19.293 5.833H.268v1h18.901l-4.332 3.79.659.753 5.736-5.018L15.52.646l-.707.708 4.48 4.48z" fill-rule="nonzero"></path>
                           </svg>
                        </i>
                     </div>
                  </div>
               </form><!-- event_calendar END here -->
            </div>
         </div>
      </div>
   </div>
</section>