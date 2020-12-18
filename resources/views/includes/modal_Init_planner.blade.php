 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="initPlanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">One last step!</h4>
         <p class="modalInitPlanner__leftSubtitle">Update your planner with information about your wedding</p>
      </div>
      <div class="modal-body">
        <form class="app-tools-wedding-modal-form bride-groom-info" name="frmBoda" action="">
                <h5 id="show-msg-wedding-pro" style="padding:10px;text-align:center;"></h5>
                <div class="p30 pb10">
                    <div class="pure-g-r">
                        <div class="pure-u-2-5">
                            <div class="modal-myWedding-dash-sectionAvatar app-coupledata-owner app-owner app-spinner-container-owner" data-rol="owner">
                                <!-- <div class="upl-foto app-photo-1">
                                    <input id="photo_1" type="file" name="foto" accept="image/*" hidden="">
                                </div> -->
                                <label for="photo" class="pointer frame-inputFile">
                                    <div class="app-hover-owner modal-myWedding-dash-sectionAvatar-hover">
                                        <!-- <i class="icon-tools icon-tools-avatar-camera-white"></i> -->
                                    </div>
                                    <div class="app-foto-owner-container">
                                        <div class="avatar-alias size-avatar-large avatar-center self-avatar-image">
                                            @if(isset($user_partner[0]['avatar']) && !empty($user_partner[0]['avatar']))
                                                 <img src="{{url('public/storage/app')}}/{{$user_partner[0]['avatar']}}">
                                                @else
                                                  <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                      <circle fill="#90caa4" cx="100" cy="100" r="100"></circle>
                                                      <text transform="translate(100,130)" y="0">
                                                          <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{($user_partner[0]['firstname']!=null)?substr($user_partner[0]['firstname'],0,1):'A'}}</tspan>
                                                      </text>
                                                  </svg>
                                               @endif
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <span class="input-group-line-label">I am</span>
                            <div class="input-group-line">
                                <input type="text" id="my_name_pro" name="my_name_pro" value="{{$user_partner[0]['firstname'] ?? ''}}" size="20" maxlength="150" placeholder="Name " data-msgerror="You must enter the name">
                            </div>
                        </div>
                        <div class="pure-u-1-5 wedding-rings">
                            <img src="{{url('public/images/wedding-rings.png')}}" alt="">
                        </div>

                        <div class="pure-u-2-5">
                            <div class="modal-myWedding-dash-sectionAvatar app-coupledata-owner app-owner app-spinner-container-partner" data-rol="partner">
                              <!--   <div class="upl-foto app-photo-2">
                                    <input id="photo_2" type="file" name="foto" accept="image/*" hidden="">
                                </div> -->
                                <label for="photo" class="pointer frame-inputFile">
                                    <div class="app-hover-partner modal-myWedding-dash-sectionAvatar-hover">
                                        <!-- <i class="icon-tools icon-tools-avatar-camera-white"></i> -->
                                        </div>
                                        <div class="app-foto-partner-container">
                                            <div class="avatar-alias size-avatar-large avatar-center partner-avatar-image">
                                                @if(isset($user_partner[0]['partner_avatar']) && !empty($user_partner[0]['partner_avatar']))
                                                 <img src="{{url('public/storage/app')}}/{{$user_partner[0]['partner_avatar']}}">
                                                @else
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#EAD6C3" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ($user_partner[0]['partner_name']!=null)?substr($user_partner[0]['partner_name'],0,1):'B'}}</tspan>
                                                    </text>
                                                </svg>
                                                @endif
                        </div>
                                        </div>
                                </label>
                            </div>
                            <span class="input-group-line-label">My partner</span>
                            <div class="input-group-line">
                                <input type="text" id="my_partner_name_pro" name="my_partner_name_pro" value="{{$user_partner[0]['partner_name'] ?? ''}}" size="20" maxlength="150" placeholder="Name ">
                            </div>
                        </div>
                    </div>

                    <div class="pure-g mb25">
                        <div class="pure-u-2-5">
                            <span class="input-group-line-label">I am</span>
                            <div class="select-switcher mt5 app-toggle-gender-wrapper">
                                <span class="select-switcher-section app-toogle-gender my-gender-select-pro @php if(isset($user_partner[0]['gender']) && $user_partner[0]['gender'] == 'groom'){ echo 'active';} @endphp" onclick="Frontend.myWeddingGenderPro(this)" data-gender="groom" role="button">Groom</span>
                                <span class="select-switcher-section app-toogle-gender my-gender-select-pro @php if(isset($user_partner[0]['gender']) && $user_partner[0]['gender'] == 'bride'){ echo 'active';} @endphp" onclick="Frontend.myWeddingGenderPro(this)" data-gender="bride" role="button">Bride</span>
                            </div>
                            <input type="hidden" id="my_gender_pro" name="my_gender_pro" class="app-partner-gender-input" value="{{$user_partner[0]['gender'] ?? ''}}">
                        </div>
                        <div class="pure-u-1-5">
                            &nbsp;
                        </div>
                        <div class="pure-u-2-5">
                            <span class="input-group-line-label">My partner is a...</span>
                            <div class="select-switcher mt5 app-toggle-gender-wrapper">
                                <span class="select-switcher-section app-toogle-gender my-partner-gender-select-pro @php if(isset($user_partner[0]['partner_gender']) && $user_partner[0]['partner_gender'] == 'groom'){ echo 'active';} @endphp" onclick="Frontend.myWeddingPartnerGenderPro(this)" data-gender="groom" role="button">Groom</span>
                                <span class="select-switcher-section app-toogle-gender my-partner-gender-select-pro @php if(isset($user_partner[0]['partner_gender']) && $user_partner[0]['partner_gender'] == 'bride'){ echo 'active';} @endphp" onclick="Frontend.myWeddingPartnerGenderPro(this)" data-gender="bride" role="button">Bride</span>
                            </div>
                            <input type="hidden" id="my_partner_gender_pro" name="my_partner_gender_pro" class="app-partner-gender-input" value="{{$user_partner[0]['partner_gender'] ?? ''}}">
                            <input type="hidden" name="isMaster" value="1">
                        </div>
                    </div>
                    <div class="pure-g">
                        <div class="pure-u-2-5">
                            <label class="input-group-line-label">Wedding date</label>
                            <div class="input-group-line app-common-datepicker mr20">
                                @php $wDate = isset($user_partner[0]['wedding_date'])?date('d/m/Y',strtotime($user_partner[0]['wedding_date'])):''; @endphp
                                <input id="my_wedding_date_pro" name="my_wedding_date_pro" class="datetimepicker" placeholder="dd/mm/yyyy" type="text" value="{{$wDate ?? ''}}" >
                            </div>
                        </div>
                        <div class="pure-u-1-5">
                            &nbsp;
                        </div>
                        <div class="pure-u-2-5">
                            <label class="input-group-line-label block mt5">Venue</label>
                            <div class="input-group-line">
                                <div id="divVenueSaved" class="input-group-line">
                                    <div class="drop-wrapper">
                                        <span class="app-loader-line loader-line input-line"></span>
                                        @php $venueN=''; @endphp
                                        @if(isset($user_partner[0]['venue']) && !empty($user_partner[0]['venue']))
                                             @php $venueN = ucwords(str_replace('-',' ',$user_partner[0]['venue'])); @endphp
                                        @endif 
                                        <input type="text" class="form-input form-input-location app-tools-main-modif-venue" name="venue" autocomplete="off" data-suffix="default" data-categs="1" data-id-thumb="1" data-sectors="0" data-concurso="0" placeholder="Business Name"  onkeyup="Frontend.getVanuesData(this)" id="venues_slug_data_show_pro" value="{{$venueN}}">
                                        <input type="hidden" class="app-suggest-vendor-id-default" name="venues_slug_data_pro" id="venues_slug_data_pro" value="{{$user_partner[0]['venue'] ?? ''}}">
                                        <div class="droplayer droplayer-scroll app-suggest-vendor-div-default hide" style="width: 170%">
                                           <ul class="nav-main-list search-venues-list">
                                           </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center pt20 pb20 border-top">
                    <input class="btn-flat red" type="button" onclick="Frontend.saveMyWeddingPromoData()" value="Save">
                </div>
            </form>

      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->