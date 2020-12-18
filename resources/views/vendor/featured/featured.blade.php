@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap bills_page_wrp dash_main_sect">
	@include('vendor.tools_nav')
	<div class="wrapper">
		<div class="pure-g">
			<div class="pure-u-2-7">
				<div class="mr40">
					<nav class="adminAside bills_list">
						<a class="adminAside__item " href="{{url('invoices')}}">
							<i class="svgIcon svgIcon__bill adminAside__icon">
								<svg viewBox="0 0 16 20">
									<path d="M14.196 5.729L9.64 1.8H1.804v16.4h12.392V5.729zm.5 13.471H1.304a.5.5 0 0 1-.5-.5V1.3a.5.5 0 0 1 .5-.5h8.522a.5.5 0 0 1 .327.121l4.87 4.2a.5.5 0 0 1 .173.379v13.2a.5.5 0 0 1-.5.5zM10.326 5h4.37a.5.5 0 0 1 0 1h-4.87a.5.5 0 0 1-.5-.5V1.3a.5.5 0 1 1 1 0V5zM3.24 17.4V6.8h9.522v10.6H3.239zm8.522-1V7.8H4.239v8.6h7.522zm-8.022-6.2a.5.5 0 0 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm0 2.4a.5.5 0 1 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm0 2.4a.5.5 0 1 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm2.544-7.7a.5.5 0 1 1 1 0v9.6a.5.5 0 1 1-1 0V7.3z" fill-rule="nonzero"></path>
								</svg>
							</i> Invoices <span class="adminAside__counter">{{ count($data['vendorInvc']) }}</span>
						</a>
						<a class="adminAside__item " href="{{url('bills')}}">
							<i class="svgIcon svgIcon__receipt adminAside__icon">
								<svg viewBox="0 0 16 22">
									<path d="M3.015 19.722l-1.328 1.327a.5.5 0 0 1-.854-.354V1.362a.5.5 0 0 1 .85-.357l1.314 1.29L4.313.98a.5.5 0 0 1 .707 0l1.313 1.313L7.646.98a.5.5 0 0 1 .708 0l1.313 1.313L10.98.98a.5.5 0 0 1 .707 0l1.316 1.316 1.313-1.29a.5.5 0 0 1 .85.356v19.333a.5.5 0 0 1-.856.35l-1.313-1.335-1.31 1.31a.5.5 0 0 1-.707 0l-1.313-1.313-1.313 1.313a.5.5 0 0 1-.71-.003L6.367 19.72l-1.354 1.307a.5.5 0 0 1-.7-.006l-1.3-1.298zM2.66 18.66a.5.5 0 0 1 .707 0l1.305 1.305 1.356-1.31a.5.5 0 0 1 .704.008l1.27 1.292 1.31-1.31a.5.5 0 0 1 .707 0l1.313 1.314 1.313-1.314a.5.5 0 0 1 .71.003l.81.825V2.554l-.816.803a.5.5 0 0 1-.704-.003L11.333 2.04 10.02 3.354a.5.5 0 0 1-.707 0L8 2.04 6.687 3.354a.5.5 0 0 1-.707 0L4.667 2.04 3.354 3.354a.5.5 0 0 1-.704.003l-.817-.803V19.49l.828-.828zM3.855 7.167a.5.5 0 0 1 0-1h5.043a.5.5 0 1 1 0 1H3.855zm0 2.666a.5.5 0 1 1 0-1h3.362a.5.5 0 1 1 0 1H3.855zm0 2.667a.5.5 0 1 1 0-1h4.203a.5.5 0 1 1 0 1H3.855zm0 2.667a.5.5 0 0 1 0-1h2.522a.5.5 0 1 1 0 1H3.855zm7.565-8a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.666a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.667a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.667a.5.5 0 0 1 0-1h.84a.5.5 0 1 1 0 1h-.84z" fill-rule="nonzero"></path>
								</svg>
							</i> Bills <span class="adminAside__counter">{{ count($data['vendorBill']) }}</span>
						</a>
						<a class="adminAside__item active" href="{{url('featured')}}">
							<i class="svgIcon svgIcon__receipt adminAside__icon">
								<svg viewBox="0 0 512 512" ><g><path d="m512 414.25v-395h-512v395h191v33.5c0 8.271-6.729 15-15 15h-61v30h282v-30h-61c-8.271 0-15-6.729-15-15v-33.5zm-30-365v275h-452v-275zm-452 335v-30h452v30zm263.57 78.5h-75.14c1.664-4.693 2.57-9.743 2.57-15v-33.5h70v33.5c0 5.257.906 10.307 2.57 15z"/><path d="m237.584 134.811h-20.183c1.267-4.038 1.951-8.33 1.951-12.78 0-23.589-19.191-42.78-42.78-42.78-10.597 0-20.299 3.882-27.78 10.287-7.481-6.405-17.183-10.287-27.78-10.287-23.589 0-42.78 19.191-42.78 42.78 0 4.45.685 8.743 1.951 12.78h-20.183v159.439h177.584zm-61.012-25.561c7.047 0 12.78 5.733 12.78 12.78s-5.733 12.78-12.78 12.78h-12.78v-12.78c0-7.047 5.733-12.78 12.78-12.78zm-68.341 12.78c0-7.047 5.733-12.78 12.78-12.78s12.78 5.733 12.78 12.78v12.78h-12.78c-7.046.001-12.78-5.733-12.78-12.78zm-18.231 42.781h43.792v99.439h-43.792zm117.584 99.439h-43.792v-99.439h43.792z"/><path d="m312.326 234.647 52.725-27.719 52.724 27.719-10.069-58.709 42.656-41.578-58.949-8.565-26.361-53.416-26.362 53.416-58.947 8.565 42.654 41.578zm46.284-81.432 6.44-13.049 6.439 13.049 14.4 2.093-10.42 10.156 2.46 14.344-12.88-6.771-12.881 6.771 2.46-14.344-10.42-10.156z"/><path d="m278.102 264.25h173.898v30h-173.898z"/></g></svg>
							</i> Upgrade to Featured <!--<span class="adminAside__counter"></span>-->
						</a>
						<!-- <a class="adminAside__item " href="{{url('payment-method')}}">
							<i class="svgIcon svgIcon__card adminAside__icon">
								<svg viewBox="0 0 22 18">
									<path d="M7.605 7.964c-.159.335-.346.67-.562.985-.654.956-1.437 1.551-2.376 1.551a.5.5 0 1 1 0-1c.532 0 1.064-.405 1.551-1.116a6.268 6.268 0 0 0 .646-1.224.5.5 0 0 1 .47-.327H9c.669 0 1.167-.364 1.167-.833v-.667c0-.461-.513-.833-1.167-.833H6.333c-2.514 0-4.5 1.568-4.5 5.167v2.666c0 2.046 1.788 3.834 3.834 3.834H12a.5.5 0 1 1 0 1H5.667c-2.598 0-4.834-2.236-4.834-4.834V9.667c0-4.21 2.479-6.167 5.5-6.167H9c1.15 0 2.167.738 2.167 1.833V6c0 1.1-1.001 1.833-2.167 1.833H7.666a8.194 8.194 0 0 1-.061.131zm2.062 3.87a.5.5 0 1 1 0-1h5.666c.972 0 1.834.86 1.834 1.833 0 .972-.862 1.833-1.834 1.833H12a.5.5 0 1 1 0-1h3.333c.42 0 .834-.413.834-.833s-.414-.834-.834-.834H9.667zm10.5-6.667h-9.712a.5.5 0 0 1 0-1h9.712v-1.5c0-.42-.414-.834-.834-.834H7.174c-.43 0-.674.235-.674.645V4a.5.5 0 0 1-1 0V2.478c0-.97.699-1.645 1.674-1.645h12.16c.971 0 1.833.862 1.833 1.834V10c0 .972-.862 1.833-1.834 1.833h-12c-.972 0-1.833-.86-1.833-1.833v-.591a.5.5 0 1 1 1 0V10c0 .42.413.833.833.833h12c.42 0 .834-.413.834-.833V5.167zM9.667 14.5a.5.5 0 1 1 0-1h2.217c.965 0 1.616.835 1.616 1.833s-.651 1.834-1.616 1.834h-1.217a.5.5 0 0 1 0-1h1.217c.35 0 .616-.341.616-.834 0-.492-.266-.833-.616-.833H9.667zm9-8.333a.5.5 0 0 1 0 1H16a.5.5 0 1 1 0-1h2.667z" fill-rule="nonzero"></path>
								</svg>
							</i> Payment methods <span class="adminAside__counter">{{ count($data['vendorPaym']) }}</span>
						</a> -->
					</nav>
				</div>
			</div>
		    <div class="pure-u-5-7 bills_wrp">
		        <div class="pure-g-r-- row mt20-- pb20--">
		        @foreach($featured as $feature)
	            <div class="col-sm-4 mb20-- featured">
	               <div class="box adminBadgeItem">
	                  <div class="adminBadgeItem__content">
	                     <div class="award award--center award--large award--rounded award--grey">
	                         <h1>{{$feature->weeks}}</h1> 
	                     </div>
	                     <p class="adminBadgeItem__title text-center">Weeks</p>
	                     <h2>${{$feature->amount}}/- Only</h2>
	                     <!--<p class="adminBadgeItem__text">Get 25 more reviews to earn the Silver MHS AllStar Team status.</p>-->
	                  </div>
	                  <div class="adminBadgeItem__footer">
	                      <form action="{{url()->current()}}" method="POST">
	                          @csrf
	                          <input type="hidden" value="{{$feature->id}}" name="feature">
	                          <button type="submit" class="featured-pay-button">Pay</button>
	                      </form>
	                  </div>
	               </div>
	            </div>
	            @endforeach
	         </div>
			</div>
	   </div>
	</div>
</section>
@include('includes.footer')
@endsection