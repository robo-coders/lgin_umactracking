<!DOCTYPE html>
<html>
<head>
	<title> {{ config('app.name') }} </title>
@yield('head')
	<meta charset="utf-8" />
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Fonts -->

	<!--begin:: Global Mandatory Vendors -->
	<link href="{{asset('/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
	<!--end:: Global Mandatory Vendors -->
@yield('css')
	<!--begin:: Global Optional Vendors -->
	<link href="{{asset('/assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

	<!--end:: Global Optional Vendors -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{asset('/assets/css/demo3/style.bundle.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

	<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{ route('redirectUser') }}">
					<img alt="UmacTracking Logo" src="{{asset('/assets/media/logos/logo-small.png')}}" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="{{ route('redirectUser') }}">
								<img src="{{asset('/assets/media/logos/logo-small.png')}}" alt="UmacTracking Logo"/>
							</a>
						</div>
					</div>

					<!-- end:: Aside -->
					
					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
							<ul class="kt-menu__nav ">
							@hasanyrole('super admin|admin')
								<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers-1"></i><span class="kt-menu__link-text">Actions</span></a>
										<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
											<ul class="kt-menu__subnav">
													<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('registerationByAdmin') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Create New User</span></a>
													</li>
												
											</ul>
										</div>
									</li>
								@endrole
								@hasanyrole('super admin|admin')
									<li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('usersList') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-group"></i><span class="kt-menu__link-text">Users</span></a></li>
								@endrole
									<!-- begin:: Aside Menu -->
								<!-- end:: Aside Menu -->
								
							</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->
				</div>

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin: Header Menu -->
						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
								<ul class="kt-menu__nav ">
									<li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{ url('/index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Tracking</span></a></li>
								</ul>
								<ul class="kt-menu__nav ">
									<li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{ route('redirectUser') }}" class="kt-menu__link "><span class="kt-menu__link-text">Dashboard</span></a></li>
								</ul>
							</div>
						</div>

						<!-- end: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">
							<!--begin: Notifications -->
							<div class="kt-header__topbar-item dropdown">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
									<span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
									{{-- <span class="kt-hidden kt-badge kt-badge--dot kt-badge--notify kt-badge--sm">66</span> --}}
									@if (Auth()->user()->unReadNotifications->count())
										<span style="
											position:absolute;
											top: 21px;
											right: 2px;
											width: 18px;
											background:red;
											color: white;
											font-size: 12px;
											text-align: center;
											border-radius: 50%;
											padding: 0px 2px;
											cursor: pointer;
										">
											{{Auth()->user()->unReadNotifications->count()}}
										</span>
									@endif
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
									<form>

										<!--begin: Head -->
										<div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
											<h3 class="kt-head__title">
												User Notifications
												&nbsp;
											</h3>
											<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
												<li class="nav-item">
													<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#topbar_notifications_readNotifications" role="tab" aria-selected="false">Notifications</a>
												</li>
											</ul>
										</div>

										<!--end: Head -->
										<div class="tab-content">
											<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
												<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
													@foreach (Auth()->user()->unReadNotifications as $notification)
														<a href="{{ route('requestorMarkAsRead', ['id'=>$notification->id]) }}" class="kt-notification__item">
															<div class="kt-notification__item-icon">
																<i class="flaticon2-image-file kt-font-warning"></i>
															</div>
															<div class="kt-notification__item-details">
																<div class="kt-notification__item-title">
																	{{$notification->data['data']}}
																</div>
																<div class="kt-notification__item-time">
																	{{$notification->created_at->diffforhumans()}}

																</div>
															</div>
														</a>
													@endforeach
												</div>
											</div>
											<div class="tab-pane" id="topbar_notifications_readNotifications" role="tabpanel">
												<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
													{{-- Read notifications	 --}}
													@foreach (Auth()->user()->readNotifications as $notification)
														<a href="" class="kt-notification__item">
															<div class="kt-notification__item-icon">
																<i class="flaticon2-image-file kt-font-warning"></i>
															</div>
															<div class="kt-notification__item-details">
																<div class="kt-notification__item-title">
																	{{$notification->data['data']}}
																</div>
																<div class="kt-notification__item-time">
																	{{$notification->created_at->diffforhumans()}}
																</div>
															</div>
														</a>
													@endforeach
												</div>
											</div>
										
										</div>
									</form>
								</div>
							</div>
							<!--begin: Cart -->
						

						<!--begin: User Bar -->
						<div class="kt-header__topbar-item kt-header__topbar-item--user">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
								<div class="kt-header__topbar-user">
									<span class="kt-hidden kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
									<span class="kt-hidden kt-header__topbar-username kt-hidden-mobile">Sean</span>
									<img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />
									<?php
									$data =auth::user()->name[0] ?>
									<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
									<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">
                                        {{strtoupper($data)}}
									</span>
								</div>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

								<!--begin: Head -->
								<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{asset('/assets/media/misc/bg-1.jpg')}}">
									<div class="kt-user-card__avatar">
										<img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
											{{strtoupper($data)}}
										</span>
									</div>
									<div class="kt-user-card__name">
										{{auth::user()->name}}
									</div>
									@if (Auth()->user()->unReadNotifications->count())
										<div class="kt-user-card__badge">
											<span class="btn btn-success btn-sm btn-bold btn-font-md">
												{{Auth()->user()->unReadNotifications->count()}} Unread Notification
											</span>
										</div>
									@endif
									
								</div>

								<!--end: Head -->

								<!--begin: Navigation -->
								<div class="kt-notification">
									<a href="{{ route('myAccount', ['id'=>Auth::user()->id]) }}" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-calendar-3 kt-font-success"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Profile
											</div>
											<div class="kt-notification__item-time">
												Account settings and more
											</div>
										</div>
									</a>
									<div class="kt-notification__custom kt-space-between">
										<a href="{{ route('logout') }}" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
											 {{ __('Sign Out') }}
										 </a>
										 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</div>
								</div>

								<!--end: Navigation -->
							</div>
						</div>

						<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
						<!-- begin:: Content -->

						<!-- begin:: Content -->
						{{-- <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content"> --}}
{{-- 						</div>

						end:: Content
 --}}
						<!-- end:: Content -->
					</div>
@yield('body')

					<!-- begin:: Footer -->
					<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-footer__copyright">
							2021&nbsp;&copy;&nbsp;<a href="#" target="_blank" class="kt-link"><b>{{ config('app.name') }} </b></a> &nbsp;&nbsp; </a>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->
	<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#2c77f4",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->
@yield('page_scripts')
		<!--begin:: Global Mandatory Vendors -->
		<script src="{{asset('/assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
		{{-- <script src="{{asset('/assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script> --}}

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		{{-- <script src="{{asset('/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script> --}}
		{{-- <script src="{{asset('/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script> --}}
		{{-- <script src="{{asset('/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script> --}}
		{{-- <script src="{{asset('/assets/vendors/custom/js/vendors/bootstrap-notify.init.js')}}" type="text/javascript"></script> --}}
		{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script> --}}
		{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
		{{-- Swal notification --}}
		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{asset('/assets/js/demo3/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		{{-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> --}}
		{{-- <script src="{{asset('/assets/vendors/custom/gmaps/gmaps.js')}}" type="text/javascript"></script> --}}
		{{-- <script src="{{asset('/assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script> --}}
		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{asset('/assets/js/demo3/pages/dashboard.js')}}" type="text/javascript"></script>
		

		<!--end::Page Scripts -->
{{-- start delete modal --}}
<script>
 $('#deleteUserByAdmin').on('show.bs.modal', function (event) {
 	console.log("modal code called");
      var button = $(event.relatedTarget) 
      var dell_id = button.data('dell_id') ;

      console.log(dell_id);
      //second part
      var modal = $(this);
      console.log(modal.find('.modal-body #dell_id'));
      modal.find('.modal-body #dell_id').val(dell_id);
}) 
$('#requestDeleteByRequestor').on('show.bs.modal', function (event) {
 	console.log("modal code called");
      var button = $(event.relatedTarget) 
      var dell_id = button.data('dell_id') ;

      console.log(dell_id);
      //second part
      var modal = $(this);
      console.log(modal.find('.modal-body #dell_id'));
      modal.find('.modal-body #dell_id').val(dell_id);
}) 
$('#delete_by_company').on('show.bs.modal', function (event) {
 	console.log("modal code called");
      var button = $(event.relatedTarget) 
      var dell_id = button.data('dell_id') ;

      console.log(dell_id);
      //second part
      var modal = $(this);
      console.log(modal.find('.modal-body #dell_id'));
      modal.find('.modal-body #dell_id').val(dell_id);
}) 
// $(document).ready(function(){
// 	$('.datepicker').datepicker();
// }); 	
</script>

@yield("after-js")
</body>
</html>