@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<style>
.icon-tools-download::before {
    background-position: 0px -223px;
    height: 19px;
    width: 19px;
}
</style>
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
      <div class="wrapper">
    <div class="app-currency-entity dnone" data-before="C$" data-after=""></div>

    <div class="tools-toggle-content app-lista-header-nav pure-g">
        <div class="pure-u-1-3"></div>
        <div class="pure-u-1-3">
            <div class="tools-toggle">
                <a class="tools-toggle-item active" href="{{url('tools/budget')}}">Budget</a>
                <a class="tools-toggle-item" href="{{url('tools/budget-payments')}}">Payments</a>
            </div>
        </div>
        <div class="pure-u-1-3 text-right bud_print_wrp">
            <a class="pointer tools-toggle-action" href="{{url('tools/budget-export')}}" role="button"><i class="icon-tools icon-tools-download icon-left"></i>Download</a>
            <a class="pointer tools-toggle-action" href="{{url('tools/budgetreport')}}" target="_blank" role="button"><i class="icon icon-print icon-left"></i>Print</a>
        </div>
    </div>
    <div id="app-error"></div>
    <div class="pure-g">
        <div class="pure-u-1-3 budget-listing cat_bud_list_wrp">
            <div class="mr40">
                <div class="box">
                    <div class="app-tools-budget-rows subtitle">
                       @if(isset($data['child_cats']) && !empty($data['child_cats']))
                       @foreach($data['child_cats'] as $cat)
                       @php
                            $cat_title = str_replace('\'','',$cat['title']);
                       @endphp
                       
                        <div style="height:54px;" class="budget-categories-item icon icon-arrow-right app-tools-budget-row app-budget-scroll-top " data-category-id="{{$cat['cat_id']}}" >
                          <a href="{{url('/tools/budget-category')}}/{{$cat['cat_id']}}" style="width:100%;">
                            <span class="budget-categories-item-title app-item-title icon-tools ">
                                @if($cat['title'] == 'Reception')
                                    <i class="svgIcon svgIcon__categReception budget-categories-item-icon"><svg viewBox="0 0 54 41"><path d="M4 19.421l-2.401 1.795A1 1 0 0 1 .4 19.614L25.868.584a1 1 0 0 1 .751-.324 1 1 0 0 1 .751.324l25.467 19.03a1 1 0 0 1-1.198 1.602L48 18.496V41H4V19.421zm2-1.494V39h12V21h16v18h12V17.002L26.619 2.519 6 17.927zM32 39V23H20v16h12z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Wedding Music')
                                    <i class="svgIcon svgIcon__categBand budget-categories-item-icon"><svg viewBox="0 0 55 41"><path d="M18.635 4.636a9.002 9.002 0 0 0 0 12.728 8.992 8.992 0 0 0 12.722 0 9.004 9.004 0 0 0 0-12.729 8.994 8.994 0 0 0-12.722 0zm14.137-1.414c4.293 4.296 4.293 11.26 0 15.556-4.294 4.296-11.257 4.296-15.551 0-4.295-4.297-4.295-11.26 0-15.556 4.294-4.296 11.257-4.296 15.55 0zM45 26v-3.465A4 4 0 1 1 43 22c.729 0 1.412.195 2 .535V6.558l9.014 3.372-.145 7.075L47 14.195V26h-2a2 2 0 1 0-3.999-.002A2 2 0 0 0 45 26zM2.877 34.27a8.29 8.29 0 0 0-.229.404c-.398.75-.636 1.485-.648 2.12-.015.903.42 1.569 1.584 2.066 1.248.532 1.547.393 7.754-3.224 4.299-2.505 7.515-3.7 11.178-3.634 3.042.054 5.307 1.278 6.849 3.267.942 1.217 1.43 2.43 1.613 3.284l-1.956.42a5.104 5.104 0 0 0-.244-.738 7.269 7.269 0 0 0-.994-1.74c-1.183-1.528-2.891-2.45-5.303-2.493-3.21-.058-6.127 1.026-10.136 3.362-.529.308-2.278 1.356-2.565 1.524-.974.573-1.702.97-2.387 1.288-1.83.852-3.28 1.084-4.593.523-1.912-.815-2.83-2.22-2.8-3.94.018-1 .349-2.018.881-3.022.21-.397.421-.736.605-1.003A4.153 4.153 0 0 1 1 30.78v-.297c0-.97.34-1.91.962-2.663l12.776-15.457 1.541 1.274L3.503 29.095A2.18 2.18 0 0 0 3 30.483v.297c0 1.132.879 2.088 2.048 2.207a2.334 2.334 0 0 0 1.702-.499l15.622-12.595 1.256 1.557L8.005 34.045a4.333 4.333 0 0 1-3.163.932 4.314 4.314 0 0 1-1.965-.706zM15.274 2.689l1.452-1.376 18 19-1.452 1.376-18-19zM51.929 14.05l.057-2.745L47 9.442v2.592l4.93 2.017z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Wedding Invitations')
                                    <i class="svgIcon svgIcon__categInvite budget-categories-item-icon"><svg viewBox="0 0 50 51"><path d="M45 22.32V9.19C45 8.54 44.444 8 43.748 8H6.252C5.556 8 5 8.54 5 9.19v13.058l20.398 12.324L45 22.321zm2-1.25l.553-.345-.553-.461v.807zm1 1.734L27.317 35.731 48 48.227V22.804zM3 21.04v-.776l-.54.45.54.326zM45.411 49L2 22.773V49h43.411zM3 17.66V9.19C3 7.423 4.463 6 6.252 6h9.978l5.589-4.868C22.546.402 23.564 0 24.656 0c1.13 0 2.125.34 2.783 1.004L33.245 6h10.503C45.537 6 47 7.423 47 9.19v8.47l3 2.5V51H0V20.16l3-2.5zM19.274 6H30.18L26.08 2.468C25.777 2.166 25.293 2 24.656 2c-.572 0-1.078.2-1.472.592L19.274 6zm8.819 8C30.248 14 32 15.78 32 18.008a4 4 0 0 1-1.14 2.803l-4.636 4.878a1 1 0 0 1-1.443.006l-4.766-4.935A4.306 4.306 0 0 1 19 18.008C19 15.813 20.72 14 22.907 14c.968 0 1.891.37 2.593.999A3.904 3.904 0 0 1 28.093 14zm1.323 5.428c.382-.396.584-.883.584-1.42 0-1.13-.864-2.008-1.907-2.008a1.91 1.91 0 0 0-1.693 1.061 1 1 0 0 1-1.801 0A1.908 1.908 0 0 0 22.907 16C21.848 16 21 16.894 21 18.008c0 .532.198 1.045.504 1.42l3.99 4.127 3.922-4.127z" fill-rule="nonzero"></path></svg></i> 
                                @elseif($cat['title'] == 'Wedding Favours')
                                    <i class="svgIcon svgIcon__categGift budget-categories-item-icon"><svg viewBox="0 0 51 52"><path d="M20 50h10V14v-.003a7.631 7.631 0 0 1-.216.003H20.21l-.21-.003V50zm-2 0V13.661c-2.892-.911-5-3.559-5-6.661 0-3.892 3.227-7 7.21-7 1.788 0 3.454.64 4.776 1.761A7.37 7.37 0 0 1 29.784 0c3.983 0 7.21 3.108 7.21 7 0 3.155-2.12 5.795-5.046 6.682.034.1.052.207.052.318v36h14V25a1 1 0 0 1 2 0v26a1 1 0 0 1-1 1H3.996a1 1 0 0 1-1-1V25a1 1 0 0 1 2 0v25H18zM29.784 2c-1.586 0-3.075.69-4.023 1.811a1 1 0 0 1-1.508.022C23.213 2.673 21.777 2 20.21 2 17.315 2 15 4.23 15 7c0 2.732 2.339 5 5.21 5h9.574c2.895 0 5.21-2.23 5.21-5s-2.315-5-5.21-5zM1 26a1 1 0 0 1-1-1V13a1 1 0 0 1 1-1h49a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H1zm1-2h47V14H2v10z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Flowers and Decoration')
                                    <i class="svgIcon svgIcon__categFlower budget-categories-item-icon"><svg viewBox="0 0 34 54"><path d="M1.262 19.007a15.769 15.769 0 0 1-.262-2.7V5a1 1 0 0 1 1-1c3.282 0 6.336 1 8.878 2.709A27.672 27.672 0 0 1 16.343.246a1 1 0 0 1 1.314 0 27.673 27.673 0 0 1 5.464 6.462c.18-.112.361-.22.545-.326A15.792 15.792 0 0 1 32 4a1 1 0 0 1 1 1v11.32c-.074 6.59-4.225 12.225-10.06 14.546a15.496 15.496 0 0 1-4.94 1.24V43.37a17.164 17.164 0 0 1 2.44-3.202c3.326-3.533 7.89-5.348 12.59-5.154l.922.038.035.923c.181 4.698-1.553 9.434-4.798 12.977-3.173 3.194-7.3 4.952-11.679 5.048h-.85c-4.363 0-8.506-1.764-11.68-5.049C1.572 45.516-.173 40.813.013 35.975l.037-.942.942-.02c4.693-.097 9.242 1.712 12.56 5.146.948.98 1.765 2.073 2.448 3.256V32.14C8.57 31.797 2.468 26.23 1.262 19.007zm15.611-4.878a15.757 15.757 0 0 1 4.618-6.252A25.576 25.576 0 0 0 17 2.346a25.567 25.567 0 0 0-4.525 5.588 16.15 16.15 0 0 1 4.398 6.195zm5.013 27.42c-1.99 2.059-3.348 4.614-3.907 7.34L17.341 52h.147c3.842-.085 7.475-1.633 10.254-4.429a16.353 16.353 0 0 0 4.254-10.567c-3.785.091-7.402 1.668-10.11 4.544zm-5.86 7.366c-.667-2.85-1.99-5.376-3.912-7.366-2.696-2.79-6.314-4.363-10.11-4.525.084 3.946 1.615 7.716 4.405 10.528C9.216 50.457 12.839 52 16.66 52h.089l-.723-3.085zM18 20.015c0 1.334-2 1.334-2 0 0-7.35-5.75-13.46-13-13.98v10.262C3.085 23.864 9.338 30 17 30c7.663 0 13.915-6.136 14-13.692V6.036c-7.2.525-13 6.662-13 13.98z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Photography' || $cat['title'] == 'Videography')
                                    <i class="svgIcon svgIcon__categPhoto budget-categories-item-icon"><svg viewBox="0 0 54 40"><path d="M14.628 17.998H2V37.47c0 .303.236.53.592.53h48.816c.356 0 .592-.227.592-.53V17.998H39.372A12.99 12.99 0 0 1 40 22c0 7.18-5.82 13-13 13s-13-5.82-13-13c0-1.397.22-2.742.628-4.002zm.838-2A12.999 12.999 0 0 1 27 9c5.015 0 9.366 2.84 11.534 6.998H52V6.53c0-.303-.236-.53-.592-.53H2.592C2.236 6 2 6.227 2 6.53v9.468zM7 4V2.292C7 1.02 8.06 0 9.344 0h6.312C16.94 0 18 1.02 18 2.292V4h33.408C52.85 4 54 5.104 54 6.53v30.94c0 1.426-1.149 2.53-2.592 2.53H2.592C1.15 40 0 38.896 0 37.47V6.53C0 5.104 1.149 4 2.592 4zm2 0h7V2.292c0-.15-.148-.292-.344-.292H9.344C9.148 2 9 2.142 9 2.292zm31 10a1 1 0 0 1-1-1V9.032a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1V13a1 1 0 0 1-1 1zm7-2v-1.968h-6V12zm-20-1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm.029 4c3.88 0 7.029 3.133 7.029 7 0 3.868-3.148 7-7.03 7C23.149 29 20 25.868 20 22c0-3.867 3.148-7 7.029-7zm0 2C24.25 17 22 19.24 22 22s2.25 5 5.029 5c2.778 0 5.029-2.24 5.029-5s-2.25-5-5.03-5z"></path></svg></i>
                                @elseif($cat['title'] == 'Transport')
                                    <i class="svgIcon svgIcon__categTransport budget-categories-item-icon"><svg viewBox="0 0 55 36"><path d="M2 25.023c.05-.008.1-.012.153-.012h7.914a7.547 7.547 0 0 1 6.779-4.224 7.55 7.55 0 0 1 6.719 4.101h9.593a7.55 7.55 0 0 1 6.72-4.101 7.547 7.547 0 0 1 6.716 4.101h6.084v-6.497c0-.73-.149-1.447-.438-2.11L46.795 3.718A2.858 2.858 0 0 0 44.174 2H3.138A1.14 1.14 0 0 0 2 3.139v21.884zM2 27v1.333c0 .665.54 1.206 1.206 1.206h6.187a7.612 7.612 0 0 1 .02-2.528h-7.26c-.052 0-.103-.004-.153-.011zm8.009 4.539H3.206A3.206 3.206 0 0 1 0 28.333V3.139a3.14 3.14 0 0 1 3.138-3.14h41.036a4.859 4.859 0 0 1 4.455 2.924l5.446 12.56a7.28 7.28 0 0 1 .603 2.908v9.846a3.304 3.304 0 0 1-3.302 3.302h-4.662a7.547 7.547 0 0 1-6.837 4.346 7.55 7.55 0 0 1-6.838-4.346h-9.354a7.55 7.55 0 0 1-6.839 4.346 7.547 7.547 0 0 1-6.837-4.346zm37.32-2h4.047c.718 0 1.302-.585 1.302-1.302v-1.349h-5.391a7.59 7.59 0 0 1 .043 2.65zm-35.736.588c.023.049.04.1.055.152a5.55 5.55 0 1 0 10.423-3.82.994.994 0 0 1-.166-.41 5.551 5.551 0 0 0-10.312 4.078zm12.665-3.239a7.585 7.585 0 0 1 .043 2.65h8.122a7.607 7.607 0 0 1 .043-2.65h-8.208zm9.926-19.885H22.54v5.524h11.643V7.003zm2 .041v5.767l1.08.813 1.147.86.514.386c.116.086.553.23.7.23h6.027a2831.413 2831.413 0 0 0-1.59-3.625l-.028-.062A660.403 660.403 0 0 0 42.524 8c-.176-.392-.32-.712-.432-.957h-5.908zm-15.643-.04H9.03v5.523h11.512V7.003zm14.504 7.453v.07H7.03V5.003h28.016v.041h7.674c.97.514.97.514.896.548l.063.123c.039.08.091.191.158.335.123.266.295.647.513 1.134.383.855.899 2.022 1.516 3.423l.027.063a1914.415 1914.415 0 0 1 2.205 5.03l.612 1.4h-9.084c-.576 0-1.431-.282-1.895-.627l-.518-.388a1306.421 1306.421 0 0 1-2.167-1.628zM19.071 28.335a2.222 2.222 0 0 1-2.224 2.222 2.222 2.222 0 1 1 0-4.444c1.228 0 2.224.994 2.224 2.222zm-2 0c0-.122-.1-.222-.224-.222a.222.222 0 1 0 0 .444c.124 0 .224-.099.224-.222zm22.806-5.548a5.549 5.549 0 1 0-.002 11.097 5.549 5.549 0 0 0 .002-11.097zm2.223 5.548a2.224 2.224 0 1 1-4.448 0 2.224 2.224 0 0 1 4.448 0zm-2 0a.22.22 0 0 0-.222-.222c-.126 0-.226.1-.226.222s.1.222.226.222a.22.22 0 0 0 .222-.222z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Bridal Accessories')
                                    <i class="svgIcon svgIcon__categBride budget-categories-item-icon"><svg viewBox="0 0 49 54"><path d="M39 36.064a22.418 22.418 0 0 0-1.352-1.036 25.587 25.587 0 0 1-4.901 2.73c-7.223 2.846-15.282 1.765-21.485-2.655C5.857 38.972 2.337 45.147 2.022 52H39V36.064zm2 1.875V52h5.977c-.243-5.372-2.439-10.309-5.977-14.06zm-5.184-4.079a22.689 22.689 0 0 0-4.337-1.908l.61-1.904c2.53.81 4.861 2.003 6.932 3.503V18.516c0-2.794-.28-4.741-1.106-6.936-3.02-7.783-11.733-11.591-19.403-8.516-5.65 2.31-9.368 7.869-9.512 13.933v17.314a24.27 24.27 0 0 1 7.99-4.265l.597 1.908a22.277 22.277 0 0 0-4.5 1.974c5.56 3.65 12.594 4.464 18.904 1.978a23.682 23.682 0 0 0 3.825-2.046zM7 36.113v-19.14C7.163 10.102 11.36 3.83 17.761 1.21c8.712-3.493 18.596.827 22.022 9.656.925 2.457 1.238 4.634 1.238 7.65v16.651C45.974 39.62 49 46.013 49 53v1H0v-1c0-6.493 2.64-12.498 7-16.887zM7 36h2v17H7V36zm30.145-10.979l.263.287v.389c0 .761-1.565 2.934-3.386 4.516C31.303 32.576 27.906 34 23.87 34c-3.648 0-6.813-1.244-9.47-3.308a16.936 16.936 0 0 1-2.396-2.264c-.409-.47-.688-.845-.84-1.074l-.856-1.3 1.54-.238c6.87-1.06 13.593-4.51 18.398-11.389l1.668-2.387.15 2.908c.175 3.37 2.11 6.83 5.081 10.073zm-6.707-7.535c-4.592 5.602-10.488 8.719-16.593 10a15.06 15.06 0 0 0 1.782 1.627C17.954 30.92 20.701 32 23.87 32c3.523 0 6.467-1.234 8.84-3.296a13.837 13.837 0 0 0 2.138-2.327 9.97 9.97 0 0 0 .355-.526c-2.34-2.663-4.041-5.476-4.765-8.365z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat_title == 'Grooms accessories')
                                    <i class="svgIcon svgIcon__categGroom budget-categories-item-icon"><svg viewBox="0 0 49 54"><path d="M38.816 19.577c.145-.837.221-1.698.221-2.577 0-8.284-6.724-15-15.018-15C15.77 2 9.073 8.643 9 16.863c1.904.656 3.948.988 6.073.988 6.374 0 12.286-3.235 15.762-8.443l1.697-2.544.134 3.056a11.453 11.453 0 0 0 6.15 9.657zm-.488 1.991a13.47 13.47 0 0 1-7.319-9.08c-3.922 4.592-9.728 7.363-15.935 7.363a20.8 20.8 0 0 1-5.94-.845C10.113 26.34 16.405 32 24.017 32c6.7 0 12.375-4.381 14.31-10.432zM16.509 32.26C8.172 35.392 2.425 43.103 2.023 52h19.68l-.186-1.212-.012-.153V41.68l1.17-1.945-1.943-2.513 2.546-3.238a16.94 16.94 0 0 1-6.769-1.725zm-2.162-1.27C9.908 27.921 7 22.8 7 17 7 7.612 14.621 0 24.018 0c9.4 0 17.019 7.61 17.019 17 0 5.686-2.794 10.72-7.086 13.806C42.803 34.537 48.742 43.196 48.742 53v1H0v-1c0-9.627 5.736-18.133 14.347-22.01zM31.8 32.123a16.921 16.921 0 0 1-6.07 1.792l2.531 3.316-1.937 2.504 1.17 1.945v8.954l-.01.153-.187 1.212h19.422c-.409-9.065-6.356-16.911-14.919-19.876zm-8.073 19.876h1.546l.222-1.441v-8.322l-.995-1.654-.995 1.654v8.322l.222 1.441zm2.012-14.776l-1.214-1.59-1.257 1.599 1.232 1.592 1.239-1.601z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Honeymoon')
                                    <i class="svgIcon svgIcon__categPlane budget-categories-item-icon"><svg viewBox="0 0 54 54"><path d="M50.572 11.446a5.68 5.68 0 0 0-8.5-7.533L9.365 40.803a2.714 2.714 0 0 0 .002 3.601 2.713 2.713 0 0 0 3.832.231L50.087 11.93c.16-.143.34-.322.485-.484zm.846 1.977L14.525 46.132a4.713 4.713 0 0 1-6.655-.4 4.713 4.713 0 0 1 0-6.258L40.575 2.586a7.678 7.678 0 1 1 10.843 10.837zM40.211 31.775l3.213-3.215a3.505 3.505 0 1 1 4.957 4.957l-3.215 3.215a3.505 3.505 0 0 1-4.955-4.957zm1.414 3.542c.586.587 1.54.587 2.128 0l3.214-3.214a1.505 1.505 0 1 0-2.13-2.128l-3.212 3.214a1.505 1.505 0 0 0 0 2.128zM17.267 8.834l3.214-3.217a3.507 3.507 0 0 1 4.958 4.959l-3.215 3.214a3.505 3.505 0 0 1-4.957-4.956zm3.543 3.541l3.215-3.213a1.507 1.507 0 0 0-2.13-2.13l-3.213 3.216a1.505 1.505 0 0 0 2.128 2.127zm-1.218 34.82a.962.962 0 0 0 1.584-1.01l-2.272-5.728 1.859-.737 2.278 5.744a2.959 2.959 0 0 1-.676 3.143c-1.154 1.158-3.038 1.158-4.15.037l-.06-.056-3.675-3.674 1.415-1.415 3.664 3.665.033.031zM5.296 35.73a2.97 2.97 0 0 1 .095-4.098 2.95 2.95 0 0 1 3.15-.673l5.74 2.277-.738 1.86-5.726-2.273a.946.946 0 0 0-1.012.224c-.377.377-.377.987-.042 1.323.018.01.026.014.062.061l3.674 3.676-1.414 1.414L5.4 35.835l-.105-.105zm40.018 17.075l1.397-1.433-1.397 1.433-18.672-18.672 1.415-1.415 18.656 18.656a2.168 2.168 0 0 0 3.056-.01c.612-.61.794-1.519.489-2.308l-4.945-12.47-.145.145a3.503 3.503 0 0 1-4.957 0 3.505 3.505 0 0 1 0-4.957l2.287-2.287-2.918-7.359 1.86-.737 3.401 8.58-.464.466-2.752 2.75a1.505 1.505 0 1 0 2.13 2.13l2.295-2.297.561 1.415 5.51 13.892a4.168 4.168 0 0 1-6.816 4.467l.703-.71.707-.708-1.4 1.429zM32.611 12.56l-.737 1.86-7.972-3.163.737-1.859 7.972 3.162zM19.566 7.388l-.737 1.86L4.952 3.744a2.167 2.167 0 0 0-2.33 3.539L21.28 25.945l-1.414 1.414L1.205 8.694a4.168 4.168 0 0 1 .015-5.88 4.17 4.17 0 0 1 4.462-.932l13.884 5.506z" fill-rule="nonzero"></path></svg></i>
                                @elseif($cat['title'] == 'Other')
                                    <i class="svgIcon svgIcon__categMore budget-categories-item-icon"><svg viewBox="0 0 54 54"><path d="M54 27c0 14.912-12.088 27-27 27S0 41.912 0 27 12.088 0 27 0s27 12.088 27 27zm-2 0C52 13.192 40.808 2 27 2S2 13.192 2 27s11.192 25 25 25 25-11.192 25-25zm-32.182 0a3.416 3.416 0 11-6.832 0 3.416 3.416 0 016.832 0zm-2 0a1.416 1.416 0 10-2.832 0 1.416 1.416 0 002.832 0zm12.113 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0zm13.084 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0z" fill-rule="nonzero"></path></svg></i>
                                @endif 
                            {{$cat['title']}}</span>
                            <span class="budget-categories-item-amount app-category-estimated-row app-row-info fright  color-grey italic">
                                C$        <span class="app-budget-estimated-cost">{{$data['catBudget'][$cat['cat_id']] ?? 0}}</span>
                                    </span>
                          </a>
                        </div>
                        @endforeach
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-u-2-3 budget-detail cat_bud_detail_wrp">
            <div class="app-my-budget  app-budget-aside box budget-summary" data-section-active="summary">
                <h1 class="tools-title text-center pt40">My Budget</h1>
                <div class="pure-g border-bottom text-center">
                <div class="pure-u-1-3">
                    <div class="budget-balance app-modif-budget pointer">
                        <i class="icon-tools icon-tools-pig block mb20"></i>
                        <span class="tools-subtitle">Estimated budget</span>
                        <span class="budget-balance-amount">
                            C$                <span class="app-tools-budget-stats-estimado">{{number_format($data['total_budget']->total_estimate ?? 0)}}</span>
                                        </span>
                        <div class="budget-spending-item-cells">
                            <span class="icon-tools icon-left icon-tools-plus-circle-outline mr10 link pointer app-add-spending" onclick="Frontend.showAddEstimateBudgetPopup(this)" data-total-estimate="{{$data['total_budget']->total_estimate ?? 0}}"> Add Budget</span>
                        </div>
                                </div>
                </div>
                <div class="pure-u-1-3">
                    <div class="budget-balance border-left">
                        <i class="icon-tools icon-tools-pig block mb20"></i>
                        <span class="tools-subtitle">Current Spend</span>
                        <span class="budget-balance-amount">
                            C$                <span class="app-tools-budget-stats-estimado">{{$data['current_estimate'] ?? 0}}</span>
                                        </span>
                                    <ul>
                                        <li class="inline-block mr10">
                                        @if($data['total_budget']->total_estimate >= filter_var($data['total_estimate'], FILTER_SANITIZE_NUMBER_INT))
                                        <span class="strong mr5 text-green">Remaining Budget:</span>
                                        C$ <span class="app-total-paid">{{number_format(($data['total_budget']->total_estimate - filter_var($data['total_estimate'], FILTER_SANITIZE_NUMBER_INT)) ?? 0)}} </span>
                                        @else
                                         <span class="strong mr5 text-red">Extra Budget:</span>
                                        C$ <span class="app-total-paid">{{number_format((filter_var($data['total_estimate'], FILTER_SANITIZE_NUMBER_INT) - $data['total_budget']->total_estimate) ?? 0)}} </span>
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                </div>
                <div class="pure-u-1-3">
                    <div class="budget-balance border-left">
                        <i class="icon-tools icon-tools-price block mb20"></i>
                        <span class="tools-subtitle">Final budget</span>
                        <span class="app-tools-budget-final-cost-container budget-balance-amount budget-balance-amount-positive">
                            C$                <span class="app-tools-budget-stats-coste-final">{{$data['total_final_cost'] ?? 0}}</span>
                                        </span>
                        <ul>
                            <li class="inline-block mr10">
                                <span class="strong mr5">Paid:</span>
                                C$                    <span class="app-total-paid">{{$data['total_paid'] ?? 0}}</span>
                                                </li>
                            <li class="inline-block">
                                <span class="strong mr5">Pending:</span>
                                C$                    <span class="app-total-pending">{{$data['total_pending'] ?? 0}}</span>
                                                </li>
                        </ul>
                    </div>
                </div>
              </div>

               <!--  <p class="budget-chart-title">Breakdown of my wedding expenses</p>
                <div class="budget-stats-graph">
                    <div id="app-budget-donutchart" data-donut-rows="[[&quot;Category&quot;,&quot;Quantity&quot;,&quot;ID&quot;,&quot;Cost&quot;],[&quot;Ceremony&quot;,480,&quot;165&quot;,&quot;Estimated budget: &quot;],[&quot;Reception&quot;,15520,&quot;167&quot;,&quot;Estimated budget: &quot;],[&quot;Music&quot;,1600,&quot;173&quot;,&quot;Estimated budget: &quot;],[&quot;Invitations&quot;,1040,&quot;176&quot;,&quot;Estimated budget: &quot;],[&quot;Wedding Favours&quot;,320,&quot;179&quot;,&quot;Estimated budget: &quot;],[&quot;Flowers and Decoration&quot;,2192,&quot;182&quot;,&quot;Estimated budget: &quot;],[&quot;Photos and Video&quot;,3840,&quot;186&quot;,&quot;Estimated budget: &quot;],[&quot;Transport&quot;,640,&quot;189&quot;,&quot;Estimated budget: &quot;],[&quot;Jewellery&quot;,960,&quot;192&quot;,&quot;Estimated budget: &quot;],[&quot;Bride &amp; accessories&quot;,2240,&quot;196&quot;,&quot;Estimated budget: &quot;],[&quot;Groom &amp; accessories&quot;,288,&quot;202&quot;,&quot;Estimated budget: &quot;],[&quot;Health &amp; Beauty&quot;,480,&quot;207&quot;,&quot;Estimated budget: &quot;],[&quot;Honeymoon&quot;,2080,&quot;213&quot;,&quot;Estimated budget: &quot;],[&quot;Other&quot;,320,&quot;215&quot;,&quot;Estimated budget: &quot;]]"><div style="position: relative;"><div dir="ltr" style="position: relative; width: 798px; height: 300px;"><div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;"><svg width="798" height="300" aria-label="A chart." style="overflow: hidden;"><defs id="defs"></defs><rect x="0" y="0" width="798" height="300" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                    <g><path d="M399,105L399,59A92,92,0,0,1,407.65796482530334,59.40829925651664L403.32898241265167,105.20414962825832A46,46,0,0,0,399,105" stroke="#ffffff" stroke-width="1" fill="#9b59b6"></path></g><g><path d="M396.1116361016515,105.0907704922995L393.2232722033031,59.18154098459901A92,92,0,0,1,399,59L399,105A46,46,0,0,0,396.1116361016515,105.0907704922995" stroke="#ffffff" stroke-width="1" fill="#a8c686"></path></g>
                    <g><path d="M378.11643701198085,110.01369988733508L357.2328740239617,69.02739977467016A92,92,0,0,1,393.2232722033031,59.18154098459901L396.1116361016515,105.0907704922995A46,46,0,0,0,378.11643701198085,110.01369988733508" stroke="#ffffff" stroke-width="1" fill="#c097a0"></path></g><g>
                    <path d="M374.35196743096617,112.1609154269073L349.70393486193234,73.32183085381459A92,92,0,0,1,357.2328740239617,69.02739977467016L378.11643701198085,110.01369988733508A46,46,0,0,0,374.35196743096617,112.1609154269073" stroke="#ffffff" stroke-width="1" fill="#a63446"></path></g><g><path d="M372.19623793524545,113.6160684360777L345.39247587049096,76.2321368721554A92,92,0,0,1,349.70393486193234,73.32183085381459L374.35196743096617,112.1609154269073A46,46,0,0,0,372.19623793524545,113.6160684360777" stroke="#ffffff" stroke-width="1" fill="#93a8ac"></path></g><g><path d="M358.82992707874365,128.58649421663475L318.6598541574873,106.17298843326952A92,92,0,0,1,345.39247587049096,76.2321368721554L372.19623793524545,113.6160684360777A46,46,0,0,0,358.82992707874365,128.58649421663475" stroke="#ffffff" stroke-width="1" fill="#f1ecce"></path></g><g><path d="M355.34157733044646,136.51062009585596L311.6831546608929,122.02124019171193A92,92,0,0,1,318.65985415748736,106.17298843326941L358.8299270787437,128.58649421663472A46,46,0,0,0,355.34157733044646,136.51062009585596" stroke="#ffffff" stroke-width="1" fill="#98b9f2"></path></g><g>
                    <path d="M353.8698361976066,142.09672446966042L308.73967239521323,133.19344893932083A92,92,0,0,1,311.6831546608929,122.02124019171193L355.34157733044646,136.51062009585596A46,46,0,0,0,353.8698361976066,142.09672446966042" stroke="#ffffff" stroke-width="1" fill="#eab6ad"></path></g><g><path d="M360.0068149400862,175.40351447810977L321.01362988017235,199.80702895621954A92,92,0,0,1,308.73967239521323,133.19344893932083L353.8698361976066,142.09672446966042A46,46,0,0,0,360.0068149400862,175.40351447810977" stroke="#ffffff" stroke-width="1" fill="#00bfb2"></path></g><g><path d="M373.74495037208595,189.44713862294043L348.48990074417185,227.89427724588086A92,92,0,0,1,321.01362988017235,199.80702895621954L360.0068149400862,175.40351447810977A46,46,0,0,0,373.74495037208595,189.44713862294043" stroke="#ffffff" stroke-width="1" fill="#c64191"></path></g>
                    <g><path d="M376.20890125210923,190.95704966415678L353.4178025042185,230.9140993283136A92,92,0,0,1,348.48990074417185,227.89427724588086L373.74495037208595,189.44713862294043A46,46,0,0,0,376.20890125210923,190.95704966415678" stroke="#ffffff" stroke-width="1" fill="#face75"></path></g><g><path d="M384.7852182587524,194.74859974957707L370.5704365175048,238.49719949915414A92,92,0,0,1,353.4178025042185,230.9140993283136L376.20890125210923,190.95704966415678A46,46,0,0,0,384.7852182587524,194.74859974957707" stroke="#ffffff" stroke-width="1" fill="#e39695"></path></g>
                    <g><path d="M399,197L399,243A92,92,0,0,1,370.5704365175048,238.49719949915414L384.7852182587524,194.74859974957707A46,46,0,0,0,399,197" stroke="#ffffff" stroke-width="1" fill="#3498db"></path></g><g>
                    <path d="M403.32898241265167,105.20414962825832L407.65796482530334,59.40829925651664A92,92,0,0,1,399,243L399,197A46,46,0,0,0,403.32898241265167,105.20414962825832" stroke="#ffffff" stroke-width="1" fill="#e67e22"></path></g><g></g></svg><div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Category</th><th>Quantity</th><th>ID</th><th>Cost</th></tr></thead><tbody><tr><td>Ceremony</td><td>C$480</td><td>165</td><td>Estimated budget: </td></tr><tr><td>Reception</td><td>C$15,520</td><td>167</td><td>Estimated budget: </td></tr><tr><td>Music</td><td>C$1,600</td><td>173</td><td>Estimated budget: </td></tr><tr><td>Invitations</td><td>C$1,040</td><td>176</td><td>Estimated budget: </td></tr><tr><td>Wedding Favours</td><td>C$320</td><td>179</td><td>Estimated budget: </td></tr><tr><td>Flowers and Decoration</td><td>C$2,192</td><td>182</td><td>Estimated budget: </td></tr><tr><td>Photos and Video</td><td>C$3,840</td><td>186</td><td>Estimated budget: </td></tr><tr><td>Transport</td><td>C$640</td><td>189</td><td>Estimated budget: </td></tr><tr><td>Jewellery</td><td>C$960</td><td>192</td><td>Estimated budget: </td></tr><tr><td>Bride &amp; accessories</td><td>C$2,240</td><td>196</td><td>Estimated budget: </td></tr><tr><td>Groom &amp; accessories</td><td>C$288</td><td>202</td><td>Estimated budget: </td></tr><tr><td>Health &amp; Beauty</td><td>C$480</td><td>207</td><td>Estimated budget: </td></tr><tr><td>Honeymoon</td><td>C$2,080</td><td>213</td><td>Estimated budget: </td></tr><tr><td>Other</td><td>C$320</td><td>215</td><td>Estimated budget: </td></tr></tbody></table></div></div></div><div aria-hidden="true" style="display: none; position: absolute; top: 310px; left: 808px; white-space: nowrap; font-family: Arial; font-size: 13px;"></div><div></div></div></div>
                </div>
                <div id="app-budget-donutchart-legend"><div class="app-legend-table budget-legend-table pure-g"><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="165"><p><span style="background-color: #9b59b6"></span>Ceremony</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="167"><p><span style="background-color: #e67e22"></span>Reception</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="173"><p><span style="background-color: #3498db"></span>Music</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="176"><p><span style="background-color: #E39695"></span>Invitations</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="179"><p><span style="background-color: #FACE75"></span>Wedding Favours</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="182"><p><span style="background-color: #C64191"></span>Flowers and Decoration</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="186"><p><span style="background-color: #00BFB2"></span>Photos and Video</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="189"><p><span style="background-color: #EAB6AD"></span>Transport</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="192"><p><span style="background-color: #98B9F2"></span>Jewellery</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="196"><p><span style="background-color: #F1ECCE"></span>Bride &amp; accessories</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="202"><p><span style="background-color: #93A8AC"></span>Groom &amp; accessories</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="207"><p><span style="background-color: #A63446"></span>Health &amp; Beauty</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="213"><p><span style="background-color: #C097A0"></span>Honeymoon</p></div><div class="pure-u-1-2 app-set-category-active pointer link-hover" data-chart-category-id="215"><p><span style="background-color: #A8C686"></span>Other</p></div></div></div>
           -->
            </div>

   </div>
  </div>
</div>
</section>
  @include('includes.add_estimate_budget_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection