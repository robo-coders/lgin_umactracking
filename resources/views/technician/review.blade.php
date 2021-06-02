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
      <!--Begin:: Portlet-->
        <!--begin:: View Ticket-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @foreach ($tickets as $ticket)
							{{$ticket->request_id}}
						@endforeach
                    </h3>
				</div>
				<div class="kt-portlet__head-label">
					<a href="{{ url('/technician/tasks') }}" class="btn btn-info pull-right">Back</a>
				</div>
            </div>
            <div class="kt-portlet__body">
              <!--begin::Form-->
		<form class="kt-form kt-form--fit kt-form--label-right" action="{{ route('reviewFromTechnician') }}" method="post">
			@csrf
			<div class="kt-portlet__body">
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Category</label>
					<div class="col-lg-3">
						<select class="form-control kt-select2 kt_select2_1 selectParentCategory"  name="category">
							<option value="">Select Category</option>
							@foreach ($categories as $category)
								<option value="{{$category->id}}"> {{$category->category}} </option>
							@endforeach
						</select>
					</div>
					<label class="col-lg-2 col-form-label">Sub Category</label>
					<div class="col-lg-3">
						<select class="form-control kt-select2 kt_select2_1 getSubCategory" id="sub_category" name="sub_category">
							<option value="">Select Category to view sub category</option>
						</select>
					</div>
				</div>
				<?php
					$dt = new DateTime();
				?>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Date Completed:</label>
					<div class="col-lg-3">
						<div class="input-group date">
							<input type="text" class="form-control datepicker" name="date" value="{{$dt->format('Y-m-d')}}" />
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-calendar"></i>
								</span>
							</div>
						</div>
						<span class="form-text text-muted">Use your custom date if needed</span>
					</div>
					<label class="col-lg-2 col-form-label">Material Usage :</label>
					<div class="col-lg-3">
						<input type="text" name="material" class="form-control" placeholder="">
					</div>
				</div>
				<div id="existingPart">
					<div class="form-group row">
						<label class="col-lg-2 col-form-label">Part:</label>
						<div class="col-lg-3">
							<select class="form-control kt-select2" id="kt_select2_3" name="existingPart[]" multiple="multiple">
								<optgroup label="Following are the available parts">
									@foreach ($parts as $part)
										<option value="{{$part->id}}">{{$part->part_no}}</option>
									@endforeach
								</optgroup>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-info" id="custonButton">
							Add custom Part
						</button>
					</div>
				</div>
				{{-- Add row by User starts --}}
				<div id="appendPosition" style="display: none;">
					<div class="form-group row" id="appendRow">
						<label class="col-lg-2 col-form-label">Part:</label>
						<div class="col-lg-2">
							<input type="text" class="form-control" name="custom_part_number[]" placeholder="Number here...">
						</div>
						<label class="col-lg-1 col-form-label">Costo:</label>
						<div class="col-lg-2">
							<input type="text" class="form-control" name="cost[]" placeholder="Cost here...">
						</div>
						<label class="col-lg-1 col-form-label">Currency:</label>
						<div class="col-lg-2">
							<div class="kt-radio-inline">
								<label class="kt-radio kt-radio--info">
									<input type="radio" name="currency[]" checked value="1"> USD
									<span></span>
								</label>
								<label class="kt-radio kt-radio--info">
									<input type="radio" name="currency[]" value="2"> MXD
									<span></span>
								</label>
							</div>
						</div>
						<div class="col-lg-2">
							<a href="javascript:;" class="btn-sm btn btn-label-danger btn-bold removeRow">
								<i class="la la-trash-o"></i>
								Delete
							</a>
						</div>
					</div>
					
				</div>
				<div class="form-group-row" id="appendButton" style="display: none;">
					<div class="col-lg-2 offset-lg-2">
						<a href="javascript:;" class="btn btn-bold btn-sm btn-label-brand appendCustomPart">
							<i class="la la-plus"></i> Add
						</a>
					</div>
				</div>
				{{-- Add row by User ends --}}
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">Could it have been prevented?</label>
					<div class="col-lg-3">
						<div class="kt-radio-inline">
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="prevention" checked value="1"> Yes
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid">
								<input type="radio" name="prevention" value="2"> No
								<span></span>
							</label>
						</div>
					</div>
					<label class="col-form-label col-lg-2 col-sm-12">Solution Provided:</label>
					<div class="col-lg-3 col-md-9 col-sm-12">
						<textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="solution"></textarea>
						<span class="form-text text-muted">Max length is 140.</span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2 col-sm-12">Explanation:</label>
					<div class="col-lg-3 col-md-9 col-sm-12">
						<textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="explanation"></textarea>
						<span class="form-text text-muted">Max length is 140.</span>
					</div>
					<label class="col-form-label col-lg-2 col-sm-12">Additional Comments:</label>
					<div class="col-lg-3 col-md-9 col-sm-12">
						<textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="comments"></textarea>
						<span class="form-text text-muted">Max length is 140.</span>
					</div>
				</div>
			<div class="kt-portlet__foot kt-portlet__foot--fit-x">
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-10">
							<button type="submit" class="btn btn-success">Submit</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!--end::Form-->
            </div>
        </div>

        <!--end:: View Ticket-->

    <!--End:: Portlet-->

      
    </div>
</div>
<!--End::Section-->
@endsection
@section('after-js')
	<script src="{{asset('/assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/js/demo1/scripts.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/js/demo1/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
	<script src="{{asset('/assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$("#custonButton").click(function() {
			var x = document.getElementById("existingPart");
			var y = document.getElementById("appendPosition");
	   var button = document.getElementById("appendButton");
			if (x.style.display === "none") {
				x.style.display = "block";
				y.style.display = "none";
				button.style.display = "none";
				
				document.getElementById("custonButton").innerHTML ="Add Custom Part" ;
				
			} else {
				x.style.display = "none";
				y.style.display = "block";
				button.style.display = "block";

				document.getElementById("custonButton").innerHTML =" Select Part ";
			}

		});
		$(document).on('change','.selectParentCategory',function(){
		var categoryParent = $(this).parent().parent();
		var category_id = $(this).val();
		var div = $(this).parent();
		var op="";

		//Second Ajax Call to get Sender Details
			$.ajax({
				type:'get',
				url:'/technician/get/sub_category',
				data:{'id':category_id},
				dataType:'json',
				success:function(data){
					console.log(data);

					if(!data.length){
						$("#sub_category").attr("disabled", true);
						return;
					}
					$("#sub_category").attr("disabled", false);
					var op = '<option value="0" selected disabled> Select sub category </option>';
					//var i can be pre define
					for(var i=0;i<data.length;i++){
					op += '<option value="'+data[i].id+'">'+data[i].sub_category+'</option>';
					console.log(op)
					}
					$(".getSubCategory").html("");
					$(".getSubCategory").append(op);
				},
				error:function(){

				}
			});
		//Second Ajax call ends
		});
	//Append Custom Part
	$(".appendCustomPart").click(function(){
		$("#appendRow").clone().appendTo("#appendPosition");
	});
	$(document).on("click", ".removeRow", function (e){
		// console.log($(this).parent())
	$(this).parent().parent().remove();
});
});
</script>
@endsection