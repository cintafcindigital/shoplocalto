@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<?php
    $idEvent = @Request::get('idEvent');
    $guestsTitle = 'Overview';
    if($idEvent) {
        $guestsTitle = $data['current_event']->event_name;
    }
?>
<section class="section-padding-ex dashboard-wrap-ex">
    @include('tools.tools_nav')
    <div class="wrapper guest-desgin">
        <div class="req-add wrapper">
            <div class="alert alert-success mt10" style="display:none;"></div>
            <div class="alert alert-error mt10" style="display:none;"></div>
            <p><span class="tools-header-title pointer app-link inline-block" data-href="/tools/Guests?idEvent=">
                    <i class="icon-header icon-header-arrow-left mr10"></i> Guest List
                </span>
            </p>
            <h1 class="tools-title">Request mailing addresses</h1>
            <form id="app-send-rsvp-form" action="/tools/GuestsRequestConfirmRun" method="post" novalidate="">
                <input type="hidden" name="idInvitation" value="">
                <input type="hidden" name="Term" value="">
                <input type="hidden" name="type" value="address">
                <div class="input-group-line">
                    <input type="hidden" name="errorGuestWebBodas">
                </div>
                <div class="pure-g">
                    <div class="pure-u-1-2">
                        <p class="tools-subtitle">1. Personalize your message</p>
                        <div class="guestsRequestPreview">
                            <div class="text-center mb20">
                                <img src="https://cdn1.weddingwire.ca/img/mail/requestAddress-en_CA.gif?_norewrite_=1" width="200">
                            </div>
                            <div class="input-group-line">
                                <textarea class="guest-textarea-confirm" name="Message" id="Message" rows="7">Hi,
                                As you may know, on March 6...

                                We're getting married!

                                We would love for you to come and we want to make sure you receive our invitation. Kindly confirm your address using the button below.</textarea>
                            </div>
                            <div class="mb20 mt30 text-center">
                                <span id="bgColorBtn" class="btn-flat red disabled">Update address</span>
                            </div>
                            <div class="text-center mb10">
                                <span class="color-secondary block fs13 font-base">Thank you very much!</span>
                                <span class="color-secondary block fs13 font-base">Maria &amp; cesario</span>     
                            </div>
                        </div>
                        <div id="prevWebsite" class="guestsRequestPreviewFooter guestsRequestPreviewFooter--flex ">
                            <div class="guestsRequestPreviewFooter__item">
                                <img class="guestsRequestPreviewFooter__img" src="https://cdn1.weddingwire.ca/assets/img/tools/invitations/nav-wedsite.png">
                                <div class="guestsRequestPreviewFooter__info">
                                    <p class="mb0">Visit our website</p>
                                    <a class="guestsRequestPreviewFooter__link" href="https://www.weddingwire.ca/web/maria-and-cesario">https://www.weddingwire.ca/web/maria-and-cesario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pure-u-1-2">
                        <div class="ml30">
                            <p class="tools-subtitle">2. Send it to your guests</p>
                            <div class="app-to-list border mb10" style="display: none;">
                                <div class="guests-input-mail">
                                    <p class="strong mb10">To:</p>
                                    <ul class="app-list-content"></ul>
                                    <div class="input-group-line">
                                        <input type="hidden" name="GuestsError">
                                    </div>
                                </div>
                            </div>
                            <div class="guests-rows scroll-box">
                                <div class="p20 border-bottom">
                                    <strong>Select your guests:</strong>
                                </div>
                                <div class="p10 pl20 border-bottom bg">
                                    <i class="icon-tools icon-tools-search icon-left"></i>
                                    <input id="guestsSearch" class="guests-rows-header-search" placeholder="Search guests..." type="text" value="">
                                </div>
                                <div class="box-scroll p20" style="height: 400px;">
                                    <div class="mb10">
                                        <label class="guests-rows-select-all raselectal_sec">
                                            <div class="icheckbox_minimal raselectal_div"><input type="checkbox" id="general"><ins class="iCheck-helper"></ins></div>
                                            <span>Select all</span>
                                        </label>
                                    </div>
                                    <table id="page-container" width="100%">
                                        <tbody class="app-guests-has-send-list" data-id-guest="" data-name-guest=" ">
                                            <tr id="contact_6493213" class="guests-rows-item ">
                                                <td class="guests-rows-td guests-rows-noBorder va-top">
                                                    <div class="icheckbox_minimal raguest_div">
                                                        <input id="guest_6493213" type="checkbox" name="guests[]" data-name="Maria " value="6493213"><ins class="iCheck-helper"></ins>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/bride.png" width="35">
                                                        <p class="guests-rows-name">Maria </p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <a role="button" data-id="6493213" class="app-invitation-add-mail guests-rows-td-mail">
                                                        bouquetcanada@gmail.com
                                                    </a>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" value="bouquetcanada@gmail.com">
                                                            <span data-id="6493213" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_8319357" class="guests-rows-item ">
                                                <td class="guests-rows-td guests-rows-noBorder va-top">
                                                    <div class="icheckbox_minimal raguest_div">
                                                        <input id="guest_8319357" type="checkbox" name="guests[]" data-name="clarck bird" value="8319357"><ins class="iCheck-helper"></ins>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/adult.png" width="35">
                                                        <p class="guests-rows-name">clarck bird</p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <a role="button" data-id="8319357" class="app-invitation-add-mail guests-rows-td-mail">
                                                        bouquetcanada@gmail.com
                                                    </a>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" value="bouquetcanada@gmail.com">
                                                            <span data-id="8319357" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_6493215" class="guests-rows-item ">
                                                <td class="guests-rows-td guests-rows-noBorder va-top">
                                                    <div class="icheckbox_minimal raguest_div">
                                                        <input id="guest_6493215" type="checkbox" name="guests[]" data-name="Partner's name " value="6493215"><ins class="iCheck-helper"></ins>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/adult.png" width="35">
                                                        <p class="guests-rows-name">Partner's name </p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <a role="button" data-id="6493215" class="app-invitation-add-mail guests-rows-td-mail">
                                                        bouquetcanada@gmail.com
                                                    </a>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" value="bouquetcanada@gmail.com">
                                                            <span data-id="6493215" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_8033973" class="guests-rows-item  guest-no-mail">
                                                <td class="guests-rows-td guests-rows-noBorder va-top"></td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/baby.png" width="35">
                                                        <p class="guests-rows-name">fghfgh ghjgj</p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <span data-id="8033973" class="pointer app-invitation-add-mail guests-rows-td-anchor">Add an e-mail</span>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" placeholder="Enter their e-mail">
                                                            <span data-id="8033973" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_8034215" class="guests-rows-item  guest-no-mail">
                                                <td class="guests-rows-td guests-rows-noBorder va-top"></td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/baby.png" width="35">
                                                        <p class="guests-rows-name">fgnhgjngvhkhj ghjkghjkmhjkj</p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <span data-id="8034215" class="pointer app-invitation-add-mail guests-rows-td-anchor">Add an e-mail</span>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" placeholder="Enter their e-mail">
                                                            <span data-id="8034215" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_6493217" class="guests-rows-item  guest-no-mail">
                                                <td class="guests-rows-td guests-rows-noBorder va-top"></td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/men.png" width="35">
                                                        <p class="guests-rows-name">Maria Araujo</p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <span data-id="6493217" class="pointer app-invitation-add-mail guests-rows-td-anchor">Add an e-mail</span>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" placeholder="Enter their e-mail">
                                                            <span data-id="6493217" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="contact_8023067" class="guests-rows-item  guest-no-mail">
                                                <td class="guests-rows-td guests-rows-noBorder va-top"></td>
                                                <td class="guests-rows-td">
                                                    <div class="flex-va-center">
                                                        <img class="image" src="https://cdn1.weddingwire.ca/images/tools/guests/groom.png" width="35">
                                                        <p class="guests-rows-name">Michael Tom</p>
                                                    </div>
                                                </td>
                                                <td class="guests-rows-td" align="right">
                                                    <span data-id="8023067" class="pointer app-invitation-add-mail guests-rows-td-anchor">Add an e-mail</span>
                                                    <div class="form-add-mail">
                                                        <div class="flex">
                                                            <input class="input-add-mail p10" type="email" name="Mail" id="Mail" placeholder="Enter their e-mail">
                                                            <span data-id="8023067" class="app-invitation-add-mail-btn btn-flat red"><i class="icon-tools icon-tools-check-white"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="guestsRowsFooter">
                                <div class="pure-g">
                                    <div class="input-group-line pure-u-3-4">
                                        <span class="input-group-line-label">Wedding Website</span>
                                        <div class="input-group-line--buttons">
                                            https://www.weddingwire.ca/web/maria-and-cesario
                                            <div class="input-group-line-web"></div>
                                        </div>
                                    </div>
                                    <div class="pure-u-1-4 text-right">
                                        <input type="hidden" name="isWebsiteActive" value="1">
                                        <div class="switch-radio app-switch-input-confirmation raswitchrad_div active">
                                            <label>
                                                <input class="app-not-icheck app_preview-invite" name="web" value="0" type="radio">
                                            </label>
                                            <label>
                                                <input class="app-not-icheck app_preview-invite" name="web" value="1" type="radio" checked="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="guestsRequestCaptcha__container">
                    <button type="submit" class="btn-flat red guestsRequestCaptcha__btn">Send</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include('includes.footer')
