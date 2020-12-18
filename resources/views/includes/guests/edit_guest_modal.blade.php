<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="editGuests-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog modalAddGuest" style="width:48%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close icon icon-close-grey" data-dismiss="modal"></button>
                <h2>Edit Guest</h2>
            </div>
            <section class="app-addguest-tabsection sectionNew">
                <form class="p30 pb0" name="editGuestsForm" id="editGuestsForm" action="#" method="post">
                    @csrf
                    <input type="hidden" name="eventId" value="{{$idEvent}}">
                    <input type="hidden" name="edit_guestId" id="edit_guestId">
                    <div class="mb30">
                        <div class="app-guest-new-companion-container">
                            <div class="modalAddGuestCompanion app-addGuest-suggest-item-contact">
                                <div class="modalAddGuestCompanion__icon app-guest-change-avatar">
                                    <i class="svgIcon svgIcon__avatarGuestAdult firstAdultIcon">
                                        <svg viewBox="0 0 179 179">
                                            <path d="M37.226 154.617C51.535 166.117 69.714 173 89.5 173c19.44 0 37.328-6.643 51.518-17.783C132.608 134.17 112.144 120 89 120c-22.92 0-43.215 13.897-51.774 34.617zm-4.754-4.124c7.464-16.539 21.784-28.892 38.969-33.963C54.747 109.63 43 93.187 43 74c0-25.405 20.595-46 46-46s46 20.595 46 46c0 19.187-11.747 35.63-28.44 42.53 17.412 5.138 31.882 17.753 39.259 34.618C162.523 135.88 173 113.914 173 89.5 173 43.384 135.616 6 89.5 6S6 43.384 6 89.5c0 24.067 10.182 45.755 26.472 60.993zM89.5 179C40.07 179 0 138.93 0 89.5S40.07 0 89.5 0 179 40.07 179 89.5 138.93 179 89.5 179zm-.5-65c22.091 0 40-17.909 40-40s-17.909-40-40-40-40 17.909-40 40 17.909 40 40 40z" fill-rule="nonzero"></path>
                                        </svg>
                                    </i>
                                    <i class="svgIcon svgIcon__avatarGuestChild " style="display:none;">
                                        <svg viewBox="0 0 179 179">
                                            <path d="M84.895 78.5h-.688C71.847 87.644 64 100.821 64 114.5v6h41v-6c0-13.285-7.967-26.674-20.105-36zM81.5 72.086V60.848c-2.275.73-5.19 1.381-8.758 2.058C66.688 64.054 59.03 65 56.5 65a9.5 9.5 0 0 1 0-19c2.53 0 10.188.946 16.242 2.094 5.477 1.039 9.414 2.02 11.863 3.311 2.512-1.293 6.568-2.27 12.243-3.314C103.067 46.948 110.958 46 113.5 46a9.5 9.5 0 0 1 0 19c-2.543 0-10.433-.948-16.652-2.091-3.855-.71-6.964-1.387-9.348-2.155v11.332c26.054 1.496 46.918 22.36 48.414 48.414h15.023a3 3 0 0 1 0 6H36a3 3 0 0 1-3-3c0-27.436 21.454-49.86 48.5-51.414zm13.267 7.077C104.733 89.023 111 101.653 111 114.5v6h18.903c-1.319-20.257-15.894-36.899-35.136-41.337zm-20.632.023c-19.193 4.471-33.721 21.091-35.038 41.314H58v-6c0-13.113 6.132-25.611 16.135-35.314zm6.256-24.052c-2.083-.732-5.043-1.457-8.58-2.128C66.037 51.912 58.656 51 56.5 51a4.5 4.5 0 1 0 0 9c2.157 0 9.538-.912 15.31-2.006 3.538-.671 6.498-1.396 8.58-2.128.353-.124.676-.246.966-.366-.29-.12-.613-.242-.965-.366zm8.48.724c2.158.734 5.221 1.46 8.881 2.133C103.698 59.084 111.32 60 113.5 60a4.5 4.5 0 0 0 0-9c-2.18 0-9.802.916-15.748 2.01-3.66.672-6.723 1.398-8.882 2.132-.355.121-.682.24-.977.358.295.117.622.237.977.358zM89.5 179C40.07 179 0 138.93 0 89.5S40.07 0 89.5 0 179 40.07 179 89.5 138.93 179 89.5 179zm0-6c46.116 0 83.5-37.384 83.5-83.5S135.616 6 89.5 6 6 43.384 6 89.5 43.384 173 89.5 173z" fill-rule="nonzero"></path>
                                        </svg>
                                    </i>
                                    <i class="svgIcon svgIcon__avatarGuestBaby " style="display:none;">
                                        <svg viewBox="0 0 179 179">
                                            <path d="M89.5 179C40.07 179 0 138.93 0 89.5S40.07 0 89.5 0 179 40.07 179 89.5 138.93 179 89.5 179zm0-6c46.116 0 83.5-37.384 83.5-83.5S135.616 6 89.5 6 6 43.384 6 89.5 43.384 173 89.5 173zM50.224 67.745c.18 1.513.47 3.032.876 4.547a32.21 32.21 0 0 0 1.852 5.134l60.93-16.326a32.21 32.21 0 0 0-.963-5.373 32.278 32.278 0 0 0-1.461-4.25L50.224 67.746zm-.13-6.173l58.413-15.519c-7.434-10.972-21.256-16.577-34.78-12.953C60.25 36.71 51.1 48.407 50.094 61.572zm-.137 22.868l-.235.064-.209-.778a38.016 38.016 0 0 1-4.209-9.881c-5.432-20.272 6.599-41.109 26.87-46.54 20.272-5.433 41.109 6.598 46.54 26.87 5.127 19.131-5.3 38.766-23.53 45.48l6.316 23.57c8.862-.89 17.317 4.741 19.697 13.624 2.644 9.869-3.212 20.013-13.082 22.658-9.869 2.644-20.013-3.213-22.657-13.082-2.38-8.882 2.126-17.988 10.246-21.647l-6.295-23.495c-15.625 3.118-31.207-3.9-39.452-16.843zm6.137-1.644c7.559 10.422 21.02 15.654 34.198 12.123 13.177-3.53 22.22-14.792 23.554-27.598L56.094 82.796zm50.469 70.915c6.668-1.787 10.625-8.64 8.838-15.31-1.786-6.668-8.64-10.625-15.309-8.838-6.668 1.787-10.626 8.641-8.839 15.31 1.787 6.668 8.641 10.625 15.31 8.838z" fill-rule="nonzero"></path>
                                        </svg>
                                    </i>
                                </div>
                                <div class="modalAddGuestCompanion__name input-group-line input-group-line--noMargin ">
                                    <span class="input-group-line-label">Name</span>
                                    <input type="text" placeholder="First name" class=" app-addGuest-suggest-item-name" name="edit_firstname" size="25" maxlength="20" onclick="hidefirstnameErr(0);" id="edit_firstname">
                                    <span class="firstnameErr0 dnone" style="color:#f5234d;">The name must contain a minimum of two characters</span>
                                </div>
                                <div class="modalAddGuestCompanion__surname input-group-line input-group-line--noMargin app-">
                                    <input type="text" placeholder="Last Name" class="app-addGuest-suggest-item-surname" name="edit_lastname" size="25" maxlength="40" id="edit_lastname">
                                </div>
                            </div>
                        </div>
                        <!-- <a role="button" class="app-guest-new-companion modalAddGuest__link" onclick="modalAddGuest_add();">
                            <i class="svgIcon svgIcon__plusCircle modalAddGuest__linkIcon">
                                <svg viewBox="0 0 16 16">
                                    <path d="M8.5 7.5h3a.5.5 0 1 1 0 1h-3v3a.5.5 0 1 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0v3zM8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" fill-rule="nonzero"></path>
                                </svg>
                            </i> Add related guests or a plus one
                        </a> -->
                    </div>
                    <p class="modalAddGuest__label app-addguest-toggle" data-value="guest_div">
                        Guest information <i class="svgIcon svgIcon__angleDown modalAddGuest__labelIcon active">
                            <svg viewBox="0 0 1792 1792">
                                <path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10L407 759q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"></path>
                            </svg>
                        </i>
                    </p>
                    <div class="pure-g mt20 mb30 guest_div">
                        <div class="pure-u-1-2">
                            <div class="app-input-select input-select app-guest-change-gender input-group-line mr15" data-name="Edad">
                                <span class="input-group-line-label">Age</span>
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="edit_age_type" id="edit_age_type" onchange="change_svgIcon(this.value);">
                                    <option>Adult</option>
                                    <option>Child</option>
                                    <option>Baby</option>
                                </select>
                            </div>
                        </div>
                        <div class="pure-u-1-2">
                            <div class="app-input-select app-select-sex input-select input-group-line mr15">
                                <span class="input-group-line-label">Gender</span>
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="edit_gender" id="edit_gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="pure-u-1-2">
                            <div class="app-input-select input-select app-select-group input-group-line input-group-line--noMargin mr15">
                                <span class="input-group-line-label">Group</span>
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="edit_group_id" id="edit_group_id">
                                    <option value="">Choose Group</option>
                                    @foreach($data['guestsCat'] as $gct)
                                        <option value="{{$gct->id}}">{{$gct->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="pure-u-1-3">
                            <span class="input-group-line-label">Need hotel</span>
                            <div class="input-group-line input-group-line--noMargin mt10">
                                <label>
                                    <input type="checkbox" id="edit_need_hotel" name="edit_need_hotel" id="edit_need_hotel">
                                    <span></span>
                                    <span class="ml5">Yes</span>
                                </label>
                            </div>
                        </div>
                        <div class="pure-u-1 mt15">
                            <div>
                                <span class="input-group-line-label">invited to</span>
                            </div>
                            <div class="pure-g">
                                @foreach($data['guests_event'] as $ge)
                                    <div class="pure-u mt10 mr15">
                                        <div class="input-group-line input-group-line--noMargin">
                                            <label>
                                                <input type="checkbox" class="app-input-checkbox-event" name="edit_invited_for[{{$ge->id}}]" id="edit_invited_for{{$ge->id}}">
                                                <span></span>
                                                <span class="ml5">{{$ge->event_name}}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <p class="modalAddGuest__label app-addguest-toggle" data-value="contact_div">
                        Contact information <i class="svgIcon svgIcon__angleDown modalAddGuest__labelIcon">
                            <svg viewBox="0 0 1792 1792">
                                <path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10L407 759q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"></path>
                            </svg>
                        </i>
                    </p>
                    <div class="mt20 mb10 contact_div" style="display:none;">
                        <div class="pure-g">
                            <div class="pure-u-1-3">
                                <div class="input-group-line mr15">
                                    <span class="input-group-line-label">Email</span>
                                    <input class="app-input-mail" placeholder="Email" type="email" name="edit_email" size="25" maxlength="80" id="edit_email" data-msgerror="Check that the e-mail is correct.">
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="input-group-line mr15">
                                    <span class="input-group-line-label">Phone number</span>
                                    <input placeholder="Phone number" type="text" name="edit_phone_no" id="edit_phone_no" maxlength="80">
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="input-group-line">
                                    <label class="input-group-line-label">Mobile number</label>
                                    <input placeholder="Phone number" type="text" name="edit_mobile_no" id="edit_mobile_no" maxlength="80">
                                </div>
                            </div>
                        </div>
                        <div class="pure-g">
                            <label class="input-group-line-label pure-u-1">Address</label>
                            <div class="pure-u-1-4">
                                <div class="input-group-line mr15">
                                    <input placeholder="Address" type="text" name="edit_address" size="25" id="edit_address" maxlength="120">
                                </div>
                            </div>
                            <div class="app-suggest-location-container pure-u-2-4">
                                <div class="pure-g mr15">
                                    <div class="pure-u-1-2">
                                        <div class="input-group-line mr15">
                                            <input placeholder="City/Town" name="edit_city_town" type="text" id="edit_city_town" class="app-contact-form-city">
                                        </div>
                                    </div>
                                    <div class="pure-u-1-2">
                                        <div class="app-input-select input-select input-group-line">
                                            <select class="app-contact-form-country-selector-default" name="edit_country" id="edit_country">
                                                <option>Canada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pure-u-1-4">
                                <div class="input-group-line mr15">
                                    <input placeholder="Postal Code" type="text" name="edit_postal_code" id="edit_postal_code" size="10" maxlength="20">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <footer class="modalAddGuest__footer">
                    <button type="button" class="btnOutline btnOutline--primary mr5 app-guest-save" onclick="editguest_new();">Save Changes</button>
                </footer>
            </section>
        </div>
    </div>
</div>