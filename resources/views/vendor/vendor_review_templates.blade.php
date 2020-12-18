@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<style>
.adminNotEmpty {
    border: 1px solid #d9d9d9;
    border-radius: 3px;
    background: #fff;
    margin-bottom: 30px;
    margin-right: 30px;
    padding: 50px 10px;
}
.admin-sol-template {
    margin-bottom: 5px !important;
}
.reviewCollector__defaultText--outline {
    position: relative;
    z-index: 3;
    background: 0 0;
    color: #eac448;
    border-color: #eac448;
    border-style: solid;
    border-width: 1px;
    padding: 5px 10px;
    text-transform: uppercase;
    transition: all .2s linear;
    font-size: 10px !important;
    border-radius: 5px;
    top: -6px;
    margin-left: 15px;
}
</style>
<section class="section-padding dashboard-wrap dash_main_sect">
@include('vendor.tools_nav')
	<div class="wrapper">
		<div class="pure-g">
			<div class="pure-u-2-7">
				<div class="mr40">
					<nav class="adminAside">
						<a class="adminAside__item " href="{{url('reviews')}}">
							<i class="svgIcon svgIcon__gear adminAside__icon">
								<svg viewBox="0 0 18 20">
									<path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
								</svg>
							</i> REVIEW REQUEST
						</a>
						<a class="adminAside__item " href="{{url('/reviews-list')}}">
							<i class="svgIcon svgIcon__note adminAside__icon">
								<svg viewBox="0 0 18 19">
									<path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
								</svg>
							</i> REVIEWS
						</a>
						<a class="adminAside__item " href="{{url('/reviews-sellos')}}">
							<i class="svgIcon svgIcon__seals adminAside__icon">
								<svg viewBox="0 0 19 18">
									<path d="M17.488 16.895h-.067c-.006.021.02.014.078.006l-.01-.006zm-.218 0V1h-16v15.895h16zm.33 1H.653c-.192 0-.383-.19-.383-.476V.476C.27.286.461 0 .749 0H17.79c.192 0 .479.19.479.476v16.943c-.191.285-.383.476-.67.476zm-2.007-7.03a.5.5 0 0 1-.393.809h-12a.5.5 0 0 1-.393-.81l1.33-1.69-1.33-1.691a.5.5 0 0 1 .393-.81h12a.5.5 0 0 1 .393.81l-1.33 1.69 1.33 1.692zm-2.358-1.382a.5.5 0 0 1 0-.618l.936-1.191H4.229l.936 1.19a.5.5 0 0 1 0 .619l-.936 1.19h9.942l-.936-1.19z" fill-rule="nonzero"></path>
								</svg>
							</i> MHS ALL STAR TEAM™
						</a>
						<a class="adminAside__item " href="{{url('/reviews-widget')}}">
							<i class="svgIcon svgIcon__gear adminAside__icon">
								<svg viewBox="0 0 18 20">
									<path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
								</svg>
							</i> REVIEWS WIDGET
						</a>
					</nav>
				</div>
			</div>
			<div class="pure-u-5-7 review_template_wrp">
				<div class="pb10">
					<a class="color-grey" href="{{url('/reviews')}}">
						<i class="icon-header icon-header-arrow-left icon-left"></i>
						<span>Back to Review Collector</span>
					</a>
				</div>
				<h1 class="adminTitle">Manage review request templates</h1>
				<div class="adminAlert">
					<span>Create and edit message templates to quickly and easily request reviews from your client.</span>            
				</div>
				@if(count($data['templates']) > 0)
					@foreach($data['templates'] as $tmp)
					<ul class="admin-sol-template">
					    <li class="admin-sol-template-item">
					        <div class="admin-sol-template-item-content app-review-collector-templates-parent">
					            <div class="admin-sol-template-item-info">
					                <a class="admin-sol-template-item-link" onclick="getEditForm('{{$tmp->id}}');" title="Edit">{{ $tmp->name }}</a>
					                <time class="admin-sol-template-item-date">{{ date_format(date_create($tmp->created_at),'d/m/Y') }}</time>
					            </div>
					            @if($tmp->status == 1)
					            	<span class="reviewCollector__defaultText--outline"> Default </span>
					            @endif
					            <div class="admin-sol-template-item-edit">
					                <a role="button" class="btnOutline btnOutline--primary app-review-collector-template-edit-button mt0" onclick="getEditForm('{{$tmp->id}}');"> Edit </a>
					            </div>
					        </div>
					        <div class="app-review-collector-template-content admin-sol-template-item-form" id="editForm{{$tmp->id}}" style="display:none;">
								
					        </div>
					    </li>
					</ul>
					@endforeach
					<a role="button" class="app-review-collector-template-new btnFlat btnFlat--primary add_rev_temp">Add template</a>
				@else
					<div class="adminEmpty">
						<i class="adminEmpty__icon adminEmpty__icon--template"></i>
						<p class="adminEmpty__description">You haven't added any templates</p>
						<a role="button" class="app-review-collector-template-new btnFlat btnFlat--primary add_rev_temp">Add template</a>
					</div>
				@endif
				<div class="mt20 review_templ_frm" id="app-review-collector-template-new" style="display: none;">
					<div class="adminBox">
						<form class="pure-form app-review-collector-templates-create-form" action="javascript:;" id="addTemplateForm" method="post">
							<div class="pure-g">
								<div class="pure-u-1">
									<div class="mb15 pure-control-group">
										<label class="adminFormLabel">Template Name</label>
										<input size="45" maxlength="100" type="text" name="name" id="name">
									</div>
									<p class="color-grey">Hi [Name],</p>
									<div class="mb15 pure-control-group">
										<textarea class="mt5" rows="10" style="height: 300px;width:100%;" name="message" id="message"></textarea>
									</div>
									<input class="btnFlat btnFlat--primary mr10 add_rev_template_btn" type="submit" value="Add template">
									<input class="btnOutline btnOutline--primary app-review-collector-template-cancel cancel_btn" type="button" value="Cancel">
									<span class="ml10 satasdefaultcls">
										<div class="icheckbox_minimal" style="position: relative;">
											<input type="checkbox" id="SetAsDefault" name="setAsDefault" class="app-set-as-default reviewCollector__setAsDefault" style="opacity: 0;">
										</div>
										<label for="SetAsDefault">Set as default</label>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('includes.footer')
