<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="newGuests-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog modalAddGuest" style="width:48%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close icon icon-close-grey" data-dismiss="modal"></button>
                <h2>Add Guests</h2>
            </div>
            <nav class="modalAddGuestTabs">
                <a class="modalAddGuestTabs__item app-addguest-tab active" data-section="new" role="button">
                    <i class="svgIcon svgIcon__user modalAddGuestTabs__itemIcon">
                        <svg viewBox="0 0 47 53">
                            <path d="M31.722 29.786C40.49 32.99 46.78 42.236 46.78 51.962v1H.846v-1c0-9.615 6.156-18.77 14.774-22.069-2.971-1.686-5.407-4.324-6.774-7.691-3.236-7.981.75-17.009 8.891-20.172 8.13-3.154 17.343.736 20.575 8.698 2.915 7.181-.03 15.22-6.59 19.058zm-12.16 1.698l-2.469.006c-7.922 2.633-13.8 10.765-14.222 19.472h41.885c-.423-8.744-6.343-16.9-14.309-19.501l-2.786.006a16.09 16.09 0 0 1-8.099.017zm-1.1-27.59c-7.11 2.762-10.576 10.617-7.763 17.556 2.82 6.944 10.88 10.347 17.998 7.582 7.107-2.761 10.575-10.62 7.762-17.551C33.64 4.537 25.579 1.133 18.46 3.895z" fill-rule="nonzero"></path>
                        </svg>
                    </i> Add new guest
                </a>
                <a class="modalAddGuestTabs__item app-addguest-tab " data-section="import" role="button">
                    <i class="svgIcon svgIcon__excel modalAddGuestTabs__itemIcon">
                        <svg viewBox="0 0 17 19">
                            <path d="M7.125 11.124v1.25h5.75v-1.25h-5.75zm-1 0h-2v1.25h2v-1.25zm1 3.5h5.5c.164 0 .25-.064.25-.062v-1.188h-5.75v1.25zm-1 0v-1.25h-2v1.188c0-.002.086.062.25.062h1.75zm1-4.5h5.75v-1.25h-5.75v1.25zm-1 0v-1.25h-2v1.25h2zm1-3.5v1.25h5.75V6.687c0 .001-.086-.063-.25-.063h-5.5zm-1 0h-1.75c-.164 0-.25.064-.25.063v1.187h2v-1.25zm8.927-2.395l-2.78-2.781a.25.25 0 0 0-.177-.073h-9.97a.25.25 0 0 0-.25.25v15.75c0 .138.112.25.25.25h12.75a.25.25 0 0 0 .25-.25V4.405a.25.25 0 0 0-.073-.176zm1.073.176v12.97c0 .69-.56 1.25-1.25 1.25H2.125c-.69 0-1.25-.56-1.25-1.25V1.625c0-.69.56-1.25 1.25-1.25h9.969c.331 0 .649.13.885.365l2.78 2.781c.234.235.366.553.366.884zm-2.25 10.157c0 .623-.586 1.062-1.25 1.062h-8.25c-.664 0-1.25-.44-1.25-1.062V6.687c0-.624.586-1.063 1.25-1.063h8.25c.664 0 1.25.44 1.25 1.063v7.875z" fill-rule="nonzero"></path>
                        </svg>
                    </i> Import spreadsheet
                </a>
            </nav>
            <section class="app-addguest-tabsection sectionNew">
                <form class="p30 pb0" name="newGuestsForm" id="newGuestsForm" action="#" method="post">
                    @csrf
                    <input type="hidden" name="eventId" value="{{$idEvent}}">
                    <div class="alert alert-success app-guest-add dnone">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>Guest added successfully.</p>
                    </div>
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
                                    <input type="text" placeholder="First name" class=" app-addGuest-suggest-item-name" name="firstname" size="25" maxlength="20" onclick="hidefirstnameErr(0);">
                                    <span class="firstnameErr0 dnone" style="color:#f5234d;">The name must contain a minimum of two characters</span>
                                </div>
                                <div class="modalAddGuestCompanion__surname input-group-line input-group-line--noMargin app-">
                                    <input type="text" placeholder="Last Name" class="app-addGuest-suggest-item-surname" name="lastname" size="25" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <a role="button" class="app-guest-new-companion modalAddGuest__link" onclick="modalAddGuest_add();">
                            <i class="svgIcon svgIcon__plusCircle modalAddGuest__linkIcon">
                                <svg viewBox="0 0 16 16">
                                    <path d="M8.5 7.5h3a.5.5 0 1 1 0 1h-3v3a.5.5 0 1 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0v3zM8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" fill-rule="nonzero"></path>
                                </svg>
                            </i> Add related guests or a plus one
                        </a>
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
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="age_type" onchange="change_svgIcon(this.value);">
                                    <option>Adult</option>
                                    <option>Child</option>
                                    <option>Baby</option>
                                </select>
                            </div>
                        </div>
                        <div class="pure-u-1-2">
                            <div class="app-input-select app-select-sex input-select input-group-line mr15">
                                <span class="input-group-line-label">Gender</span>
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="pure-u-1-2">
                            <div class="app-input-select input-select app-select-group input-group-line input-group-line--noMargin mr15">
                                <span class="input-group-line-label">Group</span>
                                <select class="app-input-hidden app-addGuest-suggest-item-age" name="group_id">
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
                                    <input type="checkbox" id="need_hotel" name="need_hotel">
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
                                                <input type="checkbox" class="app-input-checkbox-event" name="invited_for[{{$ge->id}}]" @if($ge->id == 1) checked @endif>
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
                                    <input class="app-input-mail" placeholder="Email" type="email" name="email" size="25" maxlength="80" data-msgerror="Check that the e-mail is correct.">
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="input-group-line mr15">
                                    <span class="input-group-line-label">Phone number</span>
                                    <input placeholder="Phone number" type="text" name="phone_no" maxlength="80">
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="input-group-line">
                                    <label class="input-group-line-label">Mobile number</label>
                                    <input placeholder="Phone number" type="text" name="mobile_no" maxlength="80">
                                </div>
                            </div>
                        </div>
                        <div class="pure-g">
                            <label class="input-group-line-label pure-u-1">Address</label>
                            <div class="pure-u-1-4">
                                <div class="input-group-line mr15">
                                    <input placeholder="Address" type="text" name="address" size="25" maxlength="120">
                                </div>
                            </div>
                            <div class="app-suggest-location-container pure-u-2-4">
                                <div class="pure-g mr15">
                                    <div class="pure-u-1-2">
                                        <div class="input-group-line mr15">
                                            <input placeholder="City/Town" name="city_town" type="text" autocomplete="off" class="app-contact-form-city">
                                        </div>
                                    </div>
                                    <div class="pure-u-1-2">
                                        <div class="app-input-select input-select input-group-line">
                                            <select class="app-contact-form-country-selector-default" name="country">
                                                <option>Canada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pure-u-1-4">
                                <div class="input-group-line mr15">
                                    <input placeholder="Postal Code" type="text" name="postal_code" size="10" maxlength="20">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <footer class="modalAddGuest__footer">
                    <button type="button" class="btnOutline btnOutline--primary mr5 app-guest-save" onclick="guests_layer_submit('save');">Save and add another</button>
                    <button type="button" class="btnFlat btnFlat--primary app-guest-save" onclick="guests_layer_submit('add');">Add </button>
                </footer>
            </section>
            <section class="modalAddGuest__container app-addguest-tabsection sectionImport" style="display:none;">
                <p class="modalAddGuest__title">Import guests</p>
                <p class="modalAddGuest__description">Easily organize and import your guest list using our template.</p>
                <div class="modalAddGuest__buttonSection">
                    <form action="/tools/GuestImportExcelViewDataRun" method="post" id="app-up-excel-list-form" enctype="multipart/form-data">
                        <a href="/tools/GuestsCSV?type=dnltpl" class="modalAddGuest__button btnOutline btnOutline--primary">Download Template</a>
                        <label class="modalAddGuest__button btnFlat btnFlat--primary" for="app-up-excel-list">Import Guest List</label>
                        <input class="dnone" id="app-up-excel-list" type="file" name="spreadsheet">
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>