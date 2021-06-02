@extends('parent.admin')
@section('body')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="row">
      <!--Begin:: Portlet-->
        <!--begin:: View Ticket-->
          @foreach ($views as $view)
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">
                      {{$view->request_id}}
                  </h3>
                </div>
                <div class="kt-portlet__head-label">
                  <a href="{{ URL::previous() }}" class="btn btn-info pull-right">Back</a>
                </div>
            </div>
            <div class="kt-portlet__body">
              <section id="fields" class="container-fluid ml-auto mr-auto">

                <div class="row" style="padding: 4%;">

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Machine Description:</h3>
                    </div>

                    <div class="col-lg-9 col-md-9">
                      <p class="ticket-data">{{$view->machine_description}}</p>
                    </div>

                    <hr>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">BRP#:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                    <p class="ticket-data col-border">{{$view->brp}}</p>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Priority level:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      @if($view->priority_level == '1')
                        <p class="ticket-data text-info">Low</p>
                      @elseif($view->priority_level == '1')
                        <p class="ticket-data text-danger">High</p>
                      @endif  
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Supervisor Name:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <p class="ticket-data col-border">{{$view->supervisor_name}}</p>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Request open:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <p class="ticket-data text-info">{{$view->created_at->toFormattedDateString()}}</p>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Status:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      @if($view->status == '1')
                        <p class="ticket-data col-border text-info">Open</p>
                      @elseif($view->status == '2')
                        <p class="ticket-data col-border text-warning"> Processing </p>
                      @elseif($view->status == '3')
                        <p class="ticket-data col-border text-warning"> Waiting for Approval </p>
                      @endif

                    </div>

                    <div class="col-lg-3 col-md-3">
                      @foreach ($view->ticketHistory as $history)
                        @if($history->flag == '2')
                          <h3 class="ticket-fields">Request Assigned:</h3>
                        @endif
                      @endforeach
                    </div>
                    <div class="col-lg-3 col-md-3">
                      @foreach ($view->ticketHistory as $history)
                        @if($history->flag == '2')
                          <p class="ticket-data text-info">{{$history->created_at->toFormattedDateString()}}</p>
                        @endif
                      @endforeach
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Cost & center line:</h3>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <p class="ticket-data col-border">{{$view->cost_center_line}}</p>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      @foreach ($view->ticketHistory as $history)
                        @if($history->flag == '3')
                          <h3 class="ticket-fields">Request complete:</h3>
                        @endif
                      @endforeach
                    </div>
                    
                    <div class="col-lg-3 col-md-3">
                      @foreach ($view->ticketHistory as $history)
                        @if($history->flag == '3')
                          <p class="ticket-data text-info">{{$history->created_at->toFormattedDateString()}}</p>
                        @endif
                      @endforeach
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <h3 class="ticket-fields">Description of the Problem:</h3>
                    </div>

                    <div class="col-lg-9 col-md-9">
                      <p class="ticket-data">{{$view->description_of_problem}}</p>
                    </div>
                </div>

              </section>
            </div>
          </div>
          @endforeach
        <!--end:: View Ticket-->
      <!--End:: Portlet-->
   </div>
</div>
<!--End::Section-->
@endsection