<script type="text/javascript">
$(document).ready(function(){
    /*Swith Radio Div*/
    $('body').on('click','.raswitchrad_div',function(){
        checkclass= $('.raswitchrad_div').hasClass('active');
        if(checkclass) {
            $('.raswitchrad_div').removeClass('active');
            $('#prevWebsite').addClass('dnone');
        } else {
            $('.raswitchrad_div').addClass('active');
            $('#prevWebsite').removeClass('dnone');
        }
    });
    /*Select All Section*/
    $('.raselectal_sec').mouseover(function() {
        $(this).addClass('hover');
        $('.raselectal_div').addClass('hover');
    });
    $('.raselectal_sec').mouseleave(function() {
        $(this).removeClass('hover');
        $('.raselectal_div').removeClass('hover');
    });
    $('.raselectal_sec #general').change(function() {
        var chkbox = $('.raselectal_div').hasClass('checked');
        if(chkbox) {
            $('.raselectal_sec').removeClass('active');
            $('.raselectal_div').removeClass('checked');
            $('#page-container .icheckbox_minimal.raguest_div').removeClass('checked');
        } else {
            $('.raselectal_sec').addClass('active');
            $('.raselectal_div').addClass('checked');
            $('#page-container .icheckbox_minimal.raguest_div').addClass('checked');
        }
    });
    $('.raguest_div').mouseover(function() {
        $(this).addClass('hover');
    });
    $('.raguest_div').mouseleave(function() {
        $(this).removeClass('hover');
    }); 
    $('.raguest_div').click(function() {
        var guest_chkbox = $(this).hasClass('checked');
        if(guest_chkbox) {
            $(this).removeClass('checked');
        } else {
            $(this).addClass('checked');
        }
    });
    $('.app-invitation-add-mail').click(function(){
        $(this).next('.form-add-mail').show();
        $(this).hide();
    });
});
</script>
@endsection