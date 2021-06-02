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
                @if(!$tickets->isEmpty())
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{ route('updateTicketReviewByTechnician', ['id'=>$ticket->ticket_id]) }}" method="post">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Description of the Problem:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="description" value="{{$ticket->description}}" placeholder="Describe here..">
                                </div>
                                <label class="col-lg-2 col-form-label">Solution Provided:</label>
                                <div class="col-lg-3">
                                    <input type="text" name="solution" value="{{$ticket->solution}}" class="form-control" placeholder="">
                                    <input type="hidden" class="form-control" name="ticket_id" value="{{$ticket->ticket_id}}">
                                </div>
                            </div>
                            <?php
                                $dt = new DateTime();
                            ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Date Completed:</label>
                                <div class="col-lg-3">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="date" value="{{$ticket->date}}" value="{{$dt->format('Y-m-d')}}" />
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
                                    <input type="text" name="material" value="{{$ticket->material}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Part Number:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="part_number" value="{{$ticket->part_number}}" placeholder="">
                                </div>
                                <label class="col-lg-2 col-form-label">Costo:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="costo" value="{{$ticket->costo}}" placeholder="123xxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Could it have been prevented?</label>
                                <div class="col-lg-3">
                                    <div class="kt-radio-inline">
                                        @if($ticket->prevention == '1')
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="prevention" checked value="1"> Yes
                                                <span></span>
                                            </label>
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="prevention" value="2"> No
                                                <span></span>
                                            </label>
                                        @elseif($ticket->prevention == '2') 
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="prevention" value="1"> Yes
                                                <span></span>
                                            </label>   
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="prevention" checked value="2"> No
                                                <span></span> 
                                            </label>
                                        @endif    
                                    </div>
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12">Solution Provided:</label>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="solution"> {{$ticket->solution}} </textarea>
                                    <span class="form-text text-muted">Max length is 140.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12">Explanation:</label>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="explanation"> {{$ticket->explanation}} </textarea>
                                    <span class="form-text text-muted">Max length is 140.</span>
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12">Additional Comments:</label>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <textarea class="form-control" id="kt_maxlength_5" maxlength="220" placeholder="" rows="3" name="comments"> {{$ticket->comments}} </textarea>
                                    <span class="form-text text-muted">Max length is 140.</span>
                                </div>
                            </div>
                        <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <button type="update" class="btn btn-success">Update</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif

		<!--end::Form-->
            </div>
        </div>

        <!--end:: View Ticket-->

    <!--End:: Portlet-->

      
    </div>
</div>
<!--End::Section-->
@endsection