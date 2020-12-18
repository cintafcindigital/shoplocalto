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
        <div class="online-invpg wrapper">
            <div class="alert alert-success" style="display:none"></div>
            <div class="alert alert-error" style="display:none"></div>
            <p><span class="tools-header-title pointer app-link inline-block" data-href="/tools/Guests?idEvent=1078841">
                    <i class="icon-header icon-header-arrow-left mr10"></i> Guest List
                </span>
            </p>
            <h1 class="tools-title">Send your invitations online</h1>
            <div class="pure-g mt20">
                <div class="pure-u-7-24">
                    <div class="pure-s">
                        <div class="box p20">
                            <p class="input-group-line-label">Choose an event:</p>
                            <div class="input-group icon icon-arrow-down-red pure-u-1">
                                <select class="event-select app-tools-event-select">
                                    <option value="1078841" selected="">Wedding</option>
                                    <option value="1078843">Rehearsal Dinner</option>
                                    <option value="1078845">Shower</option>
                                    <option value="1560545">Testing</option>
                                </select>
                            </div>
                        </div>
                        <div class="guests-invitationForm-container">
                            <ul class="guests-invitationForm-tabs pure-g">
                                <li class="pure-u-1-2">
                                    <a class="active app-tabs-tab" data-tab-name="new" data-tab-status="active" role="button">
                                        <i class="mb5 icon-tools icon-tools-invitation-new"></i> New
                                    </a>
                                </li>
                                <li class="pure-u-1-2">
                                    <a role="button" class="app-tabs-tab inactive " data-tab-name="list">
                                        <i class="mb5 icon icon-fav"></i> Saved
                                    </a>
                                </li>
                            </ul>
                            <div data-tab-content="new">
                                <form class="guests-invitationForm app-tools-invitations-form" name="frmToolLayer" action="/tools/InvitationsAddRun" method="post" data-has-wedsite="1">
                                    @csrf
                                    <input type="hidden" name="ref" value="">
                                    <input type="hidden" name="idInvitation" value="0">
                                    <input type="hidden" name="idGuest" value="">
                                    <input type="hidden" name="status" id="status" value="new">
                                    <input type="hidden" name="fondo" value="">
                                    <input type="hidden" name="idEvent" id="idEvent" value="1078841">
                                    <div class="input-group-line">
                                        <input type="hidden" name="headerImage" value="" data-msgerror="You must choose an image for the cover">
                                    </div>
                                    <input type="hidden" name="guests" value="">
                                    <div class="pure-g">
                                        <div class="pure-u-1-2">
                                            <div class="input-group-line mr10">
                                                <div class="input-group-line">
                                                    <span class="input-group-line-label">Your name</span>
                                                    <input class="app_preview-invite" type="text" name="nombre1" id="nombre1" placeholder="Your name" value="Maria" data-msgerror="You must enter both names">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pure-u-1-2">
                                            <div class="input-group-line ml10">
                                                <div class="input-group-line">
                                                    <span class="input-group-line-label">Partner's name</span>
                                                    <input class="app_preview-invite" type="text" name="nombre2" id="nombre2" placeholder="Name of your partner" value="cesario" data-msgerror="You must enter both names">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group-line">
                                        <span class="input-group-line-label">Wedding date</span>
                                        <div class="app-common-datepicker">
                                            <input name="fecha" class="app_preview-invite" id="invitationFecha" type="text" value="06/03/2015" maxlength="20" autocomplete="off" data-date-viewmode="years" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-weekstart="1" readonly="">
                                        </div>
                                    </div>
                                    <div class="input-group-line">
                                        <span class="input-group-line-label">Wedding location</span>
                                        <script>
                                            var executeSearch = function (e) { common_searchEmpresa(e, 1, false, event, {"addVendorOption":false,"loader":"line","forceUseDesktop":true}) };
                                        </script>
                                        <div class="drop-wrapper app-suggest-vendor-input ">
                                            <input type="hidden" class="app-suggest-vendor-id-invitation-place" id="&quot;suProvider_id-invitation-place&quot;" name="app-suggest-vendor-input-id-invitation-place" value="">
                                            <input type="hidden" class="app-suggest-vendor-new-invitation-place" id="&quot;suProvider_listed-invitation-place&quot;" name="app-suggest-vendor-input-listed-invitation-place" value="1">
                                            <input id="&quot;suProvider-invitation-place&quot;" type="text" name="app-suggest-vendor-input-invitation-place" autocomplete="off" class="pure-u-1 app-input-vendor app_preview-invite" placeholder="Wedding location" data-suffix="invitation-place" data-categs="115,126" data-sectors="" data-add-vendor-option="" data-rate-vendor-option="" data-open-new-window="1" data-function-on-click-not-found="void" data-not-found-msg-with-timeout="1" data-concurso="0" data-is-multisearch="" data-multisearch-field-ids="app-suggest-vendor-id-invitation-place" onblur="common_searchEmpresaReset(this, false);" onkeyup="executeSearch(this);" value="Somewhere" data-msgerror="Please select the location of the wedding">
                                            <div class="app-suggest-vendor-div-invitation-place droplayer droplayer-scroll dnone"></div>
                                            <span class="app-loader-line loader-line input-line "></span>
                                        </div>
                                    </div>
                                    <div class="input-group-line">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Title</span>
                                            <input class="app_preview-invite" type="text" name="titulo" id="titulo" maxlength="80" value="" placeholder="Invitation title" data-msgerror="You cannot leave the title blank">
                                        </div>
                                    </div>
                                    <div class="input-group-line">
                                        <span class="input-group-line-label">Message</span>
                                        <div class="input-group-line">
                                            <textarea class="app_preview-invite" id="texto" name="texto" rows="4" cols="34" placeholder="Invitation text" data-msgerror="You must add text for the invitations"></textarea>
                                        </div>
                                    </div>
                                    <div class="toolsInvitationsSection">
                                        <div class="pure-g mb5">
                                            <div class="pure-u-3-4">
                                                <span class="input-group-line-label">Wedding Website</span>
                                                <div class="input-group-line--buttons ellipsis">https://www.weddingwire.ca/web/maria-and-cesario</div>
                                            </div>
                                            <div class="pure-u-1-4">
                                                <input type="hidden" name="isWebsiteActive" value="1">
                                                <div class="switch-radio app-switch-input inputToggleInvite  active">
                                                    <label>
                                                        <input class="app-not-icheck app_preview-invite" name="web" value="0" type="radio">
                                                    </label>
                                                    <label>
                                                        <input class="app-not-icheck app_preview-invite" name="web" value="1" type="radio" checked="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group-line-web"></div>
                                    </div>
                                    <div class="toolsInvitationsSection">
                                        <input type="hidden" name="isRsvpVisible" value="1">
                                        <div class="pure-u-2-3">
                                            <p class="input-group-line-label">Request RSVP</p>
                                        </div>
                                        <div class="switch-radio app-switch-input inputToggleInvite " data-tipo="status">
                                            <label>
                                                <input class="app-not-icheck app_preview-invite" name="confirmacion" value="0" type="radio" checked="">
                                            </label>
                                            <label>
                                                <input class="app-not-icheck app_preview-invite" name="confirmacion" value="1" type="radio">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt20">
                                        <a class="btn-outline outline-red mr5 mb20" role="button" onclick="invitation_save();" data-send="0">Save</a>
                                        <a class="btn-flat red mb20" data-toggle="modal" onclick="invitation_save_and_send()" data-send="1">Save and send</a>
                                    </div>
                                </form>
                            </div>
                            <div data-tab-content="list" style="display:none">
                                <ul class="guests-invitationList"></ul>
                                <div class="text-center">
                                    <button class="btn-outline outline-red app-link" data-href="/tools/InvitationsAdd?new=true">New invitation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pure-u-13-24">
                    <div id="invitationPreview" class="guests-invitation-preview">
                        <table class="guests-invitation" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <td class="middle-box">
                                        <form class="guests-invitationForm-upload" id="form-header-image" enctype="multipart/form-data" action="/tools/InvitationsHeaderPhotoUpload" method="post" target="formImageCrop">
                                            <input type="hidden" name="idInvitation" value="0">
                                            <div class="app-show-hide-upload">
                                                <i class="icon-tools icon-tools-camera-big block mb20"></i>
                                            </div>
                                            <div class="app-croppie-upload-button-invitation guests-invitationForm-upload-label">
                                                <span>Upload image</span>
                                            </div>
                                            <input type="file" name="file" accept="image/jpeg,image/jpg,image/gif,image/png" style="display:none">
                                        </form>
                                        <img id="prevHeaderImg" src="https://cdn1.weddingwire.ca/assets/img/tools/trans.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invat-title">
                                        <span id="prevTitulo">Invitation title</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mario-cs">
                                        <span id="prevNombre">Maria &amp; cesario</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="wd-box">
                                        <span id="prevEvent">Wedding</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dt-desc">
                                        <span id="prevFecha">Friday 6 of March 2015</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dt-desc">
                                        <span id="prevLugar">Somewhere</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invt-txt">
                                        <table id="prevTexto" cellspacing="0" cellpadding="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>Invitation text</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr id="prevConfirm" style="display: none;">
                                    <td class="rsvp-box">
                                        <a id="bgColorBtn" class="btn-flat red disabled" role="button">RSVP</a>
                                    </td>
                                </tr>
                                <tr id="prevWebsite">
                                    <td>
                                        <table class="guestsInvitationFooter" >
                                            <tbody>
                                                <tr>
                                                    <td class="img-box" align="right">
                                                        <img width="75" src="https://cdn1.weddingwire.ca/assets/img/tools/invitations/nav-wedsite.png">
                                                    </td>
                                                    <td class="visit-box">
                                                        <span>Visit our website</span><br>
                                                        <a href="https://www.weddingwire.ca/web/maria-and-cesario">https://www.weddingwire.ca/web/maria-and-cesario</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pure-u-4-24" id="descripcionInvitationMaker">
                    <div class="guests-invitation-steps step1">
                        <i class="icon-tools icon-tools-invitation-arrow"></i>
                        <p>Add a photo of you and your partner.</p>
                    </div>
                    <div class="guests-invitation-steps step2">
                        <i class="icon-tools icon-tools-invitation-arrow"></i>
                        <p>Add your names, date, and location of your wedding.</p>
                    </div>
                    <div class="guests-invitation-steps step3">
                        <i class="icon-tools icon-tools-invitation-arrow"></i>
                        <p>Add a title to your online invitation.</p>
                    </div>
                    <div class="guests-invitation-steps step4">
                        <i class="icon-tools icon-tools-invitation-arrow"></i>
                        <p>Add important details about your big day that guests should know.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.footer')
@endsection