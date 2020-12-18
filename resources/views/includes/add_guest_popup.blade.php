<!-- Modal -->
<div class="modal fade my-wedding-modal" id="addGuestPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="margin-top: 95px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Guest</h4>
      </div>
      <div class="modal-body">
        <form name="frmToolLayer" id="frmToolLayer" action="#" method="post">
                <div class="alert app-guest-add dnone"></div>
                <div class="pure-g">
                    <div class="pure-u-2-7 modal-addGuest-left" style="min-height: 355px;">
                        <i class="app-guest-icon-big icon-tools icon-tools-men-big block mt35 text-center"></i>
                        <ul class="modal-addGuest-menu app-menu-add-guest">
                            <li class="app-tools-guests-layer-section-header active" data-step-menu="1" onclick="Frontend.handleTab(this)"><i class="icon icon-caret-right"></i>Personal information </li>
                            <li class="app-tools-guests-layer-section-header" data-step-menu="2" onclick="Frontend.handleTab(this)"><i class="icon icon-caret-right"></i>Contact information  </li>
                            <li class="app-tools-guests-layer-section-header" data-step-menu="3" onclick="Frontend.handleTab(this)"><i class="icon icon-caret-right"></i>Additional Guests</li>
                        </ul>
                    </div>
                    <div class="pure-u-5-7 modal-addGuest-right" style="min-height: 355px;">
                        <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                            <p class="modal-addGuest-right-title mb15">Personal information</p>
                             <div class="pure-g">
                                <div class="pure-u-1-2">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Name</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" maxlength="20" size="25" id="guest_name" name="guest_name" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-1-2">
                                     <div class="app-input-select input-select app-select-group input-group-line">
                                        <span class="input-group-line-label">Attendance</span>
                                         <select class="app-newTask-period" name="attendance" id="attendance" data-msgerror="You must select a attendance">
                                            <option value="">Select</option>
                                            <option value="confirmed">confirmed</option>
                                            <option value="pending">pending</option>
                                            <option value="cancelled">Cancelled</option>
                                          </select>
                                     </div>
                                    </div>
                            </div>

                            <div class="pure-g">
                                <div class="pure-u-1-2">
                                    <div class="app-input-select input-select app-select-group input-group-line mr10">
                                        <span class="input-group-line-label mr10">Group</span>
                                        <select class="app-newTask-period" name="guest_group" id="guest_group" data-msgerror="You must select a group">
                                            <option value="">Select</option>
                                            @if(isset($data['guestsCat']) && !empty($data['guestsCat']))
                                                       @foreach($data['guestsCat'] as $gro)
                                                         <option value="{{$gro['id']}}">{{$gro['title']}}</option>
                                                       @endforeach
                                            @endif
                                          </select>
                                    <input type="hidden" name="Grupo" class="app-input-hidden" value="7"></div>
                                </div>
                                <div class="pure-u-1-2">
                                     <div class="app-input-select input-select app-select-group input-group-line">
                                        <span class="input-group-line-label">Menus</span>
                                         <select class="app-newTask-period" name="guest_menu" id="guest_menu" data-msgerror="You must select a menu">
                                            <option value="">Select</option>
                                            <option value="adult">Adult</option>
                                            <option value="children">Children</option>
                                            <option value="no menu assigned">No menu assigned</option>
                                          </select>
                                     </div>
                                    </div>
                                </div>
                            <div class="pure-g mb20">
                                <div class="pure-u-2-5 app-switcher">
                                    <div class="select-switcher">
                                        <span class="select-switcher-section select-switcher-section-gender active" data-selected="male" onclick="Frontend.addGuestGender(this)">Male</span>
                                        <span class="select-switcher-section select-switcher-section-gender" data-selected="female" onclick="Frontend.addGuestGender(this)">Female</span>
                                    </div>
                                    <input id="guest_gender" name="gender" type="hidden" value="male">
                                </div><br>
                                <div class="pure-u-3-5 app-switcher">&nbsp;
                                </div>
                            </div>
                            <div class="pure-g">
                                    <div class="pure-u-3-5">
                                    <div class="select-switcher">
                                        <span class="select-switcher-section select-switcher-section-age active" data-selected="adult" onclick="Frontend.addGuestAgeType(this)">Adult</span>
                                        <span class="select-switcher-section select-switcher-section-age " data-selected="children" onclick="Frontend.addGuestAgeType(this)">Child</span>
                                        <span class="select-switcher-section select-switcher-section-age " data-selected="baby" onclick="Frontend.addGuestAgeType(this)">Baby</span>
                                    </div>
                                    <input id="age_type" type="hidden" name="age-type" value="adult">
                                </div>
                            </div>
                        </div>
                        <div class="app-tab-box-content modal-addGuest-section addGuest-2" data-step="2">
                            <p class="modal-addGuest-right-title mb15">Contact information</p>
                            <div class="pure-g mb20">
                                <div class="pure-u-3-5">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">E-mail</span>
                                            <input class="app-input-mail form-input form-input-email pure-u-1" placeholder="E-mail" type="email" name="mail" id="guest_mail" size="25" maxlength="80" value="" data-msgerror="Check that the e-mail is correct.">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-2-5">
                                    <div class="input-group-line ml10">
                                        <span class="input-group-line-label">Phone number</span>
                                        <input class="form-input form-input-phone" placeholder="Phone number" type="text" name="phone" id="guest_phone" maxlength="80" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="pure-g app-suggest-location-container">
                                        <div class="pure-u-3-5">
                                            <div class="input-group-line mr10">
                                                <span class="input-group-line-label">City/Town</span>
                                                <input placeholder="City/Town" name="city" id="guest_city" value="" type="text" autocomplete="off" data-suffix="default" class="app-contact-form-city">
                                                <div id="StrPoblacion" class="app-suggest-poblacion-div-default droplayer droplayer-scroll" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="pure-u-2-5">
                                            <span class="input-group-line-label ml10">Country</span>
                                            <div class="app-input-select input-select input-group-line ml10">
                                                <select class="app-contact-form-country-selector-default" name="country" id="guest_country">
                                                    @if(isset($data['countries']) && !empty($data['countries']))
                                                       @foreach($data['countries'] as $country)
                                                         <option value="{{$country['sortname']}}" @if($country['sortname']=='CA') selected @endif>{{$country['name']}}</option>
                                                       @endforeach
                                                       @else
                                                        <option value="CA" selected="">Canada</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                               <div class="pure-g">
                                <div class="pure-u-3-5">
                                    <div class="input-group-line mr10">
                                        <span class="input-group-line-label">Address</span>
                                        <input placeholder="Address" type="text" name="address" id="guest_address" size="25" maxlength="120" value="">
                                    </div>
                                </div>
                                <div class="pure-u-2-5">
                                    <div class="input-group-line ml10">
                                        <span class="input-group-line-label">Postal Code</span>
                                        <input placeholder="Postal Code" type="text" name="postal_code" id="guest_postal_code" size="10" maxlength="20" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /////////////////////////////////////// -->

                         <div class="app-tab-box-content modal-addGuest-section addGuest-3" data-step="3">
                            <div class="app-new-companion-form">
                                <div class="app-list-companions-container mb10 hide">
                                <p class="app-count-companions-title modal-addGuest-right-title mb5">Companion</p>
                                <div class="app-list-companions-content pure-g row centered">                                    
                                    
                                </div>
                                </div>

                                <p class="modal-addGuest-right-title">Add related guests or a plus one</p>
                                <div class="pure-g">
                                    <div class="pure-u-1-2">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Name</span>
                                            <input type="text" placeholder="First name" name="additionalg_first_name" id="additionalg_first_name" size="25" maxlength="20" data-msgerror="The name must contain a minimum of two characters" value="">
                                        </div>
                                    </div>
                                    <div class="pure-u-1-2">
                                        <div class="input-group-line ml10">
                                            <span class="input-group-line-label">Last Name</span>
                                            <input id="additionalg_last_name" type="text" name="additionalg_last_name" value="" size="19" maxlength="40" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-g mb20">
                                    <div class="pure-g mb20">
                                        <div class="pure-u-2-5 app-switcher">
                                            <div class="select-switcher">
                                                <span class="select-switcher-section additional-guest-gender active" data-selected="male" onclick="Frontend.addAdditionalGuestGender(this)">Male</span>
                                                <span class="select-switcher-section additional-guest-gender" data-selected="female" onclick="Frontend.addAdditionalGuestGender(this)">Female</span>
                                            </div>
                                            <input type="hidden" id="additionalg_gender" value="male">
                                        </div><br>
                                        <div class="pure-u-3-5 app-switcher">&nbsp;
                                        </div>
                                    </div>
                                    <div class="pure-g">
                                            <div class="pure-u-3-5">
                                            <div class="select-switcher">
                                                <span class="select-switcher-section additional-guest-age-type active" data-selected="adult" onclick="Frontend.addAdditionalGuestAgeTypeEdit(this)">Adult</span>
                                                <span class="select-switcher-section additional-guest-age-type " data-selected="children" onclick="Frontend.addAdditionalGuestAgeTypeEdit(this)">Child</span>
                                                <span class="select-switcher-section additional-guest-age-type " data-selected="baby" onclick="Frontend.addAdditionalGuestAgeTypeEdit(this)">Baby</span>
                                            </div>
                                           <input type="hidden" id="additionalg_age_type" value="adult">
                                        </div>
                                    </div>
                                    </div>
                                        <button class="btn-outline outline-red" type="button" onclick="Frontend.addAdditionalGuests()">
                                            Save companion to this guest                                </button>
                                    </div>
                        </div>

                        <!-- /////////////////////////////////////// -->
                       
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-addGuest-footer">
            <button onclick="Frontend.toolsGuestsLayerSubmit(0);" class="btn-outline outline-red mr10 app-guest-save" type="button">Save and add another</button>
            <button onclick="Frontend.toolsGuestsLayerSubmit(1);" class="btn-flat red app-guest-save" type="button">Add </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->