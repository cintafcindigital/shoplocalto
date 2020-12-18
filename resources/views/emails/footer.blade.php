<div class="app-footer">
    <div class="footer-info">
        <div class="wrapper">
            <div class="row">
                <!-- <div class="pure-u-1-4">
                    <p class="footer-info-title">Choose a country</p><hr>
                    <div class="nav pure-g-r mt5">
                        <ul class="pure-u-1-2">
                            <li><strong>Americas</strong></li>
                            <li><a href="javascript:;" title="Bodas México" hreflang="es-mx">Mexico</a></li>
                            <li><a href="javascript:;" title="Matrimonios Chile" hreflang="es-cl">Chile</a></li>
                            <li><a href="javascript:;" title="Casamientos Argentina" hreflang="es-ar">Argentina</a></li>
                            <li><a href="javascript:;" title="Casamentos Brasil" hreflang="pt-br">Brazil</a></li>
                            <li><a href="javascript:;" title="Matrimonio Colombia" hreflang="es-co">Colombia</a></li>
                            <li><a href="javascript:;" title="Matrimonio Perú" hreflang="es-pe">Peru</a></li>
                            <li><a href="javascript:;" title="Casamiento Uruguay" hreflang="es-uy">Uruguay</a></li>
                            <li><a href="javascript:;" title="Wedding" hreflang="en-us">United States</a></li>
                        </ul>
                        <ul class="pure-u-1-2">
                            <li><strong>Europe</strong></li>
                            <li><a href="javascript:;" title="Bodas" hreflang="es">Spain</a></li>
                            <li><a href="javascript:;" title="Mariage" hreflang="fr">France</a></li>
                            <li><a href="javascript:;" title="Matrimonio" hreflang="it">Italy</a></li>
                            <li><a href="javascript:;" title="Wedding United Kingdom" hreflang="en-gb">United Kingdom</a></li>
                            <li><a href="javascript:;" title="Casamentos" hreflang="pt">Portugal</a></li>
                            <li class="mt10"><strong>Asia</strong></li>
                            <li><a href="javascript:;" title="Wedding India" hreflang="en-in">India</a></li>
                        </ul>
                    </div>
                </div> -->
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                    <div class="pure-s">
                        <p class="footer-info-title">Information</p><hr>
                        <ul>
                            <li><a rel="nofollow" href="{{ url('/about-us') }}">About Us</a></li>
                            <li><a rel="nofollow" href="{{ url('/contact') }}">Contact Us</a></li>
                            <li><a rel="nofollow" href="{{ url('/privacy-policy') }}">Privacy policy</a></li>
                            <li><a rel="nofollow" href="{{ url('/user-agreement') }}">User Agreement</a></li>
                            <li><a rel="nofollow" href="{{ url('/community-guidelines') }}">Community Guidelines</a></li>
                            <li><a rel="nofollow" href="{{ url('/testimonial') }}">Testimony</a></li>
                            <li><a rel="nofollow" href="{{ url('/register') }}">Registration</a></li>
                            <!-- <li><a rel="nofollow" href="{{ url('register') }}">Registration for vendors</a></li> -->
                            <!-- <li><a rel="nofollow" href="{{ url('/wedding-vendors') }}">Wedding Vendors</a></li>
                            <li><a href="{{ url('/wedding-venues') }}">Wedding Venues</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="pure-u-1-4" style="display: none;">
                    <div class="pure-s">
                        <p class="footer-info-title">Get the My Health Squad app</p><hr>
                        <ul>
                            <li>
                                <a rel="nofollow noopener noreferrer" target="_blank" href="javascript:;">
                                    <img src="{{ url('public/images/appstore.png') }}" loading="lazy" alt="Appstore" width="140" height="42">
                                </a>
                            </li>
                            <li class="mt10">
                                <a rel="nofollow noopener noreferrer" target="_blank" href="javascript:;">
                                    <img src="{{ url('public/images/googleplay.png') }}" loading="lazy" alt="Google Play" width="140" height="42">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="pure-s">
                    <p class="footer-info-title">Follow us on</p>
                    <hr>
                        <ul class="footer-social">
                            @if(isset($socials) && !empty($socials))
                                @foreach($socials as $social)
                                    <li><a href="{{url($social->social_link)}}" target="blank">{!!$social->icon!!} &nbsp; &nbsp; {{ $social->name }}</a> </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    <div class="footer-nav">
        <div class="wrapper">
            <div class="overflow">
                <ul class="footer-nav-menu">
                    @if(isset($category) && is_array($category) && count($category) > 0)
                    @foreach($category as $cats)
                         <!-- <li class="dropdown">
                            <a href="{{url('search/'.$cats['slug'])}}" class="app-header-tab show-caret {{$cats['slug']}}">{{$cats['title']}}</a>
                         </li> -->
                        <li><a href="{{url('search?search='.$cats['slug'])}}"><span class="app-footer-links">{{$cats['title']}}</span></a></li>
                    @endforeach
                    @endif
                    <li><a href="{{url('blogs')}}"><span class="app-footer-links">Blog</span></a></li>
                    <li><a href="{{url('community')}}"><span class="app-footer-links">Community</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Progress Bar Modal START -->
