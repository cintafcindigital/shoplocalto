<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="newCompanion-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Add related guests or a plus one</p>
            </div>
            <form name="newCompanion" id="newCompanion" action="#" method="post">
                @csrf
                <div class="alert alert-success app-guest-add dnone">
                    <button type="button" class="close" data-dismiss="alert">×</button>Guest added successfully.
                </div>
                <div class="modal-addGuest-right">
                    <div class="app-tab-box-content modal-addGuest-section active" data-step="3">
                        <div class="app-new-companion-form">
                            <div class="pure-g">
                                <div class="pure-u-1-2">
                                    <div class="input-group-line mr10">
                                        <span class="input-group-line-label">First name</span>
                                        <input class="pure-u-1" type="text" name="cfirstname" size="19" maxlength="20" placeholder="First name">
                                        <span class="cfirstnameErr dnone" style="color:#f5234d;">The first name must contain a minimum of two characters</span>
                                    </div>
                                </div>
                                <div class="pure-u-1-2">
                                    <div class="input-group-line ml10">
                                        <span class="input-group-line-label">Last Name</span>
                                        <input class="pure-u-1" type="text" name="clastname" size="19" maxlength="40" placeholder="Last Name">
                                        <span class="clastnameErr dnone" style="color:#f5234d;">The last name must contain a minimum of two characters</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pure-g">
                                <div class="pure-u-1-2 app-input-select input-select input-group-line">
                                    <span class="input-group-line-label">Menu</span>
                                    <span class="app-input-label input-select-label menuTypesSpan" onclick="openMenuTypes();">Choose menu</span>
                                    <div class="app-input-dropdown input-select-dropdown menuTypesDiv">
                                        <ul>
                                            <li onclick="get_menuTypes('No menu assigned');">No menu assigned</li>
                                            <li onclick="get_menuTypes('Beef');">Beef</li>
                                            <li onclick="get_menuTypes('Chicken');">Chicken</li>
                                            <li onclick="get_menuTypes('Child Meal');">Child Meal</li>
                                            <li onclick="get_menuTypes('Fish');">Fish</li>
                                            <li onclick="get_menuTypes('Lamb');">Lamb</li>
                                            <li onclick="get_menuTypes('Other');">Other</li>
                                            <li onclick="get_menuTypes('Vegetarian');">Vegetarian</li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="cmenu_types">
                                </div>
                            </div>
                            <div class="pure-g">
                                <div class="pure-u-1-2 app-switcher mb20">
                                    <div class="select-switcher">
                                        <span class="select-switcher-section genderClass genderMale" onclick="get_Gender('Male');">Male</span>
                                        <span class="select-switcher-section genderClass genderFemale active" onclick="get_Gender('Female');">Female</span>
                                    </div>
                                    <input type="hidden" name="cgender" value="Female">
                                </div>
                                <div class="pure-u-2-3 app-switcher mb20">
                                    <div class="select-switcher">
                                        <span class="select-switcher-section ageClass ageAdult active" onclick="get_AgeTypes('Adult');">Adult</span>
                                        <span class="select-switcher-section ageClass ageChild" onclick="get_AgeTypes('Child');">Child</span>
                                        <span class="select-switcher-section ageClass ageBaby" onclick="get_AgeTypes('Baby');">Baby</span>
                                    </div>
                                    <input type="hidden" name="cage_type" value="Adult">
                                </div>
                            </div>
                            <button class="btn-flat red" type="button" onclick="guests_companion_add_new();">Save companion to this guest</button>
                            <span data-dismiss="modal" class="ml10 app-new-companion-cancel color-grey pointer">Cancel</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>