<script type="text/javascript">
$(document).ready(function(){
	$('.add_rev_temp').click(function() {
		$('.review_templ_frm').show();
		$('.app-review-collector-template-content').hide();
	});

	$('.review_templ_frm .cancel_btn').click(function() {
		$('.review_templ_frm').hide();
	});

	$(".add_rev_template_btn").click(function() {
		var name = $("#name").val();
		var message = $("#message").val();
		if(name != '' && message != '') {
			$.ajax({
                url: "{{ url('addTemplate') }}",
                type: "POST",
                data: $("#addTemplateForm").serialize(),
                success: function (response) {
                    if(response == 'done') {
                    	location.reload();
                    }
                }
            });
		} else {
			if(name == '') {
				$(this).parents('form').find('#name').focus();
			} else
			if(message == '') {
				$(this).parents('form').find('#message').focus();
			}
		}
	});

	$('body').on('click', '.satasdefaultcls', function() {
		if(!$('#SetAsDefault').is(":checked")) {
			$(this).find('.icheckbox_minimal').addClass('checked');
			$('#SetAsDefault').prop('checked', true);
		} else {
			$(this).find('.icheckbox_minimal').removeClass('checked');
			$('#SetAsDefault').prop('checked', false);
		}
	});
});

function getEditForm(id)
{
	$('.review_templ_frm').hide();
	$('.app-review-collector-template-content').hide();
	if(id) {
		$.ajax({
            url: "{{ url('editTemplate') }}/"+id,
            type: "GET",
            data: '',
            success: function (response) {
				$('#editForm'+id).show();
				$('#editForm'+id).html(response);
            }
        });
	}
}

$("body").on('click', '#editTemplateForm .cancel_btn', function() {
	$('.app-review-collector-template-content').hide();
});

$("body").on('click', '.update_rev_template_btn', function() {
	var name = $("input[name=name]").val();
	var message = $("textarea[name=message]").val();
	if(name != '' && message != '') {
		$.ajax({
            url: "{{ url('editTemplateSave') }}",
            type: "POST",
            data: $("#editTemplateForm").serialize(),
            success: function (response) {
                if(response == 'done') {
                	location.reload();
                }
            }
        });
	} else {
		if(name == '') {
			$(this).parents('form').find('input[name=name]').focus();
		} else
		if(message == '') {
			$(this).parents('form').find('textarea[name=message]').focus();
		}
	}
});
</script>
@endsection