<div id="progress-notifier" class="modal fade " tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-large">
        <div class="modal-content app-review-request-importer">
            <button type="button" class="close close-white progress-notifier-close" aria-hidden="true" style="font-size:60px;margin-top:-20px;">×</button>
            @if(@Auth::user()->first_popup == 0)
                <div class="adminModalImport__title"><h3>My Health Squad welcomes you</h3></div>
                <h4 style="padding:10px;">Thanks for joining the My Health Squad community <b>“Experts helping Experts”.</b></h4>
                <h4 style="padding:10px;">We live for health squads and we are so excited to help you grow your business and make meaningful connections.</h4>
            @else
                <div class="adminModalImport__title"><h3>Have you completed all your tasks?</h3></div>
            @endif
            <h4 style="padding:10px;"><u>List of Tasks to Complete Your Profile</u></h4>
            <div class="ctChecklistTasks__item pt2 pb2">
                @if(@$vendor_progress_basic == 'no')
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('storefront')}}">Business description and contact information for leads</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_images == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('gallery')}}">Upload 8 photos</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_address == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('storefront-map')}}">Add your business address</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_faqs == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('storefront-faqs')}}">Fill out all of your FAQs</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_deals == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('promociones')}}">Add a deal for potential clients</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_tenHDimages == 'no')
                <!-- <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('gallery')}}">Upload 10 high-quality photos</a>
                    </p>
                </div> -->
                @endif
                @if(@$vendor_progress_videos == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('videos')}}">Upload a video</a>
                    </p>
                </div>
                @endif
                @if(@$vendor_progress_reviewAsk == 'no')
                <hr style="margin:0px;">
                <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox" style="padding-left:10px;">
                    <a class="rctChecklistTasks__checkBoxLink"><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                </div>
                <div class="rctChecklistTasks__description" style="width:80% !important">
                    <p style="font-size:18px;padding-top:10px;font-weight:bold;">
                        <a href="{{url('reviews')}}">Ask 5 clients for reviews</a>
                    </p>
                </div>
                @endif
            </div>
            <div class="adminModalImport__actions p5"></div>
        </div>
    </div>
</div><!-- / END Progress Bar Modal -->
<!-- CONTACT SECTION START-->
<section id="contact-top" class="section-padding" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @if(isset($category[1]['slug']) && !empty($category[1]['slug'] && $category[1]['id'] == 1))
                <div class="widget about-widget">
                    <h3 class="widget-title"><span>{{$category[1]['title']}}</span></h3>
                    <div class="widget-content">
                        <ul class="custom-list">
                         @if(isset($category[1]['child']) && !empty($category[1]['child']))
                          @foreach($category[1]['child'] as $ch0)
                            <li><a href="{{url($category[1]['slug'])}}/{{$ch0['slug']}}">{{$ch0['title']}}</a></li>
                          @endforeach
                        @endif
                        </ul>
                    </div>
                </div><!-- ABOUT WIDGET : end -->
                @endif
            </div>
            <div class="col-sm-3"><!-- LINKS WIDGET : begin -->
                <div class="widget links-widget">
                    <h3 class="widget-title"><span>@lang('frontend.quick_link')</span></h3>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="custom-list">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    @if(isset($category[2]['slug']) && !empty($category[2]['slug']))
                                    <li><a href="{{url($category[2]['slug'])}}">My Health Squad Vendors</a></li>
                                    @endif
                                    <li><a href="{{url('/testimonial')}}">Testimonial</a></li>
                                    <li><a href="{{url('/contact')}}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="custom-list">
                                    <li><a href="{{url('/register')}}">Register</a></li>
                                    <li><a href="{{url('/login')}}">Login</a></li>
                                    <li><a href="{{url('/privacy-policy')}}">Privacy policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- LINKS WIDGET : end -->
            </div>
            <div class="col-sm-3"><!-- TWITTER WIDGET : begin -->
                <div class="widget twitter-widget">
                    <h3 class="widget-title">
                        <span>@lang('frontend.get_connect_us')</span>
                    </h3>
                    <div class="widget-content">
                        <div class="footer-icon">
                            @if(isset($socials) && !empty($socials))
                            @foreach($socials as $social)
                              <a href="{{url($social->social_link)}}">{!!$social->icon!!}</a>
                            @endforeach
                            @endif
                        </div> 
                    </div>
                </div><!-- TWITTER WIDGET : end -->
            </div>
            <div class="col-sm-3"><!-- NEWSLETTER WIDGET : begin -->
                <div class="widget newsletter-widget">
                    <h3 class="widget-title"><span>@lang('frontend.sign_newsletter')</span></h3>
                    <div class="widget-content">
                        <p style="color:#F9A32A;" id="newsletter-error"></p>
                        <form class="default-form" action="index.html">
                            <div class="input-group">
                                <input class="email" name="email" id="newsletter_email" type="text" placeholder="Email address ...">
                                <button type="button" onclick="Frontend.saveNewsletter()"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div><!-- NEWSLETTER WIDGET : end -->
            </div>
        </div>
    </div>
</section><!-- / END CONTACT SECTION-->
<!-- FOOTER SECTION-->
<!-- <div class="visible-xs" style="margin-bottom: 54%;"><p>&nbsp;</p></div> -->
<footer id="footer-section" style="display: none;">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-cont" style="padding-top: 9px;">
                    <p>@lang('frontend.copyright',['year'=>date('Y'),'url'=>'http://www.indigitalgroup.ca/'])</p>
                </div>
            </div>
        </div>
    </div>
</footer><!-- / END FOOTER SECTION-->
<script type="text/javascript">
$(document).ready(function(){
    //// for progress bar modal....
    var is_popup_allow = '{{session('vendor_progress_popup')}}';
    var vendor_progress_percentage = "{{@$vendor_progress_percentage}}";
    if(Number(vendor_progress_percentage) < 100 && Number(vendor_progress_percentage) != 0 && is_popup_allow == 'allow') {
        $('#progress-notifier').modal('show');
        <?php session(['vendor_progress_popup' => 'notAllowed']); ?>
    }
    //// for progress bar modal....
    var is_popup_allow_new = '{{session('bride_toDoList_popup')}}';
    var bride_todo_percent = "{{@$bride_todo_percent}}";
    if(Number(bride_todo_percent) < 100 && is_popup_allow_new == 'allow') {
        $('#bride-toDoList').modal('show');
        <?php session(['bride_toDoList_popup' => 'notAllowed']); ?>
    }
    $('body').on('click','.progress-notifier-close',function(){
        $('#bride-toDoList').modal('hide');
        $('#progress-notifier').modal('hide');
    });
    //// status move jquery....
    $('.app-solicitudes-changeStatus').on('click', function() {
        var cv = $(this);
        var actionvalue = cv.attr('data-actionvalue');
        var action = cv.attr('data-action');
        $('#statusAction').val(action);
        $('#statusVal').val(actionvalue);
        $('#frmGestorSolicitudes').submit();
    });
    $('.adminFiltersBox__moreButton').on('click', function() {
        $('.adminFiltersSuggest__Layer').toggle();
    });
    $('.move_select').click(function(){
        $('.mark_us_list').hide();
        $('.move_to_list').toggle();
    });
    $('.mark_select').click(function(){
        $('.move_to_list').hide();
        $('.mark_us_list').toggle();
    });
    // For multiple checkbox
    $('.adminFiltersBox__check').hover(function() {
        $(this).addClass('hover');
        $(this).find('.icheckbox_minimal').addClass('hover');
    }, function() {
        $(this).removeClass('hover');
        $(this).find('.icheckbox_minimal').removeClass('hover');
    });
    $('.icheckbox_minimal.common_icheckbox_minimal').on('click', function() {
        var cv = $(this);
        if($('.app-solicitudes-check-all').is(":checked")) {
            cv.addClass('checked');
            $('.adminHomeSol__item').each(function() {
                $(this).find('.icheckbox_minimal').addClass('checked');
                $(this).find('.app-solicitudes-check').prop('checked', true);
            });
        } else {
            cv.removeClass('checked');
            $('.adminHomeSol__item').each(function() {
                $(this).find('.icheckbox_minimal').removeClass('checked');
                $(this).find('.app-solicitudes-check').prop('checked', false);
            });
        }
    });
    // For single checkbox 
    $('.single_icheckbox_minimal').hover(function() {
        $(this).addClass('hover');
    }, function() {
        $(this).removeClass('hover');
    });
    $('.icheckbox_minimal.single_icheckbox_minimal').on('click', function() {
        var cv = $(this);
        if(cv.find('.app-solicitudes-check').is(":checked")) {
            cv.removeClass('checked');
            cv.find('.dnone').prop("checked", false);
        } else {
            cv.addClass('checked');
            cv.find('.dnone').prop("checked", true);
        }
    });
});
</script>