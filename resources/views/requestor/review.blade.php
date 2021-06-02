@extends('parent.admin')
@section('body')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="row">
      <!--Begin:: Portlet-->
      <!--begin:: View Ticket-->
      <div class="kt-portlet kt-portlet--height-fluid">
         <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
               <h3 class="kt-portlet__head-title">
                  @foreach ($views as $view)
                     {{$view->reviewTicket->request_id}}
                  @endforeach
               </h3>
            </div>
            <div class="kt-portlet__head-label">
               <a href="{{ URL::previous() }}" class="btn btn-info pull-right">Back</a>
            </div>
         </div>
         <div class="kt-portlet__body">
            @foreach ($views as $view)
               <section id="solution" class="container-fluid ml-auto mr-auto">
                  <div class="row">
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Description of The Problem:</h3>
                  </div>
                  <div class="col-lg-9 col-md-9">
                     <p class="ticket-data"> {{$view->description}} </p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Date Completed:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data col-border">{{$view->date}}</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Part Number:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data">{{$view->part_number}}
                     <p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Material Usage</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data col-border">{{$view->material}}</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Could it have been Prevented?</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     @if($view->prevention == '1')
                        <p class="ticket-data text-info"> Yes </p>
                     @elseif($view->prevention == '2')
                        <p class="ticket-data text-danger">No</p>
                     @endif
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Costo:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data col-border"> {{$view->costo}} </p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Review Date:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data" style="margin-top:14px">{{$view->created_at->toFormattedDateString()}}</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Solution Provided:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data col-border">{{$view->solution}}</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Updated Date:</h3>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <p class="ticket-data" style="margin-top:14px">{{$view->updated_at->toFormattedDateString()}} ({{$view->updated_at->diffForHumans()}})</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Explanation:</h3>
                  </div>
                  <div class="col-lg-9 col-md-9">
                     <p class="ticket-data">{{$view->explanation}}</p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                     <h3 class="ticket-fields">Additional Comments:</h3>
                  </div>
                  <div class="col-lg-9 col-md-9">
                     <p class="ticket-data">{{$view->comments}}</p>
                  </div>
               </section>
               <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                  <div class="kt-form__actions">
                     <div class="row">
                     <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                           @if($view->reviewTicket->status != '4')
                              <a type="submit" href="{{ route('approveByRequestor', ['id'=>$view->ticket_id]) }}" class="btn btn-success">Approve Now</a>
                              <a href="{{ URL::previous() }}" type="reset" class="btn btn-secondary">Back</a>
                           @endif   
                     </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
      <!--end:: View Ticket-->
      <!--End:: Portlet-->
   </div>
</div>
<!--End::Section-->
@endsection