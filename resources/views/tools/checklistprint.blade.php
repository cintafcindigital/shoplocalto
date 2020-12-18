<!DOCTYPE html>
<html lang="en-CA" prefix="og: http://ogp.me/ns#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Checklist - perfectweddingday.ca/</title>

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


        <div class="wrapper">

                <header class="print-header">
                    <p class="print-header-names">{{ $data['user']->name }}</p>
                    <p class="tools-subtitle">Wedding Date :- &nbsp; {{ date('d-M-Y', strtotime($data['user']->event_date)) }}</p>
                    <div>
                        <a class="print-header-button btn-flat red mt20 mb30" role="button" onclick="window.print();">
                            <i class="icon icon-print-white icon-left"></i> Print 
                        </a>
                    </div>
                </header>

                @if(count($data['list']) > 0)
                    @foreach($data['list'] as $listdata)
                        <ul class="print-checklist">
                            <li class="border-bottom mb30 pb15">
                                <span class="printList__titleHead">{{ $listdata['title'] }}</span>
                            </li>
                             
                            @foreach($listdata['getlist'] as $list)       
                            <li class="print-checklist-item">
                                <div class="pure-g">
                                    <div class="pure-u-1-4">
                                        <img class="mt10 mr5" src="{{ url('public/images').'/checkbox-grey.png' }}" width="36" alt="">
                                        <p class="print-checklist-item-resume">
                                        <span>{{ $listdata['title'] }}</span>
                                        <span class="strong">{{ $list['getcategory']['title'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pure-u-3-4">
                                        <p class="print-checklist-item-title"> {{ $list['title'] }} </p>
                                        <p class="print-checklist-item-description">{{ $list['description'] }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
        </div>

</body>
</html>
