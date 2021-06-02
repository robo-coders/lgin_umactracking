@extends('parent.admin')
@section('body')
@if (session()->has('message'))
<div class="alert alert-success" role="alert">
   <div class="alert-text"> {{session()->get('message')}}</div>
</div>
@endif
@if (session()->has('update'))
<div class="alert alert-success" role="alert">
   <div class="alert-text"> {{session()->get('update')}}</div>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger" role="alert">
   <div class="alert-text"> {{session()->get('delete')}}</div>
</div>
@endif	
@role('super admin')
	{{-- Admin Dashboard Graph Starts --}}
	<!-- begin:: Content -->
	
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

		<!--Begin::Dashboard 1-->

		<!--Begin::Section-->
		<div class="row">
			
			<div class="col-xl-12">

				<!--begin:: Widgets/New Users-->
				<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								New Users
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="kt_widget4_tab1_content">
								<div class="kt-widget4">
									@foreach ($new_users as $user)
										<div class="kt-widget4__item">
											<div class="kt-widget4__pic kt-widget4__pic--pic">
												@foreach ($user->infos as $info)
													@if(isset($info->avatar))
														<img src="{{ url($info->avatar) }}" alt="{{$user->name}}">
													@else
														<img src="{{asset('/extras/dummy.png')}}" alt="{{$user->name}}">
													@endif
												@endforeach
											</div>
											<div class="kt-widget4__info">
												<a href="#" class="kt-widget4__username">
													{{$user->name}}
													@foreach ($user->infos as $info)
														{{$info->last_name}}
													@endforeach
												</a>
												<p class="kt-widget4__text">
													@if($user->role == '2')
														Admin
													@elseif($user->role == '3')	
														Customer
													@else
														N/A
													@endif	
												</p>
											</div>
										</div>
									@endforeach
								</div>
							</div>
							
						</div>
					</div>
				</div>

				<!--end:: Widgets/New Users-->
			</div>
		</div>

		<!--End::Section-->
		<!--End::Dashboard 1-->
	</div>

	<!-- end:: Content -->
{{-- Admin Dashboard Graph Ends --}}

@endrole

@endsection