@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
    @include('tools.tools_nav');   
    <div class="wrapper">
    <div class="tools-toggle-content app-lista-header-nav">
        <div class="tools-toggle">
                <a class="tools-toggle-item" href="{{url('tools/budget')}}">Budget</a>
                <a class="tools-toggle-item active" href="{{url('tools/budget-payments')}}">Payments</a>
        </div>
    </div>
    <div class="pure-g">
    <div class="pure-u-1-3">
        <span class="subtitle">Show</span>:
        <ul class="tools-budgetFilters mr40">
            <li class="app-filter-budgetpayment current" data-filter="all">All</li>
            <!-- <li class="app-filter-budgetpayment" data-filter="paid">Paid</li> -->
            <!-- <li class="app-filter-budgetpayment" data-filter="pending">Pending</li> -->
        </ul>
    </div>
</div>
@if(isset($data['budgetPayments']) && !empty($data['budgetPayments']))
<table class="form-table budget-payment box" width="100%" cellspadding="0" cellspacing="0">
    <thead class="app-budgetpayment-theadmaster">
    <tr>
        <td width="120"><span class="uppercase color-grey">Status</span></td>
        <td class="uppercase"><span class="uppercase">Expense</span></td>
        <td width="200"><span class="uppercase color-grey">Details</span></td>
        <td width="150">&nbsp;</td>
        <td width="250" align="right"><span class="uppercase mr20 color-grey">Amount</span></td>
        <td width="50">&nbsp;</td>
    </tr>
    </thead>
    <tbody class="app-budgetpayments-tbody">
       @foreach($data['budgetPayments'] as $bpayment)
        <tr class="app-budget-payment-item" data-status="1" data-budget-payment-id="171109">
            <td>
            @if($bpayment['pending']==0)
            <b class="color-green app-budgetpayment-status">Paid</b>
            @else
            <b class="color-orange app-budgetpayment-status">Pending</b>
            @endif
            </td>
            <td id="task171109" name="task171109">
                <a class="budget-payment-title app-budgetpayment-category" data-category="Ceremony" href="{{url('tools/budget-category')}}/{{$bpayment['cat_id']}}">{{$bpayment['concept']}}</a>
                <span class="count">{{$bpayment['category']}}</span>
            </td>
            <td class="color-grey">
                <span class="app-budgetpayment-date " data-date="1524217545">
                    Paid on <span class="app-budgetpayment-datespan"><b>{{($bpayment['paid_date'] != '0000-00-00')?$bpayment['paid_date']:'...'}}</b></span>                </span>
                <br>
                <span class="app-budgetpayment-paidspan-parent app-budgetpayment-paid " data-paid="Ravi Sign">
                    Paid by <span class="app-budgetpayment-paidspan"><b>{{$bpayment['paid_by'] ?? '...'}}</b></span>                </span>
            </td>
            <td class="color-grey">
                <span class="app-budgetpayment-duedate-parent dnone">
                    Due by <span class="app-budgetpayment-duedate"> </span>
                </span>
                <br>
                <span class="app-budgetpayment-methodspan-parent dnone">
                    By                    <span class="app-budgetpayment-methodspan" data-methodspan="--">
                        --                    </span>
                </span>
            </td>
            <td width="250" align="right">
                <span class="budget-payment-amount">
                    C$<span class="app-budgetpayment-amount" data-import="">
                        @if($bpayment['pending']==0)
                           {{$bpayment['paid']}}
                        @else
                           {{$bpayment['pending']}}
                        @endif
                        </span>
                </span>
            </td>

            <td align="right">
                <span class="btn-outline outline-transparent app-payment-layer" data-concept="{{$bpayment['concept']}}" data-field="{{($bpayment['pending']==0)?'paid':'pending'}}" data-amount="{{($bpayment['pending']==0)?$bpayment['paid']:$bpayment['pending']}}" data-date="{{($bpayment['paid_date']!='0000-00-00')?date('d/m/Y',strtotime($bpayment['paid_date'])):''}}" data-paid-by="{{$bpayment['paid_by']}}" data-budget-id="{{$bpayment['id']}}" onclick="Frontend.addBudgetPayment(this)">
                    <i class="icon fright icon-edit-grey pointer"></i>
                </span>
            </td>
        </tr>
        @endforeach
        </tbody>
</table>
@else
<div class="app-tools-noResult tools-noResult"><br>
    <p class="tools-noResult-title">No payments matched your search</p>
</div>
@endif
</div>
<style type="text/css">
.icon-edit-grey::before {
    background-position: -52px -165px;
    height: 16px;
    width: 16px;
}
</style>
</section>
  @include('includes.payment_budget_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
