@extends('parent.admin')
@section('css')
<link href="{{asset('/assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
@endsection
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
@if (count($errors) > 0 )
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
				<div class="danger"> 
					<li> {{$error}}  </li>
				</div>
			@endforeach
		</ul>
	</div>
@endif		
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Portlet-->
         <div class="kt-portlet">
            <div class="kt-portlet__head">
               <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">
                     Create a Request
                  </h3>
               </div>
            </div>
            <div class="kt-portlet__body">
               <!--begin::Section-->
               <div class="kt-section">
                  <div class="kt-section__content">
                     {{-- body goes here --}}
                     	<!--begin::Form-->
		<form class="kt-form kt-form--fit kt-form--label-right" action="{{ route('createRequest') }}" method="post">
			@csrf
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label class="col-form-label col-lg-2 col-sm-12">Machine Description :</label>
					<div class="col-lg-3 col-md-9 col-sm-12">
						{{-- <textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="course_description"></textarea>
						<span class="form-text text-muted">Max length for machine description is 220.</span> --}}
						<input type="text" name="machine_description" value="{{old('machine_description')}}" class="form-control" placeholder="">
					</div>
					<label class="col-lg-2 col-form-label">Machine :</label>
					<div class="col-lg-3">
						<select class="form-control kt-select2 kt_select2_1 selectParentCategory" name="brp">
							<option value="">Select Machine</option>
							@foreach ($machines as $machine)
								<option value="{{$machine->id}}"> {{$machine->name}} </option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Manufacturer :</label>
					<div class="col-lg-3">
						<select class="form-control kt-select2 kt_select2_1 selectParentCategory" name="brp">
							<option value="">Select Manufacturer</option>
							@foreach ($manufacturers as $manufacturer)
								<option value="{{$manufacturer->id}}"> {{$manufacturer->name}} </option>
							@endforeach
						</select>
					</div>
					<label class="col-lg-2 col-form-label">BRS# :</label>
					<div class="col-lg-3">
						<select class="form-control kt-select2 kt_select2_1 selectParentCategory" name="brp">
							<option value="">Select BRS</option>
							@foreach ($areas as $area)
								<option value="{{$area->id}}"> {{$area->brs}} </option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Cost Center & Line :</label>
					<div class="col-lg-3">
						<input type="text" name="cost_center_line" value="{{old('cost_center_line')}}" class="form-control" placeholder="">
					</div>
					<label class="col-lg-2 col-form-label">Supervisor Name :</label>
					<div class="col-lg-3">
						<input type="text" name="supervisor_name" value="{{old('supervisor_name')}}" class="form-control" placeholder="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Description of the Problem :</label>
					<div class="col-lg-3">
					<textarea class="form-control" id="kt_maxlength_5" name="description_of_problem" value="{{old('description_of_problem')}}" maxlength="220" placeholder="" rows="3">
						</textarea>
						<span class="form-text text-muted">Max length is 220.</span>
					</div>
					<label class="col-lg-2 col-form-label">Priority Level :</label>
					<div class="col-lg-3">
						<div class="kt-radio-inline">
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="priority_level" checked value="1"> Normal
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="priority_level" value="2"> High
								<span></span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__foot kt-portlet__foot--fit-x">
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-10">
							<button type="submit" class="btn btn-success">Generate</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!--end::Form-->
               </div>
            </div>
            <!--end::Section-->
         </div>
      </div>
      <!--end::Portlet-->
   </div>
</div>
</div>
<!--End::Section-->
@endsection
@section('after-js')
	<script src="{{asset('/assets/js/demo1/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
@endsection