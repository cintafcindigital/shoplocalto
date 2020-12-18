
 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="editGuestPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Guest</h4>
      </div>
      <div class="modal-body">
        <form name="frmToolLayerEdit" id="frmToolLayerEdit" action="#" method="post">
                <div class="alert app-guest-add dnone">
                </div>
                <div class="pure-g">
                    <div class="pure-u-2-7 modal-addGuest-left">
                        <i class="app-guest-icon-big icon-tools icon-tools-men-big block mt35 text-center"></i>
                        <ul class="modal-addGuest-menu app-menu-add-guest">
                            <li class="app-tools-guests-layer-section-header active" data-step-menu="1" onclick="Frontend.handleTab(this)"><i class="icon icon-caret-right"></i>Personal information                            </li>
                            <li class="app-tools-guests-layer-section-header" data-step-menu="2" onclick="Frontend.handleTab(this)"><i class="icon icon-caret-right"></i>Contact information                            </li>
                        </ul>
                    </div>
                    <div class="pure-u-5-7 modal-addGuest-right">
                        <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                            <p class="modal-addGuest-right-title mb15">Personal information</p>
                             <div class="pure-g">
                                <div class="pure-u-1-2">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Name</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" maxlength="20" size="25" id="edit_guest_name" name="edit_guest_name" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-1-2">
                                     <div class="app-input-select input-select app-select-group input-group-line">
                                        <span class="input-group-line-label">Attendance</span>
                                         <select class="app-newTask-period" name="edit_attendance" id="edit_attendance" data-msgerror="You must select a attendance">
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
                                        <select class="app-newTask-period" name="edit_guest_group" id="edit_guest_group" data-msgerror="You must select a group">
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
                                         <select class="app-newTask-period" name="edit_guest_menu" id="edit_guest_menu" data-msgerror="You must select a menu">
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
                                        <span class="select-switcher-section select-switcher-section-gender-edit edit-male" data-selected="male" onclick="Frontend.addGuestGenderEdit(this)">Male</span>
                                        <span class="select-switcher-section select-switcher-section-gender-edit edit-female" data-selected="female" onclick="Frontend.addGuestGenderEdit(this)">Female</span>
                                    </div>
                                    <input id="edit_guest_gender" name="gender" type="hidden" value="">
                                </div><br>
                                <div class="pure-u-3-5 app-switcher">&nbsp;
                                </div>
                            </div>
                            <div class="pure-g">
                                    <div class="pure-u-3-5">
                                    <div class="select-switcher">
                                        <span class="select-switcher-section select-switcher-section-age-edit edit-adult" data-selected="adult" onclick="Frontend.addGuestAgeTypeEdit(this)">Adult</span>
                                        <span class="select-switcher-section select-switcher-section-age-edit edit-children" data-selected="children" onclick="Frontend.addGuestAgeTypeEdit(this)">Child</span>
                                        <span class="select-switcher-section select-switcher-section-age-edit edit-baby" data-selected="baby" onclick="Frontend.addGuestAgeTypeEdit(this)">Baby</span>
                                    </div>
                                    <input id="edit_age_type" type="hidden" name="age-type" value="">
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
                                            <input class="app-input-mail form-input form-input-email pure-u-1" placeholder="E-mail" type="email" name="edit_guest_mail" id="edit_guest_mail" size="25" maxlength="80" value="" data-msgerror="Check that the e-mail is correct.">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-2-5">
                                    <div class="input-group-line ml10">
                                        <span class="input-group-line-label">Phone number</span>
                                        <input class="form-input form-input-phone" placeholder="Phone number" type="text" name="edit_guest_phone" id="edit_guest_phone" maxlength="80" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="pure-g app-suggest-location-container">
                                        <div class="pure-u-3-5">
                                            <div class="input-group-line mr10">
                                                <span class="input-group-line-label">City/Town</span>
                                                <input placeholder="City/Town" name="edit_guest_city" id="edit_guest_city" value="" type="text" autocomplete="off" data-suffix="default" class="app-contact-form-city">
                                                <div id="StrPoblacion" class="app-suggest-poblacion-div-default droplayer droplayer-scroll" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="pure-u-2-5">
                                            <span class="input-group-line-label ml10">Country</span>
                                            <div class="app-input-select input-select input-group-line ml10">
                                                <select class="app-contact-form-country-selector-default" name="edit_guest_country" id="edit_guest_country">
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
                                        <input placeholder="Address" type="text" name="edit_guest_address" id="edit_guest_address" size="25" maxlength="120" value="">
                                    </div>
                                </div>
                                <div class="pure-u-2-5">
                                    <div class="input-group-line ml10">
                                        <span class="input-group-line-label">Postal Code</span>
                                        <input placeholder="Postal Code" type="text" name="edit_guest_postal_code" id="edit_guest_postal_code" size="10" maxlength="20" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-addGuest-footer">
            <input type="hidden" name="edit_guest_id" id="edit_guest_id" value="">
            <button onclick="Frontend.toolsGuestsLayerEdit(1);" class="btn-flat red app-guest-save" type="button">Edit </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->