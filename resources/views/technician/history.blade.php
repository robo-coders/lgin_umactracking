@extends('parent.admin')
@section('body')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="kt-portlet">
      <!--Begin::Section-->
      <div class="row">
         <div class="col-xl-12">
            <!--begin:: Widgets/Tasks -->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Tickets
                     </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                     <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">
                           Completed
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget2_tab1_content">
                        <div class="kt-widget2">
                           @if(!$requests->isEmpty())
                            @foreach ($requests as $request)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="kt-widget2__item kt-widget2__item--success">
                                            <div class="kt-widget2__checkbox">
                                            {{--  --}}
                                            </div>
                                            <div class="col-md-2">
                                            <div class="kt-widget2__info">
                                                <a href="#" class="kt-widget2__title">
                                                {{$request->request_id}} || {{$request->supervisor_name}}
                                                </a>
                                                <a href="#" class="kt-widget2__username">
                                                @if($request->priority_level == '1')
                                                <span class="kt-widget3__status kt-font-brand">
                                                Normal
                                                </span>
                                                @elseif($request->priority_level == '2')
                                                <span class="kt-widget3__status kt-font-danger">
                                                High
                                                </span>
                                                @endif
                                                </a>
                                            </div>
                                            </div>
                                            <div class="col-md-2">
                                            <div class="kt-widget2__info">
                                                <a href="#" class="kt-widget2__title">
                                                Request open
                                                </a>
                                                <a href="#" class="kt-widget2__username">
                                                <span class="kt-widget3__status kt-font-brand">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $request->created_at->toFormattedDateString()}}
                                                </span>
                                                </a>
                                            </div>
                                            </div>
                                            @foreach ($request->ticketHistory as $history)
                                                @if($history->flag == '2')
                                                    <div class="col-md-2">
                                                        <div class="kt-widget2__info">
                                                            <a href="#" class="kt-widget2__title">
                                                            Assign Date & Time
                                                            </a>
                                                            <a href="#" class="kt-widget2__username">
                                                            <span class="kt-widget3__status kt-font-brand">
                                                            &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @elseif($history->flag == '3')
                                                        <div class="col-md-3">
                                                            <div class="kt-widget2__info">
                                                                <a href="#" class="kt-widget2__title">
                                                                Complete Date & Time
                                                                </a>
                                                                <a href="#" class="kt-widget2__username">
                                                                <span class="kt-widget3__status kt-font-brand">
                                                                &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                                                </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @elseif($history->flag == '4')
                                                        <div class="col-md-2">
                                                            <div class="kt-widget2__info">
                                                                <a href="#" class="kt-widget2__title">
                                                                Approve Date & Time
                                                                </a>
                                                                <a href="#" class="kt-widget2__username">
                                                                <span class="kt-widget3__status kt-font-brand">
                                                                &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                                                </span>
                                                                </a>
                                                            </div>
                                                        </div>    
                                                @endif
                                            @endforeach
                                            <div class="kt-widget2__actions">
                                            <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                            <i class="flaticon-more-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__item">
                                                    <a href="{{ route('viewTicketByTechnician', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">Request</span>
                                                    </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                    <a href="{{ route('viewReviewByTechnician', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">Review</span>
                                                    </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           @else
                            {{-- Null Row Start --}}
                            <div class="col-md-12 text-danger">
                                <h5 class="text-center"> No record Found</h5>
                            </div>
                            {{-- Null row ends --}}
                           @endif
                        </div>
                     </div>
                     {{-- Today Tab Ends --}}
                  </div>
               </div>
            </div>
            <!--end:: Widgets/Tasks -->
         </div>
      </div>
      <!--End::Section-->
   </div>
</div>
@endsection