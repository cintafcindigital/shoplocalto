<!DOCTYPE html>
<html lang="en-CA" prefix="og: http://ogp.me/ns#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>BudgetReport - perfectweddingday.ca/</title>

<link rel="stylesheet" href="{{ url('public/css').'/base.css' }}">
<link rel="stylesheet" href="{{ url('public/css').'/tools.css' }}">
</head>

<body class='print-checklist-bg'>
    

        <div class="header">
            <div class="mt30 text-center">
                <a href="{{ url('/') }}" title="Weddings">
                    <img src="{{ url('images/logo.jpg') }}" alt="perfectweddingday.ca">
                </a>
            </div>
        </div>


        <div class="wrapper budget_report_wrp">

                <header class="print-header">
                    <p class="print-header-names">{{ $data['user']->name }}</p>
                    <p class="tools-subtitle">Wedding Date :- &nbsp; {{ date('d-M-Y', strtotime($data['user']->event_date)) }}</p>
                    <div>
                        <a class="print-header-button btn-flat red mt20 mb30" role="button" onclick="window.print();">
                            <i class="icon icon-print-white icon-left"></i> Print 
                        </a>
                    </div>
                    <h2 class="printList__titleMain">My Wedding Budget</h2>
                    <div class="pure-u-3-5">
                        <ul class="pure-g print-header-resume">
                            <li class="pure-u-1-4">
                                <span>C$ {{$data['total_estimate'] }}</span>
                                <small>Estimated budget</small>
                            </li>
                            <li class="pure-u-1-4">
                                <span>C$ {{$data['total_final_cost']}} </span>
                                <small>Final cost</small>
                            </li>
                            <li class="pure-u-1-4">
                                <span>C$ {{ $data['total_paid'] }} </span>
                                <small>Paid</small>
                            </li>
                            <li class="pure-u-1-4">
                                <span>C$ {{ $data['total_pending'] }} </span>
                                <small>Pending</small>
                            </li>
                        </ul>
                    </div>
                </header>
                @foreach($data['userbudgetlist'] as $budgetdata)
                <table class="printList__group" width="100%">
                   <thead>
                      <tr class="printList__rowHead">
                         <td width="28%" class="printList__titleHead">{{ $budgetdata['title'] }}</td>
                         <td width="18%" align="right" class="printlist">Estimated budget</td>
                         <td width="18%" align="right" class="printlist">Final cost</td>
                         <td width="18%" align="right" class="printlist">Paid</td>
                         <td width="18%" align="right" class="printlist">Pending</td>
                      </tr>
                      <input type="hidden" name="bc[]" value="165">
                   </thead>
                   <tbody>
                    @php 
                        $estimate_budget = 0;
                        $final_cost = 0;
                        $paid = 0;
                        $pending = 0;
                    @endphp

                    @foreach($budgetdata['get_maincategory']['get_user_budget'] as $userbudget)

                    @php $estimate_budget += (int)$userbudget['estimate_budget'] @endphp
                    @php $final_cost += (int)$userbudget['final_cost'] @endphp
                    @php $paid += (int)$userbudget['paid'] @endphp
                    @php $pending += (int)$userbudget['pending'] @endphp

                    
                      <tr class="printList__row" id="tr218">
                        <td>
                           {{$userbudget['concept']}}                        
                         </td>
                         <td align="right">
                          C$ {{$userbudget['estimate_budget']}}                     
                         </td>
                         <td align="right">
                          C$ {{$userbudget['final_cost']}}                       
                         </td>
                         <td align="right">
                          C$ {{$userbudget['paid']}}                         
                         </td>
                         <td align="right">
                          C$ {{$userbudget['pending']}}                    
                         </td>
                      </tr>

                    @endforeach
                    <tr class="printList__row" id="trt215">
                         <td>&nbsp;</td>
                         <td align="right">
                            <div id="fcet215" class="strong"> C$ {{ $estimate_budget }} </div>
                         </td>
                         <td align="right">
                            <div id="fcet215" class="strong"> C$ {{ $final_cost }} </div>
                         </td>
                         <td align="right">
                            <div id="fcet215" class="strong"> C$ {{ $paid }} </div>
                         </td>
                         <td align="right">
                            <div id="fcet215" class="strong"> C$ {{ $pending }} </div>
                         </td>
                      </tr>
                   </tbody>
                </table>
            @endforeach
                <table class="printList__group" width="100%">
                   <thead>
                      <tr class="printList__rowHead">
                         <td width="28%" class="printList__rowName"></td>
                         <td width="18%" align="right">Estimated budget</td>
                         <td width="18%" align="right">Final cost</td>
                         <td width="18%" align="right">Paid</td>
                         <td width="18%" align="right">Pending</td>
                      </tr>
                   </thead>
                   <tbody>
                      <tr class="printList__row border-bottom">
                         <td class="strong">Total</td>
                         <td align="right">
                            <div id="fcett226" class="big strong">C$ {{$data['total_estimate'] }} </div>
                         </td>
                         <td align="right">
                            <div id="fcatt226" class="big strong">C$ {{$data['total_final_cost']}} </div>
                         </td>
                         <td align="right">
                            <div id="fcptt226" class="big strong">C$ {{ $data['total_paid'] }} </div>
                         </td>
                         <td align="right">
                            <div id="fcntt226" class="big strong">C$ {{ $data['total_pending'] }} </div>
                         </td>
                      </tr>
                   </tbody>
                </table>
        </div>

</body>
</html>
